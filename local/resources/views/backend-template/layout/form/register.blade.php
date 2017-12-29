@extends('backend-template.master2')
@section('main')
    <div class="block">
        <h2>Sign up</h2>
        <div class="form-group">
            <form method="post">
                {{ csrf_field() }}
                <div class="field">
                    <label>Email</label><br />
                    <input type="email" name="email" id="email">
                </div>
                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password" id="pwd">
                </div>
                <div class="field">
                    <label>Password Confirmation</label><br />
                    <input type="password" name="password_confirmation" id="pwd">
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary btn2 col-md-3 col-md-offset-9" style="background-color: #b3b3ff">Sign up</button>
                </div>
            </form>
        </div>
    </div>
@stop