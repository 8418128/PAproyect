<!doctype html>
<html>
<head>

    <link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('Couch/jquery.couch.js')}}"></script>
    <script src="@yield('jscript')"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
    @yield('style')

    <title>@yield('title')</title>
</head>
<body>
@section('nav')
    This is the master nav.
@show

<div>
    @yield('content')

</div>
</body>
</html>