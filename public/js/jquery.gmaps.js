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
    generateMaps(position.coords.longitude, position.coords.latitude);
}

function errorMaps(msg) {
    console.log(msg);
    longitude = 106.813880;
    latitude = -6.217458;
    document.getElementById('lat').value = latitude;
    document.getElementById('lng').value = longitude;

    generateMaps(longitude, latitude);
}

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
        draggable: true
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
function bindDataToForm(address,lat,lng){
    $('input#lng').val(lng);
    $('input#lat').val(lat);
    document.getElementById('location').value = address;
    // document.getElementById('lat').value = lat;
    // document.getElementById('lng').value = lng;
}
