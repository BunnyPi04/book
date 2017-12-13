@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href=".">Danh sách hóa đơn </a><a href="{{asset('/admin/invoice/create')}}"><button type="button" class="btn btn-warning top-btn orbtn"> + Tạo Hóa đơn</button></a></h3>
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
            <table class="list-tb calibri">
                <tr>
                    <th class="col-md-1">Mã số</th>
                    <th class="col-md-2">Cửa hàng</th>
                    <th class="col-md-2">Nhân viên</th>
                    <th class="col-md-3">Tên nhân viên</th>
                    <th class="col-md-2">Thời gian</th>
                    <th class="col-md-1">Giá trị</th>
                    <th class="col-md-1 text-center"><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
                @if (isset($query))
                    @foreach ($query as $item)
                    <tr>
                        <td><a href="{{ URL('/admin/invoice/show/'.$item['id'] )}}">{{ $item['id'] }}</a></td>
                        <td>{{ $item['store_name'] }}</td>
                        <td>{{ $item['cashier_username'] }}</td>
                        <td>{{ $item['fullname'] }}</td>
                        <td>{{ $item['create_at'] }}</td>
                        <td class="text-right">{{ number_format($item['grand_total'], 0) }}</td>
                        <td class="text-center"><a href="{{ URL('/admin/invoice/delete/'.$item['id'] )}}" onclick="javascript:return confirm('Are you sure you want to delete this?')">Xóa</a></td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
        <script type="text/javascript">
        $(document).ready(function(e) {
            $('.pagination li a').click(function() {
                var page = $(this).attr('href').split('page=')[1];
                $.get('invoice?page='+page,function(data) {
                    $('body').html(data);
                });
                return false;
                })
            });
        </script>
        {{$query->links()}}
    </div>
@stop