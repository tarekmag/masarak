<label>
    {{ __('brandModel::language.field.brandModel') }} @if ($required)
        <span class="danger">*</span>
    @endif
</label>

<select name="{{ $name }}" class="form-control select2" id="brandModel-dropdown" aria-invalid="false">
    <option value="">{{ __('partials.PleaseChoose') }}</option>
    @foreach ($brandModels as $brandModel)
        <option {!! selected($brandModel->id, $brandModelId) !!} value="{{ $brandModel->id }}">{{ $brandModel->name }}</option>
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

            let brandModel = $('#brandModel-dropdown');

            $(document).on('change', '#brand-dropdown', function(e) {
                e.preventDefault();
                brandModel.empty();
                let id = $(this).find(":selected").val();
                if (id == '') {
                    return;
                }
                $.ajax({
                    method: "GET",
                    url: '{{ route('brandModel.getBrandModels') }}',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        brand_id: id
                    },
                    success: function(response) {
                        if (response.status == 'ok') {

                            $.each(response.data, function(index, value) {
                                let newOption = new Option(value.text, value.id, false,
                                    false);
                                brandModel.append(newOption).trigger('change');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
