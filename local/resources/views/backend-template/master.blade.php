<!DOCTYPE html>
<html>
  <head>
    <title>First project with Rails</title>
    <%= csrf_meta_tags %>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <%= stylesheet_link_tag    'application', media: 'all', 'data-turbolinks-track': 'reload' %>
    <%= javascript_include_tag 'application', 'data-turbolinks-track': 'reload' %>
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
            <img src="https://cdn3.iconfinder.com/data/icons/pet-shop-flat-colorful/614/5178_-_Paws-128.png" style="width: 50px; margin-top: -12px; float: left;"/>
            The Idea app</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a class="head-item-1st active" href="/ideas" style=" font-family: Helvetica, Arial, sans-serif; color: white;">Ideas</a></li>
            <li><a class="head-item-2nd" href="/pages/info"  style="color: white;  font-family: Helvetica, Arial, sans-serif">Info</a></li>
          </ul>
          <p class="navbar-text pull-right" style="color: white;">
              <div class="col-md-1 dropdown" style="float: right">
              <% if user_signed_in? %>
                <div class="dropdown" style="float: right; color: white;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" style="color: white">
                  <%= image_tag current_user.gravatar_url, :class => 'ava', :style => 'width: 30px;' %> <strong><%= current_user.email %></strong></button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <ul style="padding:0; margin:0; list-style: none;">
                      <li style="padding: 10px 20px;cursor:pointer;"><%= link_to "Edit profile", edit_user_registration_path, :class => 'dropdown-item' %></li>
                      <li style="padding: 10px 20px;"><%= link_to "Logout", destroy_user_session_path, method: :delete, :class => 'dropdown-item'  %></li>
                    </ul>
                  </div>
                </div>
  
              <% else %>
              
                <%= link_to "Sign up", new_user_registration_path, :class => 'navbar-link', :class => 'navlink', :class => 'dropdown-item'  %> |
                <%= link_to "Login", new_user_session_path, :class => 'navbar-link', :class => 'navlink', :class => 'dropdown-item'  %>
              <% end %>
              </div></p>
        </div>
      </div>
</nav>
  <div class="container">
    <div class="col-md-2" style="position: fixed; padding:0">
      <ul  style="padding:0; padding-top: 50px;">
        <li class="left-item left-item-active fst"><img src="https://cdn0.iconfinder.com/data/icons/ballicons/128/lightbulb-128.png" class="item-img"/><a href="/ideas">Ideas</a></li>
        <li class="left-item crt"><img src="https://cdn4.iconfinder.com/data/icons/keynote-and-powerpoint-icons/256/Plus-128.png" class="item-img"/><a href="/ideas/new">Create new ideas</a></li>
        <li class="left-item pages"><img src="https://cdn4.iconfinder.com/data/icons/iconsimple-interface/512/information-128.png" class="item-img"/><a href="/pages/info">Info</a></li>
      </ul>
    </div>
    <div class="col-md-6 col-md-offset-2" style="padding: 0px;">
      <% if notice %>
  <p class="alert alert-success"><%= notice %></p>
<% end %>
<% if alert %>
  <p class="alert alert-danger"><%= alert %></p>
<% end %>
    <%= yield %></div>
  </div>
  
  <footer>
  <div class="container">
    Rails Girls <%= Time.now.year %>
  </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.js"></script>
  </body>
</html>