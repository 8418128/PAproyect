<!DOCTYPE html>
<html>
    <head>
        <script src="http://js.pusher.com/3.0/pusher.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            Pusher.log = function(msg) {
                console.log(msg);
            };
            var pusher = new Pusher("{{env("PUSHER_KEY")}}")
            var channel = pusher.subscribe("{{$channel}}");
            channel.bind('App\\Events\\ChEvent',
                    function(data) {
                        //alert('Me está llegando: ' + data.texto);
                        $("#canvas").append("<p>"+data.texto+"</p>");
                    }
            );
        </script>


        <title>Laravel LALLALALALALALALALA</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
                <div id="canvas" class="title"></div>
            </div>
        </div>
    </body>
</html>
