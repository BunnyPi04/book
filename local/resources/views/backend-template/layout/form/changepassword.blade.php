@extends('backend-template.master2')
@section('main')
    <div class="block">
        <h2>Change your password</h2>
        <form method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="field">
                    <label>New password</label>
                    <input type="password" name="password" autofocus="true">
                </div>
                <div class="field">
                    <label>Confirm new password</label>
                    <input type="password" name="password_confirmation">
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary btn2 col-md-3 col-md-offset-9">Change password</button>
                </div>
            </div>
        </form>
    </div>
@stop