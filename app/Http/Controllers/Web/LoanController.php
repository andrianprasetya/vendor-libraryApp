<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            $book = Book::query()->where('call_number', $request->call_number)->first();
            $items = array(
                "id" => $book->id,
                "book_series" => $book->book_series,
                "title" => $book->title,
                "date_loan" => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                "deadline" => Carbon::now('Asia/Jakarta')->addDay(7)->format('Y-m-d'),
            );

            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " - " . $e->getFile() . " - " . $e->getLine());
            abort(404);
        }
    }

    public function getDatatableSingle(Request $request)
    {
        try {
            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
            $limit = (int)$length > 0 ? $length : 10;

            $conditions = '1 = 1';

            $countAll = Book::query()->count();
            $paginate = Book::query()->select('*')
                ->where('call_number', $request->call_number)
                ->whereRaw($conditions)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();

            foreach ($paginate->items() as $idx => $row) {
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "book_series" => $row->book_series,
                    "title" => $row->title,
                    "date_loan" => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
                    "deadline" => Carbon::now('Asia/Jakarta')->addDay(7)->format('Y-m-d'),
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

            $conditions = '1 = 1';

            $countAll = Loan::query()->count();
            $paginate = Loan::query()->select('*')
                ->whereRaw($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();

            foreach ($paginate->items() as $idx => $row) {
                $routeDetail = $row->is_returned == "t" ? "#":route("web::sirkulasi.peminjaman.show", $row['id']);
                $action = null;
                $action .= '<div class="row text-center"><div class="col-md-6">';
                $action .= '<a href="' . $routeDetail . '" style="margin:10px" class="text-light-blue disabled" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fas fa-arrow-circle-right"></i></a>';
                $action .= '</div></div>';
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "title" => $row->book->title,
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

            Loan::query()->create([
                'book_id' => $request->book_id,
                'siswa_id' => $request->siswa_id,
                'tgl_peminjaman' => $request->date_loan,
                'deadline' => $request->deadline,
            ]);

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
            $date1 = strtotime($data->tgl_deadline);
            $date2 = strtotime(\Carbon\Carbon::now()->format('Y-m-d'));

            $diff = null;


            return view($this->view . '.show', compact('breadcrumb', 'data','diff'));

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
                'tgl_pengembalian' => Carbon::now()->format('Y-m-d'),
                'is_returned' => true
            ]);
            DB::commit();
            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function denda(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $item = Loan::query()->findOrFail($id);

            $item->update([
                'tgl_pengembalian' => Carbon::now()->format('Y-m-d'),
                'is_returned' => true
            ]);
            DB::commit();
            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }
}
