@extends('master')

@section('title', 'Registro')

@section('nav')
    @parent
    <p>Esto se añade a la navegacion padre.</p>
@endsection

@section('content')
    <form action="register" method="POST" enctype="multipart/form-data" >
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
            <input name="name" type="text" placeholder="Nombre" value="{{ old('name') }}"/>
            <br>
            <input name="birthDate" type="text" placeholder="Fecha de nacimiento" value="{{ old('birthDate') }}"/>
            <br>
            <input name="email" type="text" placeholder="Email" value="{{ old('email') }}"/>
            <br>
            <input name="photo" type="file" placeholder="Foto perfil" value="{{ old('photo') }}"/>
            <br>
            <input name="password" type="password" placeholder="Contraseña" />
            <br>
        <input type="submit" value="Registrarse" />
    </form>
@endsection


