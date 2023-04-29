<label>
    {{ __('route::language.field.trips') }} @if ($required)
        <span class="danger">*</span>
    @endif
</label>

<select name="{{ $name }}" class="form-control select2" id="trip-dropdown" aria-invalid="false" multiple>
    @foreach ($trips as $trip)
        <option {!! selected($trip->_id, $selected) !!} value="{{ $trip->_id }}">{{ $trip->route_name.'-'.$trip->trip_time->format(config('helpers.timeFormat'))}}</option>
    @endforeach

</select>

@push('js')
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                placeholder: "{{ __('partials.PleaseChoose') }}",
                allowClear: true,
                width: '100%'
            });

            let trip = $('#trip-dropdown');

            $(document).on('change', '#route-dropdown', function(e) {
                e.preventDefault();
                trip.empty();
                let id = $(this).find(":selected").val();
                if (id == '') {
                    return;
                }
                $.ajax({
                    method: "GET",
                    url: '{{ route('trips.getTrips') }}',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        route_id: id,
                        status: "{{ App\Enums\RouteType::TRIP_STATUS_STARTED }}"
                    },
                    success: function(response) {
                        if (response.status == 'ok') {
                            $.each(response.data, function(index, value) {
                                let newOption = new Option(value.text, value.id, false,
                                    false);
                                trip.append(newOption).trigger('change');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
