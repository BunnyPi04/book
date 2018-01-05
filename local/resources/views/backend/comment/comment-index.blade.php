@extends('backend.master')
@section('main')
    <div class="row book-block">
        <h3 class="book-block-title"><a href="#">{{ $countUnread }} Bình luận chưa đọc </a></h3>
        <div class="book-section">
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
            <form method="post">
                {{ csrf_field() }}
                <input type="submit" value="Lưu" class="btn btn-warning">
                @foreach($unread as $item)
                <div style="border: 1px solid; padding: 10px;">
                    <a href="{{ asset('/book/show/'.$item['book_id']) }}">
                        <p><b>{{ $item['fullname'] }}</b></p>
                        <p>Đã bình luận trong <b>{{ $item['book_name']}}</b></p>
                        <p>Vào lúc {{ $item['created_at'] }}</p>
                    </a>
                    <input type="checkbox" name="seen[{{ $item['id']}}]" value="{{ $item['id'] }}"> Đánh dấu đã đọc
                </div>
                @endforeach
            </form>
        </div>
    </div>
@stop
