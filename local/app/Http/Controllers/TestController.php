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
}
