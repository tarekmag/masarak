<select name="status" class="form-control" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($status as $row)
  <option {!! selected($row, $scheduleStatus) !!} value="{{ $row }}">{{ __('route::language.field.status.'.$row) }}</option>
@endforeach

</select>

@push('js')
<script>
$(document).ready(function(){
  
});
</script>
@endpush