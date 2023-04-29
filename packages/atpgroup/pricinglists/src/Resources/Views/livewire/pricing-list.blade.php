<div>
    @if (session()->has('message'))
        <div class="alert alert-success" role="alert">
            <div class="alert-body">
                <i data-feather="star"></i>
                <span> {{ session('message') }} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="savePricing">
        <div>
            @foreach ($inputs as $key => $value)
                <div class="add-input" wire:key="banner-{{ $value }}">
                    <input type="hidden" wire:model.row_id="row_id.{{ $value }}">
                    <div class="row mt-2">
                        <div class="form-group col-md-4">
                            <label>Company</label>
                            <select wire:model.lazy='company_id.{{ $value }}'
                                class="form-control {{ $errors->has('company_id') ? 'border-danger' : '' }}">
                                <option value="">Plase Choose</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id.' . $value)
                                <p class="danger text-muted">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label>{{ __('pricingList::language.field.station_from') }}</label>
                            <input type="text" wire:model.lazy='station_from.{{ $value }}'
                                class="form-control {{ $errors->has('station_from') ? 'border-danger' : '' }}"
                                placeholder="{{ __('pricingList::language.field.station_from') }}">
                            @error('station_from.' . $value)
                                <p class="danger text-muted">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label>{{ __('pricingList::language.field.station_to') }}</label>
                            <input type="text" wire:model.lazy='station_to.{{ $value }}'
                                class="form-control {{ $errors->has('station_to') ? 'border-danger' : '' }}"
                                placeholder="{{ __('pricingList::language.field.station_to') }}">
                            @error('station_to.' . $value)
                                <p class="danger text-muted">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{ __('pricingList::language.field.client_single_cost') }}</label>
                            <input type="text" wire:model.lazy='client_single_cost.{{ $value }}'
                                class="form-control {{ $errors->has('client_single_cost') ? 'border-danger' : '' }}"
                                placeholder="{{ __('pricingList::language.field.client_single_cost') }}">
                            @error('client_single_cost.' . $value)
                                <p class="danger text-muted">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{ __('pricingList::language.field.client_waiting_cost') }}</label>
                            <input type="text" wire:model.lazy='client_waiting_cost.{{ $value }}'
                                class="form-control {{ $errors->has('client_waiting_cost') ? 'border-danger' : '' }}"
                                placeholder="{{ __('pricingList::language.field.client_waiting_cost') }}">
                            @error('client_waiting_cost.' . $value)
                                <p class="danger text-muted">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{ __('pricingList::language.field.driver_single_cost') }}</label>
                            <input type="text" wire:model.lazy='driver_single_cost.{{ $value }}'
                                class="form-control {{ $errors->has('driver_single_cost') ? 'border-danger' : '' }}"
                                placeholder="{{ __('pricingList::language.field.driver_single_cost') }}">
                            @error('driver_single_cost.' . $value)
                                <p class="danger text-muted">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label>{{ __('pricingList::language.field.driver_waiting_cost') }}</label>
                            <input type="text" wire:model.lazy='driver_waiting_cost.{{ $value }}'
                                class="form-control {{ $errors->has('driver_waiting_cost') ? 'border-danger' : '' }}"
                                placeholder="{{ __('pricingList::language.field.driver_waiting_cost') }}">
                            @error('driver_waiting_cost.' . $value)
                                <p class="danger text-muted">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12 text-right">
                            <button class="btn btn-danger btn-sm"
                                wire:click.prevent="remove({{ $key }})">Remove</button>
                        </div>
                        <hr/>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 mb-2">
                <button class="btn btn-success btn-sm mt-2 text-white" wire:click.prevent="add({{ $i }})"><i
                        class="fa fa-plus"></i> Add New Price</button>
            </div>
        </div>

        <div class="form-actions right">
            <button type="submit" class="btn btn-blue">
                <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
            </button>
        </div>
    </form>
</div>
