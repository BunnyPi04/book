<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryCheck;
use App\Http\Requests;
use App\Category;
use Validator;
use Auth;

class CategoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function list() {
        $query = Category::all();

        return view('backend.category.category-list', compact('query'));
    }

    public function getAdd() {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            return view('backend.category.category-add');
        } else{
            $alert = ['error' => 'You dont have permission!'];

            return redirect('/admin/category/')->with($alert);
        }
    }

    public function postAdd(CategoryCheck $request) {
        $category = $request->input('category_name');
        $cate = new Category;
        if ($cate->where('category_name', $category)->count() > 0) {
            $alert = ['error' => 'Lỗi trùng tên danh mục!'];
            
            return view('backend.category.category-add', $alert);
        }
        else {
            $query = $cate->insertGetId(
			    ['category_name' => "$category"]);
            if ($query > 0) {
                // $messages  = 'Đăng nhập thành công';
                $alert = ['passes' => 'Thêm thành công'];
            }
            else {
                $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
            }
            return redirect('/admin/category')->with($alert);
    	}
    }

    public function getEdit($category) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            $cate = new Category;
            $query = $cate->where('category_id', $category)->first();
            return view('backend.category.category-edit', compact('query'));
        } else{
            $alert = ['error' => 'You dont have permission!'];

            return redirect('/admin/category/')->with($alert);
        }
    }

    public function postEdit(CategoryCheck $request) {
        $category_id = $request->input('category_id');
        $category_name = $request->input('category_name');
        $cate = new Category;
        $query = $cate->where('category_id', $category_id)
        ->update(
            ['category_name' => "$category_name"]);
        if ($query > 0) {
            $alert = ['passes' => 'Lưu thành công'];
        }
        else {
            $alert = ['error' => 'Lỗi! Chưa lưu được thông tin!'];
        }
        return redirect('admin/category/')->with($alert);
    }

    public function delete($category) {
        $cate = new Category;
        $query = $cate->where('category_id', $category)->delete();
        if ($query > 0) {
            $alert = ['passes' => 'Đã xóa!'];
        } else {
            $alert = ['error' => 'Lỗi! Chưa xóa được!'];
        }

        return redirect('admin/category/')->with($alert);
    }
    public function delete($category) {
        if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
            $cate = new Category;
            $category_value = new CategoryValue;
            $id = $cate->where('category_id', $category)->first()->category_id;
            $query = $cate->where('category_id', $category)->delete();
            $query_value = $category_value->where('category_id', $category)->get();
            foreach ($query_value as $key) {
                $key->delete();
            }
            return redirect()->back();
        } else {
            $alert = ['error' => 'You dont have permission!'];

            return redirect('admin/category/')->with($alert);
        }
    }
}
