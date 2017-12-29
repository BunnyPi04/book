@extends('master')
@section('main')
	<div class="book-block"><!--features_items-->
    <h2 class="title text-center">Thông tin đơn hàng</h2>
    @if(isset($error))
        <div class="alert alert-danger calibri">
             {{ $error }} <br/> 
        </div> 
    @endif
    @if (count($cart))
        <table class="cart-table">
            <tr>
                <th class="col-md-2">Hình ảnh</th>
                <th class="col-md-3">Tên sản phẩm</th>
                <th class="col-md-1">Số lượng</th>
                <th class="col-md-1">Đơn giá</th>
                <th class="col-md-1">Thành tiền</th>
            </tr>
        @foreach($cart as $item)
            <tr>
                <td><img src="{{ asset('local//public/images/'.$item->options['image']) }}" alt="" /></td>
                <td>{{ $item->name }}</td>
                <td>{{$item->qty}}</td>
                <td>{{ number_format($item->price) }}</td>
                <td><a class="total{{$item->id}}">{{ number_format($item->total) }}</a></td>
            </tr>
        @endforeach
            <tr>
                <td colspan="4">Tổng</td>
                <td>{{ number_format($info['total']) }}</td>
            </tr>
        @if (isset($query['coupon_code']))
            <tr>
                <td colspan="">Mã giảm giá</td>
                <td>{{ $query['coupon_code'] }}</td>
                <td colspan="2"> Giảm giá </td>
                <td> - {{ number_format($info['sale_coupon_amount']) }}</td>
            </tr>
        @endif
            <tr>
                <td colspan="4">Thanh toán </td>
                <td>{{ number_format($info['grandTotal']) }}</td>
            </tr>
        </table>
        <h3>Thông tin của bạn</h3>
        <form method="post" action="{{ asset('/checkout') }}">
        {{ csrf_field() }}
        <table class="no-border">
            <tr>
                <td><label>Họ và tên</label></td>
                <td>{{ $query['name'] }}</td>
            </tr>
            <tr>
                <td><label>Email</label></td>
                <td>{{ $query['email'] }}</td>
            </tr>
            <tr>
                <td><label>Thành phố</label></td>
                <td>{{ $query['city'] }}</td>
            </tr>
            <tr>
                <td><label>Địa chỉ giao hàng</label></td>
                <td>{{ $query['add'] }}</td>
            </tr>
            <tr>
                <td><label>Số điện thoại</label></td>
                <td>{{ $query['phone'] }}</td>
            </tr>
        </table>
    @endif
        <input type="hidden" name="coupon_code" value="{{ $query['coupon_code'] }}">
        <input type="hidden" name="name" required value="{{ $query['name'] }}">
        <input type="hidden" name="email" required value="{{ $query['email'] }}">
        <input type="hidden" name="city" required value="{{ $query['city'] }}">
        <textarea name="add" required style="display: none;">{{ $query['add'] }}</textarea>
        <input type="hidden" name="phone" required value="{{ $query['phone'] }}">
        <textarea name="note" style="display: none;"></textarea>
    <div style="float: right;">
        <a href="{{ asset('/cart/info/') }}" class="btn btn-primary">Quay lại</a>
        <button type="submit" class="btn btn-warning">Thanh toán</button></div>
    </form>
    <p>Đơn hàng của bạn sẽ được nhân viên xác nhận thông qua email bạn đã cung cấp.</p>
</div><!--features_items-->
<style type="text/css">
    .no-border td {
        border: none;
    }
    .no-border label {
        font-size: 15px;
    }
</style>
@stop