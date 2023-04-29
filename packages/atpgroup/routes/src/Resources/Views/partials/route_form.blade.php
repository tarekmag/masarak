@csrf
<div class="row">
    <div class="col-md-4">
        <div class="form-group control-group">
            <x-company-dropdown-company :companyId="$route->company_id" :required="true" name="company_id" />
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group control-group">
            <x-company-dropdown-branch :companyId="$route->company_id" :branchId="$route->branch_id" :required="true" name="branch_id" />
        </div>
    </div>

    {{-- <div class="col-md-4">
        <div class="form-group control-group">
            <x-route-dropdown-type :routeType="$route->type" :required="true" name="type" />
        </div>
    </div> --}}

    <div class="col-md-6">
        <div class="form-group control-group">
            <label for="from_en">{{ __('route::language.field.from_en') }} <span
                    class="danger">*</span></label>
            <input type="text" name="from_en" value="{{ inputValidation('from_en', $route) }}" id="from_en"
                class="form-control" placeholder="{{ __('route::language.field.from_en') }}" required
                data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group control-group">
            <label for="from_ar">{{ __('route::language.field.from_ar') }} <span
                    class="danger">*</span></label>
            <input type="text" name="from_ar" value="{{ inputValidation('from_ar', $route) }}" id="from_ar"
                class="form-control" placeholder="{{ __('route::language.field.from_ar') }}" required
                data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group control-group">
            <label for="to_en">{{ __('route::language.field.to_en') }} <span class="danger">*</span></label>
            <input type="text" name="to_en" value="{{ inputValidation('to_en', $route) }}" id="to_en"
                class="form-control" placeholder="{{ __('route::language.field.to_en') }}" required
                data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group control-group">
            <label for="to_ar">{{ __('route::language.field.to_ar') }} <span class="danger">*</span></label>
            <input type="text" name="to_ar" value="{{ inputValidation('to_ar', $route) }}" id="to_ar"
                class="form-control" placeholder="{{ __('route::language.field.to_ar') }}" required
                data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
        </div>
    </div>
</div>

<x-loader id="loader_id_form" />

@push('js')
    <script type="text/javascript">
        $('#routeForm').on('submit', function(e) {
            e.preventDefault();
            let store_id = "{{ $route->id }}";
            let url = $(this).attr('action');
            let inputs = $(this).serialize();
            $.ajax({
                url: url,
                type: "POST",
                data: inputs,
                beforeSend: function() {
                    $('#loader_id_form').show();
                },
                success: function(response) {
                    if (!store_id) {
                        $('#company-dropdown').val(null).trigger('change');
                        $('#routeForm')[0].reset();
                    }
                    swal("{{ __('partials.GoodJob') }}", response.message, "success");
                    $('#loader_id_form').hide();
                },
                error: function(response) {
                    $('#loader_id_form').hide();
                    var errors = response.responseJSON.data;
                    var el = document.createElement("div");
                    $.each(errors, function(index, value) {
                        $('<p/>', {
                            class: 'text-danger',
                            html: value
                        }).appendTo(el);
                    });
                    swal({
                        icon: "{{ asset('asset/app-assets/images/icons/errorcode.png') }}",
                        title: "{{ __('partials.Error') }}",
                        content: {
                            element: el,
                        }
                    });
                },
            });
        });
    </script>
@endpush
