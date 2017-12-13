@extends('master')
@section('main')
<div class="book-block"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @if (count($listProduct) > 0)
        <table>
            <tr>
                <thead>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                    <th>Xóa sản phẩm</th>
                </thead>
            </tr>
        </table>
        @foreach(Cart::content() as $item)
            <tr class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ asset('layouts/images'.$item['options']['image']) }}" alt="" />
                            <h2>{{ number_format($item['price'] )}} VNĐ</h2>
                            <p>{{ $item['name'] }}</p>
                        </div>
                        <div class="product-overlay" style="display: none;">
                            <div class="overlay-content">
                                <h2>{{ number_format($product->price )}}</h2>
                                <p>{{ $product->name }}</p>
                                 <form method="POST" action="{{url('cart')}}">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-fefault add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div>
                </div>
            </tr>
        @endforeach
    @endif
    

</div><!--features_items-->
@endsection