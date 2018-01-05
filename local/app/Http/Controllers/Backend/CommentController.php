<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Book;
use App\Comment;
use App\User;
use Auth;
use Validator;

class CommentController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
    	$comment = new Comment;
        $unread = $comment
                ->select('comments.*', 'users.fullname', 'books.book_id', 'books.book_name')->where('comments.seen', 0)
                ->leftJoin('books', 'comments.book_id', '=', 'books.book_id')
                ->leftJoin('users', 'comments.user_id', '=', 'users.id')
                ->get();
        $countUnread = Comment::where('seen', 0)->count();

    	return view('backend.comment.comment-index', compact('countUnread', 'unread'));
    }

    public function read(Request $request) {
    	$comment = new Comment;
        $query = $comment
            ->whereIn('id', $request->input('seen'))
            ->update(['seen' => 1]);
    	return redirect()->back();
    }
}
