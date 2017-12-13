@extends('backend.master')
@section('main')
	<div class="row book-block">
    <h3 class="book-block-title"><a href="{{asset('/admin/user')}}">Danh sách nhân viên </a></h3>
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
    <a href="{{asset('/admin/user/add')}}"><button type="button" class="btn btn-warning top-btn" style="float: right;"> + Thêm người dùng</button></a>
    <div>
	    <table class="ahkio">
	    	<tr>
	    		<th class="col-md-3">Tên người dùng</th>
	    		<th class="col-md-3">Tên đăng nhập</th>
	    		<th class="col-md-1">Vị trí</th>
	    		<th class="col-md-1">Active</th>
	    		<th class="col-md-4">Sửa/Xóa</th>
	    	</tr>	
	    	@if (isset($query))
	    		@foreach ($query as $item)
	    			<tr>
	    				<td><a href="{{ URL('/admin/user/info/'.$item['id'])}}"><b>{{ $item['fullname']}}</b></a></td>
	    				<td class="text-left">{{$item['name']}}
	    				</td>
	    				<td class="text-left">{{$item['position']}}</td>
	    				<td class="text-center">
	    					@if ($item['active'] == 1) 
	    						Active
	    					@elseif ($item['active'] ==0)
	    						Inactive
	    					@endif
	    					</p></td>
	    				<td class="text-center"><a href="{{ URL('/admin/user/info/'.$item['id']) }}">
                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o"></i>Sửa
                            </button>
                        	</a><form action="{{ url('/admin/user/delete/'.$item['id']) }}" method="POST" style="float: left">
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
		border: 1px solid black;
		padding: 3px;
		font-family: calibri;
		vertical-align: top;
		line-height: 40px;
	}
</style>