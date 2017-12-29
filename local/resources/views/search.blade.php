@extends('master')

@section('main')
<div class="book-block">
    <h3  class="book-block-title"><a href="{{ asset('/new-book/') }}">Sách mới</a></h3>
    <ul class="book-item">
        @if (isset($query))
            @if ($no == 0)
                <h4>Không tìm thấy kết quả nào</h4>
            @endif
            @foreach ($query as $item)
                <li class="col-md-3 col-sm-6 col-xs-12 book-area">
                    <a href="book-infor.html">
                        <img src="{{ asset('/local/public/images/'.$item['image']) }}"/></a>
                    @if (isset($number))
                            @php
                                $count = 0;
                            @endphp
                        @foreach ($number as $key)
                            @php
                                $count = 0;
                            @endphp
                            @if ($key['sku'] == $item['sku'])
                                @php 
                                    $count = $count + 1;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if ($count == 0)
                            <img class='sold-out' src="{{ asset('/local/public/images/icon/sold-out.png') }}"/>
                        @endif
                    @endif
                    <h4><a class="book-title" href="book-infor.html">{{ $item['book_name'] }}</a></h4>
                    <div class="des">
                        @if (($item['from_date'] <= date('Y-m-d')) && ($item['special_price'] != null))
                            <p class="text-center unsale-price">{{ number_format($item['price'], 0) }} đ</p>
                            <p class="text-center price">Sale: {{ number_format($item['special_price'], 0) }} đ</p>
                        @else
                           <p class="text-center price">{{ number_format($item['price'], 0) }} đ</p>
                        @endif
                    </div>
                    <a href="{{ asset('/book/show/'.$item['book_id']) }}">
                        <div class="overlay">
                            <div class="text">{{ $item['book_name'] }}</div>
                        </div>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
    {{$query->links()}}
</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() { 
        var heights = $(".book-area").map(function() {
            return $(this).height();
        }).get(),

        maxHeight = Math.max.apply(null, heights);

        $(".book-area").height(maxHeight);
        $('.pagination li a').click(function() {
                var page = $(this).attr('href').split('page=')[1];
                $.get('search?page=' + page, function(data) {
                    $('body').html(data);
                });
                return false;
                })
    });
</script>
@stop