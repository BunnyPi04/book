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
            } elseif ((Auth::user()->position) == 'Cashier') {
                // Auth::logout();
                // session()->flash('message', trans('message.user_disable'));
                return redirect('/admin/');
            } elseif ((Auth::user()->position) == 'User') {
                return back();
            }
        } else {
            $alert = ['error' => 'Sai tài khoản hoặc mật khẩu!'];
            return redirect()->route('post_login')->with($alert);
        }
    }
    public function getForgotPassword() {
        return view('forgotpass');
    }

    public function postForgot(ForgotPassRequest $request) {
        $user = new User;
        $email = $request->email;
        $query = $user->where('email', $email)->first();
        if ($query->count() == 0) {
            $alert = ['error' => 'Không tồn tại email này trong hệ thống!'];

            return redirect()->back()->with($alert);
        } else {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $size = strlen( $chars );
            for( $i = 0; $i < 10; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
            }
            $query = $user->where('email', $email)
                    ->update([
                        'password' => bcrypt($str)
                    ]);
            $user_name = $user->where('email', $email)->first();
            $strBody = '<p>
                    <b>Tiệm sách Minh Minh:</b> đã nhận được yêu cầu reset mật khẩu cho tài khoản '.$user_name['name'].'! <br/>
                    Mật khẩu mới của bạn là: '.$str.'<br />
                    Cảm ơn bạn!';
            require("class.phpmailer.php"); // nạp thư viện
            $mailer = new PHPMailer(); // khởi tạo đối tượng
            $mailer->IsSMTP(); // gọi class smtp để đăng nhập
            $mailer->CharSet="utf-8"; // bảng mã unicode
            
            //Đăng nhập Gmail - mặc định của gmail
            $mailer->SMTPAuth = true; // Đăng nhập
            $mailer->SMTPSecure = "ssl"; // Giao thức SSL
            $mailer->Host = "smtp.gmail.com"; // SMTP của GMAIL
            $mailer->Port = 465; // cổng SMTP
            
            // Phải chỉnh sửa lại
            $mailer->Username = "hangpt248@gmail.com"; // GMAIL username
            $mailer->Password = "kaitokid1412"; // GMAIL password
            $mailer->AddAddress($email, $user_name['name']); //email người nhận
            $mailer->AddCC("bunny.pi.green@gmail.com", "Admin Tiệm sách Minh Minh"); // gửi thêm một email cho Admin
            
            // Chuẩn bị gửi thư
            $mailer->FromName = 'Vietpro Shop'; // tên người gửi
            $mailer->From = 'hangpt248@gmail.com'; // mail người gửi
            $mailer->Subject = 'Đặt lại mật khẩu tài khoản';
            $mailer->IsHTML(TRUE); //Bật HTML không thích thì false
            
            // Nội dung lá thư
            $mailer->Body = $strBody;
            
            // Gửi email
            if(!$mailer->Send()){
                $alert = ['error' => 'Lỗi gửi email: '.$mailer->ErrorInfo];
            }
            else{
                $alert = ['success' => 'Đã gửi email reset mật khẩu cho email của bạn! Xin mời đăng nhập lại'];
            }

            return redirect('/login')->with($alert);
        }
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('post_login');
    }
}
