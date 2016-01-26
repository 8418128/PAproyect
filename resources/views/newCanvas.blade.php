<!--ESTA PARTE ES COMUN A TODAS LAS PAGINAS EXCEPTO LOGIN-->
<link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
<script src="http://js.pusher.com/3.0/pusher.min.js"></script>
<script src="{{asset('generalJs/chatIndividual.js')}}"></script>
<script src="{{asset('generalJs/creatingCanvas.js')}}"></script>
<link href="{{asset('style/chatIndividual.css')}}" rel="stylesheet" type="text/css">

<body>
<form method="post">
    Nombre del canvas <input type="text" id="title" name="title"/>
    Editable <input type="checkbox" id="editable" name="editable"/>

    Invitar amigos <select id="frienda" name="friends">
        <option value="-1">Seleccione amigo</option>
        @foreach($user->friends($user->idUser) as $friend)
            <option data-image="{{asset("generalImg")."/".$friend->us()->photo}}" value="{{$friend->us()->idUser}}">{{$friend->us()->name}}</option>
        @endforeach

        </select>
    <button type="button" id="addf" class="btn btn-default btn-s">Añadir amigo</button>
    <input type="hidden" name="idUser" id="idUser" value="{{$user->idUser}}">
    <button type="button" id="createc" class="btn btn-info btn-s">Crear</button>
</form>
<div id="guests-container"></div>
<div id="chats-container"></div>
</body>