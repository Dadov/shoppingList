@extends('app')
 
@section('content')
    <h2>
        {!! link_to_route('shops.show', $shop->name, [$shop->slug]) !!} -
        {{ $product->name }}
    </h2>
 
    {{ $product->price }}DKK
@endsection