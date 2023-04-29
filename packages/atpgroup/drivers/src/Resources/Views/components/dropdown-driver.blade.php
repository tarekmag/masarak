<label>
    {{ __('driver::language.field.driver') }} </label>
@if ($required)
    <span class="danger">*</span>
@endif
</label>

<select name="{{ $name }}" class="form-control select2" id="driver-dropdown" aria-invalid="false">
    <option value="">{{ __('partials.PleaseChoose') }}</option>
    @foreach ($drivers as $driver)
        <option {!! selected($driver->id, $driverId) !!} value="{{ $driver->id }}">{{ $driver->name }}</option>
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

            let driver = $('#driver-dropdown');

            $(document).on('change', '#supplier-dropdown', function(e) {
                e.preventDefault();
                let id = $(this).find(":selected").val();
                if (id == '') {
                    return;
                }
                $.ajax({
                    method: "GET",
                    url: '{{ route('driver.getDrivers') }}',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        supplier_id: id
                    },
                    success: function(response) {
                        if (response.status == 'ok') {
                            driver.empty();
                            $.each(response.data, function(index, value) {
                                let newOption = new Option(value.text, value.id, false,
                                    false);
                                driver.append(newOption).trigger('change');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
