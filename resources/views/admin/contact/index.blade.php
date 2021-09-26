@extends('admin.layout.app')
@section('title')
Kontak
@stop
@section('admin-content-header')
<section class="content-header">
      <h1>
        Kontak
        <small>{{ $type == 'view' ? 'Kontak' : 'Edit Kontak' }} </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Kontak</a></li>
        <li class="active">Edit Kontak</li>
      </ol>
    </section>
@stop
@section('admin-main-content')
<div class="row">
<div class="col-lg-12 col-xs-12">
@if(Session::has('success'))
    <div class="alert alert-success" id="successMessage"><em> {!! session('success') !!}</em></div>
@endif
@if(Session::has('failled'))
    <div class="alert alert-danger" id="successMessage"><em> {!! session('failled') !!}</em></div>
@endif
<div class="box box-warning color-palette-box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-image"></i> {{ $type == 'view' ? 'Kontak' : 'Edit Kontak' }}</h3>
    </div>
    <div class="box-body">
    <div class="col-md-12 col-lg-12 col-xs-12">
         @if($type == 'view')
            <div class="map" id="map"></div>
            <br>
                {!! Form::hidden('address', old('address'), [
                    'class' => 'form-control', 'id' => 'location',
                    'rows' => 3, 'style' => 'resize: none'
                ]) !!}
                <input type="hidden" name="address" id="location">
                <input type="hidden" name="longitude" id="lng" class="col-md-4">
                <input type="hidden" name="latitude" id="lat" class="col-md-4">
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" name="address" readonly="readonly">
                      {{ isset($contact->address) ? $contact->address : '-' }}  
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="hp_no">No Hp</label>
                    <input type="text" name="hp_no" class="form-control" value="{{ isset($contact->hp_no) ? $contact->hp_no : '-' }}" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="telp_no">No Telp</label>
                    <input type="text" name="telp_no" class="form-control" value="{{ isset($contact->telp_no) ? $contact->telp_no : '-' }}" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="wa_no">No WA</label>
                    <input type="text" name="wa_no" class="form-control" value="{{ isset($contact->wa_no) ? $contact->wa_no : '-' }}" readonly="readonly">
                </div>
                <!-- <div class="form-group">
                    <label for="bbm_pin">Pin BBM</label>
                    <input type="text" name="bbm_pin" class="form-control" value="{{ isset($contact->bbm_pin) ? $contact->bbm_pin : '-' }}" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="line_id">ID Line</label>
                    <input type="text" name="line_id" class="form-control" value="{{ isset($contact->line_id) ? $contact->line_id : '-' }}" readonly="readonly">
                </div> -->
                <div class="form-group">
                    <label for="facebook_src">Facebook</label>
                    <input type="text" name="facebook_src" class="form-control" value="{{ isset($contact->facebook_src) ? $contact->facebook_src : '-' }}" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="instagram_src">Instagram</label>
                    <input type="text" name="instagram_src" class="form-control" value="{{ isset($contact->instagram_src) ? $contact->instagram_src : '-' }}" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="youtube_src">Youtube</label>
                    <input type="text" name="youtube_src" class="form-control" value="{{ isset($contact->youtube_src) ? $contact->youtube_src : '-' }}" readonly="readonly">
                </div>
             <!--    <div class="form-group">
                    <label for="rekening_no">No Rekening</label>
                    <input type="text" name="rekening_no" class="form-control" value="{{ isset($contact->rekening_no) ? $contact->rekening_no : '-' }}" readonly="readonly">
                </div> -->
                <div class="form-group">
                    <button class="btn btn-default" onclick="return window.history.back()">&nbsp;Back &nbsp;</button>
                    <a href="{{ route('admin.edit_contact', $contact->id) }}"><button class="btn btn-warning pull-right">&nbsp;Edit &nbsp;</button></a>
                </div>
         @else

         {!! Form::open([
            'route' => ['admin.update_contact', $contact->id], 
            'role' => 'form',
            'id' => 'form-kontak']) 
         !!}
  
         <input id="searchInput" class="input-control" type="text" placeholder="Cari Lokasi Toko anda">
         <div class="map" id="map"></div>
         <hr>
                <input type="hidden" name="longitude" id="lng" class="col-md-4">
                <input type="hidden" name="latitude" id="lat" class="col-md-4">
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea class="form-control" name="address" id="location">
                      {{ isset($contact->address) ? $contact->address : '-' }}  
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="hp_no">No Hp</label>
                    <input type="text" name="hp_no" class="form-control" value="{{ isset($contact->hp_no) ? $contact->hp_no : NULL }}">
                </div>
                <div class="form-group">
                    <label for="telp_no">No Telp</label>
                    <input type="text" name="telp_no" class="form-control" value="{{ isset($contact->telp_no) ? $contact->telp_no : NULL }}">
                </div>
                <div class="form-group">
                    <label for="wa_no">No WA</label>
                    <input type="text" name="wa_no" class="form-control" value="{{ isset($contact->wa_no) ? $contact->wa_no : NULL }}">
                </div>
                <!-- <div class="form-group">
                    <label for="bbm_pin">Pin BBM</label>
                    <input type="text" name="bbm_pin" class="form-control" value="{{ isset($contact->bbm_pin) ? $contact->bbm_pin : NULL }}">
                </div>
                <div class="form-group">
                    <label for="line_id">ID Line</label>
                    <input type="text" name="line_id" class="form-control" value="{{ isset($contact->line_id) ? $contact->line_id : NULL }}">
                </div> -->
                <div class="form-group">
                    <label for="facebook_src">Facebook</label>
                    <input type="text" name="facebook_src" class="form-control" value="{{ isset($contact->facebook_src) ? $contact->facebook_src : NULL }}">
                </div>
                <div class="form-group">
                    <label for="instagram_src">Instagram</label>
                    <input type="text" name="instagram_src" class="form-control" value="{{ isset($contact->instagram_src) ? $contact->instagram_src : NULL }}">
                </div>
                <div class="form-group">
                    <label for="youtube_src">Youtube</label>
                    <input type="text" name="youtube_src" class="form-control" value="{{ isset($contact->youtube_src) ? $contact->youtube_src : NULL }}">
                </div>
              <!--   <div class="form-group">
                    <label for="rekening_no">No Rekening</label>
                    <input type="text" name="rekening_no" class="form-control" value="{{ isset($contact->rekening_no) ? $contact->rekening_no : NULL }}">
                </div> -->
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success pull-right" value="Simpan">
                </div>
                {!! Form::close() !!}
        @endif
    </div>
    </div>
</div>
 <!-- /.box-body -->
</div>
</div>
@stop
@section('admin-custom-css')
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
        .input-control {
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 250px;
            height: 30px;
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
@if($contact['longitude'] == null && $contact['latitude'] == null)

  
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
    generateMaps({{$contact['longitude']}}, {{$contact['latitude']}});
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
var img_icon = "{{url('fashe-colorlib/images/icons/icon-position-map-echakids2.png')}}"
function initialize(longBase, latBase) {
    var latlng = new google.maps.LatLng(latBase, longBase);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 15,
        disableDefaultUI: true
    });
    var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: true,
        icon:img_icon
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
var addr     = "{{$contact['address']}}";
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
    // document.getElementById('lat').value = lat;
    // document.getElementById('lng').value = lng;
}

</script>

@endif
@stop
