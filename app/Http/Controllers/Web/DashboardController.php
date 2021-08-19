<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
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
        $book_count_all = Book::query()->count();
        $member_count_all = User::query()->count();

        return view($this->view.'.index', compact('book_count_all','member_count_all'));
    }
}
