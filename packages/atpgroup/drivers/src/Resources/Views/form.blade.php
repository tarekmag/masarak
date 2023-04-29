<?php

use ATPGroup\Upload\Upload;

?>
<div class="form-body">
    <div class="row">
        @csrf

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-supplier-dropdown-list :supplierId="$driver->supplier_id" :required="false" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="name">{{ __('driver::language.field.name') }} <span class="danger">*</span></label>
                <input type="text" name="name" value="{{ inputValidation('name', $driver) }}" id="name"
                    class="form-control" placeholder="{{ __('driver::language.field.name') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="mobile_number">{{ __('driver::language.field.mobile_number') }} <span
                        class="danger">*</span></label>
                <input type="text" name="mobile_number" value="{{ inputValidation('mobile_number', $driver) }}"
                    id="mobile_number" class="form-control"
                    placeholder="{{ __('driver::language.field.mobile_number') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-driver-dropdown-type :driverType="$driver->type" :required="true" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="personal_photo">
                    {{ __('driver::language.field.personal_photo') }}
                </label>
                <?= Upload::image([
                    'name' => 'personal_photo',
                    'value' => old('personal_photo', $driver->personal_photo),
                ]) ?>
            </div>
        </div>

        @if (!$driver->id)
            <div class="col-md-3">
                <div class="form-group control-group">
                    <x-vehicle-dropdown-vehicle :driverId="null" :vehicleId="null" :required="false"
                        name="vehicle_id" />
                </div>
            </div>
        @endif
    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
    </button>
</div>
