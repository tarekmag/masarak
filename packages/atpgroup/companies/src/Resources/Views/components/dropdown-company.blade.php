<label>{{ __('company::language.field.company') }} @if($required) <span class="danger">*</span> @endif</label>

<select name="{{ $name }}" class="form-control select2" id="company-dropdown" aria-invalid="false">
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($companies as $company)
  <option {!! selected($company->id, $companyId) !!} value="{{ $company->id }}">{{ $company->name }}</option>
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