/* global google */

function initMap() {
    if (!$('#map').length) {
        return false;
    }

    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        disableDefaultUI: true,
        scrollwheel: false,
        zoom: 15,
        center: new google.maps.LatLng(44.815998, 20.465719, 14.5),
        styles: [{"featureType": "landscape", "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]}, {"featureType": "poi", "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]}, {"featureType": "road.highway", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "road.arterial", "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]}, {"featureType": "road.local", "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]}, {"featureType": "transit", "stylers": [{"saturation": -100}, {"visibility": "simplified"}]}, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {"featureType": "water", "elementType": "labels", "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]}, {"featureType": "water", "elementType": "geometry", "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]}]
    };

    // Get the HTML DOM element that will contain your map
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');

    // Create the Google Map using our element and options defined above
    var map = new google.maps.Map(mapElement, mapOptions);

    var image = {
        url: '/np-assets/images/map-marker.png',
        size: new google.maps.Size(40, 52),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32)
    };

    var icon_kalemegdan = {
        url: '/np-assets/images/map_kalemegdan.png',
        size: new google.maps.Size(64, 64),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32)
    };

    var icon_skupstina = {
        url: '/np-assets/images/map_narodna_skupstina.png',
        size: new google.maps.Size(64, 64),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32)
    };

    var icon_skadarlija = {
        url: '/np-assets/images/map_skadarlija.png',
        size: new google.maps.Size(64, 64),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32)
    };

    var icon_trg_republike = {
        url: '/np-assets/images/map_trg_republike.png',
        size: new google.maps.Size(64, 64),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 32)
    };

    new google.maps.Marker({
        position: new google.maps.LatLng(44.8159812, 20.4658227),
        map: map, icon: image
    });

    new google.maps.Marker({
        position: new google.maps.LatLng(44.823719, 20.450449,17),
        map: map, icon: icon_kalemegdan
    });

    new google.maps.Marker({
        position: new google.maps.LatLng(44.8117368, 20.4637729,17),
        map: map, icon: icon_skupstina
    });

    new google.maps.Marker({
        position: new google.maps.LatLng(44.8181902, 20.4635033,18),
        map: map, icon: icon_skadarlija
    });

    new google.maps.Marker({
        position: new google.maps.LatLng(44.8162086, 20.4579621,17),
        map: map, icon: icon_trg_republike
    });
}