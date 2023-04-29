<label>
    {{ __('supplier::language.field.supplier') }} @if ($required)
        <span class="danger">*</span>
    @endif
</label>

<select name="supplier_id" class="form-control select2" id="supplier-dropdown" aria-invalid="false">
    <option value="">{{ __('partials.PleaseChoose') }}</option>
    @foreach ($suppliers as $supplier)
        <option {!! selected($supplier->id, $supplierId) !!} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
        });
    </script>
@endpush
