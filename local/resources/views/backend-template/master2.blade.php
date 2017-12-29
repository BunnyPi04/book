<!DOCTYPE html>
<html>
    <head>
        <title>First project with Rails</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{URL::asset('css/application.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/slick-1.8.0/slick/slick.css')}}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="{{URL::asset('css/slick-1.8.0/slick/slick.min.js')}}"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="head-navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/" style="color: white; font-family: Helvetica, Arial, sans-serif; font-size: 14px;">
                    <img src="https://cdn2.iconfinder.com/data/icons/business-and-economy/256/business_economic_finance_interprise_company_place_holder-128.png" style="width: 55px; margin-top: -10px; float: left; padding-right: 15px;"/>
                    myplaces</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a class="head-item-1st active" href="/ideas" style=" font-family: Helvetica, Arial, sans-serif; color: white;">Ideas</a></li>
                        <li><a class="head-item-2nd" href="/pages/info"  style="color: white;  font-family: Helvetica, Arial, sans-serif">Info</a></li>
                    </ul>
                    <p class="navbar-text pull-right" style="color: white;">
                    <div class="col-md-1 dropdown" style="float: right">
                        <!-- <% if user_signed_in? %> -->
                        <div class="dropdown" style="float: right; color: white;">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" style="color: white">
                                <!--                   <%= image_tag current_user.gravatar_url, :class => 'ava', :style => 'width: 30px;' %>  -->
                                <strong>
                                    <!-- <%= current_user.email %> -->Email
                                </strong>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <ul style="padding:0; margin:0; list-style: none;">
                                    <li style="padding: 10px 20px;cursor:pointer;">
                                        <!-- <%= link_to "Edit profile", edit_user_registration_path, :class => 'dropdown-item' %> -->
                                        Edit profile
                                    </li>
                                    <li style="padding: 10px 20px;">
                                        <!-- <%= link_to "Logout", destroy_user_session_path, method: :delete, :class => 'dropdown-item'  %> -->
                                        Logout
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- <% else %>
                            <%= link_to "Sign up", new_user_registration_path, :class => 'navbar-link', :class => 'navlink', :class => 'dropdown-item'  %> |
                            <%= link_to "Login", new_user_session_path, :class => 'navbar-link', :class => 'navlink', :class => 'dropdown-item'  %>
                            <% end %> -->
                    </div>
                    </p>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="col-md-2" id="left-menu">
                <ul>
                    <li class="left-item left-item-active fst"><img src="https://cdn0.iconfinder.com/data/icons/ballicons/128/lightbulb-128.png" class="item-img"/><a href="/ideas">Ideas</a></li>
                    <li class="left-item crt"><img src="https://cdn4.iconfinder.com/data/icons/keynote-and-powerpoint-icons/256/Plus-128.png" class="item-img"/><a href="/ideas/new">Create new ideas</a></li>
                    <li class="left-item pages"><img src="https://cdn4.iconfinder.com/data/icons/iconsimple-interface/512/information-128.png" class="item-img"/><a href="/pages/info">Info</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-md-offset-7" id="right-menu">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <div><img class="slide-img" src="https://data.whicdn.com/images/213868481/original.gif" alt="Los Angeles"></div>
                    <div><img class="slide-img" src="https://i.pinimg.com/736x/8b/09/ed/8b09ed009ae33e04896e64fdf62c993a--very-merry-christmas-pusheen.jpg" alt="Chicago"></div>
                    <div><img class="slide-img" src="https://i.pinimg.com/736x/d4/fb/59/d4fb59349d42b5cbb2b15c77fb3967cd--kawaii-pusheen-pusheen-cat.jpg" alt="New york"></div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-2" style="padding: 0px;">
                <!-- <% if notice %> -->
                <p class="alert alert-success">
                    <!-- <%= notice %> -->
                    Notice
                </p>
                <!-- <% end %>
                    <% if alert %>
                     -->  
                <p class="alert alert-danger">
                    <!-- <%= alert %> -->
                </p>
                <!-- <% end %>
                    -->
                @yield('main')
            </div>
        </div>
        <footer>
            <div class="container">
                Rails Girls <a id="date"></a>
            </div>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.js"></script>
    </body>
</html>
<script type="text/javascript">
    n =  new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
    var $jq = jQuery.noConflict();
    $(document).ready(function(){
        $('#myCarousel').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            // dots: true,
            autoplaySpeed: 1000,
            vertical: true,
            verticalSwiping: true,
            nextArrow: '<i class="fa fa-angle-down"></i>',
            prevArrow: '<i class="fa fa-angle-up"></i>'
        });
    });
</script>