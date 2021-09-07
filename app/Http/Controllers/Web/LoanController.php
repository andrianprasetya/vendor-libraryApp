<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\CodeBook;
use App\Models\Extend;
use App\Models\Fines;
use App\Models\Loan;
use App\Models\PatternBook;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function __construct()
    {
        $this->menu = 'peminjaman';
        $this->slug = $this->slugs['web'] . 'sirkulasi.peminjaman';
        $this->route = $this->routes['web'] . 'sirkulasi.peminjaman';
        $this->view = $this->views['web'] . 'sirkulasi.peminjaman';
        $this->breadcrumb = '<li class="breadcrumb-item"><a href="' . route($this->route . '.index') . '">' . $this->menu . '</a></li>';
        $this->share();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);

        return view($this->view . '.index', compact('breadcrumb'));
    }

    public function create()
    {
        try {
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="active breadcrumb-item">' . 'Mulai Peminjaman' . '</li>');
            return view($this->view . '.create', compact('breadcrumb'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }

    }

    public function getDataUser(Request $request)
    {
        try {
            $user = User::query()->where('nis', $request->nis)->first();
            $items = array(
                "id" => $user->id,
                "nis" => $user->nis,
                "name" => $user->name,
                "created_at" => date_format($user->created_at, "d/m/Y"),
            );
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " - " . $e->getFile() . " - " . $e->getLine());
            abort(404);
        }
    }

    public function getDataBook(Request $request)
    {
        try {
            $codeBook = CodeBook::query()->where('code', $request->code)->first();
            $book = Book::query()->where('id', $codeBook->book_id)->first();


            if ($codeBook->is_loan != true) {
                $items = array(
                    "id" => $book->id,
                    "code" => $codeBook->code,
                    "title" => $book->title,
                    "date_loan" => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                    "deadline" => Carbon::now('Asia/Jakarta')->addDay(7)->format('Y-m-d'),
                    "message" => "success"
                );
            } else {
                $items = array(
                    "message" => "fail"
                );
            }
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " - " . $e->getFile() . " - " . $e->getLine());
            abort(404);
        }
    }

    public function getDatatable(Request $request)
    {
        try {
            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
            $limit = (int)$length > 0 ? $length : 10;
            $columnIndex = $request->input('order')[0]['column'];
            $columnName = $request->input('columns')[$columnIndex]['data'];
            $columnSortOrder = $request->input('order')[0]['dir'];
            $searchValue = $request->input('search')['value'];

            $conditions = '1 = 1';

            if (!empty($searchValue)) {
                $conditions .= " AND code ILIKE '%" . trim($searchValue) . "%'";
            }
            $countAll = Loan::query()->count();
            $paginate = Loan::query()->select('*')
                ->whereRaw($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();

            foreach ($paginate->items() as $idx => $row) {
                $routeReturn = $row->is_returned == true ? "#" : route("web::sirkulasi.peminjaman.show", $row['id']);
                $routeExtend = Carbon::now('Asia/Jakarta')->toIso8601String() < $row->deadline && $row->is_returned == false ? route("web::sirkulasi.peminjaman.extend", $row['id']) : "#";
                $action = null;
                $action .= '<div class="row text-center"><div class="col-md-6">';
                $action .= '<a href="' . $routeReturn . '" style="margin:10px" class="text-light-blue disabled" data-toggle="tooltip" data-placement="bottom" title="Return"><i class="fas fa-arrow-circle-right"></i></a>';
                $action .= '</div><div class="col-md-6">';
                $action .= '<a href="' . $routeExtend . '" style="margin:10px" class="text-light-green disabled" data-toggle="tooltip" data-placement="bottom" title="Extend"><i class="fas fa-clock"></i></a>';
                $action .= '</div></div>';
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "title" => $row->book->title,
                    "code" => $row->code,
                    "name" => $row->student->name,
                    "date_loan" => $row->tgl_peminjaman,
                    "deadline" => $row->deadline,
                    "date_return" => $row->tgl_pengembalian,
                    "is_returned" => $row->is_returned,
                    "action" => $action
                );
            }
            $response = array(
                "draw" => (int)$draw,
                "recordsTotal" => (int)$countAll,
                "recordsFiltered" => (int)$paginate->total(),
                "data" => $items
            );
            return response()->json($response);

        } catch (\Exception $e) {
            Log::error($e->getMessage() . " - " . $e->getFile() . " - " . $e->getLine());
            abort(404);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::query()->where('id', $request->siswa_id)->first();

            $book_list = "";
            $tgl_pinjam = "";
            $tgl_kembali = "";
            foreach ($request->books as $key => $book) {
                Loan::query()->create([
                    'book_id' => $book['id'],
                    'siswa_id' => $request->siswa_id,
                    'code' => $book['code'],
                    'tgl_peminjaman' => $book['date_loan'],
                    'deadline' => $book['deadline'],
                ]);

                $tgl_pinjam = $book['date_loan'];
                $tgl_kembali = $book['deadline'];
                $bookData = Book::query()->where('id', $book['id'])->first();

                if ($key > 0) {
                    $book_list = $book_list . "," . $bookData->title.' - '.$book['code'];
                } else {
                    $book_list = $bookData->title.' - '.$book['code'];
                }
                $codeBook = CodeBook::query()->where('book_id', $book['id'])->where('code', $book['code'])->first();
                $codeBook->update([
                    'is_loan' => true
                ]);
            }

            $to_name = $user->name;
            $to_email = $user->email;
            $data = array('name' => $user->name, "kelas" => $user->kelas, "title" => $book_list, 'tgl_pinjam' => $tgl_pinjam, 'tgl_kembali' => $tgl_kembali);
            Mail::send($this->view . '.email.mail', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('Peminjaman Buku');
                $message->from(env('MAIL_USERNAME'), 'Peminjaman Buku SMA Angkasa');
            });

            DB::commit();

            return redirect()->route($this->route . '.index');
        } catch
        (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function show($id)
    {
        try {
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="breadcrumb-item active">' . 'Pengembalian Buku' . '</li>');
            $data = Loan::query()->findOrFail($id);

            $date1 = $data->deadline;
            $date2 = Carbon::now('Asia/Jakarta')->toIso8601String();


            $datetime1 = new DateTime($date1);
            $datetime2 = new DateTime($date2);
            $interval = $datetime2->diff($datetime1);
            $days = $interval->format('%a');

            $dendaNominal = 500 * $days;

            return view($this->view . '.show', compact('breadcrumb', 'data', 'days', 'dendaNominal'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function extend($id)
    {
        try {

            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="breadcrumb-item active">' . 'Perpanjangan Pinjaman' . '</li>');
            $data = Loan::query()->findOrFail($id);

            return view($this->view . '.extend', compact('breadcrumb', 'data'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function return(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = Loan::query()->findOrFail($id);
            $item->update([
                'tgl_pengembalian' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                'is_returned' => true
            ]);
            $codeBook = CodeBook::query()->where('book_id', $item->book_id)->where('code', $item->code)->first();
            $codeBook->update(['is_loan' => false]);

            DB::commit();
            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function perpanjangan(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = Loan::query()->findOrFail($id);
            $item->update([
                'deadline' => $request->extend_time,
            ]);


            $validator = Validator::make($request->all(), [
                'extend_time' => 'after:' . $request->due_date
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route . '.extend', $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            Extend::query()->create([
                'loan_id' => $request->loan_id,
                'siswa_id' => $request->siswa_id,
                'due_date_before' => $request->due_date,
                'due_date_after' => $request->extend_time,
            ]);
            DB::commit();
            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function dendaNominal(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = Loan::query()->findOrFail($id);

            $item->update([
                'tgl_pengembalian' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                'is_returned' => true
            ]);
            $codeBook = CodeBook::query()->where('book_id', $item->book_id)->where('code', $item->code)->first();
            $codeBook->update(['is_loan' => false]);

            $siswa = User::query()->where('nis', $request->nis)->first();
            Fines::query()->create([
                'siswa_id' => $siswa->id,
                'loan_id' => $id,
                'late' => $request->late,
                'nominal' => $request->dendaNominal,
                'object' => 0,
                'description' => $request->description
            ]);
            DB::commit();
            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function dendaBook(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = Loan::query()->findOrFail($id);

            $item->update([
                'tgl_pengembalian' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                'is_returned' => true
            ]);
            $codeBook = CodeBook::query()->where('book_id', $item->book_id)->where('code', $item->code)->first();
            $codeBook->update(['is_loan' => false]);

            $siswa = User::query()->where('nis', $request->nis)->first();
            Fines::query()->create([
                'siswa_id' => $siswa->id,
                'loan_id' => $id,
                'book_id' => $request->dendaBook,
                'late' => $request->late,
                'object' => 1,
                'description' => $request->description
            ]);

            $book = Book::query()->findOrFail($request->dendaBook);


            $existingCode = codeBook::query()->where('book_id', $book->id);
            $countExistingCode = $existingCode != null ? $existingCode->count() : 0;

            if ($countExistingCode > 0) {
                $modelExistingCode = $existingCode->first();
                $maxSequenceExistingBook = Book::query()->where('id', $modelExistingCode->book_id)->max('sequence');
                $modelExistingBook = Book::query()->where('id', $modelExistingCode->book_id)->where('sequence', $maxSequenceExistingBook)->first();
                $defaultExistingTotalItem = $modelExistingBook->total_item;
            }
            $PatternCode = PatternBook::query()->findOrFail($modelExistingCode->pattern_book_id);

            $book->update([
                'total_item' => $book->total_item + 1
            ]);

            CodeBook::query()->create([
                'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                'book_id' => $book->id,
                'pattern_book_id' => $PatternCode->id,
                'code' => $PatternCode->code . (1 + $defaultExistingTotalItem),
                'collection' => $modelExistingCode->collection,
                'location' => $modelExistingCode->location,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            DB::commit();
            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function getBook(Request $request)
    {
        try {
            $books = Book::query()->where('title', 'LIKE', '%' . $request->input("term", "") . '%')->get();
            $items = array();
            foreach ($books as $book) {
                $items[] = array(
                    "id" => $book->id,
                    "text" => $book->title
                );
            }
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }
}
