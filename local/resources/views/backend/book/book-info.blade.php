@extends('backend.master')
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
            <table class="status-table">
                <tr>
                    <th colspan="2">Tình trạng</th>
                </tr>
                <tr>
                    <th>Tiệm</th>
                    <th>Số lượng</th>
                </tr>
                @if (isset($value))
                    @foreach ($value as $item)
                        @if ($book['sku'] == $item['sku'])  
                            <tr>
                                <td>{{$item['store_name']}}</td>
                                <td>{{$item['number']}} cuốn</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </table>
            {{-- <p class="text-center"><button type="button" class="btn btn-warning" onclick="javascript:location.href='cart.html'">Đặt mua online</button></p> --}}
        </div>
    </div>
    <div class="row description">
    <h4><b>Giới thiệu sách</b></h4>
    <p class="text-justify sumarize">{!! $book['description'] !!}</p>
    </div>
    @endforeach
     @endif
</div>
@stop