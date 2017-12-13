@extends('backend.master')
@section('main')
	<div class="row book-block">
	    <h3 class="book-block-title"><a href="{{asset('/admin/category')}}">Sửa thông tin Nhà xuất bản </a></h3>
	    @if ($errors->any())
	    <div class="alert alert-danger calibri">
	        {!! implode('', $errors->all(':message<br/> 
	                ')) !!}
	    </div>
	    @endif
	    <div>
	    @if (isset($query))
	        <form method="post">
		        <input type="hidden" name="category_id" value="{{$query['category_id']}}">
	            <div class="form-group">
		            <label class="form-control-label" for="formGroupExampleInput">Tên danh mục: </label>
		            <input type="text" class="form-control" id="formGroupExampleInput" name="category_name" value="{{$query['category_name']}}" />
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
