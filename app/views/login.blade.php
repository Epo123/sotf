@extends('master')

@section('header')
@parent
<h2>Login</h2>
@stop

@section('content')

{{Form::open(array('url' => 'login', 'method' => 'post'))}}

<div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" placeholder="Enter email">
</div>
<div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" name="password" placeholder="Enter password">
</div>

<button type="submit" class="btn btn-default">Submit</button>

{{Form::close()}}

@stop