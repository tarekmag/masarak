<?php
use ATPGroup\Upload\Upload;
?>

@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/app-assets/vendors/css/pickers/miniColors/jquery.minicolors.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/app-assets/css/plugins/pickers/colorpicker/colorpicker.css') }}">
@endpush

<div class="form-body">
    <div class="row">
        @csrf
        <div class="col-md-3">
            <div class="form-group control-group">
                <x-brand-dropdown-list :brandId="$vehicle->brand_id" :required="true" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-brandModel-dropdown-list :brandId="$vehicle->brand_id" :brandModelId="$vehicle->brand_model_id" :required="true"
                    name="brand_model_id" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="plate_number">{{ __('vehicle::language.field.plate_number') }} <span
                        class="danger">*</span></label>
                <input type="text" name="plate_number" value="{{ inputValidation('plate_number', $vehicle) }}"
                    id="plate_number" class="form-control"
                    placeholder="{{ __('vehicle::language.field.plate_number') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="color_en">{{ __('vehicle::language.field.color_en') }} <span class="danger">*</span></label>
                <input type="text" name="color_en" value="{{ inputValidation('color_en', $vehicle) }}" id="color_en"
                    class="form-control" placeholder="{{ __('vehicle::language.field.color_en') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="color_ar">{{ __('vehicle::language.field.color_ar') }} <span
                        class="danger">*</span></label>
                <input type="text" name="color_ar" value="{{ inputValidation('color_ar', $vehicle) }}"
                    id="color_ar" class="form-control" placeholder="{{ __('vehicle::language.field.color_ar') }}"
                    required data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="color_code">{{ __('vehicle::language.field.color_code') }}</label>
                <input type="text" name="color_code" value="{{ inputValidation('color_code', $vehicle) }}"
                    id="color_code" class="form-control minicolors"
                    placeholder="{{ __('vehicle::language.field.color_code') }}" data-control="hue">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="number_seats">{{ __('vehicle::language.field.number_seats') }} <span
                        class="danger">*</span></label>
                <input type="text" name="number_seats" value="{{ inputValidation('number_seats', $vehicle) }}"
                    id="number_seats" class="form-control"
                    placeholder="{{ __('vehicle::language.field.number_seats') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="vehicle_year">{{ __('vehicle::language.field.vehicle_year') }} <span
                        class="danger">*</span></label>
                <input type="text" name="vehicle_year" value="{{ inputValidation('vehicle_year', $vehicle) }}"
                    id="vehicle_year" class="form-control"
                    placeholder="{{ __('vehicle::language.field.vehicle_year') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        @if (!$vehicle->id)
            <div class="col-md-4">
                <div class="form-group control-group">
                    <x-supplier-dropdown-list :supplierId="null" :required="false" />
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group control-group">
                    <x-driver-dropdown-driver :supplierId="null" :driverId="null" :required="false" name="driver_id" />
                </div>
            </div>
        @endif

    </div>

    @push('js')
        <script src="{{ asset('asset/app-assets/vendors/js/pickers/miniColors/jquery.minicolors.min.js') }}"></script>
        <script src="{{ asset('asset/app-assets/js/scripts/pickers/colorpicker/picker-color.js') }}"></script>
        <script src="{{ asset('asset/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}"
            type="text/javascript"></script>

        <script>
            $(document).ready(function() {
                $('#vehicle_year').inputmask("y");
            });
        </script>
    @endpush
