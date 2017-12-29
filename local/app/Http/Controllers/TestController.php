<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    //
    public function test($a, $b) {
    	return 'Xin chào: '.$a.' và '.$b;
    }
    public function hello() {
    	$arr = [
    		'nam'=>'Hưng',
    		'nu'=>'Tuyết'		//Khi truyền mảng tử controller thì key=> tên biến; value => value của biến
    	];
    	return view('test.hello',$arr); //moduleName.functionController
    }
    public function bye() {
    	return 'See you!';
    }
    public function getForm() {
    	return view('test.form');
    }

    //LoginController
    public function postLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->input('remember');
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)){
            if((Auth::user()->level) == 'Admin') {
                return redirect('admin/');
            } elseif ((Auth::user()->level) == 'User') {
                return back();
            }
        } else {
            $alert = ['error' => 'Sai tài khoản hoặc mật khẩu!'];
            return redirect()->route('post_login');
        }
    }
    public function getForgotPassword() {
        return view('backend-template.layout.form.forgotpassword');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('post_login');
    }
}
