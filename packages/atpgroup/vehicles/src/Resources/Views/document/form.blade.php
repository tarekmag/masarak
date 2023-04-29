<?php

use ATPGroup\Upload\Upload;

?>

<div class="form-body">
    <div class="row">
        @csrf

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-vehicle-dropdown-vehicle :driverId="$vehicleDocument->driver_id" :vehicleId="$vehicleDocument->vehicle_id" :required="true" name="vehicle_id"/>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-vehicle-dropdown-document-type :type="$vehicleDocument->type" :required="true"/>
            </div>
        </div>

        {{-- <div class="col-md-3">
            <div class="form-group control-group">
                <x-vehicle-dropdown-document-status :status="$vehicleDocument->status" :required="true" />
            </div>
        </div> --}}

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="image">
                    {{__('vehicle::language.field.document')}}
                    <span class="danger">*</span>
                </label>
                <?=
                Upload::image([
                    'name' => 'document',
                    'value' => old('document' , $vehicleDocument->document),
                ])
                ?>
            </div>
        </div>

    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>
