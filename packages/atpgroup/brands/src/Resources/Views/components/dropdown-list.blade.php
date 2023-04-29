<label>{{ __('brand::language.field.brand') }} @if($required) <span class="danger">*</span> @endif</label>

<select name="brand_id" class="form-control select2" id="brand-dropdown" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($brands as $brand)
  <option {!! selected($brand->id, $brandId) !!} value="{{ $brand->id }}">{{ $brand->name }}</option>
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