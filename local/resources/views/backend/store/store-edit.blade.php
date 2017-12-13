@extends('backend.master')
@section('main')
	<div class="row book-block">
	    <h3 class="book-block-title"><a href="{{asset('/admin/store')}}">Sửa thông tin cửa hàng </a></h3>
	    @if ($errors->any())
	    <div class="alert alert-danger calibri">
	        {!! implode('', $errors->all(':message<br/> 
	                ')) !!}
	    </div>
	    @endif
	    <div>
	    @if (isset($query))
	        <form method="post">
		        <input type="hidden" name="store_id" value="{{$query['store_id']}}">
	            <div class="form-group">
		            <label class="form-control-label" for="formGroupExampleInput">Tên cửa hàng: </label>
		            <input type="text" class="form-control" id="formGroupExampleInput" name="store_name" value="{{$query['store_name']}}" />
		        </div>
	            <div class="form-group">
		            <label class="form-control-label" for="formGroupExampleInput">Địa chỉ</label>
		            <textarea class="form-control" id="formGroupExampleInput" name="store_add" >{{$query['address']}}</textarea>
	            </div>
	            <div class="form-group">
		            <label for="exampleFormControlFile1">Điện thoại</label>
		            <input type="text" class="form-control" id="exampleFormControlFile1" name="store_phone" value="{{$query['phone']}}" />
		        </div>
	            <div class="form-group">
	                <button type="submit" class="btn btn-warning" style="float: right;">Lưu lại</button>
	            </div>
	            {{ csrf_field() }} 
	        </form>
        @endif
    </div>
    </div>
@stop
