<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookValueCheck;
use App\Http\Requests;
use App\Book;
use App\Book_value;
use Auth;
use App\Store;
use Validator;

class BookValueController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function list() {
    	if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper' || (Auth::user()->position) == 'Cashier') {
	    	$value = new Book_value;
	    	$query = $value
	    		->orderBy('book_values.sku')
	    		->select('book_values.id', 'book_values.sku', 'book_values.number', 'book_values.store_id', 'books.book_name', 'stores.store_name')
	    		->leftJoin('books', 'book_values.sku', '=', 'books.sku')
	    		->leftJoin('stores', 'book_values.store_id', '=', 'stores.store_id')
	    		->paginate(10);

	    	return view('backend.book.book_value-list', compact('query'));
    	} else {
    		return redirect('home/');
    	}
    }

    public function getAdd() {
    	if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
    		$store = Store::all();
    		$book = Book::all();

    		return view('backend.book.book_value-add', compact('book', 'store'));
    	} elseif ((Auth::user()->position) == 'Cashier') {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/book_value/')->with($alert);
    	} else {
    		return redirect('/');
    	}
	}

	public function postAdd(BookValueCheck $requests) {
		$sku = $requests->input('book_sku');
		$store_id = $requests->input('store_id');
		$number = $requests->input('number');
		$book = new Book;
		$book_value = new Book_value;
		if ($book->where('sku', $sku)->count()==0) {
			$alert = ['error' => 'Sai mã sách!'];
			return redirect()->back()->withErrors($alert);
		}
		if ($number < 1) {
			$alert = ['error' => 'Số lượng sách phải nhiều hơn 0!'];
			return redirect()->back()->withErrors($alert);
		}
		if ($book_value->where('sku', $sku)
						->where('store_id', $store_id)
						->count() > 0) {
			$result = $book_value->where('sku', $sku)
						->where('store_id', $store_id)->first();
			$number= $result['number'] + $requests->input('number');
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
			$value = new Book_value;
			$book = Book::all();
			$store = Store::all();
			$query = $value
                    ->select('book_values.sku', 'books.book_name', 'stores.store_id', 'stores.store_name', 'book_values.number')
                    ->where('id', $id)
                    ->leftJoin('books', 'books.sku', '=', 'book_values.sku')
                    ->leftJoin('stores', 'book_values.store_id', '=', 'stores.store_id')
                    ->first();
            return view('backend.book.book_value-edit', compact('query', 'book', 'store'));
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