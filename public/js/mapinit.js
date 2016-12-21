var map;
var markers = [];

$(document).ready(function () {
    $.get('/getplaces',function(response) {
        var place = $.parseJSON(response , true);
        for (var i = 0; i < place.length; i++){
            if (place[i].geo_place_id) {
                var LatLng = {lat: +place[i].map_lat, lng: +place[i].map_lng};
                var contentString =
                    '<div id="content">'+
                    '<div id="siteNotice">'+
                    '<h3>'+
                    place[i].city+' <br/>'+
                    place[i].street+' '+
                    place[i].number+'</h3>'+
                    '</div>'+
                    '<div id="bodyContent">'+
                    '<h4>'+
                    place[i].name+
                    '</h4>'+
                    '</div>'+
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                        content: contentString
                      });

                markers.push( new google.maps.Marker({
                    map: map,
                    animation: google.maps.Animation.DROP,
                    position: LatLng,
                    info: infowindow
                }));

                google.maps.event.addListener(markers[markers.length - 1 ], "click",function () {this.info.open(map, this);});
            }
        }
    });
});
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 48.5050277987034, lng: 32.2593695292334},
        //zoom: 18
        zoom: 15
    });
}
