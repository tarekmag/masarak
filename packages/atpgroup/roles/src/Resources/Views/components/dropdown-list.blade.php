<label>
    {{ __('menu.Roles') }}
    <span class="danger">*</span>
</label>
<select name="role_id" class="form-control select2" aria-invalid="false" required>
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($roles as $role)
  <option {!! selected($role->id, $roleId) !!} value="{{ $role->id }}">{{ $role->name }}</option>
@endforeach

</select>

@push('js')
<script>
$(document).ready(function(){
    $(".select2").select2({
      placeholder: "{{__('partials.PleaseChoose')}}",
      allowClear: true
    });
});
</script>
@endpush