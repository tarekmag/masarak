@extends('layouts.main')
@section('title', __('menu.LiveTracking'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.LiveTracking')" :currentPageTitle="__('menu.LiveTracking')" :haveSearch="true" :linkCache="false" :haveCalendarSearch="false"
        :pagesBreadcrumb="[]" :routePageCreate="false" :routeNamePageCreate="false" dataMethodCreate="" />
@endsection

@section('content')
    <div class="content-body">
        <section id="icon-tabs">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('partials.DataResult') }}</h4>
                            <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div id="maplivetraking" style="width: 100%; height: 450px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade text-left" id="searchModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel35">{{ __('partials.SearchModel') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="GET">
                        <div class="modal-body">
                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <label for="route_id">{{ __('route::language.field.route_id') }}</label>
                                <input type="text" name="route_id" value="{{ request()->route_id }}"
                                    class="form-control">
                            </fieldset>
                            <br>
                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <x-route-dropdown-trip :tripIds="request()->ids" :required="false"
                                    :statuss=[App\Enums\RouteType::TRIP_STATUS_STARTED] :selected="request()->ids" name="ids[]" />
                            </fieldset>
                            <br>
                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <x-company-dropdown-company :companyId="request()->company_id" :required="false" name="company_id" />
                            </fieldset>
                            <br>
                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <x-company-dropdown-branch :companyId="request()->company_id" :branchId="request()->branch_id" :required="false"
                                    name="branch_id" />
                            </fieldset>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-outline-blue btn-sm" value="{{ __('partials.Search') }}">
                            <input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"
                                value="{{ __('partials.Close') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('map/leaflet.css') }}">
@endpush

@push('js')
    <script src="{{ asset('map/leaflet.js') }}"></script>
    <script type="text/javascript" src="{{ asset('map/animated-marker.js') }}"></script>
    <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
    <script>
        var trips = $.parseJSON('<?= json_encode($trips) ?>');
        var map;
        var zoom = 6;
        var markers = {};
        var polylines = {};
        var company_id = "{{ $company_id }}";

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

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
            if (company_id != item.company_id) {
                return;
            }
            let text = 'Station Name AR: ' + item.stations_coordinates.station_name_ar + '<br> Station Name EN: ' +
                item.stations_coordinates.station_name_en + '<br>Station Arrival Time AT: ' + item
                .stations_coordinates.station_arrival_time;
            addStationMarker(item.lat, item.lng, text);
        });

        const channelRouting = pusher.subscribe('private-routing-trip');
        channelRouting.bind('client-event-tracking-trip', function(data) {
            data = JSON.stringify(data);
            item = jQuery.parseJSON(data);
            if (company_id != item.data.company_id) {
                return;
            }
            setPolylines([{
                'id': item.data.trip_id,
                'lat': item.data.lat,
                'long': item.data.long
            }]);

            addPolyline(polylines[item.data.trip_id]);

            moveCurrentMarkers([{
                'id': item.data.trip_id,
                'lat': item.data.lat,
                'long': item.data.long,
                'route_from_name_en': item.data.route_from_name_en,
                'route_from_name_ar': item.data.route_from_name_ar,
                'route_to_name_en': item.data.route_to_name_en,
                'route_to_name_ar': item.data.route_to_name_ar,
                'driver_name': item.data.driver_name,
                'driver_phone': item.data.driver_phone,
                'plate_number': item.data.plate_number,
            }]);
        });

        channelRouting.bind('event-tracking-trip', function(data) {
            data = JSON.stringify(data);
            item = jQuery.parseJSON(data);
            if (company_id != item.data.company_id) {
                return;
            }
            setPolylines([{
                'id': item.data.trip_id,
                'lat': item.data.lat,
                'long': item.data.long
            }]);

            addPolyline(polylines[item.data.trip_id]);

            moveCurrentMarkers([{
                'id': item.data.trip_id,
                'lat': item.data.lat,
                'long': item.data.long,
                'route_from_name_en': item.data.route_from_name_en,
                'route_from_name_ar': item.data.route_from_name_ar,
                'route_to_name_en': item.data.route_to_name_en,
                'route_to_name_ar': item.data.route_to_name_ar,
                'driver_name': item.data.driver_name,
                'driver_phone': item.data.driver_phone,
                'plate_number': item.data.plate_number,
            }]);
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

        trips.forEach(function(value) {
            /*
             * Add routes to map
             */
            value.route_coordinates.forEach(function(lngLat, index) {
                if (lngLat[0] && lngLat[1]) {
                    setPolylines([{
                        'id': value.trip_id,
                        'lat': lngLat[0],
                        'long': lngLat[1]
                    }]);

                    if (index === value.route_coordinates.length - 1) {
                        let text = 'Route From Name EN: ' + value.route_from_name_en +
                            '<br> Route From Name AR: ' + value.route_from_name_ar +
                            '<br> Route To Name EN: ' + value.route_to_name_en +
                            '<br> Route To Name AR: ' + value.route_to_name_ar +
                            '<br> Driver Name: ' + value.driver_name +
                            '<br> Driver Phone: ' + value.driver_phone +
                            '<br> Plate Number: ' + value.plate_number;
                        addLiveMarker(value.trip_id, [lngLat[0], lngLat[1]], text);
                    }
                }
            });
            addPolyline(polylines[value.trip_id]);

            /*
             * Each on stations to add markers
             */
            value.stations_coordinates.forEach(function(station, index) {
                let text = 'Station Name AR: ' + station.station_name_ar + '<br> Station Name EN: ' +
                    station.station_name_en + '<br>Station Arrival Time AT: ' + station
                    .station_arrival_time;
                if (index === 0) {
                    addStationMarker(station.latlng[0], station.latlng[1], text, 'green');
                } else {
                    addStationMarker(station.latlng[0], station.latlng[1], text);
                }
            });
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
                icon: iconUrl,
                title: 'Station Point',
            }).bindPopup(text).addTo(map);
        }

        /*
         * Add Live marker
         */
        function addLiveMarker(trip_id, latlng, text = null) {
            let iconUrl = L.divIcon({
                html: '<img src="{{ asset('map/live-icon-2.png') }}" />',
                iconSize: [64, 122],
                className: 'myDivIcon'
            });

            return L.animatedMarker(polylines[trip_id], {
                icon: iconUrl,
                title: 'Current Point',
            }).bindPopup(text).addTo(map);

            // return L.marker(latlng, {
            //     icon: iconUrl,
            //     title: 'Current Point',
            // }).bindPopup('Current Point').addTo(map);
        }

        /*
         * Add polyline
         */
        function addPolyline(latlng) {
            if (latlng != undefined) {

                // map.removeLayer(latlng);

                return new L.Polyline(latlng, {
                    color: '#063d9c',
                    weight: 3,
                    opacity: 0.5,
                    smoothFactor: 1
                }).addTo(map);
            }
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
                     let text = 'Route From Name EN: ' + obj.route_from_name_en +
                            '<br> Route From Name AR: ' + obj.route_from_name_ar +
                            '<br> Route To Name EN: ' + obj.route_to_name_en +
                            '<br> Route To Name AR: ' + obj.route_to_name_ar +
                            '<br> Driver Name: ' + obj.driver_name +
                            '<br> Driver Phone: ' + obj.driver_phone +
                            '<br> Plate Number: ' + obj.plate_number;

                    // Create it, and add it to the map, store into markers object
                    markers[obj.id] = addLiveMarker(obj.id, [obj.lat, obj.long], text);

                    // Add array to the marker instance to store the previous latlngs
                    markers[obj.id].previousLatLngs = [];
                } else {
                    // There is already a marker with that id in the markers object

                    // Store the previous latlng
                    markers[obj.id].previousLatLngs.push(markers[obj.id].getLatLng());

                    // Remove previous marker
                    // map.removeLayer(markers[obj.id]);

                    // Set new latlng on marker
                    markers[obj.id].setLatLng([obj.lat, obj.long]);
                }
            });
        }

        /*
         * Function for set Polylines to each trip
         */
        function setPolylines(data) {
            data.forEach(function(obj) {
                if (!polylines.hasOwnProperty(obj.id)) {
                    polylines[obj.id] = [new L.LatLng(obj.lat, obj.long)];
                } else {
                    polylines[obj.id].push(new L.LatLng(obj.lat, obj.long));
                }
            });
        }
    </script>
@endpush
