<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PublisherCheck;
use App\Publisher;
use Auth;
use Validator;

class PublishersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function list() {
    	$query = Publisher::all();

    	return view('backend.publisher.publisher-list', compact('query'));
    }

    public function getAdd() {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            return view('backend.publisher.publisher-add');
        } else {
            $alert = ['error' => 'You dont have permission!'];
            
            return redirect('admin/publisher')->with($alert);
        }
    }

    public function postAdd(PublisherCheck $request) {
        $publisher_name = $request->input('publisher_name');
        $pub = new Publisher;
        if ($pub->where('publisher_name', $publisher_name)->count()>0) {
        	$alert = ['error' => 'Lỗi trùng tên nhà xuất bản!'];
            return view('backend.publisher.publisher-add', $alert);
        } else {
            $query = $pub->insertGetId(
			    ['publisher_name' => "$publisher_name"]);
            if ($query > 0) {
                // $messages  = 'Đăng nhập thành công';
                $alert = ['passes' => 'Thêm thành công'];
            } else {
                $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
            }

            return redirect('/admin/publisher')->with($alert);
    	}
    }

    public function getEdit($publisher) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            $pub = new Publisher;
            $query = $pub->where('publisher_id', $publisher)->first();
            return view('backend.publisher.publisher-edit', compact('query'));
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('/admin/publisher/')->with($alert);
        }
    }

    public function postEdit(PublisherCheck $request) {
        $publisher_id = $request->input('publisher_id');
        $publisher_name = $request->input('publisher_name');
        $pub = new Publisher;
        $query = $pub->where('publisher_id', $publisher_id)
            ->update(
            ['publisher_name' => "$publisher_name"]);
        if ($query > 0) {
            // $messages  = 'Đăng nhập thành công';
            $alert = ['passes' => 'Lưu thành công'];
        } else {
            $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
        }
        
        return redirect('admin/publisher/')->with($alert);
    }
    public function delete($publisher) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            $deletePub = new Publisher;
            $query = $deletePub->where('publisher_id', $publisher)->delete();
            if ($query > 0) {
                $alert = ['passes' => 'Đã xóa thành công!'];
            } else
            {
                $alert = ['error' => 'Đã xảy ra lỗi!'];
            }
            return redirect('admin/publisher/')->with($alert);
        } else {
            $alert = ['error' => 'You dont have permission!'];
            
            return redirect('admin/publisher/')->with($alert); 
        }
    }
}
