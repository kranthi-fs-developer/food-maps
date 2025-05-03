<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Route Map</title>
    <!-- Leaflet.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet.js JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine -->
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
        .leaflet-right{
            display:none;
        }
       /*  .leaflet-marker-icon {
        display: none !important;
        } */

        .leaflet-marker-icon[src*="marker-icon-2x.png"] {
            display: none !important;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script>
        // Predefined locations
        const destination1 = [17.3982445, 78.4722674]; // Location 1
        const destination2 = [17.3688, 78.5250];       // Location 2

        // Initialize the map
        const map = L.map('map').setView(destination1, 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Get Rider's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const riderLocation = [position.coords.latitude, position.coords.longitude];

                    // Add routing control
                    L.Routing.control({
                        waypoints: [
                            L.latLng(riderLocation),     // Rider's location
                            L.latLng(destination1),    // Destination 1
                            L.latLng(destination2)     // Destination 2
                        ],
                        routeWhileDragging: true,
                        createMarker: (i, waypoint) => {
                            const labels = ['Your Location', 'Destination 1', 'Destination 2'];
                            return L.marker(waypoint.latLng).bindPopup(labels[i]);
                        }
                    }).addTo(map);
                },
                () => {
                    alert("Geolocation failed. Please enable location access.");
                }
            );
        } else {
            alert("Your browser doesn't support geolocation.");
        }

        
        /* const riderIcon = L.icon({
            iconUrl: 'https://i.postimg.cc/8C5rth6h/motorbike.png',
            iconSize: [40, 40], // width and height of the icon
            iconAnchor: [20, 40], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -40] // point from which the popup should open relative to the iconAnchor
        });

        L.marker(riderLocation, { icon: riderIcon }).addTo(map).bindPopup("Rider"); */

        const restaurantIcon = L.icon({
            iconUrl: 'https://i.postimg.cc/Vk4Cq7df/salad.png',
            iconSize: [40, 40], // width and height of the icon
            iconAnchor: [20, 40], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -40] // point from which the popup should open relative to the iconAnchor
        });

        L.marker(destination1, { icon: restaurantIcon }).addTo(map).bindPopup("Restaurant");

        const customerIcon = L.icon({
            iconUrl: 'https://i.postimg.cc/W1sZJRpY/boy.png',
            iconSize: [40, 40], // width and height of the icon
            iconAnchor: [20, 40], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -40] // point from which the popup should open relative to the iconAnchor
        });

        L.marker(destination2, { icon: customerIcon }).addTo(map).bindPopup("Customer");

        /* -------------------- */

    </script>
</body>
</html>

