@extends('backend.master')
@section('main')
    <div class="row book-block">
        <form method="post">
                    {{ csrf_field() }}
        <h3 class="book-block-title"><a href="#">Danh mục sản phẩm </a><a><button type="submit" class="btn btn-warning top-btn orbtn" onclick="return confirm('Bạn có muốn lưu lại thay đổi?');"> Lưu</button></a></h3>
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
            <table class="list-tb calibri" id="datatbl">
                <thead>
                    <tr>
                        <th class="col-md-2">SKU</th>
                        <th class="col-md-5">Tên sách</th>
                        <th class="col-md-3">Tác giả</th>
                        <th class="col-md-2">Sách mới</th>
                    </tr>
                </thead>
                <tbody>
                @if (isset($query))
                    @foreach ($query as $item)
                    <tr>
                        <td><a href="{{ asset('/admin/book/show/'.$item['book_id'] )}}">{{ $item['sku'] }}</a></td>
                        <td><b><a href="{{ asset('/admin/book/show/'.$item['book_id'] )}}">{{ $item['book_name'] }}</a></b>
                        </td>
                        <td>
                            {{ $item['author'] }}
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="is_new[{{$item['sku']}}]" value="{{ $item['sku'] }}"
                            @if($item['is_new'] == 1)
                                checked
                            @endif
                            >
                        </td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
                </form>
            </table>
        </div>
        {{-- {{$query->links()}} --}}
    </div>
@stop
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatbl').dataTable({
                "scrollY":        "200px",
                "scrollCollapse": true,
                "paging":         false
            });
            $('.pagination li a').click(function() {
                var page = $(this).attr('href').split('page=')[1];
                $.get('add?page=' + page, function(data) {
                    $('body').html(data);
                });
                return false;
            })
        });
    </script>
@endsection