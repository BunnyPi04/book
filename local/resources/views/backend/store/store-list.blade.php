@extends('backend.master')
@section('main')
	<div class="row book-block">
	    <h3 class="book-block-title"><a href="{{asset('/admin/store')}}">Danh sách cửa hàng </a></h3>
		@if(Session::has('passes'))
            <div class="alert alert-success calibri">
                 {{ session('passes') }} <br/> 
            </div> 
        @endif
        @if(Session::has('error'))
                <div class="alert alert-danger calibri">
                     {{ session('error') }} <br/> 
                </div> 
        @endif
	    <a href="{{asset('/admin/store/add')}}"><button type="button" class="btn btn-warning top-btn" style="float: right;"> + Thêm cửa hàng</button></a>
	    <div>
		    <table class="ahkio">
		    	<tr>
		    		<th class="col-md-4 text-center">Tên cửa hàng</th>
		    		<th class="col-md-4 text-center">Địa chỉ</th>
		    		<th class="col-md-2 text-center">Số điện thoại</th>
		    		<th class="col-md-1 text-center">Sửa</th>
		    		<th class="col-md-1 text-center">Xóa</th>
		    	</tr>	
		    	@if (isset($query))
		    		@foreach ($query as $item)
		    			<tr>
		    				<td>{{ $item['store_name'] }}</td>
		    				<td>{{ $item['address'] }}</td>
		    				<td>{{ $item['phone'] }}</td>
		    				<td><a href="{{ URL('/admin/store/edit/'.$item['store_id'])}}">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-pencil-square-o"></i>Sửa
                                </button>
                            </a></td>
		    				<td><form action="{{ url('/admin/store/delete/'.$item['store_id']) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger" onclick="javascript:return confirm('Are you sure you want to delete this?')">
                                            <i class="fa fa-trash"></i>Xóa
                                        </button>
                                    </form></td>
		    			</tr>
		    		@endforeach
		    	@endif
		    </table>
	    </div>
    </div>
@stop
<style type="text/css">
	table {
		font-size: 20px;
	}
	td {
		font-family: calibri;
		vertical-align: top;
		line-height: 40px;
	}
</style>