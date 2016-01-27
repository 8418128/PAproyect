<!doctype html>

<html>
<head>
    <title>Profile view</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="generalJs/menu.js"></script>
    <script src="http://js.pusher.com/3.0/pusher.min.js"></script>
    <link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css">

    <script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('generalJs/chatIndividual.js')}}"></script>
    <link href="{{asset('style/chatIndividual.css')}}" rel="stylesheet" type="text/css">


    <link href="style/profile.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style/menu.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <!-- hamburger menu: http://codepen.io/g13nn/pen/eHGEF -->
    <button class="hamburger">&#9776;</button>
    <button class="cross">&#735;</button>
    My Profile
    <button class="friends"><img src="style/profile_icon_small.png"></button>
    <button class="cross2" visibility="hidden" >&#735;</button>
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

    <ul id ="friends_ul">>

    </ul>
</div>

<div class = "containerz">

    <img src="generalImg/{{$photo}}" width="100px">
    <p>Name: {{$name}}</p>
    <p>Date of birth: {{$birthdate}}</p>
    <p>Email: {{$email}}</p>

    <a href="editProfile"><button>Edit profile</button></a>
</div>

<div id = "chats-container"></div>
<input type="hidden" id="idUser" value="{{$idUserSession}}"/>
</body>
</html>