@extends('backend.master')
@section('main')
	<div class="row book-block">
	    <h3 class="book-block-title"><a href="{{asset('/admin/book_value')}}">Sửa số lượng sách </a></h3>
	    @if ($errors->any())
	    <div class="alert alert-danger calibri">
	        {!! implode('', $errors->all(':message<br/> 
	                ')) !!}
	    </div>
	    @endif
	    <div>
	    @if (isset($query))
	        <form method="post"> 
            <table class="no-border">
                {{ csrf_field() }}
                <tr>
                    <td class="col-md-3"><label class="form-control-label" for="formGroupExampleInput">Chọn sách: </label></td>
                    <td class="col-md-4"><input list="book_sku" name="book_sku" value="{{$query['sku']}}">
                        <datalist class="custom-select mb-2 mr-sm-2 mb-sm-0" id="book_sku">
                            @if (isset($book))
                                @foreach ($book as $item)
                                    <option value="{{$item['sku']}}">{{$item['sku']}} - {{$item['book_name']}}</option>
                                @endforeach
                            @endif
                        </datalist>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3"><label class="form-control-label" for="formGroupExampleInput">Chọn nhà sách</label></td>
                    <td class="col-md-4"><input list="store_id" name="store_id" value="{{$query['store_id']}}">
                    <datalist class="custom-select mb-2 mr-sm-2 mb-sm-0" id="store_id">
                        @if (isset($store))
                            @foreach ($store as $item)
                                <option value="{{$item['store_id']}}">{{$item['store_id']}} - {{$item['store_name']}}</option>
                            @endforeach
                        @endif
                    </datalist>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3"><label for="exampleFormControlFile1">Số lượng</label></td>
                    <td class="col-md-4"><input type="number" name="number" value="{{$query['number']}}" /></td>
                </tr>    
                <tr>
                    <td class="col-md-3"></td>
                    <td class="col-md-4"><button type="submit" class="btn btn-warning" style="float: right;">Lưu</button></td>
                </tr>
            </table>
 
        </form>
        @endif
    </div>
    </div>
@stop
