@extends('app')
 
@section('content')
   <h2>Shops</h2>
 
    @if ( !$shops->count() )
        There are no shops
    @else
        <ul>
            @foreach( $shops as $shop )
                <li>
				{!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('shops.destroy', $shop->slug))) !!}
                        <a href="{{ route('shops.show', $shop->slug) }}">{{ $shop->name }}</a>
                        (
                            {!! link_to_route('shops.edit', 'Edit', array($shop->slug), array('class' => 'btn btn-info')) !!},
                            {!! Form::submit('Delete', array('class' => 'btn btn-danger')) !!}
                        )
                    {!! Form::close() !!}
				</li>
            @endforeach
        </ul>
    @endif
	<p>
        {!! link_to_route('shops.create', 'Register Shop') !!}
    </p>
@endsection