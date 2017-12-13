@extends('master')

@section('main')
<div class="book-block">
    <h3  class="book-block-title"><a href="#">Thông tin sách</h3>
    @if (isset($books))
    @foreach ($books as $book) 
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <img src="{{URL::asset('/local/public/images/'.$book['image'])}}"/>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <h4 class="text-center"><a href="#" class="book-name">{{ $book['book_name'] }}</a></h4>
            @if ($book->special_price != null)
                <p class="text-center unsale-price">Giá bán: {{ number_format($book['price'], 0) }} đ</p>
                <p class="text-center price">Sale: {{ number_format($book['special_price'], 0) }} đ</p>
                <p>Từ ngày {{date('d-m-Y', strtotime(str_replace('/', '-', $book['from_date'])))}} đến ngày {{date('d-m-Y', strtotime(str_replace('/', '-', $book['to_date'])))}}</p>
            @else
               <p class="text-center price">Giá bán: {{ number_format($book['price'], 0) }} đ</p>
            @endif
            <p><h4><b>Thể loại: </b><br/>
                @if (isset($category_value))
                    @foreach ($category_value as $category)
                        @if ($category['sku'] == $book['sku'])
                            {{ $category['category_name'] }}<br/>
                        @endif
                    @endforeach
                @endif
            </h4></p>
            <p><h4><b>Tác giả: </b>{{ $book['author'] }}</h4></p>
            <p><h4><b>Nhà xuất bản: </b>{{ $book['publisher_name'] }}</h4></p>

            <br />
            <p><h4><b>Tình trạng: </b></h4>
                @if ($sum['count'] != 0)
                    Còn hàng</p>
                    <form id="cart-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p class="text-center"><button type="button" class="btn btn-warning" onclick="add_item({{ $book['book_id']}})">Thêm vào giỏ</button></p>
                    </form>
                @else
                    Hết hàng</p>
                @endif</th>
        </div>
    </div>
    <div class="row description text-justify">
    <h4><b>Giới thiệu sách</b></h4>
    <p class="text-justify sumarize">{!! $book['description'] !!}</p>
    </div>
    @endforeach
    @endif
    <hr>
    <div>
        <h4><b>Viết bình luận</b></h4>
            @if (Auth::guest())
                <textarea name="description" disabled="1" placeholder="Bạn phải đăng nhập để bình luận"></textarea>
            @else
            <input type="hidden" value="{{ csrf_token() }}">
            <form name="description" method="post" action="">
                <label>Username: {{ Auth::user()->name }}</label>
                <input type="hidden" name="name" value="{{ Auth::user()->name }}"><br/>
                <input type="hidden" name="book_id" value="{{ $book['book_id']}}">
                <textarea name="description"></textarea>
            </form>
            @endif
    </div>
    @if (isset($comments))
        @foreach($comments as $item)
            <div class="comments-div">
                <h4>{{ $item['name'] }}</h4>
                <p>{!! $item['description'] !!}</p>
            </div>
        @endforeach
    @endif
</div>
@stop