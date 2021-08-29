<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = 'Profile';
        $this->slug = $this->slugs['web'].'profile';
        $this->route = $this->routes['web'].'profile';
        $this->view = $this->views['web'].'.profile';
        $this->breadcrumb = '<li class="breadcrumb-item"><a href="' . route($this->route . '.index') . '">' . $this->menu . '</a></li>';
        $this->share();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);
        $data = User::query()->where('id',auth()->user()->id)->first();

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

        return view($this->view.'.index', compact('breadcrumb','data','provinces','districts','regencies', 'listSelectedProvince',
            'listSelectedDistrict' , 'listSelectedRegency'));
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
}
