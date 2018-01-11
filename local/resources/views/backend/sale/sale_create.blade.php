@extends('backend.master')
@section('main')
    <div class="row book-block">
    <h3 class="book-block-title"><a href="#">Tạo chương trình giảm giá </a></h3>
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
        <form method="post">
            <table class="no-border">
                {{ csrf_field() }}
                <tr>
                    <td class="col-md-2"><label class="form-control-label" for="formGroupExampleInput">Giảm giá theo: </label></td>
                    <td class="col-md-4">
                        <h4>Nhà xuất bản</h4>
                        @foreach($publishers as $pub)
                            <input type="radio" name="sale_by" value="pub-{{ $pub->publisher_id }}"><label>{{ $pub->publisher_name }}</label><br/>
                        @endforeach
                    </td>
                    <td class="col-md-4">
                        <h4>Danh mục</h4>
                        @foreach($categories as $cate)
                            <input type="radio" name="sale_by" value="cate-{{ $cate->category_id }}"><label>{{ $cate->category_name }}</label><br/>
                        @endforeach
                        <h4>Cửa hàng</h4>
                        @foreach($stores as $store)
                            <input type="radio" name="sale_by" value="store-{{ $store->store_id }}"><label>{{ $store->store_name }}</label><br/>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td><label class="form-control-label" for="formGroupExampleInput">Giảm giá</label></td>
                    <td colspan="2"><input name="amount" id="amount" required="" min="0" max="100"> %</td>
                </tr>
                <tr>
                    <td><label>Ngày bắt đầu</label></td>
                    <td colspan="2"><input type="date" name="from" required=""></td>
                </tr>
                <tr>
                    <td><label>Ngày hết hạn</label></td>
                    <td colspan="2"><input type="date" name="expired" required=""></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2"><button type="submit" class="btn btn-warning" style="float: right;">Tạo</button></td>
                </tr>
            </table>
        </form>
    </div>
</div>
@stop