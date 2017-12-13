<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\demo;
use Validator;
use App\Employee;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
    	return view('backend.admin');
    }

    public function getLogin() {
        return view('backend.login');
    }

    public function postLogin(demo $request) {
        $user_name = $request->input('user_name');
        $user_pass = $request->input('user_pass');
        $query = Employee::where('emp_username', $user_name)
                ->where('emp_pass', $user_pass)
                ->where('active', 1)
                ->get();
        if ($query->count() > 0) {
            // $messages  = 'Đăng nhập thành công';
            $alert = ['passes' => 'Đăng nhập thành công'];

            return redirect('/admin/category/');
        } else {
            $alert = ['error' => 'Lỗi! Sai tài khoản hoặc mật khẩu!'];

            return view('backend.login', $alert);
        }
    }

    public function logout() {
        session_unset();

        return view('backend.login');
    }
    //user
    public function user_add() {
    	return view('backend.user-add');
    }
}
