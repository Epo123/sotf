@extends('master')

@section('header')
@parent
<h2>Home</h2>
@stop

@section('content')

@foreach($products as $product)
<button type="button" class="btn btn-default">{{$product->name}}<br><img src="{{asset('img/'.$product->ean_code.'.jpg')}}" onclick="window.location.href='putinshoppingcart/{{$product->ean_code}}';" width="150px"><br>€{{$product->price_in_cents/100}}</button>
@endforeach

@stop