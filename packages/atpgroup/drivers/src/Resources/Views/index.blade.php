@extends('layouts.main')
@section('title', __('menu.Drivers'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.Drivers')" :currentPageTitle="__('menu.Drivers')" :haveSearch="true" :linkCache="false" :haveCalendarSearch="false"
        :pagesBreadcrumb="[]" :routePageCreate="route('driver.create')" :routeNamePageCreate="__('partials.Create')" dataMethodCreate="driver.create" />
@endsection

@section('content')
    <div class="content-body">
        <section id="icon-tabs">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-12">
                    <div class="card bg-gradient-directional-info">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-address-card font-large-2 float-left text-white"></i>
                                    </div>
                                    <div class="media-body text-right text-white">
                                        <h3 class="text-white">{{ number_format($result->total()) }}</h3>
                                        <span><a class="text-white" href="{{ route('driver.index') }}">All <br> Drivers</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-12">
                    <div class="card bg-gradient-directional-success">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-like font-large-2 float-left text-white"></i>
                                    </div>
                                    <div class="media-body text-right text-white">
                                        <h3 class="text-white">{{ number_format($activeDrivers) }}</h3>
                                        <span><a class="text-white" href="{{ route('driver.index', ['is_active' => 1]) }}">Active Drivers</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-12">
                    <div class="card bg-gradient-directional-success">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-check-circle-o font-large-2 float-left text-white"></i>
                                    </div>
                                    <div class="media-body text-right text-white">
                                        <h3 class="text-white">{{ number_format($trackedDrivers) }}</h3>
                                        <span><a class="text-white" href="{{ route('driver.index', ['tracked' => 1]) }}">Tracked Drivers</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-12">
                    <div class="card bg-gradient-directional-danger">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="icon-dislike font-large-2 float-left text-white"></i>
                                    </div>
                                    <div class="media-body text-right text-white">
                                        <h3 class="text-white">{{ number_format($inactiveDrivers) }}</h3>
                                        <span><a class="text-white" href="{{ route('driver.index', ['is_active' => 0]) }}">Inactive Drivers</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-2 col-12">
                    <div class="card bg-gradient-directional-danger">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-times-circle-o font-large-2 float-left text-white"></i>
                                    </div>
                                    <div class="media-body text-right text-white">
                                        <h3 class="text-white">{{ number_format($untrackedDrivers) }}</h3>
                                        <span><a class="text-white" href="{{ route('driver.index', ['tracked' => 0]) }}">UnTracked Drivers</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('partials.DataResult') }}</h4>
                            <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table-bordered table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('driver::language.field.name') }}</th>
                                                <th>{{ __('driver::language.field.mobile_number') }}</th>
                                                <th>{{ __('driver::language.field.type') }}</th>
                                                <th>{{ __('driver::language.field.vehicle_count') }}</th>
                                                @if (auth()->user()->company_id)
                                                    <th>{{ __('driver::language.field.status') }}</th>
                                                @else
                                                    <th>{{ __('driver::language.field.trip_status') }}</th>
                                                @endif
                                                <th>{{ __('partials.Settings') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $row)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('route.getAllTrips', ['driver_id' => $row->id]) }}">{{ $row->id }}</a>
                                                    </td>
                                                    <td><a
                                                            href="{{ route('route.getAllTrips', ['driver_id' => $row->id]) }}">{{ $row->name_with_supplier }}</a>
                                                    </td>
                                                    <td>{{ $row->mobile_number }}</td>
                                                    <td>{{ $row->type }}</td>
                                                    <td>{{ $row->vehicle_count }}</td>
                                                    @if (auth()->user()->company_id)
                                                        <td>
                                                            <x-driver-driver-html-status :status="$row->driver_status" />
                                                        </td>
                                                    @else
                                                        <td>
                                                            <x-route-trip-html-status :status="$row->trip_status['trip_status']" />
                                                            <br>
                                                            {{ $row->trip_status['trip_time'] }}
                                                            <br>
                                                            {{ $row->trip_status['route_name'] }}
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <x-edit :href="route('driver.edit', [$row->id])" data-method="driver.edit" />
                                                        <x-custom-action :title="__('driver::language.field.documents')" :routeName="route('driverDocument.index', [
                                                            'driver_id' => $row->id,
                                                        ])"
                                                            icon="file" color="blue" target="_self"
                                                            dataMethod="driverDocument.index" />
                                                        <x-custom-action :title="__('driver::language.field.vehicle')" :routeName="route('driverVehicle.edit', [$row->id])"
                                                            icon="bus" color="green" target="_self"
                                                            dataMethod="driverVehicle.edit" />
                                                        @if ($row->lat && $row->lng)
                                                            <x-custom-action :title="__('driver::language.field.location_time', [
                                                                'time' => $row->updated_at,
                                                            ])"
                                                                routeName="http://maps.google.com/?q={{ $row->lat }},{{ $row->lng }}"
                                                                icon="map" color="pink" target="_blank"
                                                                dataMethod="driver.index" />
                                                        @endif
                                                        <x-delete :href="route('driver.destroy', [$row->id])" data-method="driver.destroy" />
                                                        <x-toggle :isActive="$row->is_active" :url="route('driver.activated', [$row->id])"
                                                            dataMethod="driver.activated" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $result->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade text-left" id="searchModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel35">{{ __('partials.SearchModel') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="GET">
                        <div class="modal-body">
                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <label for="id">#</label>
                                <input type="text" name="id" value="{{ request()->id }}" class="form-control">
                            </fieldset>
                            <br>

                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <x-supplier-dropdown-list :supplierId="request()->supplier_id" :required="false" name="supplier_id" />
                            </fieldset>
                            <br>

                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <label for="name">{{ __('driver::language.field.name') }}</label>
                                <input type="text" name="name" value="{{ request()->name }}" class="form-control"
                                    id="name" placeholder="{{ __('driver::language.field.pleaseEnterName') }}">
                            </fieldset>
                            <br>
                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <label for="mobile_number">{{ __('driver::language.field.mobile_number') }}</label>
                                <input type="text" name="mobile_number" value="{{ request()->mobile_number }}"
                                    class="form-control" id="mobile_number"
                                    placeholder="{{ __('driver::language.field.pleaseEnterMobileNumber') }}">
                            </fieldset>
                            <br>

                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <div class="form-group control-group">
                                    <x-driver-dropdown-type :driverType="request()->type" :required="false" />
                                </div>
                            </fieldset>
                            <br>

                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <div class="form-group control-group">
                                    <x-company-dropdown-company :companyId="request()->company_id" :required="false" name="company_id" />
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-outline-blue btn-sm"
                                value="{{ __('partials.Search') }}">
                            <input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"
                                value="{{ __('partials.Close') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <x-delete-js />
        <x-toggle-js />
    </div>
@endsection
