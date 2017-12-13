<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\BookCheck;
use App\Http\Requests;
use App\CategoryValue;
use App\Book_value;
use App\Book;
use App\Publisher;
use App\Category;
use Auth;
use Validator;

class BooksController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
        $now = Carbon::now();
        $book = new Book;
        $query = $book->where('to_date', '<=', $now)->update([
            'special_price' => null
        ]);
    }
    public function list() {
    	$book = new Book;
        $category = new CategoryValue;
        $query = $book
            ->select('books.sku', 'books.book_id', 'books.book_name', 'books.is_new', 'books.is_hightlight', 'books.publisher_id', 'books.author', 'books.image', 'books.price', 'books.special_price', 'books.author', 'publishers.publisher_name')
            ->leftJoin('publishers', 'books.publisher_id', '=', 'publishers.publisher_id')
            ->orderBy('books.book_id', 'desc')
            ->get();
        $category_value = $category
            ->select('categories.category_name', 'category_values.category_id', 'category_values.sku')
            ->leftJoin('categories', 'category_values.category_id', '=', 'categories.category_id')
            ->get();
    	return view('backend.book.book-list', compact('query', 'category_value'));
    }

    public function show($book_id) {
        $book = new Book;
        $category = new CategoryValue;
        $books = $book
            ->select('books.sku', 'books.book_id', 'books.book_name', 'books.publisher_id', 'books.author', 'books.image', 'books.price', 'books.special_price', 'books.author', 'books.description', 'publishers.publisher_name', 'books.to_date', 'books.from_date')
            ->where('books.book_id', $book_id)
            ->leftJoin('publishers', 'books.publisher_id', '=', 'publishers.publisher_id')
            ->get();
        $number = new Book_value;
        $value = $number
                ->select('book_values.sku', 'book_values.store_id', 'book_values.number', 'stores.store_name')
                ->leftJoin('stores', 'book_values.store_id', '=', 'stores.store_id')
                ->leftJoin('books', 'book_values.sku', '=', 'books.sku')
                ->get();
        $category_value = $category
            ->select('categories.category_name', 'category_values.category_id', 'category_values.sku')
            ->leftJoin('categories', 'category_values.category_id', '=', 'categories.category_id')
            ->get();
        return view('backend.book.book-info', compact('books', 'value', 'category_value'));
    }

    public function getAdd() {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            $publisher = Publisher::all();
            $category = Category::all();
            return view('backend.book.book-add', compact('publisher', 'category'));
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/book/')->with($alert);
        }
    }

    public function postAdd(BookCheck $request) {
        $sku = $request->input('sku');
        $book_name = $request->input('book_name');
        $publisher_id = $request->input('publisher_id');
        $author = $request->input('author');
        // $category_id = $request->input('category_id');
        $image = $request->input('images');
        $price = $request->input('price');
        $description = $request->input('description');
        $book = new Book;
        if ($book->where('sku', $sku)->count() > 0) {
            $alert = ['error' => 'Lỗi trùng SKU!'];
            return redirect()->back()->with($alert);
            // return view('backend.book.book-add', $alert);
        } else {
            if($request->hasFile('images')){
                $file = $request->images;
                $image = $file->getClientOriginalName();
                $file->move('local/public/images', $file->getClientOriginalName());
            } else {
                $image = null;
            }
            $query = $book->insertGetId(
                ['sku' => $sku,
                 'book_name' => $book_name,
                 'publisher_id' => $publisher_id,
                 'author' => $author,
                 // 'category_id' => $category_id,
                 'image' => $image,
                 'price' => $price,
                 'description' => $description]);
            $category = new CategoryValue;
            foreach ($request->input('category') as $key) {
                if ($category
                    ->where('sku', $sku)
                    ->where('category_id', $key)
                    ->count() == 0) {
                    $query = CategoryValue::insertGetId([
                        'sku' => $sku,
                        'category_id' => $key
                    ]);
                }
            }
            if ($query > 0) {
                $alert = ['passes' => 'Thêm thành công'];
            }
            else {
                $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
            }
            
            return redirect('/admin/book/')->with($alert);
        }
    }
    public function getEdit($book_id) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            $book = new Book;
            $publishers = Publisher::all();
            $categories = Category::all();
            $category_value = new CategoryValue;
            $query = $book
                    ->select('books.sku', 'books.book_id', 'books.book_name', 'books.publisher_id', 'books.is_new', 'books.is_hightlight', 'books.author', 'books.image', 'books.price', 'books.special_price', 'books.author', 'books.description', 'books.from_date', 'books.to_date', 'publishers.publisher_name')
                    ->where('book_id', $book_id)
                    ->leftJoin('publishers', 'books.publisher_id', '=', 'publishers.publisher_id')
                    // ->leftJoin('categories', 'books.category_id', '=', 'categories.category_id')
                    ->get();
            $query_value = $category_value
                ->select('category_values.sku', 'category_values.category_id', 'categories.category_name')
                ->where('category_values.sku', $sku = $book->where('book_id', $book_id)->first()->sku)
                ->leftJoin('categories', 'category_values.category_id', '=', 'categories.category_id')
                ->get();
            
            return view('backend.book.book-edit', compact('query', 'publishers', 'categories', 'query_value'));
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/book/')->with($alert);
        }
    }
    public function postEdit(BookCheck $request) {

        $book_id = $request->input('book_id');
        $sku = $request->input('sku');
        $book = new Book;
        if ($book->where('sku', $sku)
                ->where('book_id', '<>', $book_id)
                ->count() > 0) {
            $alert = ['error' => 'Lỗi trùng SKU!'];
            
            return redirect('/admin/book/add')->with($alert);
        } else {
            $book_name = $request->input('book_name');
            $publisher_id = $request->input('publisher_id');
            $author = $request->input('author');
            $is_new = $request->input('is_new');
            $is_hightlight = $request->input('is_hightlight');
            $category = new CategoryValue;
            if($request->hasFile('images')){
                $file = $request->images;
                $image = $file->getClientOriginalName();
                $file->move('local/public/images', $file->getClientOriginalName());
            } else {
                $image = $request->input('old_images');
            }
            $price = $request->input('price');
            $description = $request->input('description');

            if ($request->input('special_price') != "") {
                $special_price = $request->input('special_price');
                $from_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('from_date'))));
                $to_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('to_date'))));
            } else {
                $special_price = null;
                $from_date = null;
                $to_date = null;
            }
            $query = $book->where('book_id', $book_id)->update(
                ['sku' => $sku,
                 'book_name' => $book_name,
                 'is_new' => $is_new,
                 'is_hightlight' => $is_hightlight,
                 'publisher_id' => $publisher_id,
                 'author' => $author,
                 'special_price' => $special_price,
                 'from_date' => $from_date,
                 'to_date' => $to_date,
                 'image' => $image,
                 'price' => $price,
                 'description' => $description]);
            if ($query > 0) {
                $alert = ['passes' => 'Lưu thành công'];
            } else {
                $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
            }
            foreach ($request->input('category') as $key) {
                if ($category
                    ->where('sku', $sku)
                    ->where('category_id', $key)
                    ->count() == 0) {
                    $query = CategoryValue::insertGetId([
                        'sku' => $sku,
                        'category_id' => $key
                    ]);
                }
            }
            $reset = $category
                        ->where('sku', $sku)
                        ->whereNotIn('category_id', $request->input('category'))
                        ->delete();
            
            return redirect('/admin/book/')->with($alert);   
        }
    }

    public function delete($book_id) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            $book = new Book;
            $book_value = new Book_value;
            $category_value = new CategoryValue;
            $sku = $book->where('book_id', $book_id)->first()->sku;
            $query = $book->where('book_id', $book_id)->delete();
            $query_value = $book_value->where('sku', $sku)->get();
            foreach ($query_value as $key) {
                $key->delete();
            }
            $query_category = $category_value->where('sku', $sku)->get();
            foreach ($query_category as $key) {
                $key->delete();
            }

            return redirect('admin/book/');
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/book/')->with($alert);
        }
    }
}
