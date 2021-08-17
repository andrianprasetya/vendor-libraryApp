<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\PatternBook;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

            $countAll = Book::query()->count();
            $paginate = Book::query()->select('*')
                ->whereRaw($conditions)
                ->orderBy($columnName, $columnSortOrder)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();

            foreach ($paginate->items() as $idx => $row) {
                $routeDetail = route("web::book.show", $row['id']);
                $routeEdit = route("web::book.edit", $row['id']);
                $action = null;

                $action .= '<div class="row text-center"><div class="col-md-6">';
                $action .= '<a href="' . $routeDetail . '" style="margin:10px" class="text-light-blue" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-eye"></i></a>';
                $action .= '</div><div class="col-md-6">';
                $action .= '<a href="' . $routeEdit . '" style="margin:10px" class="text-yellow"  data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>';
                $action .= '</div></div>';
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    'title' => $row->title,
                    'author' => $row->author,
                    'edition' => $row->edition,
                    'code' => $row->PatternCode->code,
                    'total_item' => $row->total_item,
                    'publisher' => $row->publisher,
                    'book_series' => $row->book_series,
                    'publishing_year' => $row->publishing_year,
                    'publishing_place' => $row->publishing_place,
                    'classification' => $row->classification,
                    'call_number' => $row->call_number,
                    'language' => $row->language,
                    'notes' => $row->notes,
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

    public function pattern_book(Request $request)
    {
        DB::beginTransaction();
        try {
            PatternBook::query()->create([
                'prefix' => $request->prefix,
                'length' => $request->length,
                'code' => $request->code
            ]);
            DB::commit();

            return redirect()->route($this->route . '.create');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function getCode(Request $request)
    {
        try {
            $codes = PatternBook::query()->where('code', 'ILIKE', '%' . $request->input("term", "") . '%')->get();
            $items = array();
            foreach ($codes as $code) {
                $items[] = array(
                    "id" => $code->id,
                    "text" => $code->code
                );
            }
            return response()->json($items);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $isEdit = true;
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="breadcrumb-item active">' . 'Ubah Anggota' . '</li>');

            $data = Book::query()->findOrFail($id);


            return view($this->view . '.edit', compact('breadcrumb', 'data', 'isEdit'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $ImagePath = "";
            if ($request->hasFile('image')) {
                $path = 'public/images';
                $ImagePath = Storage::disk()->put($path, $request->file('image'));
            }


            $FilePath = "";
            if ($request->hasFile('file')) {
                $path = 'public/pdf';
                $FilePath = Storage::disk()->put($path, $request->file('file'));
            }
            Book::query()->create([
                'title' => $request->title,
                'author' => $request->author,
                'edition' => $request->edition,
                'code_pattern_id' => $request->code,
                'total_item' => $request->total_item,
                'collection' => $request->collection,
                'location' => $request->location,
                'GMD' => $request->GMD,
                'media_type' => $request->media_type,
                'book_series' => $request->book_series,
                'publisher' => $request->publisher,
                'publishing_year' => $request->publishing_year,
                'publishing_place' => $request->publishing_place,
                'classification' => $request->classification,
                'call_number' => $request->call_number,
                'language' => $request->language,
                'notes' => $request->notes,
                'image' => $ImagePath,
                'file' => $FilePath,
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $isEdit = false;
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="breadcrumb-item active">' . 'Detail Buku' . '</li>');
            $data = Book::findOrFail($id);
            return view($this->view . '.show', compact('breadcrumb', 'data', 'isEdit'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $data = Book::query()->findOrFail($id);

            if (Storage::exists($data->image)) {
                Storage::delete($data->image);
            }

            $ImagePath = "";
            if ($request->hasFile('image')) {
                $path = 'public/images';
                $ImagePath = Storage::disk()->put($path, $request->file('image'));
            }

            if (Storage::exists($data->file)) {
                Storage::delete($data->file);
            }
            $FilePath = "";
            if ($request->hasFile('file')) {
                $path = 'public/pdf';
                $FilePath = Storage::disk()->put($path, $request->file('file'));
            }
            $data->update([
                'title' => $request->title,
                'author' => $request->author,
                'edition' => $request->edition,
                'code_pattern_id' => $request->code,
                'total_item' => $request->total_item,
                'collection' => $request->collection,
                'location' => $request->location,
                'GMD' => $request->GMD,
                'media_type' => $request->media_type,
                'book_series' => $request->book_series,
                'publisher' => $request->publisher,
                'publishing_year' => $request->publishing_year,
                'publishing_place' => $request->publishing_place,
                'classification' => $request->classification,
                'call_number' => $request->call_number,
                'language' => $request->language,
                'notes' => $request->notes,
                'image' => $ImagePath,
                'file' => $FilePath,
            ]);


            DB::commit();

            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {

        }
    }
}
