@extends('master')
@section('main')
<div id="login" class="col-md-6">
	<h2 class="text-center">Login Into Admin</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        {!! implode('', $errors->all(':message<br/> 
                ')) !!}
    </div>
    @endif
	<form method="post">
    	<div class="form-group">
        	<label>Username</label>
            <input type="text" name="user_name" class="form-control" placeholder="Username" />
        </div>
        <div class="form-group">
        	<label>Password</label>
            <input type="Password" name="user_pass" class="form-control" placeholder="Password" />
        </div>
        <button type="submit" name="submit" class="btn btn-warning">Login</button>
        {{ csrf_field() }} 
    </form>
</div>
@stop