@extends('master')

@section('header')
@parent
<h2>Shoppinglist</h2>
@stop

@section('content')

<table class="table">
    <tr><th>Naam</th><th>Quantity</th></tr>
@foreach($products as $product)
<tr><td>{{$product->product->name}}</td><td>{{$product->quantity}}</td><td><span class="glyphicon glyphicon-remove" onclick="window.location.href='removefromshoppingcart/{{$product->product->ean_code}}'"></span></td></tr>
@endforeach
</table>


@stop