@extends('backend.master')
@section('main')
	<div class="row book-block">
	    <h3 class="book-block-title"><a href="{{asset('/admin/category')}}">Danh sách NXB </a></h3>
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
	    <a href="{{asset('/admin/category/add')}}"><button type="button" class="btn btn-warning top-btn" style="float: right;"> + Thêm danh mục sách</button></a>
	    <div>
		    <table class="ahkio">
		    	<tr>
		    		<th class="col-md-8 text-center">Tên danh mục</th>
		    		<th class="col-md-2">Sửa</th>
		    		<th class="col-md-2">Xóa</th>
		    	</tr>	
		    	@if (isset($query))
		    		@foreach ($query as $item)
		    			<tr>
		    				<td>{{ $item['category_name'] }}</td>
		    				<td><a href="{{ URL('/admin/category/edit/'.$item['category_id'] )}}">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-pencil-square-o"></i>Sửa
                                </button>
                            </a></td>
		    				<td><form action="{{ url('/admin/category/delete/'.$item['category_id']) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?');">
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