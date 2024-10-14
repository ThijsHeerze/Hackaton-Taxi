<!DOCTYPE html>
<html>
<head>
    <title>Volg Route</title>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Volg de gereden en te rijden route</h1>
    <div id="map"></div>

    <script>
        let map, directionsService, directionsRenderer;
        let startLocation = { lat: 52.3676, lng: 4.9041 }; // Amsterdam als startlocatie
        let endLocation = { lat: 51.9225, lng: 4.47917 };  // Rotterdam als eindlocatie
        let currentPositionMarker;

        function initMap() {
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();

            // Maak de kaart aan in het 'map'-element
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: startLocation
            });

            directionsRenderer.setMap(map);

            // Start route tekenen
            calculateAndDisplayRoute();

            // Zet een marker op de huidige positie van de taxi
            navigator.geolocation.getCurrentPosition(function(position) {
                let pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                currentPositionMarker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: "Huidige Locatie"
                });

                map.setCenter(pos);
            });

            // Update de huidige positie elke 10 seconden
            setInterval(updateCurrentLocation, 10000);
        }

        function calculateAndDisplayRoute() {
            directionsService.route(
                {
                    origin: startLocation,
                    destination: endLocation,
                    travelMode: google.maps.TravelMode.DRIVING
                },
                function(response, status) {
                    if (status === "OK") {
                        directionsRenderer.setDirections(response);
                    } else {
                        window.alert("Kan route niet laden: " + status);
                    }
                }
            );
        }

        function updateCurrentLocation() {
            navigator.geolocation.getCurrentPosition(function(position) {
                let pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Verplaats de marker naar de nieuwe locatie
                currentPositionMarker.setPosition(pos);
                map.setCenter(pos);
            });
        }

        // Initialiseer de kaart wanneer de pagina laadt
        window.onload = initMap;
    </script>
</body>
</html>
