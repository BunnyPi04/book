@extends('backend.master')
@section('main')
    @if ($errors->any())
    <div class="alert alert-danger calibri">
        {!! implode('', $errors->all(':message<br/> 
                ')) !!}
    </div>
    @endif
    <div class="row book-block">
    <h3 class="book-block-title"><a href="#">Thêm cửa hàng mới </a></h3>
    <div>
        <form method="post">
            <div class="form-group">
	            <label class="form-control-label" for="formGroupExampleInput">Tên cửa hàng: </label>
	            <input type="text" class="form-control" id="formGroupExampleInput" name="store_name" />
	        </div>
            <div class="form-group">
	            <label class="form-control-label" for="formGroupExampleInput">Địa chỉ</label>
	            <textarea class="form-control" id="formGroupExampleInput" name="store_add" ></textarea>
            </div>
            <div class="form-group">
	            <label for="exampleFormControlFile1">Điện thoại</label>
	            <input type="text" class="form-control" id="exampleFormControlFile1" name="store_phone" />
	        </div>
            <div class="form-group">
                <button type="submit" class="btn btn-warning" style="float: right;">Thêm</button>
            </div>
            {{ csrf_field() }} 
        </form>
    </div>
</div>

@stop