<html>
<head>
    <link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body>
@section('nav')
    This is the master nav.
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>