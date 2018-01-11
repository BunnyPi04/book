@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href="#">Tình trạng các kho </a><a href="{{asset('/admin/book_value/add')}}"><button type="button" class="btn btn-warning top-btn orbtn"> + Thêm sách vào kho</button></a></h3>
        <div class="row" style="margin-bottom: 10px;">
            <form method="post">
                {{ csrf_field() }}
                <div class="col-md-4">Chọn kho hàng</div>
                <div class="col-md-5">
                    <select name="store" required="">
                        @foreach ($stores as $store)
                            <option value="{{ $store->store_id }}">{{ $store->store_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="text-align: right;">
                    <input type="submit" class="btn btn-warning top-btn" value="Lọc thông tin">
                </div>
            </form>
        </div>
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
                    <th class="col-md-2">SKU</th>
                    <th class="col-md-4">Tên sách</th>
                    <th class="col-md-3">Tên nhà sách</th>
                    <th class="col-md-1">Số lượng</th>
                    <th class="col-md-1 text-center"><span class="glyphicon glyphicon-pencil"></span></th>
                    <th class="col-md-1 text-center"><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
                @if (isset($query))
                    @foreach ($query as $item)
                    <tr>
                        <td><a>{{$item['sku']}}</a></td>
                        <td><b><a>{{$item['book_name']}}</a></b></td>
                        <td>{{$item['store_name']}}</td>
                        <td>{{$item['number']}}</td>
                        <td class="text-center"><a href="{{ URL('/admin/book_value/edit/'.$item['id'] )}}">Sửa</a></td>
                        <td class="text-center"><a href="{{ URL('/admin/book_value/delete/'.$item['id'] )}}">Xóa</a></td>
                    </tr>
                    @endforeach
                @endif
            </table>
        </div>
        <script type="text/javascript">
        $(document).ready(function(e) {
            $('.pagination li a').click(function() {
                var page = $(this).attr('href').split('page=')[1];
                $.get('book_value?page=' + page,function(data) {
                    $('body').html(data);
                });
                return false;
                })
            });
        </script>
        {{ $query->links() }}
    </div>
@stop