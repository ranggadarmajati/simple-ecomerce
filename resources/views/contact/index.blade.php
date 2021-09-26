@extends('layout.app')
@section('title')
  Kontak
@stop
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(fashe-colorlib/images/product/banner_head2.jpeg);">
		<h2 class="l-text2 t-center">
			Echa Kids
		</h2>
		<p class="m-text1 t-center">
		---------------------------------
		</p>
		<p class="m-text13 t-center">
			<b>Kontak</b>
		</p>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<div class="p-r-20 p-r-0-lg">
						<!-- <div class="contact-map size21" id="google_map" data-map-x="40.614439" data-map-y="-73.926781" data-pin="images/icons/icon-position-map.png" data-scrollwhell="0" data-draggable="1"></div> -->
						<div class="contact-map size21" id="map"></div>
					</div>
				</div>

				<div class="col-md-6 p-b-30">
					<form class="leave-comment">
						<h4 class="m-text26 p-b-36 p-t-15">
							Kirimi kami pesan Anda
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Phone Number">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email Address">
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message"></textarea>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
								Send
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@stop
@section('custom-css-script')
<!-- gmaps script -->
{!! Html::script( 'https://maps.googleapis.com/maps/api/js?key='.$gmap_apikey.'&libraries=places' ) !!}
<!--end gmaps script -->
<style type="text/css">
        .map {
            width: 100%;
            height: 500px;
        }
        label.btn.btn-default {
            padding: 11px;
        }
    </style>

    <style type="text/css">
        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 15px;
            border-radius: 5px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .desc, .fac {
            padding: 6px 12px;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }
    </style>
@stop
@section('push-javascript')
@if($data['longitude'] == null && $data['latitude'] == null)

  
  <!-- Jquery Gmaps -->
  {!! Html::script( 'js/jquery.gmaps.js' ) !!}
  
@else
<!-- Jquery Gmaps -->
<script type="text/javascript">
  if (navigator.geolocation) {
    	navigator.geolocation.getCurrentPosition(successMaps, errorMaps);
} else {
    alert('geolocation not supported');
}

function generateMaps(longitude, latitude) {
    google.maps.event.addDomListener(
        window
        , 'load'
        , initialize(
            longitude
            , latitude
            )
        );
}

function successMaps(position) {
    console.log("============position===============");
    console.log(position);
    //generateMaps(107.46546597351073, -7.101166863187003);
    generateMaps({{$data['longitude']}}, {{$data['latitude']}});
}

function errorMaps(msg) {
    console.log(msg);
    longitude = 106.813880;
    latitude = -6.217458;
    document.getElementById('lat').value = latitude;
    document.getElementById('lng').value = longitude;

    generateMaps(longitude, latitude);
}
@if($type != 'view')
function initialize(longBase, latBase) {
    var latlng = new google.maps.LatLng(latBase, longBase);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 13,
        disableDefaultUI: true
    });
    var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: true,
        icon:'images/icons/location.png';
// anchorPoint: new google.maps.Point(0, -29)
});
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

// If the place has a geometry, then present it on a map.
if (place.geometry.viewport) {
    map.fitBounds(place.geometry.viewport);
} else {
    map.setCenter(place.geometry.location);
    map.setZoom(17);
}

marker.setPosition(place.geometry.location);
marker.setVisible(true);
bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
infowindow.setContent(place.formatted_address);
infowindow.open(map, marker);

});
// this function will work on marker move event into map
google.maps.event.addListener(marker, 'dragend', function() {
    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            }
        }
    });
});
}
@else 
var img_icon = "{{url('fashe-colorlib/images/icons/icon-position-map-echakids2.png')}}";
var addr 	 = "{{$data['address']}}";
function initialize(longBase, latBase) {
    var latlng = new google.maps.LatLng(latBase, longBase);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 16,
        disableDefaultUI: true
    });
    var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Echakids.</h1>'+
            '<div id="bodyContent">'+
            '<p>' +addr+
            '</p>'+
            '</div>'+
            '</div>';
    var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
    var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: false,
        icon:img_icon,
        title:'Echkids Grosir Baju Anak'
// anchorPoint: new google.maps.Point(0, -29)
	});
    marker.addListener('click', function() {
          infowindow.open(map, marker);
        });

    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }

// If the place has a geometry, then present it on a map.
if (place.geometry.viewport) {
    map.fitBounds(place.geometry.viewport);
} else {
    map.setCenter(place.geometry.location);
    map.setZoom(17);
}

marker.setPosition(place.geometry.location);
marker.setVisible(true);
bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
infowindow.setContent(place.formatted_address);
infowindow.open(map, marker);

});
// this function will work on marker move event into map
google.maps.event.addListener(marker, 'dragend', function() {
    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            }
        }
    });
});
}
@endif
function bindDataToForm(address,lat,lng){
    $('input#lng').val(lng);
    $('input#lat').val(lat);
    document.getElementById('location').value = address;
}

</script>

@endif
@stop