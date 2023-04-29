<div id="mapmarker" style="width: {{ $width }}; height: {{ $height }};"></div>

@push('css')
  <link rel="stylesheet" href="{{ asset('map/leaflet.css') }}">
@endpush

@push('js')
<script src="{{ asset('map/leaflet.js') }}"></script>
<script>
  var lat = "{{ $lat }}";
  var lng = "{{ $lng }}";
  var zoom = "{{ $zoom }}";
  var icon = L.divIcon({
      html: '<i class="fa fa-map-marker fa-3x"></i>',
      iconSize: [64, 122],
      className: 'myDivIcon'
    });
  var map;
  var marker;

  /*
  * Initialize map with leaflet layer with openstreetmap
  */
  if(lat && lng)
  {
    map = L.map('mapmarker').setView({lon: lng, lat: lat}, zoom);
  }
  else
  {
    map = L.map('mapmarker').setView({lon: 26.8206, lat: 30.8025}, 6);
  }

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  /*
  * Add Existed Marker
  */
  if(lat && lng)
  {
    marker = L.marker({lon: lng, lat: lat}, { icon: icon, draggable: true }).bindPopup('The center of the world').addTo(map).on('dragend', addMarkerAndDrag);
  }

  /*
  * Event click on map to create new Marker
  */
  map.on('click', onMapClick);

  /*
  * Add and drag marker
  */
  function onMapClick(e)
  {
    if (marker) // check
    {
      map.removeLayer(marker); // remove
    }

    marker = new L.marker(e.latlng, {icon: icon, draggable:'true'}); // to add new marker

    marker.on('dragend', addMarkerAndDrag); // to drag the marker
    saveToInputs(e.latlng.lat, e.latlng.lng);
    map.addLayer(marker);
  }

  /*
  * Add Marker And Drag
  */
  function addMarkerAndDrag(e)
  {
    var marker = e.target;
    var position = marker.getLatLng();
    saveToInputs(position.lat, position.lng);
    marker.setLatLng(position, {icon: icon, draggable:'true'}).bindPopup('The center of the world').update();
  }

  /*
  * Save the values to inputs
  */
  function saveToInputs(lat, lng)
  {
    $("#input-map-lat").val(lat);
    $("#input-map-lng").val(lng);
  }
</script>
@endpush

<input type="hidden" name="map-lat" id="input-map-lat" />
<input type="hidden" name="map-lng" id="input-map-lng" />
