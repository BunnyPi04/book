 <div class="row footer">
    <div class="col-md-6 col-sm-12 col-xs-12" id="store-name">
        <div class="col-md-2 col-sm-2 col-xs-3"><img src="{{URL::asset('/local/public/images/bookshelf.png')}}"/></div>
        <div class="col-md-10 col-sm-10 col-xs-9"><h2>Tiệm sách Minh Minh</h2></div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12" id="store-name">
        <ul>
            @if (isset($store))
                @foreach ($store as $item)
                    <li class="col-md-6">
                        <h4>{{ $item['store_name'] }} </h4>
                        <p>{{ $item['address'] }}</p>
                        <p>Điện thoại: {{ $item['phone']}}</p>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>