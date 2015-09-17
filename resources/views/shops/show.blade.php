@extends('app')
 
@section('content')
    <h2>{{ $shop->name }}</h2>
 
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
		<div id ="map" style="height: 350px" >
		</div>

		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script language="javascript" type="text/javascript">

    var map;
    var geocoder;
    function InitializeMap() {

        var latlng = new google.maps.LatLng({{$shop->latitude}}, {{$shop->longitude}});
        var myOptions =
        {
            zoom: 19,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);
		
		var marker = new google.maps.Marker({
			position: latlng,
			map: map
		})
    }

    function FindLocaiton() {
        geocoder = new google.maps.Geocoder();
        InitializeMap();

        var address = document.getElementById("addressinput").value;
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });

            }
            else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });

    }

    window.onload = InitializeMap;

	</script>
    @endif
	  <p>
        {!! link_to_route('shops.index', 'Back to Shops') !!} |
        {!! link_to_route('shops.products.create', 'Register Product', $shop->slug) !!}
    </p>
@endsection