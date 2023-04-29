<form class="row col-md-12">
    <div class="col-md-4">
        <div class="form-group control-group">
            <label>{{ __('route::language.field.employee') }} <span class="danger">*</span></label>
            <select wire:model="employee_id" name="employee_id" class="form-control" aria-invalid="false">
                <option value="">{{ __('partials.PleaseChoose') }}</option>
                @foreach ($employeesList as $row)
                    <option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
                @endforeach
            </select>
            @error('employee_id') <span class="danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group control-group">
            <label>{{ __('route::language.field.station') }}</label>
            <select wire:model="station_id" name="station_id" class="form-control" aria-invalid="false">
                <option value="">{{ __('partials.PleaseChoose') }}</option>
                @foreach ($stationsList as $row)
                    <option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
                @endforeach
            </select>
            @error('station_id') <span class="danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-md-4">
        <button wire:click.prevent="store()" class="btn btn-success mt-2">Save</button>
    </div>
</form>

<x-message />
