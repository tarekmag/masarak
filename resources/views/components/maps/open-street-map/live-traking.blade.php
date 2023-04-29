<div id="maplivetraking" style="width: {{ $width }}; height: {{ $height }};"></div>

@push('css')
    <link rel="stylesheet" href="{{ asset('map/leaflet.css') }}">
@endpush

@push('js')
    <script src="{{ asset('map/leaflet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('map/animated-marker.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var polylines = $.parseJSON("{{ $coordinates }}");
        var stations = $.parseJSON('<?= $stations; ?>');
        var zoom = "{{ $zoom }}";
        var trip_id = "{{ $tripId }}";
        var map;
        var markers = {};

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: 'eu',
            authEndpoint: '/pusher/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            }
        });

        const channelStation = pusher.subscribe('channel-station-trip');
        channelStation.bind('event-tracking-trip', function(data) {
            data = JSON.stringify(data);
            item = jQuery.parseJSON(data);
            let text = 'Station Name AR: '+item.stations_coordinates.station_name_ar +'<br> Station Name EN: '+item.stations_coordinates.station_name_en +'<br>Station Arrival Time AT: '+item.stations_coordinates.station_arrival_time;
            if (trip_id == item.trip_id) {
                addStationMarker(item.lat, item.lng, text);
            }
        });

        const channelRouting = pusher.subscribe('private-routing-trip');
        channelRouting.bind('client-event-tracking-trip', function(data) {
            data = JSON.stringify(data);
            item = jQuery.parseJSON(data);
            if (trip_id == item.data.trip_id) {
                setPolylines([
                    item.data.lat,
                    item.data.long
                ]);
                addPolyline(polylines);
                moveCurrentMarkers([{
                    'id': item.data.trip_id,
                    'lat': item.data.lat,
                    'long': item.data.long
                }]);
            }
        });

        /*
         * Initialize map with leaflet layer with openstreetmap
         */
        const center = new L.LatLng(26.8206, 30.8025);

        map = L.map('maplivetraking', {
            center: center,
            zoom: zoom,
            worldCopyJump: true,
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /*
         * Each on stations to add markers
         */
        stations.forEach(function(station, index) {
            let text = 'Station Name AR: ' + station.station_name_ar + '<br> Station Name EN: ' + station.station_name_en + '<br>Station Arrival Time AT: ' + station.station_arrival_time;
            if (index === 0) {
                addStationMarker(station.latlng[0], station.latlng[1], text, 'green');
            } else {
                addStationMarker(station.latlng[0], station.latlng[1], text);
            }
        });

        /*
         * Add routes to map
         */
        addPolyline(polylines);
        if (polylines.at(-1)[0] && polylines.at(-1)[1]) {
            moveCurrentMarkers([{
                'id': trip_id,
                'lat': polylines.at(-1)[0],
                'long': polylines.at(-1)[1]
            }]);
        }

        /*
         * Add Station marker
         */
        function addStationMarker(lat, lng, text, color = null) {
            if (color) {
                icon = '<i class="fa fa-map-marker fa-3x" style="color:' + color + '"></i>';
            } else {
                icon = '<i class="fa fa-map-marker fa-3x"></i>';
            }
            let iconUrl = L.divIcon({
                html: icon,
                iconSize: [64, 122],
                className: 'myDivIcon'
            });

            return L.marker([lat, lng], {
                icon: iconUrl,
                title: 'Station Point',
            }).bindPopup(text).addTo(map);
        }

        /*
         * Add Live marker
         */
        function addLiveMarker() {
            let iconUrl = L.divIcon({
                html: '<img src="{{ asset('map/live-icon-2.png') }}" />',
                iconSize: [64, 122],
                className: 'myDivIcon'
            });

            return L.animatedMarker(polylines, {
                icon: iconUrl,
                title: 'Current Point',
            }).bindPopup('Current Point').addTo(map);
        }

        /*
         * Add polyline
         */
        function addPolyline(latlng) {
            return new L.Polyline(latlng, {
                color: '#063d9c',
                weight: 3,
                opacity: 0.5,
                smoothFactor: 1
            }).addTo(map)
        }

        /*
         * Function for Move Current Markers
         */
        function moveCurrentMarkers(data) {
            // Loop over the array and handle each object
            data.forEach(function(obj) {
                // Check if there is already a marker with that id in the markers object
                if (!markers.hasOwnProperty(obj.id)) {
                    // No marker with that id found in the markers object

                    // Create it, and add it to the map, store into markers object
                    markers[obj.id] = addLiveMarker();

                    // Add array to the marker instance to store the previous latlngs
                    markers[obj.id].previousLatLngs = [];

                } else {
                    // There is already a marker with that id in the markers object

                    // Store the previous latlng
                    markers[obj.id].previousLatLngs.push(markers[obj.id].getLatLng());

                    // Remove previous marker
                    map.removeLayer(markers[obj.id]);

                    // Set new latlng on marker
                    markers[obj.id].setLatLng([obj.lat, obj.long]);
                }
            });
        }

        /*
         * Function for set Polylines to each trip
         */
        function setPolylines(latlng) {
            polylines.push(latlng);
        }
    </script>
@endpush
