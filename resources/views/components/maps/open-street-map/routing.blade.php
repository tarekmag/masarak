<div id="maprouting" style="width: {{ $width }}; height: {{ $height }};"></div>

@push('css')
    <link rel="stylesheet" href="{{ asset('map/leaflet.css') }}">
@endpush

@push('js')
    <script src="{{ asset('map/leaflet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('map/animated-marker.js') }}"></script>
    <script>
        var coordinates = $.parseJSON("{{ $coordinates }}");
        var stations = $.parseJSON('<?= $stations; ?>');
        var zoom = "{{ $zoom }}";
        var map;
        var polyline;

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
        stations.forEach(function(station, index) {
            let text = 'Station Name AR: '+station.station_name_ar +'<br> Station Name EN: '+station.station_name_en +'<br>Station Arrival Time AT: '+station.station_arrival_time;
            addStationMarker(station.latlng[0], station.latlng[1], text);
        });

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
                draggable: false,
                icon: iconUrl,
                title: 'Station Point',
            }).bindPopup(text).addTo(map);
        }

        /*
         * Add polyline
         */
        polyline = L.polyline(coordinates, {
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

        L.animatedMarker(coordinates, {
            icon: iconUrl,
            title: 'Current Point',
        }).bindPopup('Current Point').addTo(map);
    </script>
@endpush
