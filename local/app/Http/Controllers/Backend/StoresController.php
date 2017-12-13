<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCheck;
use App\Http\Requests;
use App\Store;
use Validator;
use Auth;

class StoresController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function list() {
    	$query = Store::all();

    	return view('backend.store.store-list', compact('query'));
    }

    public function getAdd() {
        if((Auth::user()->position) == 'Admin') {
            return view('backend.store.store-add');
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/store/')->with($alert);
        }
    }
    public function postAdd(StoreCheck $request) {
        $store_name = $request->input('store_name');
        $store_add = $request->input('store_add');
        $store_phone = $request->input('store_phone');
        $store = new Store;
        $query = $store->insertGetId(
		    ['store_name' => "$store_name",
		     'address' => "$store_add",
		     'phone' => "$store_phone"]);
        if ($query > 0) {
            $alert = ['passes' => 'Thêm thành công'];
        } else {
            $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
        }
        
        return redirect('/admin/store/');	
    }
    public function getEdit($store_id) {
        if((Auth::user()->position) == 'Admin') {
            $store = new Store;
            $query = $store->where('store_id', $store_id)->first();

            return view('backend.store.store-edit', compact('query'));
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/store/')->with($alert);
        }
    }
    public function postEdit(StoreCheck $request) {
        $store_id = $request->input('store_id');
        $store_name = $request->input('store_name');
        $store_add = $request->input('store_add');
        $store_phone = $request->input('store_phone');
        $store = new Store;
        $query = $store->where('store_id', $store_id)
            ->update(
            ['store_name' => "$store_name",
             'address' => "$store_add",
             'phone' => "$store_phone"]);
        if ($query > 0) {
            // $messages  = 'Đăng nhập thành công';
            $alert = ['passes' => 'Lưu thành công'];
        } else {
            $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
        }
        
        return redirect('admin/store/'); 
    }
    public function delete($store_id) {
        if((Auth::user()->position) == 'Admin') {
            $store = new Store;
            $query = $store->where('store_id', $store_id)->delete();

            return redirect('admin/store/');
        } else{
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/store/')->with($alert);
        }
    }
}