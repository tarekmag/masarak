<label>{{ __('vehicle::language.field.type') }} @if ($required) <span class="danger">*</span> @endif</label>

<select name="type" class="form-control select2" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($types as $documentType)
  <option {!! selected($documentType, $type) !!} value="{{ $documentType }}">{{ __('vehicle::language.field.documentType.'.$documentType) }}</option>
@endforeach

</select>

@push('js')
<script>
$(document).ready(function(){
    $(".select2").select2({
      placeholder: "{{__('partials.PleaseChoose')}}",
      allowClear: true,
      width:'100%'
    });
});
</script>
@endpush