<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests;
use App\User;
use Validator;
use App\Store;
use Auth;

class UsersController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function list() {
        if((Auth::user()->position) == 'Admin') {
    		$query = User::all();
    		
    		return view('backend.user.user-list', compact('query'));
    	}
        else
        {
    		$alert = ['error' => 'You dont have permission'];
    		return redirect('/admin')->with($alert);
    	}
    }
    public function show($id) {
        $store = Store::all();
        $item = User::find($id);
        // dd($user);
        return view('backend.user.user-info', compact('item', 'store'));
    }
    public function postEdit(UserEditRequest $request) {
        $id = $request->input('id');
        $name = $request->input('name');
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $user = new User;
        if ($user->where('email', $email)
                ->where('id', '<>', $id)
                ->count() > 0) {
            $alert = ['error' => 'Lỗi trùng email!'];
            
            return redirect()->back()->with($alert);
        }
        elseif($user->where('name', $name)
                ->where('id', '<>', $id)
                ->count() > 0) {
            $alert = ['error' => 'Lỗi trùng tên đăng nhập!'];
            
            return redirect()->back()->with($alert);
        }
        else {
            if ($request->input('password') != '')
            {
                $password = bcrypt($request->input('password'));
            } else {
                $password = $user->find($id)->password;
            }
            if ($request->input('store')!='')
            {
                $store_id = $request->input('store');
            } else {
                $store_id = null;
            }
            $city = $request->input('city');
            $address = $request->input('address');
            $phone_number = $request->input('phone_number');
            $position = $request->input('position');
            $query = $user->where('id', $id)
                        ->update([
                    'fullname' => $fullname,
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'position' => $position,
                    'city' => $city,
                    'address' => $address,
                    'phone_number' => $phone_number,
                    'store_id' => $store_id,
                ]);
            if ($query > 0) {
                $alert = ['passes' => 'Lưu thành công'];
            } else {
                $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
            }
            return redirect('/admin/user/')->with($alert);   
        }
    }
}