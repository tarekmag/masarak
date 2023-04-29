<div id="maprouting" style="width: 100%; height: 450px;"></div>

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
         * Add Routing
         */
        L.Routing.control({
            waypoints: stations,
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
                if (i === 0) {
                    let iconUrl = L.divIcon({
                        html: '<i class="fa fa-map-marker fa-3x" style="color:green"></i>',
                        iconSize: [64, 122],
                        className: 'myDivIcon'
                    });
                    return L.marker(wp.latLng, {
                        draggable: false,
                        icon: iconUrl,
                        title: 'Start Point',
                    }).bindPopup('Start Point');
                } else {
                  let iconUrl = L.divIcon({
                        html: '<i class="fa fa-map-marker fa-3x"></i>',
                        iconSize: [64, 122],
                        className: 'myDivIcon'
                    });
                    return L.marker(wp.latLng, {
                        icon: iconUrl,
                        title: 'End Point',
                    }).bindPopup('End Point');
                }
            }
        }).addTo(map);
    </script>
@endpush
