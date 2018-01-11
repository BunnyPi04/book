<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\BookCheck;
use App\Http\Requests;
use App\CategoryValue;
use App\Book_value;
use App\Store;
use App\Book;
use App\Publisher;
use App\Category;
use Auth;
use Validator;

class SaleController extends Controller
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

    public function getSale() {
        if((Auth::user()->position) == 'Admin') {
            $publishers = Publisher::all();
            $categories = Category::all();
            $stores = Store::all();
            return view('backend.sale.sale_create', compact('publishers', 'categories', 'stores'));
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/book/')->with($alert);
        }
    }

    public function createSale(Request $request) {
        if((Auth::user()->position) == 'Admin') {
            $book = new Book;
            $sale_by = $request->sale_by;
            $amount = $request->amount;
            $from = $request->from;
            $expired = $request->expired;
            $explode = explode("-",$sale_by);
            $id = $explode[1];
            if (strpos($sale_by, 'pub-') !== false) {
                $query = Book::where('publisher_id', $id)->get();
                foreach ($query as $key) {
                    $key->from_date = $from;
                    $key->to_date = $expired;
                    $key->special_price = $key->price - ($key->price / 100) * $amount;
                    $key->save();
                }
                $alert = ['passes' => 'Thành công!'];
            } elseif (strpos($sale_by, 'store-') !== false) {
                $query = $book::select('books.*', 'book_values.sku')
                    ->where('book_values.store_id', $id)
                    ->leftJoin('book_values', 'book_values.sku', 'books.sku')
                    ->get();
                foreach ($query as $key) {
                    $key->from_date = $from;
                    $key->to_date = $expired;
                    $key->special_price = $key->price - ($key->price / 100) * $amount;
                    $key->save();
                }
                $alert = ['passes' => 'Thành công!'];
            } elseif (strpos($sale_by, 'cate-') !== false) {
                $query = $book::select('books.*', 'category_values.category_id')
                    ->where('category_values.category_id', $id)
                    ->leftJoin('category_values', 'category_values.sku', 'books.sku')
                    ->get();
                foreach ($query as $key) {
                    $key->from_date = $from;
                    $key->to_date = $expired;
                    $key->special_price = $key->price - ($key->price / 100) * $amount;
                    $key->save();
                }
                $alert = ['passes' => 'Thành công!'];
            }
            return redirect('admin/')->with($alert);
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return back()->with($alert);
        }
    }
}
