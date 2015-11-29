<form action="login" method="POST">
	@if (count($errors) > 0)
		<span>{{ $errors->first('auth')  }}</span>
    <br>
		<input name="user" type="text" placeholder="Usuario" value="{{ old('user') }}"/>
	@else
		<input name="user" type="text" placeholder="Usuario"/>
	@endif
		<br>
		<input name="pass" type="password" placeholder="Contraseña" />
		<br>
		<input type="submit" value="Entrar" />
        <a href="regForm">Registrarse</a>
</form>