<label>{{ __('station::language.field.station') }} @if($required) <span class="danger">*</span> @endif</label>

<select name="station_id" class="form-control select2" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($stations as $station)
  <option {!! selected($station->id, $stationId) !!} value="{{ $station->id }}">{{ $station->name }}</option>
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