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
                    @if (Auth::guest())
                        <form id="cart-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p class="text-center"><a href="{{ asset('/login/') }}" class="btn btn-warning">Đăng nhập để mua sản phẩm</a></p>
                        </form>
                    @else
                        <form id="cart-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p class="text-center"><button type="button" class="btn btn-warning" onclick="add_item({{ $book['book_id'] }})">Thêm vào giỏ</button></p>
                        </form>
                    @endif
                @else
                    Hết hàng</p>
                @endif</th>
        </div>
    </div>
    <div class="row description text-justify">
    <h4><b>Giới thiệu sách</b></h4>
    <p class="text-justify sumarize">{!! $book['description'] !!}</p>
    </div>
    <hr>
    <div>
        <h4><b>Viết bình luận</b></h4>
            @if (Auth::guest())
                <textarea name="description" disabled="1" placeholder="Bạn phải đăng nhập để bình luận"></textarea>
            @else
            <form name="description" method="post" action="" name="logOn">
                {{ csrf_field() }}
                <label>Username: {{ Auth::user()->name }}</label>
                <input type="hidden" name="name" value="{{ Auth::user()->name }}"><br/>
                <input type="hidden" name="book_id" value="{{ $book['book_id']}}">
                <label>Nội dung:</label>
                <br/>
                <input type="text" name="description" id="description" required="" style="width: 400px;">
                <br/>
                <input type="submit" class="btn btn-warning" onclick="return validate();" value="Đăng bình luận">
            </form>
            @endif
    </div>
    @endforeach
    @endif
    @if (isset($comments))
        @foreach($comments as $item)
            <div class="comments-div">
                <h4>{{ $item['name'] }}</h4>
                <small><b>at </b>{{ $item['created_at'] }}</small>
                <p>{!! $item['description'] !!}</p>
            </div>
        @endforeach
    @endif
</div>
<script type="text/javascript">
    function validate(){
        var name = $('#description').val();
        var test = /^[a-zA-Z0-9!@#_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]+$/;
        console.log(name);
        if(!name.match(test)){
            alert("Bạn phải nhập ký tự tiếng việt!");
            return false;
        }               
        return true;
    }
</script>
@stop