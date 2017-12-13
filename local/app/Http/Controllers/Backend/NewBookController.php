<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewBookCheck;
use App\Http\Requests;
use App\Book;
use Auth;
use Validator;

class NewBookController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function list() {
    	$book = new Book;
        $query = $book->where('is_new', 1)->paginate(10);

    	return view('backend.book.new_book-list', compact('query'));
    }

    public function add() {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            $query = Book::all();

            return view('backend.book.new_book-add', compact('query'));
        } else {
            $alert = ['error' => 'You dont have permission'];
            return redirect()->back()->with($alert);
        }
    }
    public function save(NewBookCheck $request) {
    	// dd($request->input('checkNew'));
    	if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
	    	$new = new Book;
	    	$count = 0;
	    	$affected = 0;
            $update = $new->whereIn('sku', $request->input('is_new'))
                        ->update([
                            'is_new' => 1]);
	    	$reset = $new->whereNotIn('sku', $request->input('is_new'))
	    				->update([
                            'is_new' => 0]);
	    	if ($update == (count($request->input('is_new')))) {
	    		$alert = ['passes' => 'Lưu thành công!'];
	    	} else {
	    		$alert = ['error' => 'Đã có lỗi xảy ra!'];
	    	}
	    	return redirect('admin/new_book')->with($alert);
    	} else {
    		$alert = ['error' => 'You dont have permission'];
    		return redirect()->back()->with($alert);
    	}
    }
}