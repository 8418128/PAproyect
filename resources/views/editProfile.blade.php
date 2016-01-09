<html>
<head>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
        .fileUpload {
            position: relative;
            overflow: hidden;
            margin: 10px;
            background: url("generalImg/{{$photo}}");
            background-size: 120px 150px;
            background-repeat: no-repeat;
            width: 120px;
            height: 150px;

        }
        .fileUpload input.upload {
            filter: alpha(opacity=0);
            opacity: 0;
            height: 150px;
            width: 120px;

        }
    </style>

</head>
<body>
<div>
    <form method="post" action="saveProfile" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Nombre</td><td><input type="text" name="name" value="{{$name}}"></td><td rowspan="4">
                <div class="fileUpload">
                    <input type="file" class="upload" id="imagen" />
                </div>
            </td>
        </tr>
        <tr>
            <td>Apellidos</td><td><input type="text" name="surname" value="{{$surname}}"></td>
        </tr>
        <tr>
            <td>Fecha de Nacimiento</td><td><input type="text" name="birthdate" value="{{$birthdate}}"></td>
        </tr>
        <tr>
            <td>Email</td><td><input type="text" name="email" value="{{$email}}"></td>
        </tr>
    </table>
        <input type="hidden" value="{{$email}}" name="user">
        <input type="submit" name="enviar" value="Enviar">
    </form>
</div>
</body>
</html>