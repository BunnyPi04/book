@extends('backend.master')
@section('main')
    <div class="row book-block">
    <h3 class="book-block-title"><a href="#">Thêm sách mới </a></h3>
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
    @if(Session::has('error'))
        <div class="alert alert-danger calibri">
             {{ session('error') }} <br/> 
        </div> 
    @endif
    <div>
        <form method="post" enctype="multipart/form-data" > 
            {{ csrf_field() }}
            <table class="edit">
                <tr>
                    <td class="col-md-3"><div class="form-group">
                        <label class="form-control-label" for="formGroupExampleInput">SKU: </label>
                        <input type="text" class="form-control"  value="{{ old('sku') }}" name="sku" />
                    </div></td>
                    <td class="col-md-9"><div class="form-group">
                        <label class="form-control-label" for="formGroupExampleInput">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="book_name" value="{{ old('book_name') }}" />
                    </div></td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label class="form-control-label" for="formGroupExampleInput2">Tác giả</label>
                            <input type="text" class="form-control" value="{{ old('author') }}" name="author" />
                        </div>
                    </td>
                    <td><div class="form-group">
                        <label class="form-control-label" for="formGroupExampleInput2">Nhà xuất bản</label><br />
                        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="publisher_id">
                            @if(isset($publisher))
                                @foreach($publisher as $pub)
                                    <option value="{{$pub['publisher_id']}}">{{$pub['publisher_name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div></td>
                </tr>
                <tr>
                    <td><div class="form-group">
                            <label for="imgInp">Hình ảnh</label>
                            <input type="file" class="form-control-file" id="imgInp" name="images" required="1"/>
                            <img id="preview" src="#" style="width: 200px;"/>
                        </div>
                    </td>
                    <td rowspan="2">
                        <label class="form-control-label" for="formGroupExampleInput2">Thể loại</label>
                        <div class="form-group category-div">
                        @if (isset($category))
                            @foreach ($category as $cate)
                                <p><input type="checkbox" name="category[{{ $cate['id'] }}]" value="{{ $cate['category_id']}}"/>
                                <label for="category">{{ $cate['category_name']}}</label></p>
                            @endforeach
                        @endif
                    </div></td>
                </tr>
                <tr>
                    <td><div class="form-group">
                        <label class="form-control-label" for="formGroupExampleInput2">Giá bìa</label>
                        <input type="number" class="form-control" name="price" value="{{ old('price') }}" />
                    </div></td>
                </tr>
                <tr>
                    <td colspan="2">Giới thiệu sách</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="description" value="{{ old('description') }}" ></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning" style="float: right;">Thêm sách</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function(){
            readURL(this);
        });
    </script>
@stop