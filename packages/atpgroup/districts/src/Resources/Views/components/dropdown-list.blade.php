<label>{{ __('district::language.field.district') }} @if($required) <span class="danger">*</span> @endif</label>

<select name="district_id" class="form-control select2" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($districts as $district)
  <option {!! selected($district->id, $districtId) !!} value="{{ $district->id }}">{{ $district->name }}</option>
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