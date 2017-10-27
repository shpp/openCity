var map;
var markers = [];
var lastInfo = null;

$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var placesCache = null;
  function getMarkersList(query, forceNoCache, cb) {
    if (!forceNoCache && placesCache)
      return cb(placesCache);
    $.get('/getplaces', function(response) {
      placesCache = response;
      cb(response);
    });
  }

  var deferTimeMarker = 0;
  var deferTimeout = 300;
  function addMarkersToMap(query, forceNoCache) {
    const now = Date.now();
    if (now - deferTimeMarker < deferTimeout) return;
    deferTimeMarker = now;

    query = query ? '?' + query : '';
    getMarkersList(query, forceNoCache, function(response) {
      var access_cnt_all = response.access_cnt_all;
      var places = response.places;

      clearMarkers();

      places
        .filter(function(place) {
          return place.geo_place_id;
        })
        .map(function(place) {
          var LatLng = {lat: +place.map_lat, lng: +place.map_lng};
          var addrString = '<div class="marker-popup">' + place.street + ', '+ place.number + '</div>';
          var markerColor = '';

          switch (place.acc_cnt) {
            case 0:
              markerColor = '#F44336';
              break;
            case access_cnt_all:
              markerColor = '#4aa54e';
              break;
            default:
              markerColor = '#FFEB3B';
          }

          var popupInfo = new google.maps.InfoWindow({
              content: addrString
          });

          addMarker(LatLng, popupInfo, place.name, markerColor, place.id);
        });
    });
  }
  
  const $rightSideBar = $("#right-bar");

  function hideRightSideBar() {
    $rightSideBar.animate({right: '-400px'}, 400);
  }

  function showRightSideBar() {
    $rightSideBar.animate({right: '1rem'}, 400);
  }

  function submitComment() {
      var placeId = $('#right-bar-place-id__input').val();
      var comment = $('#comment').val();
      if (!comment.trim()) {
          // todo: pretty alerts
          alert('Введіть коментар!');
          return;
      }

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          url: 'place-comments',
          method: 'POST',
          data: {'place-id': placeId, 'comment': comment, token: ''}
      }).done(function (response) {
          // todo: pretty alerts
          alert('Коментар додано');
      }).fail(function (err) {
          // todo: pretty alerts
          console.log(err);
      });
  }

  $('#right-bar-close').click(hideRightSideBar);
  $('#right-bar-comment__submit').click(submitComment);
  $('#categories').mCustomScrollbar({
    theme: 'rounded-dots-dark'
  });

  addMarkersToMap();

  $('#search-input.typeahead')
    .typeahead({
      limit: 10,
      highlight: true,
      minLength: 1
    }, {
      name: 'places',
      display: 'name',
      source: function(query, syncResults, asyncResults) {
        $.get('/search', {'val': query}, function(response) {
          console.log(response.places);
          return asyncResults(response.places);
        });
      }
    })
    .on('typeahead:selected', function(event, item) {
      $(this).blur();
      setMapCenter(item.id);
    });

  /****************************************************
  * Focus on marker with same place_id and show popup
  *****************************************************/
  function setMapCenter(id) {
      for (var i = 0; i < markers.length; i++) {
          if (markers[i].place_id === id) {
              map.setCenter(markers[i].getPosition());
              google.maps.event.trigger(markers[i], 'click');

              break;
          }
      }
  }

  $('#categories-form input[type=checkbox], #access-form input[type=checkbox]')
    .change(filterPlaces);

  function filterPlaces() {
    var categories = $("#categories-form").serialize();
    var access = $("#access-form").serialize();
    var query = categories + '&' + access;

    addMarkersToMap(query);
  }

  /****************************************************
  * Clear all markers on the map
   ****************************************************/
  function clearMarkers() {
    for (let i in markers) {
      markers[i].setMap(null);
    }
    markers = [];
  }

  /****************************************************
  * Adds a marker to the map and push to the array.
  ****************************************************/
  function addMarker(LatLng, infowindow, contentString, markerColor, id) {
    var markerIcon = {
      path: 'M256,0C149.969,0,64,85.969,64,192c0,43.188,14.25,83,38.313,115.094L256,512l153.688-204.906 C433.75,275,' +
      '448,235.188,448,192C448,85.969,362.031,0,256,0z M256,320c-70.688,0-128-57.313-128-128S185.313,64,256,64 s128,57.' +
      '313,128,128S326.688,320,256,320z',
      fillColor: markerColor,
      fillOpacity: 1,
      scale: .08,
      strokeWeight: 1,
      strokeColor: 'grey'
    };

    var marker = new google.maps.Marker({
      map: map,
      position: LatLng,
      info: infowindow,
      content: contentString,
      icon: markerIcon,
      place_id: id
    });

    google.maps.event.addListener(marker, 'click', function () {
      var place = this;

      if (lastInfo) lastInfo.close();
      place.info.open(map, place);
      lastInfo = place.info;
      $('#right-bar-place-id__input').val(place.place_id)
      $.get('/getinfo', {'id': place.place_id}, function(response) {
          if (response.success) {
            var $address = $('#right-bar-address');
            var $access = $('#right-bar-access');
            var $heading = $('#right-bar-heading');

            var params = response.parameters.map(function(param) {
              return '<li>' + param.name + ': ' + param.value + '</li>';
            });

            var accessibilities = response.accessibilities.map(function(access) {
              return '<li>' + access + '</li>';
            });

            $heading.html(place.content);
            $address.html('<ul>' + params.join('') + '</ul>');

            if (accessibilities.length) {
              $access.html('<ul>' + accessibilities.join('') + '</ul>');
              $access.show();
            } else {
              $access.hide();
            }

            showRightSideBar();
          }
      });
        $.ajax({
            url: '/place/' + place.place_id + '/comments',
            method: 'get'
        }).done(function (response) {
            var comments = response.data;
            for (var i = 0, arrLength = comments.length; i < arrLength; i++) {
                var comment = comments[i];
                // todo: make it nicer
                var commentDiv = $('<div>').text('"' + comment.comment + '"  ' + comment.author.name);
                $('.right-bar-comments').append(commentDiv, $('<hr style="margin: 0; color:fafafa">'));
            }
        })
    });

    markers.push(marker);
  }
});

/****************************************************
* Google map initialization
 ****************************************************/
function initMap() {
  var mapContainer = document.getElementById('map');
  var defaultZoom = 15;
  var defaultCoords = {
    lat: 48.5050277987034,
    lng: 32.2593695292334
  };

  map = new google.maps.Map(mapContainer, {
    zoom: defaultZoom,
    center: defaultCoords,
    scrollwheel: false,
    mapTypeControlOptions: {
      position: google.maps.ControlPosition.BOTTOM_CENTER
    },
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_CENTER
    },
    // TODO
    // need to figure out how to set street view back button position
    streetViewControl: false
    // streetViewControlOptions: {
    //   position: google.maps.ControlPosition.LEFT_CENTER
    // },
  });

  $("#message-form").submit(function () {
     $.post('/messages',$( this ).serialize());
     $(this).trigger("reset");
     var $toastContent = $('<span>Дякуємо! Ваше повідомлення успішно надіслано.</span>');
     Materialize.toast($toastContent, 5000);
     // you don't have any event here!!
     event.preventDefault();
  });
}
