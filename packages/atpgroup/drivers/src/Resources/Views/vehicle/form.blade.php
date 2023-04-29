<div class="form-body">
    <div class="row">
        @csrf

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-supplier-dropdown-list :supplierId="$driverVehicle->supplier_id" :required="false" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-driver-dropdown-driver :driverId="old('driver_id', $driverVehicle->id)" :required="true" name="driver_id" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-vehicle-dropdown-vehicle :driverId="$driverVehicle->id" :vehicleId="old('vehicle_ids', $driverVehicle->vehicles->pluck('id')->toArray())" :required="true" name="vehicle_ids[]" :isMultiple="true" :showAll="true" />
            </div>
        </div>

    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
    </button>
</div>
