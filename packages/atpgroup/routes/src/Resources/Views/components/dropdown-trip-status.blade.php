<label>{{ __('route::language.field.'.$name) }} @if($required) <span class="danger">*</span> @endif</label>

<select name="{{ $name }}" class="form-control select2" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($statuss as $status)
  <option {!! selected($status, $tripStatus) !!} value="{{ $status }}">{{ __('route::language.field.trip.status.'.$status) }}</option>
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