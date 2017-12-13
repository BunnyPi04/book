<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Requests;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        $name = $request->name;
        $password = $request->password;
        $remember = $request->input('remember');
        if (Auth::attempt(['name' => $name, 'password' => $password], $remember)){
            if((Auth::user()->position) == 'Admin' || (Auth::user()->position) == 'Keeper') {
                return redirect('admin/');
            } elseif((Auth::user()->position) == 'Cashier') {
                // Auth::logout();
                // session()->flash('message', trans('message.user_disable'));
                return redirect('/admin/');
            } elseif((Auth::user()->position) == 'User') {
                return back();
            }
        } else {
            $alert = ['error' => 'Sai tài khoản hoặc mật khẩu!'];
            return redirect()->route('post_login');
        }
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('post_login');
    }
}
