@extends('app')
 
@section('content')
    <h2>
        {!! link_to_route('shops.show', $shop->name, [$shop->slug]) !!} -
        {{ $list->name }}
    </h2>
 
 	<ul>
 		@foreach($list->products as $product)
 		<li>
 			 {{$product->pivot->quantity}}x
 			{{$product->name}}
 		</li>
 		@endforeach
 	</ul>
    {{ $list->total_price }}DKK
@endsection