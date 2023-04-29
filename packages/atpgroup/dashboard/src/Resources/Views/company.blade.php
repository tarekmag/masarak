@extends('layouts.main')
@section('title', __('menu.Dashboard'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.Dashboard')" :currentPageTitle="__('menu.Dashboard')" :haveSearch="false" :linkCache="route('dashboard.clearCompanyCache')" :haveCalendarSearch="false"
        :pagesBreadcrumb="[]" :routePageCreate="false" :routeNamePageCreate="false" dataMethodCreate="" />
@endsection

@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $dashboardStatistics['drivers'] }}</h3>
                                    <span><a href="{{ route('driver.index') }}"
                                            class="black font-medium-1">{{ __('dashboard::language.statistics.Drivers Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-address-card blue font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $dashboardStatistics['vehicles'] }}</h3>
                                    <span><a href="{{ route('vehicle.index') }}"
                                            class="black font-medium-1">{{ __('dashboard::language.statistics.Vehicles Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-bus blue font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $dashboardStatistics['routes'] }}</h3>
                                    <span><a href="{{ route('route.index') }}"
                                            class="black font-medium-1">{{ __('dashboard::language.statistics.Routes Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-road blue font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $dashboardStatistics['routeSchedule'] }}</h3>
                                    <span><a href="{{ route('route.index') }}"
                                            class="black font-medium-1">{{ __('dashboard::language.statistics.Routes Schedule Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-road blue font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $dashboardStatistics['employees'] }}</h3>
                                    <span><a href="{{ route('employee.index') }}"
                                            class="black font-medium-1">{{ __('dashboard::language.statistics.Employees Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-users blue font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $dashboardStatistics['stations'] }}</h3>
                                    <span><a href="{{ route('station.index') }}"
                                            class="black font-medium-1">{{ __('dashboard::language.statistics.Stations Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-map-marker blue font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="green">{{ $dashboardStatistics['totalCompletedTrips'] }}</h3>
                                    <span><a href="{{ route('user.index') }}"
                                            class="black font-medium-1">{{ __('dashboard::language.statistics.Total Completed Trips Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-map-signs green font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="red">{{ $dashboardStatistics['totalbBudgetCompletedTrips'] }}
                                    </h3>
                                    <span><a href="{{ route('route.getAllTrips') }}"
                                            class="black font-medium-1">{{ __('dashboard::language.statistics.Total Budget Completed Trips Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-usd red font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('dashboard::language.charts.Trips Reports') }}</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div id="trips-reports" class="height-400 echart-container"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@push('css')
@endpush

@push('dashboard-js')
    <script src="{{ asset('asset/app-assets/vendors/js/charts/raphael-min.js') }}"></script>
    <script src="{{ asset('asset/app-assets/vendors/js/charts/morris.min.js') }}"></script>
    <script src="{{ asset('asset/app-assets/vendors/js/charts/echarts/echarts.js') }}"></script>

    <script type="text/javascript">
        $(window).on("load", function() {
            // Set paths
            // ------------------------------
            require.config({
                paths: {
                    echarts: "{{ asset('asset/app-assets/vendors/js/charts/echarts') }}"
                }
            });

            // trips-reports
            // ------------------------------
            require(
                [
                    'echarts',
                    'echarts/chart/bar',
                    'echarts/chart/line'
                ],


                // Charts setup
                function(ec) {

                    // Initialize chart
                    // ------------------------------
                    var myChart = ec.init(document.getElementById('trips-reports'));

                    // Chart Options
                    // ------------------------------
                    chartOptions = {

                        // Setup grid
                        grid: {
                            x: 40,
                            x2: 40,
                            y: 35,
                            y2: 25
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'axis'
                        },

                        // Add legend
                        legend: {
                            data: jQuery.parseJSON('<?= $tripsReports['status'] ?>')
                        },

                        // Add custom colors
                        color: ['#626E82', '#28D094', '#52a832', '#6a91d9'],

                        // Enable drag recalculate
                        calculable: true,

                        // Horizontal axis
                        xAxis: [{
                            type: 'category',
                            data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                                'Oct', 'Nov', 'Dec'
                            ]
                        }],

                        // Vertical axis
                        yAxis: [{
                            type: 'value'
                        }],

                        // Add series
                        series: jQuery.parseJSON('<?= $tripsReports['result'] ?>')
                    };

                    // Apply options
                    // ------------------------------

                    myChart.setOption(chartOptions);


                    // Resize chart
                    // ------------------------------

                    $(function() {

                        // Resize chart on menu width change and window resize
                        $(window).on('resize', resize);
                        $(".menu-toggle").on('click', resize);

                        // Resize function
                        function resize() {
                            setTimeout(function() {

                                // Resize chart
                                myChart.resize();
                            }, 200);
                        }
                    });
                }
            );

        });
    </script>
@endpush

