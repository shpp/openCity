var map;
var markers = [];

var hide_right = 1;

var lastInfo = null;
var markerIcon = 'img/red-dot.png';


$(document).ready(function () {
    fillCategories();
    fillAccessebilities();
    cat = [];
    acc = [];
    //$("#submit_params").click();
    addMarkersToMap(cat,acc);
});

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
    event.preventDefault();
    clearMarkres();
    cat = [];
    acc = [];
    var o=document.getElementsByName('cat[]');
    for(var i = 0; i < o.length; i++){
        if (o[i].checked) {
            cat.push(o[i].value);
        }
    }
    o=document.getElementsByName('acc[]');
    for(var i = 0; i < o.length; i++){
        if (o[i].checked) {
            acc.push(o[i].value);
        }
    }

    //alert(cat);
    addMarkersToMap(cat,acc);
    
});

/****************************************************
* Build checkboxes for categories
 ***************************************************/
function fillCategories() {
    //var itemHead = '<div class="accordion-inner">';
    var items = '';
    $.get('/getcategories',function(response) {
       response = $.parseJSON(response);
       for(var i = 0; i < response.length; i++){
        items += '<div class="accordion-inner">';
        items += '<label><input type="checkbox" name="cat[]" id="cat' + response[i].id + '" value="' + response[i].id + '" checked >';
        items += response[i].name;
        items +='<\/label><\/div>';
       }
       document.getElementById("collapseOne").innerHTML = items;
    });
}

/****************************************************
* Build checkboxes for accessebilities
 ***************************************************/
function fillAccessebilities() {
    //var itemHead = '<div class="accordion-inner">';
    var items = '';
    $.get('/getaccessebilities',function(response) {
       response = $.parseJSON(response);
       for(var i = 0; i < response.length; i++){
        items += '<div class="accordion-inner">';
        //items += '<label><input type="checkbox" name="acc[]" id="acc' + response[i].id + '" value="' + response[i].id + '" checked >';
           items += '<label><input type="checkbox" name="acc[]" id="acc' + response[i].id + '" value="' + response[i].id + '" >';
        items += response[i].name;
        items +='<\/label><\/div>';
       }
       document.getElementById("collapseTwo").innerHTML = items;
    });
}

/****************************************************
* Clear all markers on the map
 ****************************************************/
function clearMarkres() {
    // удаляем все маркеры
for (i in markers) {
    markers[i].setMap(null);
}
   markers = [];
}


// Adds a marker to the map and push to the array.
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
    $.get('/getplaces',{ "cat[]": cat,
                         "acc[]": acc,
     },function(response) {
        var place = $.parseJSON(response , true);
        //alert(place.length);
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

                if(place[i].aceess_count != 0){
                    if (place[i].aceess_count == place[i].access_all)
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
                    $.get('/getinfo', {id:this.place_id}, function(inforesponse){
                        var info_add = document.getElementById('infoAdd');
                        var infoStr = '<hr/><h5><ul>';
                        inforesponse = $.parseJSON(inforesponse , true);
                        for (var i = 0; i < inforesponse.length; i++){
                            infoStr += '<li>'+inforesponse[i].comment +': '+ inforesponse[i].value+'</li>';
                        }
                        infoStr += '</ul></h5>';
                        info_add.innerHTML = infoStr;
                    });
                    // Access parameters
                    $.get('/getaccess', {id:this.place_id}, function(accessresp){
                       var info_acc = document.getElementById('infoAcc');
                        var infoStr = '<hr/><h5><ul>';
                        accessresp = $.parseJSON(accessresp , true);
                        for (var i = 0; i < accessresp.length; i++){
                            infoStr += '<li>'+accessresp[i].comment +'</li>';
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
