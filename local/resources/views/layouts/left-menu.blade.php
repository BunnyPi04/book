<div class="col-md-3" id="left-menu">
    <ul class="sidebar-nav">
        <li><a href="{{ asset('/home/') }}">Danh Mục</a></li>
        @if (isset($category))
            @foreach ($category as $item)
                <li><a href="{{ asset('/category/'.$item['category_id'])}}">{{ $item['category_name'] }}</a></li>
            @endforeach
        @endif
    </ul>
</div>