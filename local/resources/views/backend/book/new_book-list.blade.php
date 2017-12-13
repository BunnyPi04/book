@extends('backend.master')
@section('main')
    <div class="row book-block">
        <form method="post">
            {{ csrf_field() }}
            <h3 class="book-block-title"><a href="#">Sách mới </a><a href="{{ asset('/admin/new_book/add') }}"><button type="button" class="btn btn-warning top-btn orbtn"> Thêm sách mới</button></a></h3>
            <div>
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
                 <table class="list-tb calibri">
                <tr>
                    <th class="col-md-1">SKU</th>
                    <th class="col-md-2">Ảnh</th>
                    <th class="col-md-3">Tên sách</th>
                    <th class="col-md-2">Sách mới/sách nổi bật</th>
                    <th class="col-md-2">Giá bìa</th>
                    <th class="col-md-1 text-center"><span class="glyphicon glyphicon-pencil"></span></th>
                    <th class="col-md-1 text-center"><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
                @if (isset($query))
                    @foreach ($query as $item)
                    <tr>
                        <td><a href="{{ URL('/admin/book/show/'.$item['book_id'] )}}">{{ $item['sku'] }}</a></td>
                        <td><img src="{{ URL::asset('/local/public/images/'.$item['image']) }}"/></td>
                        <td><p><b><a href="{{ URL('/admin/book/show/'.$item['book_id'] )}}">{{ $item['book_name'] }}</a></b></p>
                        </td>
                        <td>
                            @if($item['is_new'] == 1)
                                <p> Sách mới </p>
                            @endif
                            @if ($item['is_hightlight'] == 1)
                                <p> Sách nổi bật </p>
                            @endif
                        </td>
                        <td class="text-right">{{$item['price']}} đ
                            @if ($item['special_price'] != null )
                            <p>Sale: {{ $item['special_price'] }} đ</p>
                            @endif</td>
                        <td class="text-center"><a href="{{ URL('/admin/book/edit/'.$item['book_id'] )}}">Sửa</a></td>
                        <td class="text-center"><a href="{{ URL('/admin/book/delete/'.$item['book_id'] )}}" onclick="javascript:return confirm('Are you sure you want to delete this?')">Xóa</a></td>
                    </tr>
                    @endforeach
                @endif
            </table>
            </div>
        </form>
    </div>
@stop