<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\District;
use App\Models\Loan;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

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
        $data = null;
        return view($this->view . '.index', compact('breadcrumb','data'));
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
                $conditions .= " AND name ILIKE '%" . trim($searchValue) . "%'";
            }

            $countAll = User::query()->count();
            $paginate = User::query()->select('*')
                ->whereHas('roles' , function ($q){
                    $q->where('slug','=','siswa');
                })
                ->whereRaw($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();

            foreach ($paginate->items() as $idx => $row) {
                $routeDetail = route("web::member.show", $row['id']);
                $routeEdit = route("web::member.edit", $row['id']);
                $routeCard = route("web::member.print-card", $row['id']);
                $routeDelete = route("web::member.destroy", $row['id']);
                $action = null;
                $action .= '<div class="row text-center"><div class="col-md-3">';
                $action .= '<a href="' . $routeDetail . '" style="margin:10px" class="text-light-blue" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-eye"></i></a>';
                $action .= '</div><div class="col-md-3">';
                $action .= '<a href="' . $routeEdit . '" style="margin:10px" class="text-yellow"  data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>';
                $action .= '</div><div class="col-md-3">';
                $action .= '<a href="' . $routeCard . '" style="margin:10px" class="text-green"  data-toggle="tooltip" data-placement="bottom" title="Print" target="_blank"><i class="fa fa-print"></i></a>';
                $action .= '</div><div class="col-md-3">';
                $action .= '<a href="' . $routeDelete . '" style="margin:10px" class="text-green delete"  data-toggle="tooltip" data-singleton="true" data-popout="true" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></a>';
                $action .= '</div></div>';

                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    "name" => $row->name,
                    "email" => $row->email,
                    "nis" => $row->nis,
                    "birthday" => $row->birthday,
                    "gender" => $row->gender == 'L' ? "Laki-Laki" : ($row->gender != null ? "Perempuan" : ""),
                    "address" => $row->address,
                    "districts" => $row->district_id != null ? $row->district->name : '',
                    "regency" => $row->regency_id != null ? $row->regency->name : '',
                    "province" => $row->province_id != null ? $row->province->name : '',
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'nis' => 'required|unique:users',
                'name' => 'required',
                'email' => 'required|unique:users',
                'kelas' => 'required',
                'password' => 'required',
                'address' => 'required',
                'province' => 'required',
                'regency' => 'required',
                'district'  => 'required',
                'code_pos'  => 'required',
                'birthday'  => 'required',
                'no_telp'  => 'required|numeric',
                'institution' => 'required',
                'image' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route . '.create')
                    ->withErrors($validator)
                    ->withInput();
            }


            $storagePath = "";
            if ($request->hasFile('image')) {
                foreach ($request->file() as $files) {
                    $path = 'public/images';
                    $storagePath = Storage::disk()->put($path, $files);
                }

                $member = User::query()->create([
                    'nis' => $request->nis,
                    'name' => $request->name,
                    'address' => $request->address,
                    'kelas' => $request->kelas,
                    'province_id' => $request->province,
                    'regency_id' => $request->regency,
                    'district_id' => $request->district,
                    'code_pos' => $request->code_pos,
                    'gender' => $request->gender,
                    'birthday' => date('Y-m-d', strtotime($request->birthday)),
                    'no_telp' => $request->no_telp,
                    'institution' => $request->institution,
                    'email' => $request->email,
                    'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                    'image' => $storagePath,
                    'expire' => Carbon::now('Asia/Jakarta')->addDay(30)->format('Y-m-d')
                ]);

                $roleSiswa = Role::query()->where('slug', '=', 'siswa')->first();

                $member->roles()->attach($roleSiswa, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            }
            DB::commit();

            return redirect()->route($this->route . '.index');
        } catch
        (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $isEdit = false;
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="breadcrumb-item active">' . 'Detail Member' . '</li>');
            $data = User::findOrFail($id);
            return view($this->view . '.show', compact('breadcrumb', 'data','isEdit'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function printCard($id)
    {
        try {

            $data = User::query()->findOrFail($id);

            $chekLoan = Loan::query()->where('siswa_id',$data->id)->where('is_returned',false)->count();
            if($chekLoan > 0){
                return redirect(URL::previous())->with('status', 'User Masih ada Peminjaman');
            }
            $pdf = PDF::loadView($this->view . '.pdf.card', compact('data', 'initial'))
                ->setOption('page-width', '320.0')
                ->setOption('page-height', '180.0')
                ->save(storage_path('app/public/pdf/card/kartu_perpustakaan_' . $data->id . '.pdf'), true);

            return $pdf->download(asset('storage/pdf/card/kartu_perpustakaan_'.$data->id.'.pdf'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function changePassword(Request $request ,$id)
    {  DB::beginTransaction();
        try {
            if ($request->password != $request->konfirmasi_password){
                return redirect(URL::previous())->with('status', 'Password Tidak Sesuai / Tida sama');
            }

            $student = User::query()->findOrFail($id);
            $student->update(['password' => Hash::make($request->password)]);
            DB::commit();
            return redirect()->route('web::dashboard.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $isEdit = true;
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="breadcrumb-item active">' . 'Ubah Anggota' . '</li>');

            $data = User::query()->findOrFail($id);
            $provinces = Province::query()->get();
            $districts = District::query()->get();
            $regencies = Regency::query()->get();

            $provinceSelected = $data->province()->get();

            $listSelectedProvince = array();
            foreach ($provinceSelected as $g) {
                $listSelectedProvince[$g->id] = $g->id;
            }
            $districtSelected = $data->district()->get();

            $listSelectedDistrict = array();
            foreach ($districtSelected as $g) {
                $listSelectedDistrict[$g->id] = $g->id;
            }
            $regencySelected = $data->regency()->get();

            $listSelectedRegency = array();
            foreach ($regencySelected as $g) {
                $listSelectedRegency[$g->id] = $g->id;
            }

            return view($this->view . '.edit', compact('breadcrumb', 'data','isEdit','provinces','districts','regencies', 'listSelectedProvince',
                'listSelectedDistrict' , 'listSelectedRegency'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }
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
        DB::beginTransaction();

        try {

            $data = User::query()->findOrFail($id);
            $validator = Validator::make($request->all(), [
                'nis' => 'required|unique:users,nis,'.$id,
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$id,
                'kelas' => 'required',
                'address' => 'required',
                'province' => 'required',
                'regency' => 'required',
                'district'  => 'required',
                'code_pos'  => 'required',
                'birthday'  => 'required',
                'no_telp'  => 'required|numeric',
                'institution' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route . '.edit', $id)
                    ->withErrors($validator)
                    ->withInput();
            }

            $storagePath = "";
            if ($request->hasFile('image')) {

                if (Storage::exists($data->image)) {
                    Storage::delete($data->image);
                }

                foreach ($request->file() as $files) {
                    $path = 'public/images';
                    $storagePath = Storage::disk()->put($path, $files);
                }
            }
                $data->update([
                    'nis' => $request->nis,
                    'name' => $request->name,
                    'address' => $request->address,
                    'kelas' => $request->kelas,
                    'province_id' => $request->province,
                    'regency_id' => $request->regency,
                    'district_id' => $request->district,
                    'code_pos' => $request->code_pos,
                    'gender' => $request->gender,
                    'birthday' => $request->birthday,
                    'no_telp' => $request->no_telp,
                    'institution' => $request->institution,
                    'email' => $request->email,
                    'password' => $request->password != null ? $request->password : $data->password,
                    'image' => $storagePath != null ? $storagePath : $data->image,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::query()->findOrFail($id);
        $item->delete();
        return redirect(URL::previous())->with('status','Delete Successfully');
    }
}
