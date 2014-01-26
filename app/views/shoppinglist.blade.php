@extends('master')

@section('header')
@parent
<h2>Shoppinglist</h2>
@stop

@section('content')

<table class="table">
    <tr><th>Naam</th><th class="centered">Quantity</th><th class="centered">Delete</th></tr>
    @foreach($products as $product)
    <tr>
        <td>{{$product->product->name}}</td>
        <td class="centered">{{$product->quantity}}</td>
        <td class="centered">
            <button type="button" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-remove" onclick="window.location.href='removefromshoppingcart/{{$product->product_id}}'"></span>
            </button>
        </td>
    </tr>
    @endforeach
</table>


@stop