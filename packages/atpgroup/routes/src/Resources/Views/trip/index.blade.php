@extends('layouts.main')
@section('title', __('menu.AllTrips'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.AllTrips')" :currentPageTitle="__('menu.AllTrips')" :haveSearch="true" :linkCache="false" :haveCalendarSearch="true"
        :pagesBreadcrumb="[]" :routePageCreate="false" :routeNamePageCreate="false" dataMethodCreate="" />
@endsection

@section('content')
    <div class="content-body">
        <section id="icon-tabs">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('partials.DataResult') }}</h4>
                            @canany(['trips.exportPDFTrips', 'trips.exportExcelTrips'])
                                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <span class="dropdown">
                                        <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"
                                            class="btn btn-blue btn-sm dropdown-toggle dropdown-menu-right"><i
                                                class="ft-download white"></i></button>
                                        <span aria-labelledby="btnSearchDrop1" class="dropdown-menu dropdown-menu-right mt-1">
                                            @can('trips.exportPDFTrips')
                                                <a href="{{ route('trips.exportPDFTrips', request()->all()) }}"
                                                    class="dropdown-item"><i class="fa fa-file-pdf-o"></i> PDF</a>
                                            @endcan

                                            @can('trips.exportExcelTrips')
                                                <a href="{{ route('trips.exportExcelTrips', request()->all()) }}"
                                                    class="dropdown-item"><i class="fa fa-file-excel-o"></i> Excel
                                                </a>
                                            @endcan
                                        </span>
                                    </span>
                                </div>
                            @endcanany
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                @can('trips.changeStatus')
                                    <div class="form-group control-group row mb-2">
                                        <div class="col-md-6">
                                            <button type="button"
                                                data-status="{{ App\Enums\RouteType::TRIP_STATUS_AVAILABLE }}"
                                                class="btn btn-float btn-outline-info btn-round btnAction"><i
                                                    class="fa fa-clock-o">
                                                    {{ __('route::language.field.trip.status.available') }}</i></button>

                                            <button type="button"
                                                data-status="{{ App\Enums\RouteType::TRIP_STATUS_NOT_STARTED }}"
                                                class="btn btn-float btn-outline-danger btn-round btnAction"><i
                                                    class="fa fa-pause">
                                                    {{ __('route::language.field.trip.status.not_started') }}</i></button>

                                            <button type="button" data-status="{{ App\Enums\RouteType::TRIP_STATUS_STARTED }}"
                                                class="btn btn-float btn-outline-warning btn-round btnAction"><i
                                                    class="fa fa-play">
                                                    {{ __('route::language.field.trip.status.started') }}</i></button>

                                            <button type="button"
                                                data-status="{{ App\Enums\RouteType::TRIP_STATUS_COMPLETED }}"
                                                class="btn btn-float btn-outline-success btn-round btnAction"><i
                                                    class="fa fa-thumbs-up">
                                                    {{ __('route::language.field.trip.status.completed') }}</i></button>

                                            <button type="button"
                                                data-status="{{ App\Enums\RouteType::TRIP_STATUS_CANCELLED }}"
                                                class="btn btn-float btn-outline-danger btn-round btnAction"><i
                                                    class="fa fa-thumbs-down">
                                                    {{ __('route::language.field.trip.status.cancelled') }}</i></button>

                                            <button type="button" data-status="{{ App\Enums\RouteType::TRIP_STATUS_STOPPED }}"
                                                class="btn btn-float btn-outline-danger btn-round btnAction"><i
                                                    class="fa fa-stop">
                                                    {{ __('route::language.field.trip.status.stopped') }}</i></button>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="">{{ __('route::language.field.reason') }}</label>
                                            <textarea name="status_action_reasons" id="status_action_reasons" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="icheck1 col-md-12">
                                            <input type="checkbox" id="checkAll">
                                            <label>{{ __('partials.ChooseAll') }}</label>
                                        </div>
                                    </div>
                                @endcan

                                <x-loader id="loader_id" />

                                <div class="table-responsive">
                                    <table class="table-striped table-bordered table">
                                        <thead>
                                            <tr>
                                                @can('trips.changeStatus')
                                                    <th>{{ __('partials.Choose') }}</th>
                                                @endcan
                                                @can('route.showTrip')
                                                    <th>#</th>
                                                @endcan
                                                <th>{{ __('route::language.field.tripTable.routeName') }}</th>
                                                <th>{{ __('route::language.field.tripTable.date') }}</th>
                                                <th>{{ __('route::language.field.tripTable.driver') }}</th>
                                                <th>{{ __('route::language.field.tripTable.vehicle') }}</th>
                                                <th>{{ __('route::language.field.tripTable.vehicleType') }}</th>
                                                <th>{{ __('route::language.field.tripTable.status') }}</th>
                                                <th>{{ __('route::language.field.tripTable.capacity') }}</th>
                                                <th>{{ __('route::language.field.tripTable.clientPrice') }}</th>
                                                @if (auth()->user()->compant_id)
                                                    <th>{{ __('route::language.field.tripTable.driverPrice') }}</th>
                                                @endif
                                                @can('route.showTrip')
                                                    <th>{{ __('partials.Settings') }}</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $row)
                                                <tr>
                                                    @can('trips.changeStatus')
                                                        <td>
                                                            <div class="card-body">
                                                                <div class="icheck1">
                                                                    <fieldset>
                                                                        <input type="checkbox" class="selectedItems"
                                                                            name="selectedItems" value="{{ $row->id }}">
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @endcan
                                                    @can('route.showTrip')
                                                        <td> <a
                                                                href="{{ route('route.showTrip', $row->_id) }}">{{ $row->_id }}</a>
                                                        </td>
                                                    @endcan
                                                    <td> <a
                                                            href="{{ route('route.edit', $row->route_id) }}">{{ $row->route_name }}</a>
                                                    </td>
                                                    <td>{{ $row->trip_date_time }}</td>
                                                    <td>{{ $row->driver['name'] }}</td>
                                                    <td>{{ $row->vehicle['plate_number'] }}</td>
                                                    <td>{{ $row->vehicle_type_with_model }}</td>
                                                    <td>
                                                        <x-route-trip-html-status :status="$row->status" />
                                                        <br />
                                                        <span
                                                            class="text-danger">{{ $row->arrival_allowance_diff_time }}</span>
                                                    </td>
                                                    <td>{{ $row->capacity }}</td>
                                                    <td>{{ $row->client_price_formated }}</td>
                                                    @if (auth()->user()->compant_id)
                                                        <td>{{ $row->driver_price_formated }}</td>
                                                    @endif
                                                    @can('route.showTrip')
                                                        <td>
                                                            <x-edit :href="route('route.showTrip', [$row->id])" data-method="route.showTrip" />
                                                        </td>
                                                    @endcan
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel35">{{ __('partials.SearchModel') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="GET">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <label for="rider_code">{{ __('route::language.field.riderCode') }}</label>
                                        <input type="text" name="rider_code" value="{{ request()->rider_code }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <label for="route_id">{{ __('route::language.field.route_id') }}</label>
                                        <input type="text" name="route_id" value="{{ request()->route_id }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-company-dropdown-company :companyId="request()->company_id" :required="false"
                                            name="company_id" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-company-dropdown-branch :companyId="request()->company_id" :branchId="request()->branch_id" :required="false"
                                            name="branch_id" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-route-dropdown-trip-status :tripStatus="request()->status" :required="false"
                                            name="status" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-supplier-dropdown-list :supplierId="request()->supplier_id" :required="false" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-driver-dropdown-driver :supplierId="request()->supplier_id" :driverId="request()->driver_id" :required="false"
                                            name="driver_id" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-vehicle-dropdown-vehicle :driverId="request()->driver_id" :vehicleId="request()->vehicle_id" :required="false"
                                            name="vehicle_id" />
                                    </div>
                                </div>

                            </div>
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
    </div>
