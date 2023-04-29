<?php

use ATPGroup\Upload\Upload;

?>

<div class="form-body">
    <div class="row">
        @csrf

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-driver-dropdown-driver :driverId="$driverDocument->driver_id" :required="true" name="driver_id" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-driver-dropdown-document-type :type="$driverDocument->type" :required="true" />
            </div>
        </div>

        {{-- <div class="col-md-3">
            <div class="form-group control-group">
                <x-driver-dropdown-document-status :status="$driverDocument->status" :required="true" />
            </div>
        </div> --}}

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="expiration_date">{{ __('driver::language.field.expiration_date') }} <span
                        class="danger">*</span></label>
                <input type="text" name="expiration_date"
                    value="{{ inputValidation('expiration_date', $driverDocument) }}" id="expiration_date"
                    class="form-control date" placeholder="{{ __('driver::language.field.expiration_date') }}" required
                    data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="image">
                    {{ __('driver::language.field.document') }}
                </label> <span class="danger">*</span>
                <?= Upload::image([
                    'name' => 'document',
                    'value' => old('document', $driverDocument->document),
                ]) ?>
            </div>
        </div>

    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
    </button>
</div>

@push('js')
    <script src="{{ asset('asset/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}"
        type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $('.date').inputmask("yyyy-mm-dd");
        });
    </script>
@endpush
