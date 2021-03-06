@extends('backend.master')
@section('main')
    <div class="row book-block">
    <h3 class="book-block-title"><a href="#">Sửa mã giảm giá </a></h3>
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
        <form method="post" onsubmit="return validateCouponForm();"> 
            <table class="no-border">
                {{ csrf_field() }}
                @if (isset($query))
                <input type="hidden" name="coupon_id" value="{{ $query['coupon_id'] }}">
                <tr>
                    <td class="col-md-3"><label class="form-control-label" for="formGroupExampleInput">Mã giảm giá: </label></td>
                    <td class="col-md-4"><input list="book_sku" name="code" value="{{ $query['code'] }}"></td>
                </tr>
                <tr>
                    <td class="col-md-3"><label class="form-control-label" for="formGroupExampleInput">Giảm giá</label></td>
                    <td class="col-md-4"><input list="store_id" id="amount" name="amount" value="{{ $query['amount'] }}"></td>
                </tr>
                <tr>
                    <td class="col-md-3"><label for="exampleFormControlFile1">Loại sale</label></td>
                    <td class="col-md-4">
                        <select name="type" id="type">
                            <option value="Percent"
                            @if ($query['type'] == 'Percent')
                            selected 
                            @endif
                            >Theo phần trăm </option>
                            <option value="Price"
                            @if ($query['type'] == 'Price')
                            selected
                            @endif
                            >Theo giá tiền </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="col-md-3"><label>Ngày hết hạn</label></td>
                    <td class="col-md-4"><input type="date" name="expired" value="{{ $query['expired'] }}"></td>
                </tr>
                <tr>
                    <td class="col-md-3"></td>
                    <td class="col-md-4"><button type="submit" class="btn btn-warning" style="float: right;">Lưu</button></td>
                </tr>
                @endif
            </table>
        </form>
    </div>
</div>
@stop