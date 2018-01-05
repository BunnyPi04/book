<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Comment;
use Auth;

class CommentController extends Controller
{
    public function add(Request $request) {
    	$book_id = $request->book_id;
        $now = Carbon::now();
    	$comment = new Comment;
    	$query = $comment->insert([
    		'book_id' => $request->input('book_id'),
    		'user_id' => Auth::user()->id,
    		'description' => $request->input('description'),
            'created_at' => $now
    	]);
    	if ($query > 0) {
            $alert = ['passes' => 'Thêm thành công'];
        }
        else {
            $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
        }
        
        return redirect()->back()->with($alert);
    }
}
