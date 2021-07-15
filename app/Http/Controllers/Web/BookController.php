<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function __construct()
    {
        $this->menu = 'buku';
        $this->slug = $this->slugs['web'] . 'buku';
        $this->route = $this->routes['web'] . 'book';
        $this->view = $this->views['web'] . 'buku';
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
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="active breadcrumb-item">' . 'Buat Buku' . '</li>');
            return view($this->view . '.create', compact('breadcrumb'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }
    }
}
