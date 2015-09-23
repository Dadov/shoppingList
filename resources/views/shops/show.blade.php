@extends('app')
 
@section('content')
<input type="hidden" name="lat" id="lat" value="{{$shop->latitude}}"/>
<input type="hidden" name="lng" id="lng" value="{{$shop->longitude}}" />
    <h2>{{ $shop->name }}</h2>
 	<div id ="map" style="height: 350px" >
		</div>
    @if ( !$shop->products->count() )
	{{ $shop->name }} has no products.
    @else
		<p>Products:</p>
        <ul>
            @foreach( $shop->products as $product )
                <li>
				{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('shops.products.destroy', $shop->slug, $product->slug))) !!}
					<a href="{{ route('shops.products.show', [$shop->slug, $product->slug]) }}">{{ $product->name }}</a>
                        (
                            {!! link_to_route('shops.products.edit', 'Edit', array($shop->slug, $product->slug), array('class' => 'btn btn-info')) !!},
 
                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        )
                    {!! Form::close() !!}
				</li>
            @endforeach
        </ul>
    @endif

        @if ( !$shop->lists->count() )
        {{ $shop->name }} has no lists.
        @else
        <p>Shopping lists:</p>
        <ul>
            @foreach( $shop->lists as $list )
                <li>
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('shops.lists.destroy', $shop->slug, $list->slug))) !!}
                    <a href="{{ route('shops.lists.show', [$shop->slug, $list->slug]) }}">{{ $list->name }}</a>
                        (
                            {!! link_to_route('shops.lists.edit', 'Edit', array($shop->slug, $list->slug), array('class' => 'btn btn-info')) !!},
 
                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        )
                    {!! Form::close() !!}
                </li>
            @endforeach
        </ul>
	

		
    @endif
	  <p>
        {!! link_to_route('shops.index', 'Back to Shops') !!} |
        {!! link_to_route('shops.products.create', 'Register Product', $shop->slug) !!} |
        {!! link_to_route('shops.lists.create', 'Create shopping list', $shop->slug) !!}
    </p>
@endsection