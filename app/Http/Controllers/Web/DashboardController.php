<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = 'Dashboard';
        $this->slug = $this->slugs['web'].'dashboard';
        $this->route = $this->routes['web'].'.dashboard';
        $this->view = $this->views['web'].'.dashboard';
        $this->share();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view($this->view.'.index');
    }
}
