@extends('layouts.main')
@section('title', __('menu.DriversVehicles'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.DriversVehicles')" :currentPageTitle="__('menu.DriversVehicles')" :haveSearch="true" :linkCache="false" :haveCalendarSearch="false"
        :pagesBreadcrumb="[]" :routePageCreate="route('driverVehicle.create')" :routeNamePageCreate="__('partials.Create')" dataMethodCreate="driverVehicle.create" />
@endsection

@section('content')
    <div class="content-body">
        <section id="icon-tabs">
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
                                                <th>{{ __('driver::language.field.driver') }}</th>
                                                <th>{{ __('driver::language.field.vehicle') }}</th>
                                                <th>{{ __('partials.Settings') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $row)
                                                <tr>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->vehicle_names }}</td>
                                                    <td>
                                                        <x-edit :href="route('driverVehicle.edit', [$row->id])" data-method="driverVehicle.edit" />
                                                        <x-delete :href="route('driverVehicle.destroy', [$row->id])" data-method="driverVehicle.destroy" />
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
                                <div class="form-group control-group">
                                    <x-driver-dropdown-driver :driverId="request()->driver_id" :required="false" name="driver_id" />
                                </div>
                            </fieldset>

                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <div class="form-group control-group">
                                    <x-vehicle-dropdown-vehicle :driverId="request()->driver_id" :vehicleId="request()->vehicle_id" :required="false" name="vehicle_id" />
                                </div>
                            </fieldset>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-outline-blue btn-sm" value="{{ __('partials.Search') }}">
                            <input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"
                                value="{{ __('partials.Close') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <x-delete-js />
    </div>
@endsection
