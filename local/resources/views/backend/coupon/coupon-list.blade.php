@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href="#">Phiếu giảm giá </a><a href="{{asset('/admin/coupon/add')}}"><button type="button" class="btn btn-warning top-btn orbtn"> + Thêm coupon</button></a></h3>
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
                    <th class="col-md-2">Coupon code</th>
                    <th class="col-md-3">Giảm giá</th>
                    <th class="col-md-3">Loại sale</th>
                    <th class="col-md-2">Ngày hết hạn</th>
                    <th class="col-md-1 text-center"><span class="glyphicon glyphicon-pencil"></span></th>
                    <th class="col-md-1 text-center"><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
                @if (isset($query))
                    @foreach ($query as $item)
                    <tr>
                        <td><a>{{$item['code']}}</a></td>
                        <td class="text-right"><b><a>{{ number_format($item['amount'], 0) }}</a></b></td>
                        <td>{{$item['type']}}</td>
                        <td>{{$item['expired']}}</td>
                        <td class="text-center"><a href="{{ URL('/admin/coupon/edit/'.$item['coupon_id'] )}}">Sửa</a></td>
                        <td class="text-center"><a href="{{ URL('/admin/coupon/delete/'.$item['coupon_id'] )}}">Xóa</a></td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@stop