@extends('master')
@section('jscript'){{asset('generalJs/login_snippet.js')}}@endsection
<link href="{{asset('style/login_snippet.css')}}" rel="stylesheet" type="text/css">
@section('title', 'Register')
<header>Fakebook</header>
<div class="login-container">
	<div id="output"></div>
	<div class="avatar"></div>
	<div class="form-box">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
			</div>
			<br>
		@endif
		<form action="doReg" method="POST">
			<input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
			<input name = "name" id = "name" type="text" placeholder="First name" value="{{ old('name') }}">
			<input name = "surname" id = "surname" type="text" placeholder="Last name" value="{{ old('surname') }}">
			<input name = "birthDate" id = "birthDate" type="text" placeholder="Birth date" value="{{ old('birthDate') }}">
			<input name = "password" id = "password" type="password" placeholder="Password">
			<input name = "confirm_password" id = "confirm_password"  class = "password" type="password" placeholder="Confirm password"><br>
			I accept <a href = "license.html" target="_blank">license</a> terms.
			<input name="accept_licence" type="checkbox" value="accept_licence/">


			<button id = "register_bt" class="btn btn-info btn-block register" type="submit">Register</button>
		</form>

	</div>
</div>



