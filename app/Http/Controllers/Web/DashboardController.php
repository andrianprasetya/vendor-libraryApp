<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\CodeBook;
use App\Models\Fines;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
        $member_count_all = User::query()->whereHas('roles', function ($q){
            $q->where('slug','siswa');
        })->count();

        $count_late_book = Fines::query()->count();
        $book_ready = CodeBook::query()->where('is_loan',false)->count();
        $book_loan = CodeBook::query()->where('is_loan',true)->count();

        return view($this->view.'.index', compact('book_count_all','member_count_all','book_loan','book_ready','count_late_book'));
    }

    public function about()
    {
        return view($this->view.'.about');
    }
}
