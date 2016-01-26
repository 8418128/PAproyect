<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link href="{{asset('style/editProfile.css')}}" rel="stylesheet" type="text/css">
        <script src="generalJs/menu.js"></script>
        <script src="{{asset('generalJs/chatIndividual.js')}}"></script>
        <link href="{{asset('style/chatIndividual.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style/menu.css">
        <script src="http://js.pusher.com/3.0/pusher.min.js"></script>
        <script type="text/javascript" src="{{asset('generalJs/buscador.js')}}"></script>
    </head>
    <body>
    <header>
        <!-- hamburger menu: http://codepen.io/g13nn/pen/eHGEF -->
        <button class="hamburger">&#9776;</button>
        <button class="cross">&#735;</button>
        My friends
        <button class="friends"><img src="style/profile_icon_small.png"></button><!--generalImg/ -->
        <button class="cross2">&#735;</button>
    </header>
    <div class="menu" id = "menu1">
        <ul>
            <li><a href="gallery">Gallery</a></li>
            <li><a href="atelier">Atelier</a></li>
            <li><a href="home">Museum</a></li>
            <li><a href="myProfile">My Profile</a></li>
            <li><a href="search">My friends</a></li>
        </ul>
    </div>
    <div class="menu" id = "menu2">

        <ul id ="friends_ul">>

        </ul>
    </div>
    <div class="containerz">
        <div>
            <p>Buscador</p>
          <!--  <form method="post" action="#">
                <input type="text" name="buscar" id="name">
                <input type="submit" value="buscar" id="buscador">
            </form>-->
          <!--  <input type="text" name="buscar" id="name">
            <button id="buscador" onclick="load()">Buscar</button>-->
            <form class = "form-box" action="lookFor" method="post">
                <input type="text" name="name">
                <input type="submit" value="Buscar">
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

     <input type="hidden" id="idUser" value="{{$idUserSession}}"/>
    </body>
</html>