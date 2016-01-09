<html>
<head></head>
<body>
<div>
    <table>
        <tr>
            <td>Nombre</td><td>{{$name}}</td><td rowspan="2"><img src="image/{{$photo}}" width="100px"></td><!-- CSS -->
        </tr>
        <tr>
            <td>Apellidos</td><td>{{$surname}}</td>
        </tr>
        <tr>
            <td>Fecha de Nacimiento</td><td>{{$birthdate}}</td>
        </tr>
        <tr>
            <td>Email</td><td>{{$email}}</td>
        </tr>
    </table>
    <a href="edit"><button>Editar</button></a>
</div>
</body>
</html>