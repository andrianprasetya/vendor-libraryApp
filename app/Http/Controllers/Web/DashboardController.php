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
        $this->slug = $this->slugs['web'] . 'dashboard';
        $this->route = $this->routes['web'] . '.dashboard';
        $this->view = $this->views['web'] . '.dashboard';
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
        $member_count_all = User::query()->whereHas('roles', function ($q) {
            $q->where('slug', 'siswa');
        })->count();

        $count_late_book = Fines::query()->count();
        $book_ready = CodeBook::query()->where('is_loan', false)->count();
        $book_loan = CodeBook::query()->where('is_loan', true)->count();

        $kelas = array('X IPA 1', 'X IPA 2', 'X IPA 3', 'X IPS 1', 'X IPS 2', 'X IPS 3',
            'XI IPA 1', 'XI IPA 2', 'XI IPA 3', 'XI IPS 1', 'XI IPS 2', 'XI IPS 3',
            'XII IPA 1', 'XII IPA 2', 'XII IPS 1', 'XII IPS 2', 'XII IPS 3');
        $user_in_kelas = array();
        foreach ($kelas as $i => $k) {
            $user_count_kelas = User::query()->where('kelas', $kelas[$i])->count();
            $user_in_kelas[$i] = $user_count_kelas;
        }
        return view($this->view . '.index', compact('book_count_all', 'member_count_all', 'book_loan', 'book_ready', 'count_late_book', 'kelas','user_in_kelas'));
    }

    public function about()
    {
        return view($this->view . '.about');
    }
}
