window.Vue = require('vue');

var map;
window.initMap = function () {
    map = new google.maps.Map(document.getElementById('js-main-map'), {
        center: {lat: 48.5050277987034, lng: 32.2593695292334},
        zoom: 15
    });
}

//todo: put this to localstorage
var checkedCategories = [1, 2, 3, 4, 5];
var checkedAccessibilities = [1, 2, 3, 4, 5];
var places = [];
var mapMarkers = [];
var filterForm = new Vue({
    el: '#oc-filter-form',
    data: {
        checkedCategories: checkedCategories,
        checkedAccessibilities: checkedAccessibilities,
        places: places
    },
    methods: {
        drawPlaces: function () {
            for (var i in filterForm.places) {
                //todo: cool markers with titles and info
                var marker = new google.maps.Marker({
                    position: {lat: +filterForm.places[i]['map_lat'], lng: +filterForm.places[i]['map_lng']},
                    title:"Hello World!"
                });
                marker.setMap(map);
                mapMarkers.push(marker);
            }
        },
        clearPlaces: function () {
            for (var i in mapMarkers) {
                mapMarkers[i].setMap(null);
            }
        },
        getPlaces: function () {
            //todo: delete thi copypasta
            if (checkedCategories.length < 0) {
                return;
            }
            var checkedCategoriesList = this.checkedCategories.join(',');
            var checkedAccessibilitiesList = this.checkedAccessibilities.join(',');

            axios.get(`/api/v1/filter?categories=${checkedCategoriesList}&accessibility=${checkedAccessibilitiesList}`)
                .then(function (res) {
                    filterForm.places = res.data.places;
                })
                .catch(function (err) {
                    console.log(err);
                });
        }
    },
    watch: {
        checkedCategories: function () {
            filterForm.getPlaces();
        },
        checkedAccessibilities: function () {
            filterForm.getPlaces();
        },
        places: function () {
            filterForm.clearPlaces();
            filterForm.drawPlaces();
        }
    },
    computed: {
    },
    mounted: function () {
        // `this` points to the vm instance
    },
    created: function () {
        //created
    },
    beforeCreate: function () {
        if (checkedCategories.length < 0) {
            console.log('No categories checked');
            return;
        }
        var checkedCategoriesList = checkedCategories.join(',');
        var checkedAccessibilitiesList = checkedAccessibilities.join(',');

        axios.get(`/api/v1/filter?categories=${checkedCategoriesList}&accessibility=${checkedAccessibilitiesList}`)
            .then(function (res) {
                filterForm.places = res.data.data.places;
            })
            .catch(function (err) {
                console.log(err);
            });
    }
});

