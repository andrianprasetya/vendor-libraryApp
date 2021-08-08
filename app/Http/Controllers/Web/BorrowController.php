<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BorrowController extends Controller
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
    public function getDataUser(Request $request){
        try {
            dd($request->id);
            $users = User::query()->where('nis', $request->id)->get();
            $items = array();
            foreach ($users as $user) {
                $items[] = array(
                    "nis" => $user->id,
                    "nama" => $user->name,
                    "created_at" => $user->created_at
                );
            }
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }
}
