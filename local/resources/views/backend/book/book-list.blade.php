@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href="#">Danh mục sản phẩm </a><a href="{{asset('/admin/book/add')}}"><button type="button" class="btn btn-warning top-btn orbtn"> + Thêm sách</button></a></h3>
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
                        <th class="col-md-1">SKU</th>
                        <th class="col-md-2">Ảnh</th>
                        <th class="col-md-3">Tên sách</th>
                        <th class="col-md-2">Sách mới/sách nổi bật</th>
                        <th class="col-md-2">Giá bìa</th>
                        <th class="col-md-1 text-center"><span class="glyphicon glyphicon-pencil"></span></th>
                        <th class="col-md-1 text-center"><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($query))
                        @foreach ($query as $item)
                        <tr>
                            <td style="padding: 5px!important;"><a href="{{ URL('/admin/book/show/'.$item['book_id'] )}}">{{ $item['sku'] }}</a></td>
                            <td style="padding: 5px!important;"><img src="{{ URL::asset('/local/public/images/'.$item['image']) }}"/></td>
                            <td style="padding: 5px!important;"><p><b><a href="{{ URL('/admin/book/show/'.$item['book_id'] )}}">{{ $item['book_name'] }}</a></b></p>
                                <p>Thể loại: <br/>
                                @if (isset($category_value))
                                    @foreach ($category_value as $category)
                                        @if ($category['sku'] == $item['sku'])
                                        {{ $category['category_name'] }}<br/>
                                        @endif
                                    @endforeach
                                @endif
                                {{ $item['category_name'] }}</p>
                            </td>
                            <td style="padding: 5px!important;">
                                @if($item['is_new'] == 1)
                                    <p> Sách mới </p>
                                @endif
                                @if ($item['is_hightlight'] == 1)
                                    <p> Sách nổi bật </p>
                                @endif
                            </td>
                            <td class="text-right" style="padding: 5px!important;">{{ number_format($item['price'], 0) }} đ
                                @if ($item['special_price'] != null )
                                <p>Sale: {{ number_format($item['special_price'], 0) }} đ</p>
                                @endif</td>
                            <td class="text-center" style="padding: 5px!important;"><a href="{{ URL('/admin/book/edit/'.$item['book_id'] )}}">Sửa</a></td>
                            <td class="text-center" style="padding: 5px!important;"><a href="{{ URL('/admin/book/delete/'.$item['book_id'] )}}" onclick="javascript:return confirm('Are you sure you want to delete this?')">Xóa</a></td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        {{ $query->links() }}
    </div>
@stop
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(e) {
        $('.pagination li a').click(function() {
            var page = $(this).attr('href').split('page=')[1];
            $.get('book?page=' + page, function(data) {
                $('body').html(data);
            });
            return false;
            })
        });
    </script>
@endsection