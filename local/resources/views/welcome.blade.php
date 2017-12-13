@extends('master')

@section('carousel')
<div class="col-md-9 carousel slide" id="myCarousel" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <a href="#"><img src="{{asset('/local/public/images/sach-napoleon.jpg')}}" alt="slide1" width="100%"/></a>
        </div>
        <div class="item">
            <a href="#"><img src="{{asset('/local/public/images/sale.jpg')}}" alt="slide2" width="100%"/></a>
        </div>
        <div class="item">
            <a href="#"><img src="{{asset('/local/public/images/sale2.jpg')}}" alt="slide3" width="100%"/></a>
        </div>
        <div class="item">
            <a href="#"><img src="{{asset('/local/public/images/codauphapsu.jpg')}}" alt="slide4" width="100%"/></a>
        </div>
        
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@stop

@section('main')
<div class="book-block">
    <h3  class="book-block-title"><a href="#">Sách mới</a></h3>
    <ul class="book-item">
        @if (isset($new_book))
            @foreach ($new_book as $item)
                <li class="col-md-3 col-sm-6 col-xs-12 book-area">
                    <a href="book-infor.html">
                        <img class="tag" src="{{ asset('/local/public/images/new-icon.png') }}">
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
</div>

<!--shelf 2 -->
<div class="book-block">
    <h3 class="book-block-title"><a href="#">Sách nổi bật</a></h3>
    <ul class="book-item">
        @if (isset($hightlight_book))
            @foreach ($hightlight_book as $item)
                <li class="col-md-3 col-sm-6 col-xs-12 book-area">
                    <a href="book-infor.html">
                        <img class="tag" src="{{ asset('/local/public/images/icon/sparkling-star.gif') }}">
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
</div>

<!--shelf 3 -->
<div class="book-block">
    <h3  class="book-block-title"><a href="#">Sách giảm giá</a></h3>
    <ul class="book-item">
        @if (isset($sale_book))
            @foreach ($sale_book as $item)
                <li class="col-md-3 col-sm-6 col-xs-12 book-area">
                    <a href="book-infor.html">
                        <img class="tag" src="{{ asset('/local/public/images/sale-icon.png') }}">
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
    });
</script>
@stop