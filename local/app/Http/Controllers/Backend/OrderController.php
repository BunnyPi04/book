<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Book_value;
use App\Book;
use App\User;
use App\Order;
use App\Order_detail;
use Auth;
use Validator;

class OrderController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
    	$countUser = User::all()->count();
        $countOrderPending = Order::where('status', 'Pending')->count();
        $countOrderDelivering = Order::where('status', 'Shipping')->count();

    	return view('backend.order.order-index', compact('countUser', 'countOrderDelivering', 'countOrderPending'));
    }

    public function list() {
    	$order = new Order;
    	$user = new User;
        $query = $order
            ->select('orders.id', 'orders.user_id', 'orders.city', 'orders.created_at', 'orders.total', 'orders.status', 'users.fullname')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->orderBy('orders.created_at', 'desc')
            ->get();
    	return view('backend.order.order-list', compact('query'));
    }

    public function pending() {
    	$order = new Order;
    	$user = new User;
        $query = $order
            ->select('orders.id', 'orders.user_id', 'orders.city', 'orders.created_at', 'orders.total', 'orders.status', 'users.fullname')
            ->where('orders.status', 'Pending')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->orderBy('orders.created_at', 'desc')
            ->get();
    	return view('backend.order.order-pending', compact('query'));
    }

    public function shipping() {
    	$order = new Order;
    	$user = new User;
        $query = $order
            ->select('orders.id', 'orders.user_id', 'orders.city', 'orders.created_at', 'orders.total', 'orders.status', 'users.fullname')
            ->where('orders.status', 'Shipping')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->orderBy('orders.created_at', 'desc')
            ->get();
    	return view('backend.order.order-shipping', compact('query'));
    }

    public function show($order_id) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Cashier') {
            $order = new Order;
            $order_details = new Order_detail;
            $query_order = $order
            			->select('orders.*', 'users.fullname')
            			->where('orders.id', $order_id)
            			->leftJoin('users', 'orders.user_id', '=', 'users.id')
            			->first();
            $query_detail = $order_details
            			->where('order_details.order_id', $order_id)
            			->leftJoin('books', 'order_details.book_id', '=', 'books.book_id')
            			->get();
            
            return view('backend.order.order-show', compact('query_order', 'query_detail'));
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/')->with($alert);
        }
    }

    public function getEdit($order_id) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Cashier') {
            $order = new Order;
            $order_details = new Order_detail;
            $query_order = $order
            			->select('orders.*', 'users.fullname')
            			->where('orders.id', $order_id)
            			->leftJoin('users', 'orders.user_id', '=', 'users.id')
            			->first();
            $query_detail = $order_details
            			->where('order_details.order_id', $order_id)
            			->leftJoin('books', 'order_details.book_id', '=', 'books.book_id')
            			->get();
            
            return view('backend.order.order-edit', compact('query_order', 'query_detail'));
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/')->with($alert);
        }
    }
    public function postEdit(Request $request) {
    	$order = new Order;
    	$order_details = new Order_detail;
        $order_id = $request->input('order_id');
    	$query_detail = $order_details
    			->where('order_details.order_id', $order_id)
    			->leftJoin('books', 'order_details.book_id', '=', 'books.book_id')
    			->get();
        $status = $request->input('status');
        if ($status == 'Shipping') {
        	// $book_value = new Book_value;
        	// foreach ($query_detail as $key) {
        	// 	$book_sku[] = $key['sku'];
        	// }
        	// foreach ($book_sku as $value) {
        	// 	$number = $book_value->where('sku', $value)->first();
        	// 	$book_value->where('sku', $value)->update([
        	// 		'number' => $number['number'] - 1,]);
        	// }
        	$query = $order->where('id', $order_id)->update([
	        	'status' => $status
	        ]);
	        if ($query > 0) {
	        	$alert = ['passes' => 'Lưu thành công'];
	        } else {
	        	$alert = ['error' => 'Đã xảy ra lỗi'];
	        }
        } else {
	        $query = $order->where('id', $order_id)->update([
	        	'status' => $status
	        ]);
	        if ($query > 0) {
	        	$alert = ['passes' => 'Lưu thành công'];
	        } else {
	        	$alert = ['error' => 'Đã xảy ra lỗi'];
	        }
    	}

        return redirect('admin/order')->with($alert);
    }

    public function delete($order_id) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Cashier') {
            $order = new Order;
            $order_detail = new Order_detail;
            $query = $order->where('id', $order_id)->delete();
            $query2 = $order_detail->where('order_id', $order_id)->delete();
            if ($query != 0) {
            	$alert = ['passes' => 'Xóa thành công'];
            } else {
            	$alert = ['error' => 'Đã xảy ra lỗi'];
            }

            return back()->with($alert);
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return back()->with($alert);
        }
    }
    public function statistic() {
        return view('backend.order.statistic');
    }

    public function postStatistic(Request $request) {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $order = new Order;
        $user = new User;
        $query = $order
            ->select('orders.id', 'orders.user_id', 'orders.city', 'orders.created_at', 'orders.total', 'orders.status', 'users.fullname')
            ->whereBetween('orders.created_at', [$from_date, $to_date])
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->orderBy('orders.created_at', 'desc')
            ->get();
        $getTotal = $order->select('total')
            ->whereBetween('created_at', [$from_date, $to_date])
            ->get();
            // dd($getTotal);
        $order_total = 0;
        foreach ($query as $value) {
            $order_total += floatval($value->total);
        }

        return view('backend.order.statistic', compact('query', 'order_total'));
    }
}
