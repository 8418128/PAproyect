<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="{{asset('generalJs/menu.js')}}"></script>
    <script src="http://js.pusher.com/3.0/pusher.min.js"></script>
    <link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('generalJs/chatIndividual.js')}}"></script>
    <link href="{{asset('style/chatIndividual.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('style/editProfile.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style/menu.css" rel="stylesheet" type="text/css">
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.fileUpload')
                            .css({background:"url("+e.target.result+")",
                                position:"relative",
                                overflow:"hidden",
                                margin:"10px",
                                backgroundSize:"120px 150px",
                                backgroundRepeat:"no-repeat",
                                width:"120px",
                                height:"150px"
                            });
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(function(){
            var fileExtension = "";
            //función que observa los cambios del campo file y obtiene información
            $(':file').change(function()
            {
                //obtenemos un array con los datos del archivo
                var file = $("#imagen")[0].files[0];
                //obtenemos el nombre del archivo
                var fileName = file.name;
                //obtenemos la extensión del archivo
                fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
                //obtenemos el tamaño del archivo
                var fileSize = file.size;
                //obtenemos el tipo de archivo image/png ejemplo
                var fileType = file.type;
                if(!isImage(fileExtension)){
                    alert("HAy que mostrar este error con jquery en la pagina")
                }else{
                    //cambiar Foto
                    readURL($("#imagen")[0])
                }
                /*alert("Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.");
                 console.log($("#imagen")[0].files)*/
            });
        });
        //comprobamos si el archivo a subir es una imagen
        //para visualizarla una vez haya subido
        function isImage(extension) {
            switch (extension.toLowerCase()) {
                case 'jpg':
                case 'gif':
                case 'png':
                case 'jpeg':
                    return true;
                    break;
                default:
                    return false;
                    break;
            }
        }
    </script>
    <style>
        .fileUpload{
            background: url("generalImg/{{$photo}}");
        }
    </style>

</head>
<body>
<header>
    <!-- hamburger menu: http://codepen.io/g13nn/pen/eHGEF -->
    <button class="hamburger">&#9776;</button>
    <button class="cross">&#735;</button>
    Edit Profile
    <button class="friends"><img src="style/profile_icon_small.png"></button>
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

    <ul id ="friends_ul">>

    </ul>
</div>
<div class = "containerz">
    @if (count($errors) > 0)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @endif
    <form class = "form-box" method="post" action="updateProfile" enctype="multipart/form-data">

        <table>
            <tr> Profile image:
                <div class="fileUpload">
                    <input name="photo" type="file" class="upload" id="imagen" />
                </div>
            </tr>
            <tr>
                <td>Name: </td><td><input type="text" name="name" value="{{$name}}">

                </td>
            </tr>
            <tr>
                <td>Date of birth: </td><td><input type="text" name="birthdate" value="{{$birthdate}}"></td>
            </tr>
            <tr>
                <td>Email: </td><td><input type="text" name="email" value="{{$email}}"></td>
            </tr>
        </table>
        <input type="hidden" value="{{$email}}" name="user">

        <button id = "enviar" class="btn btn-info btn-block register" type="submit" name = "enviar">Keep changes</button>
    </form>
</div>
<div id = "chats-container"></div>
<input type="hidden" id="idUser" value="{{$idUserSession}}"/>
</body>
</html>
