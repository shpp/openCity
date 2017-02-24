var map;
var markers = [];
var hide_right = 1;
var parameters = [];
var accessebilities =[];
var lastInfo = null;
var markerIcon = 'img/red-dot.png';


$(document).ready(function () {
    addMarkersToMap([], []);
});

/****************************************************
*  Searching place on its name
*****************************************************/
$('#search-input.typeahead').typeahead({  
  name: 'places',
  limit: 10,
  highlight: true,
  minLength: 2,
  source: function(query, handler){
    return $.get('/search', {'val':query}, function(response){
        var names = [];
        var places = response.places;
        for (var i = 0; i < places.length; i++) {
            names.push(places[i].id+'_'+places[i].name);
        }
        return handler(names);
    }, 'json'); 
  },
  updater: function(item){
     var items = item.split('_');
     setMapCenter(items[0]);  
  }
});

/****************************************************
* Set focus to marker with some place_id and show info panel
*****************************************************/
function setMapCenter(id) {
    for (var i = 0; i < markers.length; i++) {
        if(markers[i].place_id == id) {
            console.log('!! '+i);
            map.setCenter(markers[i].getPosition());
            google.maps.event.trigger(markers[i], 'click');
            break;
        }
    }    
}
/****************************************************
 * Hide right bar
 ***************************************************/
function rigthHide() {
    $("#right-bar").animate({right: '-390px'},800);
    hide_right = 1;
}

/****************************************************
 * Show right bar
 ***************************************************/
function rigthShow() {
    $("#right-bar").animate({right: '0px'},800);
    hide_right = 0;
}

$("#right-bar").click(function(){
    $("#right-bar").stop();
    (hide_right == 0) ? rigthHide() : rigthShow();
});

$("#submit_params").click(function() {
    var cat = [];
    var acc = [];
    event.preventDefault();
    clearMarkres();
    
    $.each($("input[name='cat[]']").serializeArray(), function(i, obj) { 
        cat.push(+obj.value);
    });
    $.each($("input[name='acc[]']").serializeArray(), function(i, obj) { 
        acc.push(+obj.value);
    });

    addMarkersToMap(cat,acc);
});

/****************************************************
* Get array in Parameters
 ***************************************************/
function fillParameters() {
    var items = '';
    $.get('/getparameters', function(response) {
       parameters = $.parseJSON(response);
    });
}


/****************************************************
* Clear all markers on the map
 ****************************************************/
function clearMarkres() {
    for (i in markers) {
        markers[i].setMap(null);
    }
   markers = [];
}

/****************************************************
* Adds a marker to the map and push to the array.
****************************************************/
function addMarker(LatLng, infowindow, contentString, markerIcon, id) {
    var marker = new google.maps.Marker({
                     map: map,
                     animation: google.maps.Animation.DROP,
                     position: LatLng,
                     info: infowindow,
                     content: contentString,
                     icon: markerIcon,
                     place_id: id
    })
    markers.push(marker);

}


/****************************************************
* Add markers to Google map
****************************************************/
function addMarkersToMap(cat,acc){
    $.get('/getplaces',{"cat[]": cat,
                         "acc[]": acc,
     },function(response) {
        var access_cnt_all = response.access_cnt_all;
        var place = response.places;
        for (var i = 0; i < place.length; i++){
            if (place[i].geo_place_id) {
                var LatLng = {lat: +place[i].map_lat, lng: +place[i].map_lng};

                var contentString =
                    '<div id="content">'+
                    '<div id="siteNotice">'+
                    '<h3>'+
                    place[i].city+' <br/>'+
                    place[i].street+' '+
                    place[i].number+'</h3><hr/>'+
                    '</div>'+
                    '<div id="bodyContent">'+
                    '<h4>'+
                    place[i].name+
                    '</h4>'+
                    '</div>'+
                    '</div>';

                var addrString =
                    '<div id="content">'+
                    '<div id="siteNotice">'+
                    '<h3>'+
                    place[i].street+' '+
                    place[i].number+'</h3>'+
                    '</div>'+
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: addrString
                });

                if(place[i].acc_cnt != 0){
                    if (place[i].acc_cnt == access_cnt_all)
                        markerIcon = 'img/green-dot.png';
                    else
                        markerIcon = 'img/yellow-dot.png';
                }
                else
                    markerIcon = 'img/red-dot.png';

                addMarker(LatLng, infowindow, contentString, markerIcon, place[i].id);

                google.maps.event.addListener(markers[markers.length - 1 ], "click",function () {
                    if (lastInfo) lastInfo.close();
                    this.info.open(map, this);
                    lastInfo = this.info;
                    document.getElementById('info').innerHTML   = this.content;
                    // Additional paramerers
                    $.get('/getinfo', {'id':this.place_id}, function(inforesponse){
                        var info_add = document.getElementById('infoAdd');
                        var infoStr = '<hr/><h5><ul>';

                        var param = inforesponse.parameters;
                        var len = param.length
                        for (var i = 0; i < len; i++) {
                            infoStr += '<li>' + param[i].name +': '+ 
                            param[i].value + '</li>';
                        }

                        infoStr += '</ul></h5>';
                        info_add.innerHTML = infoStr;


                        var info_acc = document.getElementById('infoAcc');
                        var infoStr = '<hr/><h5><ul>';
                        //accessresp = $.parseJSON(inforesponse['parameters'] , true);
                        var acc = inforesponse.accessibilities;
                        len = acc.length
                        
                        for (var i = 0; i < len; i++) {
                            infoStr += '<li>' + acc[i] + '</li>';
                        }
                        infoStr += '</ul></h5>';
                        info_acc.innerHTML = infoStr;

                    });

                    if (hide_right) rigthShow();
                });
            }
        }
    });
}

/****************************************************
* Google map initialization
 ****************************************************/
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 48.5050277987034, lng: 32.2593695292334},
        zoom: 15
    });
}
