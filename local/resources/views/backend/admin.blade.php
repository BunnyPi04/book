@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href="#">Danh mục sản phẩm </a><button type="button" class="btn btn-warning" style="float: right;" onclick="javascript:location.href='infor.html'">Thêm sách mới</button></h3>
        <div>
            <table class="list-tb">
                <tr>
                    <th class="col-md-1">SKU</th>
                    <th class="col-md-2">Ảnh</th>
                    <th class="col-md-3">Tên sách</th>
                    <th class="col-md-2">NXB</th>
                    <th class="col-md-2">Giá bìa</th>
                    <th class="col-md-1"><span class="glyphicon glyphicon-pencil"></span></th>
                    <th class="col-md-1"><span class="glyphicon glyphicon-remove"></span></th>
                </tr>
                <tr>
                    <td><a href="#">BK0001</a></td>
                    <td><img src="../../../../bookstore/local/public/images/the joker.jpg"/></td>
                    <td>The joker</td>
                    <td>NXB Trẻ</td>
                    <td>60.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr>
                <tr>
                    <td>BK0002</td>
                    <td><img src="../../../bookstore/local/public/images/máu hiếm.jpg"/></td>
                    <td>Máu hiếm</td>
                    <td>NXB Trẻ</td>
                    <td>60.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr>
                <tr>
                    <td>BK0003</td>
                    <td><img src="../../../bookstore/local/public/images/50s.jpg"/></td>
                    <td>50 sắc thái - đen</td>
                    <td>NXB Trẻ</td>
                    <td>60.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr>
                <tr>
                    <td>BK0004</td>
                    <td><img src="../../../bookstore/local/public/images/thời khắc định mệnh.jpg"/></td>
                    <td>Thời khắc định mệnh</td>
                    <td>NXB Trẻ</td>
                    <td>60.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr>
                <tr>
                    <td>BK0005</td>
                    <td><img src="../../../bookstore/local/public/images/thiên thần và ác quỷ.jpg"/></td>
                    <td>Thiên thần và ác quỷ</td>
                    <td>NXB Trẻ</td>
                    <td>160.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr>
                <tr>
                    <td>BK0001</td>
                    <td><img src="../../../bookstore/local/public/images/the joker.jpg"/></td>
                    <td>The joker</td>
                    <td>NXB Trẻ</td>
                    <td>60.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr>
                <tr>
                    <td>BK0001</td>
                    <td><img src="../../../bookstore/local/public/images/the joker.jpg"/></td>
                    <td>The joker</td>
                    <td>NXB Trẻ</td>
                    <td>60.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr><tr>
                    <td>BK0001</td>
                    <td><img src="../../../bookstore/local/public/images/the joker.jpg"/></td>
                    <td>The joker</td>
                    <td>NXB Trẻ</td>
                    <td>60.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr>
                <tr>
                    <td>BK0001</td>
                    <td><img src="../../../bookstore/local/public/images/the joker.jpg"/></td>
                    <td>The joker</td>
                    <td>NXB Trẻ</td>
                    <td>60.000đ</td>
                    <td><a href="#">Sửa</a></td>
                    <td><a href="#">Xóa</a></td>
                </tr>
            </table>
        </div>
    </div>
@stop