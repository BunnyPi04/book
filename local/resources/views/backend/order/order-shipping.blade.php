@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href="#">Danh mục các đơn hàng online đang được chuyển đi </a></h3>
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
            <table id="datatbl" class="list-tb calibri">
                <thead>
                    <tr>
                        <th class="col-md-1">Mã đơn hàng</th>
                        <th class="col-md-2">Người đặt</th>
                        <th class="col-md-3">Tổng</th>
                        <th class="col-md-2">Ngày đặt</th>
                        <th class="col-md-2">Trạng thái</th>
                        <th class="col-md-1 text-center"><span class="glyphicon glyphicon-pencil"></span></th>
                        <th class="col-md-1 text-center"><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($query))
                        @foreach ($query as $item)
                        <tr>
                            <td style="padding: 5px!important;">{{ $item['id'] }}</td>
                            <td style="padding: 5px!important;"><a href="{{ URL('/admin/user/info/'.$item['user_id'] )}}">{{ $item['fullname'] }}</a></td>
                            <td style="padding: 5px!important;"><p><b></b></p>
                                {{ number_format($item['total'], 0) }} đ</p>
                            </td>
                            <td style="padding: 5px!important;">
                                {{ $item['created_at'] }}
                            </td>
                            <td class="text-right" style="padding: 5px!important;">{{ $item['status'] }}</td>
                            <td class="text-center" style="padding: 5px!important;"><a href="{{ URL('/admin/order/edit/'.$item['id'] )}}">Sửa</a></td>
                            <td class="text-center" style="padding: 5px!important;"><a href="{{ URL('/admin/order/delete/'.$item['id'] )}}" onclick="javascript:return confirm('Are you sure you want to delete this?')">Xóa</a></td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#datatbl').DataTable();
    })
</script>
@endsection