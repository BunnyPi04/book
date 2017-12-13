<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HightlightBookCheck;
use App\Http\Requests;
use App\Book;
use Auth;
use Validator;

class HightlightBookController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function list() {
    	$book = new Book;
        $query = $book->where('is_hightlight', 1)->paginate(10);

    	return view('backend.book.hightlight_book-list', compact('query'));
    }

    public function add() {
        $query = Book::all();

        return view('backend.book.hightlight_book-add', compact('query'));
    }
    public function save(HightlightBookCheck $request) {
    	// dd($request->input('checkNew'));
    	if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
	    	$new = new Book;
	    	$count = 0;
	    	$affected = 0;
            $update = $new->whereIn('sku', $request->input('is_hightlight'))
                        ->update([
                            'is_hightlight' => 1]);
	    	$reset = $new->whereNotIn('sku', $request->input('is_hightlight'))
	    				->update([
                            'is_hightlight' => 0]);
	    	if ($update == (count($request->input('is_hightlight')))) {
	    		$alert = ['passes' => 'Lưu thành công!'];
	    	} else {
	    		$alert = ['error' => 'Đã có lỗi xảy ra!'];
	    	}
	    	return redirect('admin/hightlight_book')->with($alert);
    	} else {
    		$alert = ['error' => 'You dont have permission'];
    		return redirect()->back()->with($alert);
    	}
    }
}
