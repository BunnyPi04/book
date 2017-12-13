<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeCheck;
use App\Http\Requests;
use Validator;
use DB;

class EmployeesController extends Controller
{
    //
    public function list() {
    	$query = DB::table('employees')->get();
    	return view('backend.employee-list',['query'=>$query->toArray()]);
    }
    public function getAdd() {
        return view('backend.employee-add');
    }
    public function postAdd(EmployeeCheck $request) {
        $emp_name = $request->input('emp_name');
        $emp_username = $request->input('emp_username');
        $emp_pass = $request->input('emp_pass');
        $emp_phone_number = $request->input('emp_phone_number');
        $emp_position = $request->input('emp_position');
        $emp_active = $request->input('emp_active');
        if (DB::table('employees')->where('emp_username',$emp_username)->count()>0) {
        	$alert=['error'=>'Lỗi trùng tên đăng nhập!'];
        	return view('backend.employee-add',$alert);
        }
        else {
            $query = DB::table('employees')->insertGetId(
			    ['emp_name' => "$emp_name",
			     'emp_username'=>"$emp_username",
			     'emp_pass'=>"$emp_pass",
			     'phone_number' => "$emp_phone_number",
			     'position' => "$emp_position",
			     'active'=>"$emp_active"]);
            if ($query>0) {
                // $messages  = 'Đăng nhập thành công';
                $alert = ['passes'=>'Thêm thành công'];
            }
            else {
                $alert = ['error'=>'Lỗi! Chưa lưu được thông tin!'];
            }
            return redirect('/admin/employee')->with($alert);
    	}
    }
    public function getEdit($employee) {
        $query = DB:: table('employees')->where('emp_id',$employee)->get();
        return view('backend.employee-edit',['query'=>$query->toArray()]);
    }
    public function postEdit(EmployeeCheck $request) {
        $emp_id = $request->input('emp_id');
        $emp_name = $request->input('emp_name');
        $emp_username = $request->input('emp_username');
        if (isset($request->new_pass)) {
            $emp_pass = $request->input('new_pass');
        } else {
            $emp_pass = $request->input('emp_pass');
        }
        $emp_phone_number = $request->input('emp_phone_number');
        $emp_position = $request->input('emp_position');
        $emp_active = $request->input('emp_active');
        if (DB::table('employees')->where('emp_username',$emp_username)
                                ->where('emp_id','<>',$emp_id)->get()->count()>0) {
            $alert=['error'=>'Trùng tên đăng nhập'];
            return view('backend.employee-edit',$alert);
        } else {
            $query = DB::table('employees')->where('emp_id',$emp_id)
                ->update(
                ['emp_name' => "$emp_name",
                'emp_username' =>"$emp_username",
                'emp_pass'=>"$emp_pass",
                'phone_number'=>"$emp_phone_number",
                'position'=>"$emp_position",
                'active'=>"$emp_active"
                ]);
            if ($query>0) {
                $alert = ['passes'=>'Lưu thành công'];
            }
            else {
                $alert = ['error'=>'Lỗi! Chưa lưu được thông tin!'];
            }
            return redirect('admin/employee/')->with($alert);
        }
    }
    public function delete($employee) {
        $query = DB::table('employees')->where('emp_id',$employee)->delete();
        return redirect('admin/employee/');
    }
}
