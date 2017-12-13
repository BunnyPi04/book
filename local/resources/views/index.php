<?php 
//     session_start();
//     require_once('library/__autoload.php');
// //    $user = new User;
//     $book = new Book;
//     $book_type = new Book_type;
?>
<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
	<meta name="author" content="lolkittens" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../../bookstore/css/bs-style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Untitled 1</title>
</head>

<body>
    <div class="container">
        <!-- header -->
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2" id="banner"><img src="images/bookshelf.png"/></div>
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
                <a href="cart.html"><i class="fa fa-shopping-cart"></i>
                <p><b>Giỏ hàng: </b>3 sản phẩm</p>
                <p>Chào <b>Mei</b>!</p></a>
            </div>
        </div>
        
        <!-- main body-->
        <div class="row">
            <!-- left menu -->
            <div class="col-md-3" id="left-menu">
                <ul class="sidebar-nav">
                    <li><a href="#">Danh Mục</a></li>
                    <li><a href="#">SGK - sách tham khảo</a></li>
                    <li><a href="#">Sách nấu ăn, pha chế</a></li>
                    <li><a href="#">Sách nghệ thuật</a></li>
                    <li><a href="#">Tiểu thuyết</a></li>
                    <li><a href="#">Sách thiếu nhi</a></li>
                    <li><a href="#">Sách kỹ năng sống</a></li>
                    <li><a href="#">Sách kinh tế</a></li>
                    <li><a href="#">Truyện tranh</a></li>
                    <li><a href="#">Sách khoa học</a></li>
                    <li><a href="#">Sách chuyên ngành</a></li>
                    <li><a href="#">Sách làm đẹp</a></li>
                    <li><a href="#">Sách học ngoại ngữ</a></li>
                </ul>
            </div>
            <!-- slide show-->
            <div class="col-md-9 carousel slide" id="myCarousel" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active">
                    <a href="#"><img src="images/sach-napoleon.jpg" alt="slide1" width="100%"/></a>
                </div>
                <div class="item">
                    <a href="#"><img src="images/sale.jpg" alt="slide2" width="100%"/></a>
                </div>
                <div class="item">
                    <a href="#"><img src="images/sale2.jpg" alt="slide3" width="100%"/></a>
                </div>
                <div class="item">
                    <a href="#"><img src="images/codauphapsu.jpg" alt="slide4" width="100%"/></a>
                </div>
                
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
            </div>
            
            <!-- shelf 1-->
            <div class="col-md-9">
                <div class="book-block">
                    <h3  class="book-block-title"><a href="#">Sách mới</a></h3>
                    <ul class="book-item">
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/luật chơi.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Luật chơi</a></h4>
                            <div class="des">
                                <a class="price">50.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/thapgiacquan-_cover_1.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Thập giác quán</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/máu hiếm.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Máu hiếm</a></h4>
                            <div class="des">
                                <a class="price">50.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/luật chơi.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html#">Luật chơi</a></h4>
                            <div class="des">
                                <a class="price">50.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/thapgiacquan-_cover_1.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Thập giác quán</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/the joker.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">The joker</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/tôi thấy hoa vàng trên cỏ xanh.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html#">Tôi thấy hoa vàng trên cỏ xanh</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/máu hiếm.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Máu hiếm</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!--shelf 2 -->
                <div class="book-block">
                    <h3 class="book-block-title"><a href="#">Sách nổi bật</a></h3>
                    <ul class="book-item">
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/luật chơi.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Luật chơi</a></h4>
                            <div class="des">
                                <a class="price">50.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/thapgiacquan-_cover_1.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Thập giác quán</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/máu hiếm.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Máu hiếm</a></h4>
                            <div class="des">
                                <a class="price">50.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/luật chơi.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html#">Luật chơi</a></h4>
                            <div class="des">
                                <a class="price">50.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/thapgiacquan-_cover_1.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Thập giác quán</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/the joker.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">The joker</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/tôi thấy hoa vàng trên cỏ xanh.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html#">Tôi thấy hoa vàng trên cỏ xanh</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <a href="book-infor.html"><img src="images/máu hiếm.jpg"/></a>
                            <h4><a class="book-title" href="book-infor.html">Máu hiếm</a></h4>
                            <div class="des">
                                <a class="unsale-price">60.000<br /></a>
                                <a class="price">80.000đ</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- footer-->
        <div class="row footer">
            <div class="col-md-6 col-sm-12 col-xs-12" id="store-name">
                <div class="col-md-2 col-sm-2 col-xs-3"><img src="images/bookshelf.png"/></div>
                <div class="col-md-10 col-sm-10 col-xs-9"><h2>Tiệm sách Minh Minh</h2></div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12" id="store-name">
                <ul>
                    <li class="col-md-6">
                        <h4>Tiệm Minh Minh Cầu Giấy: </h4>
                        <p>123 Cầu Giấy, Hà Nội</p>
                        <p>Điện thoại: 0123456789</p>
                    </li>
                    <li class="col-md-6">
                        <h4>Tiệm Minh Minh Hai Bà Trưng: </h4>
                        <p>123 Đại Cồ Việt, Hà Nội</p>
                        <p>Điện thoại: 0123456789</p>
                    </li>
                    <li class="col-md-6">
                        <h4>Kho Tiệm Minh Minh: </h4>
                        <p>123 Nguyễn Khang, Hà Nội</p>
                        <p>Điện thoại: 0123456789</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>