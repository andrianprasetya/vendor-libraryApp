<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\CodeBook;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->menu = 'Laporan';
        $this->slug = $this->slugs['web'] . 'report';
        $this->route = $this->routes['web'] . 'report';
        $this->view = $this->views['web'] . 'report';
        $this->breadcrumb = '<li class="breadcrumb-item"><a href="' . route($this->route . '.member') . '">' . $this->menu . '</a></li>';
        $this->share();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function reportMember()
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);
        return view($this->view . '.member.index', compact('breadcrumb'));
    }

    public function detailMember()
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);
        return view($this->view . '.member.detail', compact('breadcrumb'));
    }

    public function getDatatableMember(Request $request)
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
                $conditions .= " AND name ILIKE '%" . trim($searchValue) . "%'";
            }

            $countAll = User::query()->count();
            $paginate = User::query()->select('*')
                ->whereHas('roles', function ($q) {
                    $q->where('slug', '=', 'siswa');
                })
                ->whereRaw($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();

            foreach ($paginate->items() as $idx => $row) {
                $routeDetail = route("web::report.detail-member", $row['id']);
                $action = null;
                $action .= '<div class="row text-center"><div class="col-md-6">';
                $action .= '<a href="' . $routeDetail . '" style="margin:10px" class="text-light-blue" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-eye"></i></a>';
                $action .= '</div></div>';

                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "name" => $row->name,
                    "kelas" => $row->kelas,
                    "nis" => $row->nis,
                    "action" => $action,
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
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function getDatatableDetailMember(Request $request)
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
                $routeAction = $row->is_returned == "t" ? "#" : route("web::sirkulasi.peminjaman.show", $row['id']);
                $action = null;
                $action .= '<div class="row text-center"><div class="col-md-6">';
                $action .= '<a href="' . $routeAction . '" style="margin:10px" class="text-light-blue disabled" data-toggle="tooltip" data-placement="bottom" title="Return"><i class="fas fa-arrow-circle-right"></i></a>';
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

    public function reportCollection()
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);
        return view($this->view . '.koleksi.index', compact('breadcrumb'));
    }

    public function getDatatableCollection(Request $request)
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
                $conditions .= " AND name ILIKE '%" . trim($searchValue) . "%'";
            }
            $countAll = Book::query()->count();
            $paginate = Book::query()->selectRaw('collection,count(*) AS total_title,sum(total_item) AS all_item')
                ->groupBy('collection')
                ->whereRaw($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();
            foreach ($paginate->items() as $idx => $row) {
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "collection" => $row->collection,
                    "title_count" => $row->total_title,
                    "satuan_count" => $row->all_item,
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
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function reportLanguage()
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);
        return view($this->view . '.bahasa.index', compact('breadcrumb'));
    }

    public function getDatatableLanguage(Request $request)
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
                $conditions .= " AND name ILIKE '%" . trim($searchValue) . "%'";
            }
            $countAll = Book::query()->count();
            $paginate = Book::query()->selectRaw('language,count(*) AS item, sum(total_item) AS total_item')
                ->whereRaw($conditions)
                ->groupBy('language')
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();
            foreach ($paginate->items() as $idx => $row) {
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "language" => $row->language,
                    "item" => $row->item,
                    "total_item" => $row->total_item,
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
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function reportGMD()
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);
        return view($this->view . '.gmd.index', compact('breadcrumb'));
    }

    public function getDatatableGMD(Request $request)
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
                $conditions .= " AND GMD ILIKE '%" . trim($searchValue) . "%'";
            }
            $countAll = Book::query()->count();
            $paginate = Book::query()->selectRaw('gmd ,count(*) as title, sum(total_item) as item')
                ->groupBy('gmd')
                ->whereRaw($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();
            foreach ($paginate->items() as $idx => $row) {
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "gmd" => $row->gmd,
                    "title" => $row->title,
                    "item" => $row->item,
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
            Log::error($e->getMessage());
            abort(404);
        }
    }

}
