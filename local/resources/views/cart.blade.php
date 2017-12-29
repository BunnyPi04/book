@extends('master')
@section('main')
<div class="book-block"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @if (count($cart))
        <table class="cart-table">
            <tr>
                <th class="col-md-2">Hình ảnh</th>
                <th class="col-md-3">Tên sản phẩm</th>
                <th class="col-md-3">Số lượng</th>
                <th class="col-md-1">Đơn giá</th>
                <th class="col-md-1">Thành tiền</th>
                <th class="col-md-1">Xóa</th>
            </tr>
        @foreach($cart as $item)
            <tr>
                <td><img src="{{ asset('local//public/images/'.$item->options['image']) }}" alt="" /></td>
                <td>{{ $item->name }}</td>
                <td>
                    <button class="cart_quantity_up float-left" onclick="add_item({{$item->id}})"> + </button>
                    <input class="cart_quantity_input{{$item->id}} float-left" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="2" disabled="1">
                    <button class="cart_quantity_down" onclick="remove_item({{ $item->id }})"> - </button>
                </td>
                <td>{{ number_format($item->price) }}</td>
                <td><a class="total{{$item->id}}">{{ number_format($item->total) }}</a></td>
                <td><button onclick="remove_book({{ $item->id }})">Xóa</button></td>
            </tr>
        @endforeach
            <tr>
                <td colspan="4"><h3>Tổng</h3></td>
                <td colspan="2">{{ $total }}</td>
            </tr>
        </table>
        <h3>Thông tin khách hàng</h3>
        <form method="post">
            {{ csrf_field() }}
        <table class="no-border">
            <tr>
                <td><label>Họ và tên</label></td>
                <td><input type="text" name="name" required class="col-md-8 col-sm-12 col-xs-12" value="{{ Auth::user()->fullname }}"></td>
            </tr>
            <tr>
                <td><label>Email (*)</label></td>
                <td><input type="email" name="email" required class="col-md-8 col-sm-12 col-xs-12" value="{{ Auth::user()->email }}"></td>
            </tr>
            <tr>
                <td><label>Thành phố (*)</label></td>
                <td><input type="text" name="city" required class="col-md-8 col-sm-12 col-xs-12" value="{{ Auth::user()->city }}"></td>
            </tr>
            <tr>
                <td><label>Địa chỉ giao hàng (*)</label></td>
                <td><textarea name="add" class="col-md-8 col-sm-12 col-xs-12" required>{{ Auth::user()->address }}</textarea></td>
            </tr>
            <tr>
                <td><label>Số điện thoại (*)</label></td>
                <td><input type="text" name="phone" class="col-md-8 col-sm-12 col-xs-12" required value="{{ Auth::user()->phone_number }}"></td>
            </tr>
            <tr>
                <td><label>Mã coupon</label></td>
                <td><input type="text" name="coupon_code" class="col-md-8 col-sm-12 col-xs-12"></td>
            </tr>
            <tr>
                <td><label>Ghi chú</label></td>
                <td><textarea name="note" class="col-md-8 col-sm-12 col-xs-12"></textarea></td>
            </tr>
        </table>
    @endif
    <div style="float: right;"><button type="submit" class="btn btn-warning">Tiếp tục</button></div>
    </form>
</div><!--features_items-->
<style type="text/css">
    .no-border td {
        border: none;
    }
    .no-border label {
        font-size: 15px;
    }
</style>
@endsection