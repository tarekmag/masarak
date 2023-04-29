<div id="mapstatic" style="width: {{ $width }}; height: {{ $height }};"></div>

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
  map = L.map('mapstatic').setView({lon: lng, lat: lat}, zoom);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  /*
  * Add Existed Marker
  */
  if(lat && lng)
  {
    marker = L.marker({lon: lng, lat: lat}, { icon: icon }).bindPopup('The center of the world').addTo(map);
  }
</script>
@endpush
