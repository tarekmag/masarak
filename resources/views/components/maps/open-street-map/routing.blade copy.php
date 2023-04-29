<div id="maprouting" style="width: {{ $width }}; height: {{ $height }};"></div>

@push('css')
<link rel="stylesheet" href="{{ asset('map/leaflet.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" />
@endpush

@push('js')
<script src="{{ asset('map/leaflet.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>
<script type="text/javascript" src="{{ asset('map/animated-marker.js') }}"></script>
<script>
    var lat = 0;
    var lng = 0;
    var coordinates = $.parseJSON("{{ $coordinates }}");
    var stations = $.parseJSON('<?= $stations; ?>');
    var zoom = "{{ $zoom }}";
    var map;
    var polyline;

    /*
     * Initialize map with leaflet layer with openstreetmap
     */
    map = L.map('maprouting').setView({
        lon: lng,
        lat: lat
    }, zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    /*
     * Each on stations to add markers
     */
    stations.forEach(function(station, index) {
        let text = 'Station Name AR: ' + station.station_name_ar + '<br> Station Name EN: ' + station.station_name_en + '<br>Station Arrival Time AT: ' + station.station_arrival_time;
        if (index === 0) {
            addStationMarker(station.latlng[0], station.latlng[1], 'green');
        } else if (index === stations.length - 1) {
            addStationMarker(station.latlng[0], station.latlng[1], 'red');
        } else {
            addStationMarker(station.latlng[0], station.latlng[1]);
        }
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
     * Add Routing
     */
    L.Routing.control({
        waypoints: coordinates,
        routeWhileDragging: true,
        lineOptions: {
            styles: [{
                // color: 'green',
                opacity: 1,
                weight: 5,
                className: 'animate'
            }]
        },
        createMarker: function(i, wp, nWps) {
            return null;
        }
    }).addTo(map);

    let iconUrl = L.divIcon({
        html: '<img src="{{ asset('
        map / live - icon - 2. png ') }}" />',
        iconSize: [64, 122],
        className: 'myDivIcon'
    });

    L.animatedMarker(coordinates, {
        icon: iconUrl,
        title: 'Current Point',
    }).bindPopup('Current Here').addTo(map);
</script>
@endpush
