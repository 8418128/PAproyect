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
        Home
        <button class="friends"><img src=""></button><!--generalImg/ -->
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
            <h2>Aqui Van los Paitings publicados de los amigos</h2>

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