<label>{{ __('vehicle::language.field.status') }} @if ($required) <span class="danger">*</span> @endif</label>

<select name="status" class="form-control select2" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($statuses as $row)
  <option {!! selected($row, $status) !!} value="{{ $row }}">{{ __('vehicle::language.field.documentStatus.'.$row) }}</option>
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