<label>{{ __('driver::language.field.type') }} @if($required) <span class="danger">*</span> @endif</label>

<select name="type" class="form-control select2" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($types as $type)
  <option {!! selected($type, $driverType) !!} value="{{ $type }}">{{ $type }}</option>
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