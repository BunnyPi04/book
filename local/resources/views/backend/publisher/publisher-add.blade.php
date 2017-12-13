@extends('backend.master')
@section('main')
@if ($errors->any())
    <div class="alert alert-danger calibri">
        {!! implode('', $errors->all(':message<br/> 
                ')) !!}
    </div>
    @endif
    @if (isset($error)) 
        <div class="alert alert-danger calibri">
             {{ $error }} <br/> 
        </div> 
    @endif
    <div class="row book-block">
    <h3 class="book-block-title"><a href="#">Thêm nhà xuất bản mới </a></h3>
    <div>
        <form method="post">
            <div class="form-group">
	            <label class="form-control-label" for="formGroupExampleInput">Tên nhà xuất bản:</label>
	            <input type="text" class="form-control" id="formGroupExampleInput" name="publisher_name" />
	        </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning" style="float: right;">Thêm</button>
            </div>
            {{ csrf_field() }} 
        </form>
    </div>
</div>
@stop