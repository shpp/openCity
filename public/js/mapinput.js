let marker;
let geocoder;
let map;

$(document).ready(function () {
  $("#places_category").change(function () {
    let curLoc = window.location;
    let url = curLoc.origin + curLoc.pathname + '?category=' + $(this).val();
    $(location).attr('href', url);
  });

});

/****************************************************
 * Google map add marker
 ****************************************************/
function addMarker(location) {
  let image = new google.maps.MarkerImage('/img/green-dot.png');//,
  if (marker) {
    marker.setMap(null);
  }

  marker = new google.maps.Marker({
    position: location,
    map: map,
    icon: image,
    animation: google.maps.Animation.DROP,
    draggable: true,
    zIndex: 999
  });//create marker
  map.setCenter(location);
  google.maps.event.addListener(marker, 'mouseup', function (event) {
    $('input[name="map_lat"]').val(marker.position.lat());
    $('input[name="map_lng"]').val(marker.position.lng());
    geocodeLatLng();
  });//create event on move marker
}

/****************************************************
 * Google map initialization
 ****************************************************/
function initMap() {
  let latLng_data;
  let divMap = document.getElementById('map');

  if (!divMap) {
    return false;
  }

  if ($('input[name="geo_place_id"]').val()) {
    latLng_data = latLng();
  } else {
    latLng_data = {lat: 48.5050277987034, lng: 32.2593695292334}
  }

  map = new google.maps.Map(divMap, {
    center: latLng_data,
    zoom: 17
  });

  geocoder = new google.maps.Geocoder;

  google.maps.event.addListener(map, 'click', function (event) {
    addMarker(event.latLng);
  });//create event on click marker

  document.getElementById('find_address').addEventListener('click', function (event) {
    event.preventDefault();
    let find_option = $('input[name="find_option"]:checked')[0].value;
    if ('adr' === find_option) {
      geocodeAddress();
    } else if ('gps' === find_option) {
      geocodeLatLng();
    } else {
      return false;
    }
    return false;
  });
  //add marker if set coordinate
  if ($('input[name="geo_place_id"]').val()) {
    addMarker(latLng_data);
  }
}

/****************************************************
 * Google geocode search coordinate by address
 ****************************************************/
function geocodeAddress() {
  let address = `${$('input[name="city"]').val()} ${$('input[name="street"]').val()} ${$('input[name="number"]').val()}`;
  console.log(geocoder);
  geocoder.geocode({'address': address}, function (results, status) {
    console.log(results, status);
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        fillAddress(results[0]);
        addMarker(latLng());
      }
    } else {
      alert("Geocoder видав помилку: " + status);
    }
  });
}

/****************************************************
 * Google geocode address search by coordinates
 ****************************************************/
function geocodeLatLng() {
  let latLng_data = latLng();
  geocoder.geocode({'location': latLng_data}, function (results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        fillAddress(results[0]);
        addMarker(latLng());
      } else {
        window.alert('Нічого не знайдено!');
      }
    } else {
      window.alert('Geocoder видав помилку: ' + status);
    }
  });
}

function latLng() {
  let lat = $('input[name="map_lat"]').val();
  let lng = $('input[name="map_lng"]').val();
  return {lat: +lat, lng: +lng}
}

function fillAddress(data) {
  $('input[name="city"]').val(data.address_components[3].short_name);//city
  $('input[name="street"]').val(data.address_components[1].short_name);//street
  $('input[name="number"]').val(data.address_components[0].short_name);//number
  $('input[name="map_lat"]').val(data.geometry.location.lat());//location lat
  $('input[name="map_lng"]').val(data.geometry.location.lng());//location lng
  $('input[name="geo_place_id"]').val(data.place_id);//location id
  $('input[name="comment_adr"]').val(data.formatted_address);
}
