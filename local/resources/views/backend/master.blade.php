<!DOCTYPE HTML>
<head>
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
    <title>Quản trị admin</title>
    <meta name="author" content="lolkittens">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ asset('css/bs-style.css') }} "/>
</head>

<body>
    <div class="container">
        <!-- header -->
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2" id="banner"><a href="{{ asset('/home') }}"><img src="{{ asset('/local/public/images/bookshelf.png') }}"/></a></div>
            <div class="col-md-8 col-sm-8 col-xs-8">
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
            <div class="col-md-2 col-sm-2 col-xs-2 text-center cart">
                Xin chào
                @if (((Auth::user()->position) == 'Admin'))
                    <b> Quản trị viên </b>
                @elseif (((Auth::user()->position) == 'Keeper'))
                    <b> Thủ kho </b>
                @elseif (((Auth::user()->position) == 'Cashier'))
                    <b> Thu ngân </b>
                @endif
                !
                <p>{{ Auth::user()->fullname }}</p>
                <p><a href="{{ asset('/logout') }}">Đăng xuất</a></p>
            </div>
        </div>
        
        <!-- main body-->
        <div class="row">
            <!-- left menu -->
            <div class="col-md-3" id="left-menu">
                <ul class="sidebar-nav">
                    <li><a href="{{ asset('/admin/') }}">Danh Mục</a></li>
                    <li><a href="{{ asset('/admin/book') }}">Danh sách sản phẩm</a></li>
                    <li><a href="{{ asset('/admin/publisher') }}">Nhà xuất bản</a></li>
                    <li><a href="{{ asset('/admin/category') }}">Thể loại sách</a></li>
                    <li><a href="{{ asset('/admin/hightlight_book') }}">Sản phẩm nổi bật</a></li>
                    <li><a href="{{ asset('/admin/new_book') }}">Sản phẩm mới</a></li>
                    <li><a href="{{ asset('/admin/book') }}">Chương trình sale</a></li>
                    @if (((Auth::user()->position) == 'Admin'))
                        <li><a href="{{ asset('/admin/coupon') }}">Coupon</a></li>
                        <li><a href="{{ asset('/admin/user') }}">Quản lý người dùng</a></li>
                        <li><a href="{{ asset('/admin/book') }}">Đơn đặt hàng online</a></li>
                        <li><a href="{{ asset('/admin/invoice/') }}">Báo cáo hóa đơn</a></li>
                    @endif
                        <li><a href="{{ asset('/admin/invoice/create') }}">Tạo hóa đơn</a></li>
                        <li><a href="{{ asset('/admin/book_value/') }}">Tình trạng các kho</a></li>
                        <li><a href="{{ asset('/admin/store') }}">Danh sách cửa hàng</a></li>
                </ul>
            </div>
            <!-- shelf 1-->
            <div class="col-md-9">
                @yield('main')                
            </div>
        </div>
        <!-- footer-->
        @include('layouts.footer')
    </div>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

    <script src="{{ asset('/local/public/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/myscript.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description');//chi_tiet_sp: tên textarea cũ
    </script>

    @yield('scripts')
</body>
</html>