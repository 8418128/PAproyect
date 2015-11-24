<form action="register" method="POST">
@if (count($errors) > 0)
    <span>{{ $errors->first('exist')  }}</span>
        <br>
    <input name="user" type="text" placeholder="Usuario" value="{{ old('user') }}"/>
    <br>
        <input name="email" type="text" placeholder="Email" value="{{ old('email') }}"/>
@else
    <input name="user" type="text" placeholder="Usuario"/>
        <br>
        <input name="email" type="text" placeholder="Email"/>
@endif
<br>


<input name="pass" type="password" placeholder="Contraseña" />
    <br>


<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<br>
<input type="submit" value="Registrarse" />
</form>