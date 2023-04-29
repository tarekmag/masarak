<label>{{ __('emergency::language.field.emergency') }} </label> @if ($required) <span class="danger">*</span> @endif</label>

<select name="emergency_id" class="form-control select2" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($emergencies as $emergency)
  <option {!! selected($emergency->id, $emergencyId) !!} value="{{ $emergency->id }}">{{ $emergency->name }}</option>
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