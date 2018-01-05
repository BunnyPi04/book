@extends('backend.master')
@section('main')
    <div class="book-block"><!--features_items-->
    <h2 class="title text-center">Thông tin đơn hàng</h2>
    @if(isset($error))
        <div class="alert alert-danger calibri">
             {{ $error }} <br/> 
        </div> 
    @endif
        <table class="cart-table">
            <tr>
                <th class="col-md-3">Tên sản phẩm</th>
                <th class="col-md-1">Số lượng</th>
                <th class="col-md-1">Đơn giá</th>
                <th class="col-md-1">Thành tiền</th>
            </tr>
        @foreach($query_detail as $item)
            <tr>
                <td>{{ $item->book_name }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->subtotal) }}</td>
                <td><a>{{ number_format($item->subtotal * $item->qty) }}</a></td>
            </tr>
        @endforeach
            <tr>
                <td colspan="3"><b>Giảm giá</b></td>
                <td> - {{ number_format($query_order['sale_coupon_amount']) }}</td>
            </tr>
            <tr>
                <td colspan="3"><h4><b>Tổng đơn</b></h4> </td>
                <td>{{ number_format($query_order['total']) }}</td>
            </tr>
        </table>
        <h3>Thông tin khách hàng</h3>
        <table class="no-border">
            <tr>
                <td><label>Họ và tên</label></td>
                <td>{{ $query_order['fullname'] }}</td>
            </tr>
            <tr>
                <td><label>Email</label></td>
                <td>{{ $query_order['email'] }}</td>
            </tr>
            <tr>
                <td><label>Thành phố</label></td>
                <td>{{ $query_order['city'] }}</td>
            </tr>
            <tr>
                <td><label>Địa chỉ giao hàng</label></td>
                <td>{{ $query_order['address'] }}</td>
            </tr>
            <tr>
                <td><label>Số điện thoại</label></td>
                <td>{{ $query_order['phone'] }}</td>
            </tr>
        </table>
    <div>
        <p><h4>Chọn Trạng thái</h4></p>
        <form method="post">
            {{ csrf_field() }}
            <input type="hidden" name="order_id" value="{{ $query_order['id'] }}">
            <input type="radio" name="status" value="Pending" @if ($query_order['status'] == 'Pending') checked="1" @endif> Đang chờ xử lý<br/>
            <input type="radio" name="status" value="Shipping" @if ($query_order['status'] == 'Shipping') checked="1" @endif> Đang chuyển hàng<br/>
            <input type="radio" name="status" value="Done"  @if ($query_order['status'] == 'Done') checked="1" @endif> Đã hoàn thành<br/>
            <input type="submit" value="Lưu" class="btn btn-warning">
        </form>
    </div>
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