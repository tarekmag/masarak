<label>
    {{ __('vehicle::language.field.vehicle') }} @if ($required)
        <span class="danger">*</span>
    @endif
</label>

<select name="{{ $name }}" class="form-control select2" id="vehicle-dropdown" aria-invalid="false"
    @if ($isMultiple) multiple @endif>
    <option value="">{{ __('partials.PleaseChoose') }}</option>
    @foreach ($vehicles as $vehicle)
        <option {!! selected($vehicle['id'], $vehicleId) !!} value="{{ $vehicle['id'] }}">{{ $vehicle['name'] }}
        </option>
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

            let vehicle = $('#vehicle-dropdown');

            @if (!$showAll)
                $(document).on('change', '#driver-dropdown', function(e) {
                    e.preventDefault();
                    let id = $(this).find(":selected").val();
                    if (id == '') {
                        return;
                    }
                    $.ajax({
                        method: "GET",
                        url: '{{ route('driverVehicle.getVehicles') }}',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            driver_id: id
                        },
                        success: function(response) {
                            if (response.status == 'ok') {
                                vehicle.empty();
                                $.each(response.data, function(index, value) {
                                    let newOption = new Option(value.text, value.id,
                                        false,
                                        false);
                                    vehicle.append(newOption).trigger('change');
                                });
                            }
                        }
                    });
                });
            @endif
        });
    </script>
@endpush
