<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="{{asset('style/editProfile.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style\menu.css">
    <script type="text/javascript" src="{{asset('generalJs/buscador.js')}}"></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="{{asset('generalJs/published.js')}}"></script>
</head>
<body>
<header>
    <!-- hamburger menu: http://codepen.io/g13nn/pen/eHGEF -->
    <button class="hamburger">&#9776;</button>
    <button class="cross">&#735;</button>
    My Atelier
    <button class="friends"><img src="style/group_contact-512.png"></button>
    <button class="cross2">&#735;</button>
</header>
<div class="menu" id = "menu1">
    <ul>
        <li><a href="{{asset('gallery')}}">Gallery</a></li>
        <li><a href="{{asset('newcanvas')}}">Created</a></li>
        <li><a href="{{asset('atelier')}}">Atelier</a></li>
        <li><a href="{{asset('home')}}">Museum</a></li>
        <li><a href="{{asset('myProfile')}}">My Profile</a></li>
        <li><a href="{{asset('search')}}">My friends</a></li>
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
        <label>Mis Canvas:</label><br>
        @if (count($canvas)>0)
            @foreach ($canvas as $p)
                <figure>
                    <a href="canvas/{{ $p->idCanvas}}"><img src="{{asset('preview/'.$p->preview)}}" /></a>
                    <figcaption>{{$p->title}}.</figcaption>
                </figure>
                <button name="publish" value="{{$p->idCanvas}}" class="published">Publicar</button>
            @endforeach
        @else

            <p>No tienes aún un painting.</p>
        @endif
    </div>
    <!-- Los canvas invitados -->
    <div>
        <label>Canvas Invitados:</label><br>
        @if (isset($invited))
            @if (count($invited)>0)
                @foreach ($invited as $p)
                    <figure>
                        <a href="canvas/{{ $p->idCanvas}}"><img src="{{asset('preview/'.$p->preview)}}" /></a>
                        <figcaption>{{$p->title}}.</figcaption>
                    </figure>
                @endforeach
            @else

                <p>No tienes aún un painting.</p>
            @endif
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
<input type="hidden" id="idUser" value="{{$idUserSession}}"/>
</body>
</html>