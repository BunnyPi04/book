@extends('master')
@section('main')
<div class="book-block">
    <h3  class="book-block-title"><a href="#">Thông tin tài khoản</a><a href="{{asset('/personal/')}}"><button type="button" class="btn btn-warning top-btn orbtn">Sửa thông tin</button></a></h3>
    @if (isset($user))
    <div class="row">
        <div class="col-md-12">
            <table>
                <tr>
                    <td>Tên đăng nhập: </td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Tên người dùng: </td>
                    <td>{{ $user->fullname }}</td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Địa chỉ: </td>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <td>Thành phố: </td>
                    <td>{{ $user->city }}</td>
                </tr>
                <tr>
                    <td>Số điện thoại: </td>
                    <td>{{ $user->phone_number }}</td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    @endif
</div>
@stop