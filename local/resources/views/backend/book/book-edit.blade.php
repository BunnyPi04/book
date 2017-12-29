@extends('backend.master')
@section('main')
    <div class="row book-block">
    <h3 class="book-block-title"><a href="#">Sửa thông tin sách </a></h3>
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
    <div>
        <form method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            @if (isset($query))
                @foreach ($query as $item)
                    <table class="edit no-border">
                        <tr>
                            <input type="hidden" name="book_id" value="{{$item['book_id']}}">
                            <td><div class="form-group">
                                <label class="form-control-label">SKU: </label>
                                <input type="text" class="form-control" name="sku" value="{{$item['sku']}}"/>
                            </div></td>
                            <td><div class="form-group">
                                <label class="form-control-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="book_name" value="{{$item['book_name']}}"/>
                            </div></td>
                        </tr>
                        <tr>
                            <td><div class="form-group">
                                <label class="form-control-label">Sách mới</label><br/>
                                <input type="radio" name="is_new" value="1" 
                                @if ($item['is_new'] == 1)
                                    checked
                                @endif
                                >: Có<br/>
                                <input type="radio" name="is_new" value="0"
                                @if ($item['is_new'] == 0)
                                    checked
                                @endif
                                >: Không
                            </div></td>
                            <td>
                                <label class="form-control-label">Sách nổi bật</label><br/>
                                <input type="radio" name="is_hightlight" value="1" 
                                @if ($item['is_hightlight'] == 1)
                                    checked
                                @endif
                                >: Có<br/>
                                <input type="radio" name="is_hightlight" value="0"
                                @if ($item['is_hightlight'] == 0)
                                   checked
                                @endif
                                >: Không
                            </div></td>
                        </tr>
                        <tr>

                            <td><div class="form-group">
                                <label>Hình ảnh</label>
                                <img style="width: 200px" src="{{URL::asset('/local/public/images/'.$item['image'])}}"/>
                                <input type="hidden" name="old_images" value="{{$item['image']}}">
                              </div></td>
                            <td>
                                <label class="form-control-label">Thể loại</label>
                                <div class="form-group" style="overflow-y: scroll; height: 250px;">
                                @if (isset($categories))
                                    @foreach ($categories as $cate)
                                        <p><input type="checkbox" name="category[{{ $cate['id'] }}]" value="{{ $cate['category_id']}}"
                                            @if (isset($query_value))
                                                @foreach($query_value as $key)
                                                    @if ($key['category_id'] == $cate['category_id'])
                                                    checked 
                                                    @endif
                                                @endforeach
                                            @endif
                                            />
                                        <label for="category">{{ $cate['category_name']}}</label></p>
                                    @endforeach
                                @endif
                            </div></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                <label>Hình ảnh mới </label><br />
                                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="images" />
                                </div>
                                <div class="form-group">
                                <label class="form-control-label">Nhà xuất bản</label><br />
                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="publisher_id">
                                    @if(isset($publishers))
                                        @foreach($publishers as $pub)
                                        <option value="{{$pub['publisher_id']}}" 
                                            @if ($item['publisher_id'] == $pub['publisher_id'])
                                                selected
                                            @endif
                                        >{{$pub['publisher_name']}}</option>
                                        @endforeach
                                    @endif
                                 </select>
                            </div></td>
                            <td><div class="form-group">
                                <label class="form-control-label">Tác giả</label>
                                <input type="text" class="form-control" name="author" value="{{$item['author']}}"/>
                            </div></td>
                        </tr>
                        <tr>
                            <td><div class="form-group">
                                <label class="form-control-label">Giá bìa</label>
                                <input type="number" class="form-control" name="price" value="{{$item['price']}}"/>
                            </div></td>
                            <td><div class="form-group">
                                <label class="form-control-label">Giá sale</label>
                                <input type="number" class="form-control" name="special_price" value="{{$item['special_price']}}">
                            </div></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label class="form-control-label">Áp dụng từ: </label>
                                <input type="date" name="from_date"
                                @if (isset($item['from_date']))
                                value="{{date('Y-m-d', strtotime(str_replace('/', '-', $item['from_date'])))}}"
                                @endif
                                >
                                </div>
                            </td>
                            <td><div class="form-group">
                                <label class="form-control-label">Áp dụng đến: </label>
                                <input type="date" name="to_date"
                                @if (isset($item['to_date']))
                                 value="{{date('Y-m-d', strtotime(str_replace('/', '-', $item['to_date'])))}}"
                                @endif
                                >
                            </div></td>
                        </tr>
                        <tr>
                            <td colspan="2">Giới thiệu sách</td>
                        </tr>
                        <tr>
                            <td colspan="2"><textarea name="description" >{{$item['description']}}</textarea></td>
                        </tr>
                    </table>
                @endforeach
            @else
                <div class="alert alert-danger calibri">
                     Không tìm thấy thông tin <br/> 
                </div> 
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-warning" style="float: right;">Lưu</button>
            </div>
        </form>
    </div>
</div>
@stop