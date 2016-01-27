<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link href="{{asset('style/editProfile.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style\menu.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="{{asset('generalJs/comment.js')}}"></script>
    <script type="text/javascript" src="{{asset('generalJs/like_canva.js')}}"></script>

</head>
<body>
<header>
    <!-- hamburger menu: http://codepen.io/g13nn/pen/eHGEF -->
    <button class="hamburger">&#9776;</button>
    <button class="cross">&#735;</button>
    Home
    <button class="friends"><img src=""></button><!--generalImg/ -->
    <button class="cross2">&#735;</button>
</header>
<div class="menu" id = "menu1">
    <ul>
        <li><a href="gallery">Gallery</a></li>
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
        <label>POST:</label><br>
        @if (count($painting)>0)
            @foreach ($painting as $p)
                <figure>
                    <a href="canvas/{{ $p->idPainting}}"><img src="{{asset('preview/'.$p->image)}}" /></a>
                    <figcaption>{{$p->title}}.</figcaption>
                </figure>
                <button name="like" value="{{$p->idPainting}}" class="like">Me gusta</button>

                <div class="comentarios" id="comment".{{ $p->idPainting}}>

                    @foreach($p->comments() as $co)
                        {{$co->publish()->name}}: <p> {{$co->text}} </p>
                    @endforeach
                </div>
            @endforeach
            <br>Yo: <input type="text" name="{{ $p->idPainting}}" class="comentario" placeholder="Escribe un comentario..." >
        @else

            <p>No hay publicacioness.</p>
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