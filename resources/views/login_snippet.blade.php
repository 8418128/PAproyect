@extends('master')
@section('jscript'){{asset('generalJs/login_snippet.js')}}@endsection
<link href="{{asset('style/login_snippet.css')}}" rel="stylesheet" type="text/css">
@section('title', 'Login')
<header>Fakebook</header>
<div class="login-container">
	<div id="output"></div>
	<div class="avatar"></div>		<!-- logo redondo -->
	<div class="form-box">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<li>{{ $errors->first('auth')  }}</li>
			</div>
			<br>

		@endif
		<form action="doLog" method="POST">
			<input name="email" type="email" placeholder="email">
			<input name="password" class = "password" type="password" placeholder="password">
			<br>
			<button id = "login_bt" class="btn btn-info btn-block login" type="submit">Login</button>

		</form>
		<form action="register" method="GET">

			<button id = "register_bt" class="btn btn-info btn-block register" type="submit">Register</button>
		</form>

	</div>
</div>



</div>