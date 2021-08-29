<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\CodeBook;
use App\Models\PatternBook;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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
                $routeDelete = route("web::book.destroy", $row['id']);
                $action = null;

                $action .= '<div class="row text-center"><div class="col-md-4">';
                $action .= '<a href="' . $routeDetail . '" style="margin:10px" class="text-light-blue" data-toggle="tooltip" data-placement="bottom" title="Detail"><i class="fa fa-eye"></i></a>';
                $action .= '</div><div class="col-md-4">';
                $action .= '<a href="' . $routeEdit . '" style="margin:10px" class="text-yellow"  data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i></a>';
                $action .= '</div><div class="col-md-4">';
                $action .= '<a href="' . $routeDelete . '" style="margin:10px" class="text-green delete"  data-toggle="tooltip" data-singleton="true" data-popout="true" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></a>';
                $action .= '</div></div>';
                $items[] = array(
                    "no" => 1 + $idx . ".",
                    "id" => $row->id,
                    'title' => $row->title,
                    'author' => $row->author,
                    'edition' => $row->edition,
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

    public function getDatatableCode(Request $request)
    {
        try {
            $draw = $request->input('draw');
            $start = $request->input('start');
            $length = $request->input('length');
            $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
            $limit = (int)$length > 0 ? $length : 10;


            $conditions = '1 = 1';


            $countAll = CodeBook::query()->count();
            $paginate = CodeBook::query()->select('*')
                ->where('book_id',$request->book_id)
                ->whereRaw($conditions)
                ->paginate($limit, ["*"], 'page', $page);
            $items = array();

            foreach ($paginate->items() as $idx => $row) {
                $items[] = array(
                    "id" => $row->id,
                    'code' => $row->code,
                    'location' => $row->location,
                    'collection' => $row->collection,
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
            Log::error($e->getMessage() . " - " . $e->getFile() . " - " . $e->getLine());
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
            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="breadcrumb-item active">' . 'Ubah Buku' . '</li>');

            $data = Book::query()->findOrFail($id);


            return view($this->view . '.edit', compact('breadcrumb', 'data', 'isEdit'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function editCode($id)
    {
        try {

            $breadcrumb = $this->breadcrumbs($this->breadcrumb . '<li class="breadcrumb-item active">' . 'Ubah Code' . '</li>');
            $data = CodeBook::query()->findOrFail($id);

            return view($this->view . '.edit-code', compact('breadcrumb', 'data'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $defaultExistingTotalItem = 0;
            $ImagePath = "";
            if ($request->hasFile('image')) {
                $path = 'public/images';
                $ImagePath = Storage::disk()->put($path, $request->file('image'));
            }

            $nameFile = null;
            $FilePath = "";
            if ($request->hasFile('file')) {
                $path = 'public/pdf';
                $nameFile = $request->file('file')->getClientOriginalName();
                $FilePath = Storage::disk()->put($path, $request->file('file'));
            }

            $existingCode = CodeBook::query()->where('pattern_book_id', $request->code);
            $countExistingCode = $existingCode != null ? $existingCode->count() : 0;

            if ($countExistingCode > 0) {
                $modelExistingCode = $existingCode->first();
                $maxSequenceExistingBook = Book::query()->where('id', $modelExistingCode->book_id)->max('sequence');
                $modelExistingBook = Book::query()->where('id', $modelExistingCode->book_id)->where('sequence', $maxSequenceExistingBook)->first();
                $defaultExistingTotalItem = $modelExistingBook->total_item;
            }
            $book = Book::query()->create([
                'title' => $request->title,
                'author' => $request->author,
                'edition' => $request->edition,
                'total_item' => $request->total_item,
                'gmd' => $request->gmd,
                'media_type' => $request->media_type,
                'book_series' => $request->book_series,
                'publisher' => $request->publisher,
                'publishing_year' => $request->publishing_year,
                'publishing_place' => $request->publishing_place,
                'classification' => $request->classification,
                'call_number' => $request->call_number,
                'language' => $request->language,
                'collection' => $request->collection,
                'notes' => $request->notes,
                'image' => $ImagePath,
                'file' => $FilePath,
                'slug_file' => $nameFile,
                'sequence' => $countExistingCode + 1,
            ]);

            $PatternCode = PatternBook::query()->where('id', '=', $request->code)->first();

            for ($i = 1; $i <= $request->total_item; $i++) {
                $book->codes()->attach($PatternCode, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'code' => $PatternCode->code . ($i + $defaultExistingTotalItem),
                    'collection' => $request->collection,
                    'location' => $request->location,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            DB::commit();

            return redirect()->route($this->route . '.index');
        } catch
        (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage() . " - " . $e->getLine());
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


            $ImagePath = "";
            if ($request->hasFile('image')) {
                if (Storage::exists($data->image)) {
                    Storage::delete($data->image);
                }
                $path = 'public/images';
                $ImagePath = Storage::disk()->put($path, $request->file('image'));
                $data->update(['image' => $ImagePath]);
            }


            $FilePath = "";
            if ($request->hasFile('file')) {
                if (Storage::exists($data->file)) {
                    Storage::delete($data->file);
                }
                $path = 'public/pdf';
                $FilePath = Storage::disk()->put($path, $request->file('file'));
                $data->update(['file' => $FilePath]);
            }
            $data->update([
                'title' => $request->title,
                'author' => $request->author,
                'edition' => $request->edition,
                'code_pattern_id' => $request->code,
                'total_item' => $request->total_item,
                'collection' => $request->collection,
                'location' => $request->location,
                'gmd' => $request->gmd,
                'media_type' => $request->media_type,
                'book_series' => $request->book_series,
                'publisher' => $request->publisher,
                'publishing_year' => $request->publishing_year,
                'publishing_place' => $request->publishing_place,
                'classification' => $request->classification,
                'call_number' => $request->call_number,
                'language' => $request->language,
                'notes' => $request->notes,
            ]);


            DB::commit();

            return redirect()->route($this->route . '.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(404);
        }
    }

    public function updateCode($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $data = CodeBook::query()->findOrFail($id);

            $data->update([
                'collection' => $request->collection,
                'location' => $request->location,
            ]);


            DB::commit();

            return redirect()->route($this->route . '.edit', $data->book_id);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(404);
        }
    }
    public function destroy($id)
    {
        $item = Book::query()->findOrFail($id);
        $item->delete();
        return redirect(URL::previous())->with('status','Delete Successfully');
    }
}
