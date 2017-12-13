@extends('backend.master')
@section('main')
<div id="login" class="col-md-6">
	@if (isset($item))
    <h2 class="text-center">Thông tin người dùng</h2>
    <form class="form-horizontal" role="form" method="POST">
        {{ csrf_field() }}
        @if ($errors->any())
        <div class="alert alert-danger calibri">
            {!! implode('', $errors->all(':message<br/> 
                    ')) !!}
        </div>
        @endif
        @if (isset($error)) 
            <div class="alert alert-danger calibri">
                 {{ $error }} <br/> 
            </div> 
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger calibri">
                 {{ session('error') }} <br/> 
            </div> 
        @endif
        <input type="hidden" name="id" value="{{ $item['id'] }}">
        <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
            <label for="fullname" class="control-label">Full Name</label>
            <input id="fullname" type="text" class="form-control" name="fullname" value="{{ $item['fullname'] }}" required autofocus>
            @if ($errors->has('fullname'))
                <span class="help-block">
                    <strong>{{ $errors->first('fullname') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">User name</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $item['name'] }}" required autofocus>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label">Vị trí</label>
            <select name="position">
                <option value='Admin'
                    @if ($item['position'] == 'Admin')
                        selected
                    @endif 
                >Quản trị viên</option>
                <option value="Keeper"
                    @if ($item['position'] == 'Keeper')
                        selected
                    @endif
                    >Thủ kho</option>
                <option value="Cashier"
                    @if ($item['position'] == 'Cashier')
                        selected
                    @endif
                >Thu ngân</option>
                <option value="User"
                    @if ($item['position'] == 'User')
                        selected
                    @endif
                >Người dùng</option>
            </select>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">E-Mail Address</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $item['email'] }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">New Password</label>
            <input id="password" type="password" class="form-control" name="password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="control-label">Confirm New Password</label><div class="registrationFormAlert" id="confirmMessage"></div>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" onkeyup="checkRePass(); return false;">
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            <label for="city" class="control-label">City</label>
            <input id="city" type="text" class="form-control" name="city" value="{{ $item['city'] }}" required autofocus>
            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label for="address" class="control-label">Address</label>
            <input id="address" type="text" class="form-control" name="address" value="{{ $item['address'] }}" required autofocus>
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
            <label for="phone_number" class="control-label">Phone number</label>
            <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ $item['phone_number'] }}" required autofocus>
            @if ($errors->has('phone_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
            <label for="phone_number" class="control-label">Thuộc cửa hàng</label>
            <select name="store">
                    <option value="">Không</option>
            	@if (isset($store))
            		@foreach ($store as $str)
            			<option value="{{ $str['store_id'] }}"
            			@if ($item['store_id'] == $str['store_id']) 
            			selected="1"
            			@endif 
            			>{{ $str['store_name'] }}</option>
            		@endforeach
            	@endif
            </select>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-warning">
                    Save
                </button>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection