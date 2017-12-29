@extends('backend-template.master2')
@section('main')
    <div class="block">
        <h2>Edit Account</h2>
        <form method="post">
            {{ csrf_field() }}
            <div class="field">
                <label>Email</label><br />
                <input type="email" name="email" autofocus="true" id="email">
            </div>
            <div>Currently waiting confirmation for: Account email</div>  
            <div class="field">
                <label>Password <i>(leave blank if you don't want to change it)</i></label><br />
                <input type="password" name="password" id="pwd">
            </div>  
            <div class="field">
                <label>Password Confirmation</label><br />
                <input type="password" name="password_confirmation" id="pwd">
            </div>
            <div class="field">
                <label>Current password <i>(we need your current password to confirm your changes)</i></label><br />
                <input type="password" name="current_password" id="pwd">
            </div>
            <div class="actions">
                <button type="submit" class="btn btn-primary btn2 col-md-3 col-md-offset-9" style="background-color: #b3b3ff">Update</button>
            </div>
        </form>  
        <h3>Cancel my account</h3>
        <p>
            <img src="https://cdn3.iconfinder.com/data/icons/social-messaging-ui-color-shapes-2/128/face-sad-red-128.png" style="width: 30px; margin: 0px 15px;">Unhappy?
            <button class="btn btn-primary btn2 col-md-3" style="background-color: #b3b3ff" onclick="return confirmation('Are you sure?')">Cancel my account</button>
        </p>
        <a href="#"><img src="https://cdn2.iconfinder.com/data/icons/social-messaging-productivity-1/128/reply-128.png" style="width:30px; margin: 0px 15px;"/>Back</a>
    </div>
@stop