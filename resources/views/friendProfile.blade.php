<!doctype html>

<html>
<head>
    <title>Profile view</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="{{asset('style/profile.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style\menu.css">
</head>
<body>
<header>
    <!-- hamburger menu: http://codepen.io/g13nn/pen/eHGEF -->
    <button class="hamburger">&#9776;</button>
    <button class="cross">&#735;</button>
    Perfil From {{$name}}
    <button class="friends"><img src="style/group_contact-512.png"></button>
    <button class="cross2">&#735;</button>
</header>
<div class="menu" id = "menu1">
    <ul>
        <li><a href="gallery">Gallery</a></li>
        <li><a href="canva">Created</a></li>
        <li><a href="{{asset('atelier')}}">Atelier</a></li>
        <li><a href="{{asset('home')}}">Home</a></li>
        <li><a href="{{asset('search')}}">Buscar amigos</a></li>
        <li><a href="{{asset('myProfile')}}">My Profile</a></li>
    </ul>
</div>
<div class="menu" id = "menu2">
    <ul>
        <a href="#"><li>Friend1</li></a>
        <a href="#"><li>Friend2</li></a>
        <a href="#"><li>Friend3</li></a>
    </ul>
</div>
<div class = "container">


    <img src="generalImg/{{$photo}}" width="100px">
    <p>Name: {{$name}}</p>
    <p>Date of birth: {{$birthdate}}</p>
    <p>Email: {{$email}}</p>
    @if($friend)
        <a href="/socialnet/public/declinedFriend2/{{ $idUser}}"><button>Eliminar amigo</button></a>
        @else
        <a href="/socialnet/public/sendFriend2/{{ $idUser}}"><button>Enviar peticion de amistad</button></a>
    @endif

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!-- Slidebars -->
<script src="generalJs\menu.js"></script>
<script>
    (function($) {
        $(document).ready(function() {
            $.slidebars();
        });
    }) (jQuery);
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<!-- Slidebars -->
<script src="generalJs\menu.js"></script>
<script>
    (function($) {
        $(document).ready(function() {
            $.slidebars();
        });
    }) (jQuery);
</script>
<input type="hidden" id="idUser" value="{{$idUserSession}}"/>
</body>
</html>