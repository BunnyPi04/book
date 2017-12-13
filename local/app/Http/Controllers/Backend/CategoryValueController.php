<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryValueCheck;
use App\Http\Requests;
use App\Book;
use App\Publisher;
use App\Category;
use Auth;
use Validator;

class CategoryValueController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function list() {
    	if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
	    	$value = new CategoryValue;
	    	$query = $value
	    		->orderBy('categoryValues.sku')
	    		->select('categoryValues.id', 'categoryValues.sku', 'categoryValues.category_id', 'categories.category_name')
	    		->leftJoin('books', 'categoryValues.sku', '=', 'books.sku')
	    		->leftJoin('categories', 'categoryValues.category_id', '=', 'categories.category_id')
	    		->get();

	    	return view('backend.book_value-list', compact('query'));
    	} else {
    		return redirect('/');
    	}
    }

    public function add($sku, $category_id) {
    	if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
    		$query = CategoryValue::insertGetId([
    			'sku' => $sku,
    			'category_id' => $category_id]);

    		return view('backend.book_value-add', compact('book', 'categoryValue'));
    	} elseif ((Auth::user()->position) == 'Cashier') {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/book_value/')->with($alert);
    	} else {
    		return redirect('home/');
    	}
	}

	public function postAdd(BookValueCheck $requests) {
		$sku = $requests->input('book_sku');
		$store_id = $requests->input('store_id');
		$number = $requests->input('number');
		$book_value = new Book_value;
		if ($book_value->where('sku', $sku)
						->where('store_id', $store_id)
						->count() > 0) {
			$result = $book_value->where('sku', $sku)
						->where('store_id', $store_id)->first();
			$number = $result['number'] + $requests->input('number');
			$query = $book_value->where('sku', $sku)->update(
				['number' => "$number"]
			);
			if ($query > 0) {
                $alert = ['passes' => 'Lưu thành công'];
            }
            else {
                $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
            }
		} else {
			$query = $book_value->insertGetId([
				'sku' => $sku,
				'store_id' => $store_id,
				'number' => $number
			]);
			if ($query > 0) {
                $alert = ['passes' => 'Thêm thành công'];
            }
            else {
                $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
            }
		}

		return redirect('/admin/book_value/')->with($alert);
	}
	public function getEdit($id) {
		if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
			$value = new Category_value;
			$book = Book::all();
			$store = Category::all();
			$query = $value
                    ->select('book_values.sku', 'books.book_name', 'stores.store_id', 'stores.store_name', 'book_values.number')
                    ->where('id', $id)
                    ->leftJoin('books', 'books.sku', '=', 'book_values.sku')
                    ->leftJoin('stores', 'book_values.store_id', '=', 'stores.store_id')
                    ->first();
            return view('backend.book_value-edit', compact('query', 'book', 'store'));
		} elseif ((Auth::user()->position) == 'Cashier'){
			$alert = ['error' => 'You dont have permission'];
		} else {
			return redirect('home/');
		}
	}

	public function postEdit(BookValueCheck $requests) {
		$value = new Book_value;
		$sku = $requests->input('book_sku');
		$store_id = $requests->input('store_id');
		$number = $requests->input('number');
		$query = $value->where('id', $id)
						->update([
							'sku' => $sku,
							'store_id' => $store_id,
							'number' => $number]);
		if ($query > 0) {
			$alert = ['passes' => 'Lưu thành công!'];
		} else {
			$alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
		}

		return redirect('/admin/book_value/')->with($alert);
	}

	public function delete($id) {
		$value = new Book_value;
		$query = $value->where('id', $id)->delete();
		if($query > 0) {
			$alert = ['passes' => 'Đã xóa'];
		} else {
			$alert = ['error' => 'Lỗi! Chưa xóa được'];
		}

		return redirect('/admin/book_value')->with($alert);
	}
}
