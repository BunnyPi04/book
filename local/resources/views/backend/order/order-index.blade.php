@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href="#">Quản lý đơn hàng online </a></h3>
        <div class="book-section">
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
            <div class="admin">
                <i class="fa fa-list fa-5x"></i><a href="{{ asset('/admin/order/list') }}"> Tất cả đơn hàng </a>
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
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#datatbl').DataTable();
    })
</script>
@endsection