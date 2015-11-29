@extends('master')

@section('title', 'Registro')

@section('nav')
    @parent
    <p>Esto se añade a la navegacion padre.</p>
@endsection

@section('content')
    <form action="register" method="POST">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br>
        @endif
            <input name="nick" type="text" placeholder="Usuario" value="{{ old('nick') }}"/>
            <br>
            <input name="email" type="text" placeholder="Email" value="{{ old('email') }}"/>
        <br>
        <input name="pass" type="password" placeholder="Contraseña" />
        <br>
        <input type="submit" value="Registrarse" />
    </form>
@endsection


