var map;
var geocoder;
function InitializeMap() {

	var lat = $('#lat').val();
	var lng = $('#lng').val();
    var latlng = new google.maps.LatLng(lat,lng);
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
	});
}

window.onload = InitializeMap;