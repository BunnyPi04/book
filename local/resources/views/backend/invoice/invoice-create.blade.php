@extends('backend.master')
@section('main')
    <div class="row book-block">
    <h3 class="book-block-title"><a href="#">Tạo hóa đơn </a></h3>
    @if ($errors->any())
    <div class="alert alert-danger calibri">
        {!! implode('', $errors->all(':message<br/> 
                ')) !!}
    </div>
    @endif
    @if (isset($error)) 
        <div class="alert alert-danger calibri">
             {{ $error }} <br/> 
        </div> 
    @endif
    <div>
        <form method="post" enctype="multipart/form-data" > 
            {{ csrf_field() }}
            <p><b>Tên nhân viên: </b>{{ Auth::user()->name }} - {{ (Auth::user()->fullname) }}</p>
            <p><b>Cửa hàng: </b></p>
            <div>
                <input list="book_sku" name="book_sku">
                        <datalist class="custom-select mb-2 mr-sm-2 mb-sm-0" id="book_sku">
                            @if (isset($book))
                                @foreach ($book as $item)
                                    <option value="{{ $item['sku'] }}">{{ $item['sku'] }} - {{ $item['book_name'] }}</option>
                                @endforeach
                            @endif
                        </datalist>
                <button onclick="">Thêm</button>
            </div>
            <table id="datatbl">
                <thead>
                    <tr>
                        <th class="col-md-2">SKU</th>
                        <th class="col-md-2">Tên sách</th>
                        <th class="col-md-1">Còn hàng</th>
                        <th class="col-md-2">Giá bìa</th>
                        <th class="col-md-2">Sale</th>
                        <th class="col-md-2">Thành tiền</th>
                        <th class="col-md-1">Chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($book))
                        @foreach ($book as $item)
                            <tr class="test">
                                <td>{{ $item['sku'] }}</td>
                                <td>{{ $item['book_name'] }}</td>
                                <td>3</td>
                                <td>{{ number_format($item['price'], 0) }}</td>
                                <td>
                                    @if (isset($item['special_price']) && (date('Y-m-d') >= $item['from_date']) && (date('Y-m-d') <= $item['to_date']))
                                        {{ number_format($item['special_price'], 0) }}
                                    @endif
                                </td>
                                <td>
                                    @if (isset($item['special_price']) && (date('Y-m-d') >= $item['from_date']) && (date('Y-m-d') <= $item['to_date']))
                                        {{ number_format($item['special_price'], 0) }}
                                    @else
                                        {{ number_format($item['price'], 0) }}
                                    @endif
                                </td>
                                <td><input type="button" name="add" value="Add" onclick="add_to_cart('{{ $item['sku'] }}', '{{ $item['book_name'] }}', '{{ $item['price'] }}', '{{ $item['special_price'] }}', '{{ $item['from_date'] }}');" /></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </form>
        <table id="order_body" class="row">
            <tr>
                <td class="col-md-3">Tên sp</td>
                <td class="col-md-1">SL</td>
                <td class="col-md-2">Giá bìa</td>
                <td class="col-md-2">Sale</td>
                <td class="col-md-2">Thành tiền</td>
            </tr>
            <!-- View shopping cart[] -->
        </table>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatbl').DataTable( {
                "scrollY":        "200px",
                "scrollCollapse": true,
                "paging":         false
            } );
        } );
    </script>
@endsection