<div id="maprouting" style="width: 100%; height: 450px;"></div>

@push('css')
    <link rel="stylesheet" href="{{ asset('map/leaflet.css') }}">
@endpush

@push('js')
    <script src="{{ asset('map/leaflet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('map/animated-marker.js') }}"></script>
    <script>
        var lat = 0;
        var lng = 0;
        var stations = $.parseJSON("{{ json_encode($stations) }}");
        var zoom = 10;
        var map;

        /*
         * Initialize map with leaflet layer with openstreetmap
         */
        const center = new L.LatLng(26.8206, 30.8025);
        map = L.map('maprouting', {
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
        stations.forEach(function(lngLat, index) {
            if (index === 0) {
                addStationMarker(lngLat[0], lngLat[1], 'green');
            } else if (index === stations.length - 1) {
                addStationMarker(lngLat[0], lngLat[1], 'red');
            } else {
                addStationMarker(lngLat[0], lngLat[1]);
            }
        });

        /*
         * Add Station marker
         */
        function addStationMarker(lat, lng, color = null) {
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
            }).bindPopup('Station Here').addTo(map);
        }

        /*
         * Add polyline
         */
        polyline = L.polyline(stations, {
            color: '#063d9c',
            weight: 5,
            opacity: 0.5,
            smoothFactor: 1
        }).addTo(map);

        map.fitBounds(polyline.getBounds());

        let iconUrl = L.divIcon({
            html: '<img src="{{ asset('map/live-icon-2.png') }}" />',
            iconSize: [64, 122],
            className: 'myDivIcon'
        });

        L.animatedMarker(stations, {
            icon: iconUrl,
            title: 'Current Point',
        }).bindPopup('Current Here').addTo(map);
    </script>
@endpush
