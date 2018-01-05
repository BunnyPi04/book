@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href="#">Quản trị </a></h3>
        <div>
            <div class="admin">
                <i class="fa fa-user fa-5x"></i><a href="{{ asset('/admin/user') }}">{{ $countUser }} Người dùng </a>
            </div>
            <div class="admin">
                <i class="fa fa-comment fa-5x"></i><a href="{{ asset('/admin/comment/') }}">{{ $countCommentUnread }} Bình luận chưa đọc </a>
            </div>
            <div class="admin">
                <i class="fa fa-hourglass fa-5x"></i><a href="{{ asset('/admin/order/pending') }}">{{ $countOrderPending }} Đơn hàng chưa xử lý </a>
            </div>
            <div class="admin">
                <i class="fa fa-truck fa-5x"></i><a href="{{ asset('/admin/order/shipping') }}">{{ $countOrderDelivering }} Đơn hàng đang chuyển </a>
            </div>
        </div>
    </div>
    <style type="text/css">
        .admin {
            padding: 15px;
        }
        .admin a {
            font-size: 30px;
            padding: 20px;
        }
    </style>
@stop