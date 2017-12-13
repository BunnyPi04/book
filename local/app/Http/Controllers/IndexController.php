<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Requests\BookCheck;
use App\CategoryValue;
use App\Book_value;
use App\Comment;
use App\Store;
use App\Book;
use App\Publisher;
use App\Category;
use Auth;
use Validator;
class IndexController extends Controller
{
    //
    public function __construct() {
        $category = Category::all();
        $store = Store::all();
        $now = Carbon::now();
        $book = new Book;
        $query = $book->where('to_date', '<=', $now)->update([
            'special_price' => null
        ]);

        return compact('category', 'store');
    }

    public function index() {
    	return view('welcome');
    }
    public function show_category() {
        $query = Category::all();
    	return $query;
    }
    public function show($book_id) {
    	$book = new Book;
        $category = new CategoryValue;
        $comment = new Comment;
        $books = $book
                ->select('books.*', 'publishers.publisher_name')
                ->where('books.book_id', $book_id)
                ->leftJoin('publishers', 'books.publisher_id', '=', 'publishers.publisher_id')
                ->get();
        $comments = $comment
                ->select('comments.*', 'users.name')
                ->where('comments.book_id', $book_id)
                ->leftJoin('users', 'users.id', 'comments.user_id')
                ->get();
        $find_sku = Book::find($book_id);
        $sku = $find_sku['sku'];
        $book_value = new Book_value;
        $number = $book_value->where('sku', $sku)->get();
        $count = 0;
        foreach ($number as $item) {
            $count += $item['number'];
        };
        $sum = ['count' => $count];
        $value = $book_value
                ->select('book_values.sku', 'book_values.store_id', 'book_values.number', 'stores.store_name')
                ->leftJoin('stores', 'book_values.store_id', '=', 'stores.store_id')
                ->leftJoin('books', 'book_values.sku', '=', 'books.sku')
                ->get();
        $category_value = $category
                ->select('categories.category_name', 'category_values.*')
                ->leftJoin('categories', 'category_values.category_id', '=', 'categories.category_id')
                ->get();
        return view('book-info', compact('books', 'value', 'category_value', 'comments', 'sum'));
    }
    public function category($id) {
        $book = new Book;
        $book_values = new Book_value;
        $category_value = new CategoryValue;
        $category_name = Category::find($id);
        $category_value_id = CategoryValue::where('category_id', $id)->get();
        $sku = [];
        foreach ($category_value_id as $key) {
            $sku[] = $key->sku;
        }
        $query = $category_value
                ->select('category_values.*', 'books.*')
                ->where('category_values.category_id', $id)
                ->leftJoin('categories', 'category_values.category_id', '=', 'categories.category_id')
                ->leftJoin('books', 'books.sku', '=', 'category_values.sku')
                ->get();
        $number = $book_values
                ->select('category_values.category_id', 'book_values.sku', 'book_values.number')
                ->whereIn('category_values.sku', $sku)
                ->leftJoin('category_values', 'book_values.sku', '=', 'category_values.sku')
                ->get();
        return view('category', compact('category_name', 'query', 'number'));
    }
}
