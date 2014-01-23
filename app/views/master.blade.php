<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PPPS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>



<div class="container">

    @if(Auth::check())
    <a href="{{URL::to('logout')}}" class="pull-right btn btn-danger">Logout</a>
    <a href="{{URL::to('shoppingcart')}}" class="pull-right btn btn-info">Shoppinglist</a>
    @else
    <a href="{{URL::to('login')}}" class="pull-right btn btn-info">Login</a>
    @endif

    @section('header')
    <h1><a href="{{URL::to('/')}}">PPPS</a></h1>
    @show

    @if (Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
    @endif
    @if (Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif

    @yield('content')
</div>
</body>
</html>