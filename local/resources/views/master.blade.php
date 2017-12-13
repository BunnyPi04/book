<!DOCTYPE HTML>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
    <meta name="author" content="lolkittens" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{URL::asset('css/bs-style.css')}}"/>
    <script src="{{URL::asset('js/myscript.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.0.8/dist/sweetalert2.all.js"></script>
    <title>Tiệm sách Minh Minh</title>
</head>

<body>
    <div class="container">
        <!-- header -->
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2" id="banner"><img src="{{asset('/local/public/images/bookshelf.png')}}"/></div>
            <div class="col-md-7 col-sm-8 col-xs-8">
                <p><h1>Tiệm sách Minh Minh</h1></p>
                <!-- search box-->
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" class="form-control input-lg" placeholder="Tìm kiếm" />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-2 text-center cart">
                <a href="{{ asset('/cart/') }}"><i class="fa fa-shopping-cart"></i></a>
                <ul class="nav navbar-nav navbar-left col-md-12">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="col-md-6 pad-0"><a href="{{ url('/login') }}">Login</a></li>
                        <li class="col-md-6 pad-0"><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <div id="cart-number">
                            @if (isset($count))
                                {{ $count }}
                            @endif
                        </div>
                        @if (isset($count))
                                @if ($count != 0)
                                    <p><a onclick="destroyCart()">Xóa giỏ hàng</a></p>
                                @endif
                            @endif
                        <p>Chào <b>{{ Auth::user()->fullname }}</b>!</p>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                @if (((Auth::user()->position) == 'Admin') || ((Auth::user()->position) == 'Keeper') || ((Auth::user()->position) == 'Cashier'))
                                    <li><a href="{{ asset('/admin/') }}">Trang quản trị</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                </ul>
                @if (isset($cart))
                    <p><b>Giỏ hàng: </b>3 sản phẩm</p>
                @endif
            </div>
        </div>
        
        <!-- main body-->
        <div class="row">
            <!-- left menu -->
            @include('layouts.left-menu')
            <!-- slide show-->
            @yield('carousel')
            
            <!-- shelf 1-->
            <div class="col-md-9">
            @yield('main')
            </div>
        </div>
        <!-- footer-->
        @include('layouts.footer')
    </div>
</body>
</html>