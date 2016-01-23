<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link href="{{asset('style/editProfile.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style\menu.css">
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
            <form method="post" action="lookFor">
                <input type="text" name="buscar">
                <input type="submit" value="buscar">
            </form>


        </div>
        <div id="pendiente">
            <label>Peticiones pendientes:</label><br>
            @if (count($peticiones)>0)
                @foreach ($peticiones as $p)
                    <p><a href="friendProfile/{{ $p->get(0)->idUser}}">{{ $p->get(0)->name }}</a></p>
                    <div>
                        <a href="addFriend/{{ $p->get(0)->idUser}}"><button>Aceptar peticion de amistad</button></a><a href="declinedFriend/{{ $p->get(0)->idUser}}"><button>Eliminar peticion de amistad</button></a>
                    </div>
                @endforeach
            @else

                <p>No tienes peticiones pendientes.</p>
            @endif


        </div>
        <div id="buscar">
            <label>Personas que quizas conozcas:</label><br>
            @if (count($friend)>0)
                @foreach ($friend as $p)
                    <div>
                        <p><a href="friendProfile/{{ $p->idUser}}">{{ $p->name }}</a></p>
                    </div>
                    <div>
                        <a href="sendFriend/{{ $p->idUser}}"><button>Enviar peticion de amistad</button></a>
                    </div>
                @endforeach
            @else
                <p>No hay resultados de momento.</p>
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