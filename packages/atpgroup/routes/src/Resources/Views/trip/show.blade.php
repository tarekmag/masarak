@extends('layouts.main')
@section('title', __('menu.Routes'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.Routes')" :currentPageTitle="__('route::language.page.show_trip')" :haveSearch="false" :linkCache="false" :haveCalendarSearch="false"
        :pagesBreadcrumb="[['title' => __('menu.Routes'), 'link' => route('route.edit', [$trip->route_id])]]" :routePageCreate="false" :routeNamePageCreate="false" dataMethodCreate="" />
@endsection

@section('content')
    <div class="content-body">
        <section id="icon-tabs">
            <!-- Trip Information -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('route::language.page.trip_info') }}</h4>
                            <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-1 text-right">
                                    <x-route-trip-html-status :status="$trip['status']" />
                                    @isset($trip['modified_by']['name'])
                                        <h4 class="card-title">Modified Action By:
                                            {{ $trip['modified_by']['name'] ?? '' }}</h4>
                                        <h4 class="card-title">Last Modified At:
                                            {{ $trip->created_at->format(config('helpers.dateTimeFormat12')) }}</h4>
                                    @endisset
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form" action="{{ route('route.updateTrip', [$trip->_id]) }}" method="POST"
                                    novalidate>
                                    @csrf
                                    <div class="form-body">
                                        <div class="row col-md-12">
                                            <div class="col-md-3">
                                                <label>
                                                    {{ __('route::language.field.clientPrice') }}
                                                    <span class="danger">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="text" name="client_price"
                                                        value="{{ $trip->client_price }}" class="form-control price_format">
                                                </div>
                                            </div>

                                            @if (!auth()->user()->company_id)
                                                <div class="col-md-3">
                                                    <label>
                                                        {{ __('route::language.field.driverPrice') }}
                                                        <span class="danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">$</span>
                                                        </div>
                                                        <input type="text" name="driver_price"
                                                            value="{{ $trip->driver_price }}"
                                                            class="form-control price_format">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-3">
                                                <div class="form-group control-group">
                                                    <label>
                                                        {{ __('route::language.field.date') }}
                                                        <span class="danger">*</span>
                                                    </label>
                                                    <input type="text" name="start_date"
                                                        value="{{ $trip->trip_date->format(config('helpers.dateFormat')) }}"
                                                        class="form-control date">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group control-group">
                                                    <label>
                                                        {{ __('route::language.field.time') }}
                                                        <span class="danger">*</span>
                                                    </label>
                                                    <input type="text" name="start_time"
                                                        value="{{ $trip->trip_time->format(config('helpers.timeFormat')) }}"
                                                        class="form-control time">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <x-supplier-dropdown-list :supplierId="$trip->supplier_id" :required="false" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <x-driver-dropdown-driver :supplierId="$trip->supplier_id" :driverId="$trip->driver_id"
                                                        :required="true" name="driver_id" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <x-vehicle-dropdown-vehicle :driverId="$trip->driver_id" :vehicleId="$trip->vehicle_id" :required="true"
                                                        name="vehicle_id" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <x-route-dropdown-trip-status :tripStatus="$trip->status" :required="true"
                                                        name="status" />
                                                </div>
                                            </div>

                                            <div class="col-md-4"
                                                @if (!in_array($trip['status'], app(App\Services\TripService::class)->getStatusOfReasonsTrip())) style="display: none;" @endif
                                                id="status_action_reasons">
                                                <div class="form-group control-group">
                                                    <label>
                                                        {{ __('route::language.field.reason') }}
                                                        <span class="danger">*</span>
                                                    </label>
                                                    <textarea name="status_action_reasons" class="form-control" rows="3">{{ $trip['status_action_reasons'] }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <x-route-dropdown-type :routeType="$trip->class" :required="true"
                                                        name="class" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <label>
                                                        {{ __('route::language.field.riderCode') }}
                                                    </label>
                                                    <input type="text" name="rider_code" value="{{ $trip->rider_code }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @can('route.updateTrip')
                                        <div class="form-actions right">
                                            <button type="submit" class="btn btn-blue">
                                                <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
                                            </button>
                                        </div>
                                    @endcan

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('route::language.page.map') }}</h4>
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
                                @if ($trip->status == App\Enums\RouteType::TRIP_STATUS_STARTED)
                                    <x-maps.open-street-map.live-traking :tripId="$trip->_id" :coordinates="json_encode($trip->route_coordinates)"
                                        :stations="json_encode($trip->stations_coordinates)" :zoom="6" width="100%" height="450px;" />
                                @else
                                    @include('route::partials.map', [
                                        'coordinates' => $trip->route_coordinates,
                                        'stations' => $trip->stations_coordinates,
                                    ])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stations -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('route::language.page.stations') }}</h4>
                            <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>{{ __('route::language.field.allEmployeesCount') }} (<span
                                            class="danger">{{ $trip->employees_count }}</span>)</li>
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="card collapse-icon accordion-icon-rotate">
                                    @foreach ($trip->stations as $station)
                                        <div id="headingCollapse{{ $loop->index }}"
                                            class="card-header @if ($loop->first && $trip->arrival_allowance_diff_time) border-danger @else border-grey @endif mb-1">
                                            <span
                                                class="badge border-blue-grey black badge-border">{{ $loop->iteration }}</span>
                                            |

                                            <a href="http://maps.google.com/?q={{ $station['lat'] }},{{ $station['lng'] }}"
                                                target="_blank" class="black">
                                                <i class="fa fa-map-marker fa-lg"></i>
                                            </a>

                                            <span class="float-right mr-5">
                                                @php
                                                    $employeesCollection = collect($station['employees']);
                                                    $isAttended = $employeesCollection->filter(function ($value) {
                                                        return isset($value['is_attended']) && $value['is_attended'] == true ? true : false;
                                                    });
                                                @endphp
                                                {{ __('route::language.field.employees') }}<br> <span
                                                    class="info">{{ $isAttended->count() . '/' . $employeesCollection->count() }}</span>
                                            </span>

                                            <span class="float-right mr-5">
                                                {{ __('route::language.field.status') }}<br> <span
                                                    class="{{ $station['status'] ? 'success' : 'danger' }}">{{ __('route::language.field.trip.status.' . $station['status']) }}</span>
                                            </span>

                                            @if ($loop->index == 0)
                                                <span
                                                    class="@if ($trip->arrival_allowance_diff_time) text-danger @endif float-right mr-5">
                                                    {{ __('route::language.field.arrival_time') }} <br>
                                                    {{ $station['arrival_time'] ? $station['arrival_time'] : 'none' }}
                                                </span>

                                                <span
                                                    class="@if ($trip->arrival_allowance_diff_time) text-danger @endif float-right mr-5">
                                                    {{ __('route::language.field.diff_arrival_time') }} <br>
                                                    {{ $trip->arrival_allowance_diff_time }}
                                                </span>

                                                <span class="float-right mr-5">
                                                    {{ __('route::language.field.time_with_arrival_allowance') }} <br>
                                                    {{ app(App\Services\TripService::class)->getTripDateTimeFormated($trip, $trip->arrival_allowance)->format(config('helpers.timeFormat')) }}
                                                </span>
                                            @else
                                                <span class="float-right mr-5">
                                                    {{ __('route::language.field.arrival_time') }} <br>
                                                    {{ $station['arrival_time'] ? $station['arrival_time'] : 'none' }}
                                                </span>
                                            @endif

                                            <a data-toggle="collapse" href="#collapse{{ $loop->index }}"
                                                aria-expanded="false" aria-controls="collapse{{ $loop->index }}"
                                                class="card-title lead">
                                                {{ $station['name_' . app()->getLocale()] }}
                                            </a>
                                        </div>
                                        <div id="collapse{{ $loop->index }}" role="tabpanel"
                                            aria-labelledby="headingCollapse{{ $loop->index }}"
                                            class="card-collapse collapse" aria-expanded="false">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <table class="table-bordered table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('route::language.field.employee') }}</th>
                                                                <th>{{ __('route::language.field.phone') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($station['employees'] as $employee)
                                                                <tr
                                                                    class="@if (isset($employee['is_attended']) && $employee['is_attended']) bg-teal bg-lighten-4 @else bg-pink bg-lighten-4 @endif">
                                                                    <td>{{ $employee['name'] }}</td>
                                                                    <td>{{ $employee['phone'] }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/forms/icheck/custom.css') }}">
@endpush

@push('js')
    <script src="{{ asset('asset/app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('asset/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}"
        type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $(".price_format").inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'placeholder': '000.00'
            });
            $('.date').inputmask("yyyy-mm-dd");
            $('.time').inputmask("hh:mm");

            // Is Return Section
            $('#icheck-isReturn input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });

        $(document).on('change', 'select[name=status]', function(e) {
            let status = $(this).val();
            let statusArray = jQuery.parseJSON('<?= $statusArray ?>');
            if (jQuery.inArray(status, statusArray) !== -1) {
                $("#status_action_reasons").show();
            } else {
                $("#status_action_reasons").hide();
            }
        });
    </script>
@endpush