@endsection

@push('js')
    <script src="{{ asset('asset/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#checkAll').on('ifChecked', function() {
                $('.selectedItems').iCheck('check');
            });

            $('#checkAll').on('ifUnchecked', function() {
                $('.selectedItems').iCheck('uncheck');
            });

            $('.icheck1 input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
            });

            $(".btnAction").on('click', function(e) {
                e.preventDefault();
                let status = $(this).data('status');
                let status_action_reasons = $('#status_action_reasons').val();
                var selectedItems = $("input:checkbox[name=selectedItems]:checked").map(function() {
                    return $(this).val();
                }).get();

                if (selectedItems.length == 0) {
                    toastr.error("{{ __('partials.PleaseChooseFirst') }}",
                        "{{ __('partials.Error') }}", {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 2000
                        });
                    return;
                }

                $.ajax({
                    url: '{{ route('trips.changeStatus') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status,
                        status_action_reasons: status_action_reasons,
                        selectedItems: selectedItems
                    },
                    beforeSend: function() {
                        $("#loader_id").show();
                    },
                    success: function(response) {
                        if (response.status === 'ok') {
                            $("input:checkbox[name=selectedItems]:checked").map(function() {
                                $(this).closest('tr').remove();
                            }).get();

                            toastr.success(response.message,
                                "{{ __('partials.Success') }}", {
                                    "showMethod": "slideDown",
                                    "hideMethod": "slideUp",
                                    timeOut: 2000
                                });

                            $('#status_action_reasons').val('');
                        }
                    },
                    complete: function() {
                        $("#loader_id").hide();
                    }
                });
            });

        });
    </script>
@endpush
