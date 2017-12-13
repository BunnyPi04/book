@extends('master')
@section('main')
<div id="login" class="col-md-6">
	<h2 class="text-center">Login</h2>
    <?php if (isset($_SESSION['error'])) {$_SESSION['error'];}
    	// <div class="alert alert-danger">Account not valid!</div> 
    	?>
	<form method="post">
    	<div class="form-group">
        	<label>Username</label>
            <input required type="text" name="user" class="form-control" placeholder="Username" />
        </div>
        <div class="form-group">
        	<label>Password</label>
            <input required type="text" name="pass" class="form-control" placeholder="Password" />
        </div>
        <button type="submit" name="submit" class="btn btn-warning">Login</button>
    </form>
</div>
@stop