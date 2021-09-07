<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OpacController extends Controller
{
    public function __construct()
    {
        $this->menu = 'buku';
        $this->slug = $this->slugs['web'] . 'opac';
        $this->route = $this->routes['web'] . 'opac';
        $this->view = $this->views['web'] . 'opac';
        $this->breadcrumb = '<li class="breadcrumb-item"><a href="' . route($this->route . '.index') . '">' . $this->menu . '</a></li>';
        $this->share();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);
        $books = Book::query()->when($request->search_book, function ($q) use ($request) {
            return $q->where('id', $request->search_book);
        })->orderBy('created_at', 'desc')
            ->paginate(8);
        return view($this->view . '.index', compact('breadcrumb', 'books'));
    }

    public function getBook(Request $request)
    {
        try {

            $books = Book::query()->where('title', 'ILIKE', '%' . $request->input("term", "") . '%')->get();
            $items = array();
            foreach ($books as $book) {
                $items[] = array(
                    "id" => $book->id,
                    "text" => $book->title
                );
            }

            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function detail($id)
    {
        $br = '<li class="active breadcrumb-item">' . ' list ' . $this->menu . '</li>';
        $breadcrumb = $this->breadcrumbs($br);
        $data = Book::query()->findOrFail($id);
        return view($this->view . '.detail', compact('breadcrumb', 'data'));
    }


}
