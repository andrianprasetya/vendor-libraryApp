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
use Illuminate\Support\Facades\Storage;

class FinesController extends Controller
{
    public function __construct()
    {
        $this->menu = 'Denda';
        $this->slug = $this->slugs['web'] . 'sirkulasi.denda';
        $this->route = $this->routes['web'] . 'sirkulasi.denda';
        $this->view = $this->views['web'] . 'sirkulasi.denda';
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

    /*public function create()
    {
        try {
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="active breadcrumb-item">' . 'Mulai Peminjaman' . '</li>');
            return view($this->view . '.create', compact('breadcrumb'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }

    }*/

  /*  public function getDataUser(Request $request)
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
    }*/

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
dd($row->loan);
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "title" => $row->student->name,
                    "loan" => $row->loan->book_id->title,
                    "name" => $row->student->name,
                    "late" => $row->late,
                    "object" => $row->object == 0 ? 'Uang' : 'Buku'
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


}
