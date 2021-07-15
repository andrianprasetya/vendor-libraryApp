<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{

    public function __construct()
    {
        $this->menu = 'member';
        $this->slug = $this->slugs['web'] . 'member';
        $this->route = $this->routes['web'] . 'member';
        $this->view = $this->views['web'] . 'member';
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
                $conditions .= " AND name ILIKE '%" . trim($searchValue) . "%'" . "OR name ILIKE '%" . trim($searchValue) . "%'";
            }

            $countAll = User::query()->count();
            $paginate = User::query()->select('*')
                ->whereRaw($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();

            foreach ($paginate->items() as $idx => $row) {
                /*$routeDetail = route("backend::outlet.show", $row['id']);
                $routeEdit = route("backend::outlet.edit", $row['id']);*/
                $action = null;
                /*$select = null;
                $action .= '<div class="row text-center"><div class="col-md-6">';
                $action .= '<a href="' . $routeDetail . '" style="margin:10px" class="text-light-blue" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-eye"></i></a>';
                $action .= '</div><div class="col-md-6">';
                $action .= '<a href="' . $routeEdit . '" style="margin:10px" class="text-yellow"  data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>';
                $action .= '</div></div>';*/
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "name" => $row->name,
                    "email" => $row->email,
                    "nis" => $row->nis,
                    "birthday" => $row->birthday,
                    "gender" => $row->gender,
                    "address" => $row->address,
                    "districts" => $row->districts,
                    "regency" => $row->regency,
                    "province" => $row->province,
                    "institution" => $row->institution,
                    "code_pos" => $row->code_pos,
                    "no_telp" => $row->no_telp,
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="active breadcrumb-item">' . 'Buat Anggota' . '</li>');
            return view($this->view . '.create', compact('breadcrumb'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }

    }

    public function getProvince(Request $request)
    {
        try {
            $provinces = Province::query()->where('name', 'ILIKE', '%' . $request->input("term", "") . '%')->get();
            $items = array();
            foreach ($provinces as $province) {
                $items[] = array(
                    "id" => $province->id,
                    "text" => $province->name
                );
            }
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function getDistrict(Request $request)
    {
        try {
            $districts = District::query()->where('regency_id', $request->id)->where('name', 'ILIKE', '%' . $request->searchTerm . '%')->get();
            $items = array();
            foreach ($districts as $district) {
                $items[] = array(
                    "id" => $district->id,
                    "text" => $district->name
                );
            }
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function getRegency(Request $request)
    {
        try {
            $regencies = Regency::query()->where('province_id', $request->id)->where('name', 'ILIKE', '%' . $request->searchTerm . '%')->get();
            $items = array();
            foreach ($regencies as $regency) {
                $items[] = array(
                    "id" => $regency->id,
                    "text" => $regency->name
                );
            }
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
