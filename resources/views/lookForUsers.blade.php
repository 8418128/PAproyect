<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="{{asset('style/editProfile.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style\menu.css">
    <script type="text/javascript" src="{{asset('generalJs/buscador.js')}}"></script>
    <script src="http://js.pusher.com/3.0/pusher.min.js"></script>
</head>
<body>
<header>
    <!-- hamburger menu: http://codepen.io/g13nn/pen/eHGEF -->
    <button class="hamburger">&#9776;</button>
    <button class="cross">&#735;</button>
    My Search Friend
    <button class="friends"><img src="style/group_contact-512.png"></button>
    <button class="cross2">&#735;</button>
</header>
<div class="menu" id = "menu1">
    <ul>
        <li><a href="#">Gallery</a></li>
        <li><a href="#">Atelier</a></li>
        <li><a href="home">Home</a></li>
        <li><a href="search">Buscar amigos</a></li>
        <li><a href="myProfile">My Profile</a></li>
    </ul>
</div>
<div class="menu" id = "menu2">
    <ul>
        <a href="#"><li>Friend1</li></a>
        <a href="#"><li>Friend2</li></a>
        <a href="#"><li>Friend3</li></a>
    </ul>
</div>
<div id="contenido">
    <div>
        <p>Buscador</p>
        <!--  <form method="post" action="#">
              <input type="text" name="buscar" id="name">
              <input type="submit" value="buscar" id="buscador">
          </form>-->
        <!--  <input type="text" name="buscar" id="name">
          <button id="buscador" onclick="load()">Buscar</button>-->
        <form action="lookFor" method="post">
            <input type="text" name="name">
            <input type="submit" value="Buscar">
        </form>
    </div>
    <div >
        <label>Resultado de la búsqueda:</label><br>
        @if (count($users)>0)
            @foreach ($users as $p)
             <p><a href="friendProfile/{{ $p->idUser}}">{{ $p->name }}</a></p>
                <div>
                    <a href="addFriend/{{ $p->idUser}}"><button>Enviar peticion de amistad</button></a>
                </div>
            @endforeach
        @else

            <p>No hay coincidencias.</p>
        @endif
    </div>
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
</body>
</html>