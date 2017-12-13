<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CouponCheck;
use App\Http\Requests;
use Carbon\Carbon;
use App\Coupon;
use Auth;
use Validator;

class CouponsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $now = Carbon::now();
        $book = new Coupon;
        $query = $book->where('expired', '<', $now)->delete();
    }

    public function list() {
        if((Auth::user()->position) == 'Admin')
        {
        	$query = Coupon::all();

        	return view('backend.coupon.coupon-list', compact('query'));
        } else
        {
            $alert = ['error' => 'You dont have permission!'];

            return redirect()->back()->with($alert);
        }
    }

    public function getAdd() {
    	if((Auth::user()->position) == 'Admin') {
            return view('backend.coupon.coupon-add');
        } else{
            $alert = ['error' => 'You dont have permission!'];

            return redirect()->back()->with($alert);
        }
    }

    public function postAdd(CouponCheck $requests) {
    	$code = $requests->input('code');
    	$coupon = new Coupon;
    	if ($coupon->where('code', $code)->count() > 0) {
    		$alert = ['error' => 'Lỗi trùng mã coupon!'];

            return view('backend.coupon.coupon-add',$alert);
    	} else {
    		$sale = $requests->input('amount');
    		$type = $requests->input('type');
    		$expired = $requests->input('expired');
    		$query = $coupon->insertGetId([
    			'code' => $code,
    			'amount' => $sale,
    			'type' => $type,
    			'expired' => $expired]);
    		if ($query > 0) {
    			$alert = ['passes' => 'Lưu thành công'];
    		} else {
    			$alert = ['error' => 'Lỗi! Chưa lưu được thông tin'];
    		}

    		return redirect('admin/coupon/')->with($alert);
    	}
    }

    public function getEdit($coupon_id) {
        if((Auth::user()->position) == 'Admin') {
            $coupon = new Coupon;
            $query = $coupon->where('coupon_id', $coupon_id)->first();

            return view('backend.coupon.coupon-edit', compact('query'));
        } else{
            $alert = ['error' => 'You dont have permission'];

            return redirect()->back()->with($alert);
        }
    }

    public function postEdit(CouponCheck $requests) {
        $coupon = new Coupon;
        $coupon_id = $requests->input('coupon_id');
        $code = $requests->input('code');
        $amount = $requests->input('amount');
        $type = $requests->input('type');
        $expired = $requests->input('expired');
        // $query = $coupon->where('coupon_id', $coupon_id)->get();
        $query = $coupon->where('coupon_id', $coupon_id)
                        ->update([
                        'code' => $code,
                        'amount' => $amount,
                        'type' => $type,
                        'expired' => $expired
                        ]);
        if ($query > 0) {
            $alert = ['passes' => 'Thêm thành công'];
        }
        else {
            $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
        }
        
        return redirect('/admin/coupon/')->with($alert);
    }

    public function delete() {
        if((Auth::user()->position) == 'Admin') {
            $coupon = new Coupon;
            $query = $coupon->where('coupon_id', $coupon_id)->delete();
            if ($query > 0) {
                $alert = ['passes' => 'Xóa thành công'];
            } else {
                $alert = ['error' => 'Đã xảy ra lỗi!'];
            }

            return redirect('/admin/coupon/')->with($alert);
        } else{
            $alert = ['error' => 'You dont have permission'];

            return redirect()->back()->with($alert);
        }
    }
}
