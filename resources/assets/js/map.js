var map;
window.initMap = function () {
    map = new google.maps.Map(document.getElementById('js-main-map'), {
        center: {lat: 48.5050277987034, lng: 32.2593695292334},
        zoom: 15
    });
}