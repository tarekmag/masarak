<label>
    {{ __('company::language.field.branch') }} @if ($required)
        <span class="danger">*</span>
    @endif
</label>

<select name="{{ $name }}" class="form-control select2" id="branch-dropdown" aria-invalid="false">
    <option value="">{{ __('partials.PleaseChoose') }}</option>
    @foreach ($companies as $company)
        <option {!! selected($company->id, $branchId) !!} value="{{ $company->id }}">{{ $company->name }}</option>
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

            let branch = $('#branch-dropdown');

            $(document).on('change', '#company-dropdown', function(e) {
                e.preventDefault();
                branch.empty();
                let id = $(this).find(":selected").val();
                if(id == '')
                {
                    return;
                }
                $.ajax({
                    method: "GET",
                    url: '{{ route('branch.getBranches') }}',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        company_id: id
                    },
                    success: function(response) {
                        if (response.status == 'ok') {
                            $.each(response.data, function(index, value) {
                                let newOption = new Option(value.text, value.id, false,
                                    false);
                                branch.append(newOption).trigger('change');
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
