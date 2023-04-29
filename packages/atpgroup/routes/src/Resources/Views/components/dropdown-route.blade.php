<label>{{ __('route::language.field.route') }} @if($required) <span class="danger">*</span> @endif</label>

<select name="{{ $name }}" class="form-control select2" id="route-dropdown" aria-invalid="false" >
<option value="">{{ __('partials.PleaseChoose') }}</option>
@foreach ($routes as $route)
  <option {!! selected($route->id, $routeId) !!} value="{{ $route->id }}">{{ $route->route_name }}</option>
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
