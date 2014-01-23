@extends('master')

@section('header')
@parent
<h2>Shoppinglist</h2>
@stop

@section('content')

@foreach($products as $product)
{{$product}}
@endforeach

@stop