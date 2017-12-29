@extends('backend-template.master2')
@section('main')
    <div class="block">
        <div class="form-group">
            <h2>Log in</h2>
            <form method="post">
                {{ csrf_field() }}

                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email" autofocus="true">
                </div>    
                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password" id="pwd">
                </div>
                <div class="field checkbox">
                    <input type="checkbox" name="remember">
                    <label>Remember me</label>
                </div>
                <div class="field">
                    <input type="submit" class="btn btn-primary btn2 col-md-3 col-md-offset-9" style="background-color: #b3b3ff" value="Login"/>
                </div>
            </form>
        </div>
    </div>
@stop