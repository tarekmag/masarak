@extends('layouts.main')
@section('title', __('menu.Dashboard'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.Dashboard')" :currentPageTitle="__('menu.Dashboard')" :haveSearch="false" :linkCache="route('dashboard.clearAdminCache')" :haveCalendarSearch="false"
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
                                    <span><a href="{{ route('driver.index') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Drivers Count') }}</a></span>
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
                                    <span><a href="{{ route('vehicle.index') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Vehicles Count') }}</a></span>
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
                                    <h3 class="blue">{{ $dashboardStatistics['companies'] }}</h3>
                                    <span><a href="{{ route('company.index') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Companies Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-building blue font-large-2 float-right"></i>
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
                                    <span><a href="{{ route('route.index') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Routes Count') }}</a></span>
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
                                    <h3 class="blue">{{ $dashboardStatistics['suppliers'] }}</h3>
                                    <span><a href="{{ route('supplier.index') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Suppliers Count') }}</a></span>
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
                                    <span><a href="{{ route('station.index') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Stations Count') }}</a></span>
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
                                    <h3 class="blue">{{ $dashboardStatistics['employees'] }}</h3>
                                    <span><a href="{{ route('employee.index') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Employees Count') }}</a></span>
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
                                    <h3 class="blue">{{ $dashboardStatistics['adminUsers'] }}</h3>
                                    <span><a href="{{route('user.index')}}" class="black font-medium-1">{{ __('dashboard::language.statistics.Admin Accounts Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-user-secret blue font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="blue">{{ $dashboardStatistics['totalTrips'] }}</h3>
                                    <span><a href="{{ route('route.getAllTrips') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Total Trips Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-map-signs blue font-large-2 float-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="red">{{ $dashboardStatistics['totalLiveTrips'] }}</h3>
                                    <span><a href="{{ route('trips.liveTracking') }}" class="black font-medium-1">{{ __('dashboard::language.statistics.Total Live Trips Count') }}</a></span>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa fa-map-signs red font-large-2 float-right"></i>
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
                        <h4 class="card-title">{{ __('dashboard::language.charts.Trips with Status') }}</h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div id="trips-status" class="height-400 echart-container"></div>
                        </div>
                    </div>
                </div>
            </div>

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

            // trips-status
            // ------------------------------
            require(
                [
                    'echarts',
                    'echarts/chart/pie',
                    'echarts/chart/funnel'
                ],


                // Charts setup
                function(ec) {
                    // Initialize chart
                    // ------------------------------
                    var myChart = ec.init(document.getElementById('trips-status'));

                    // Chart Options
                    // ------------------------------
                    chartOptions = {

                        // Add tooltip
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b}: {c} ({d}%)"
                        },

                        // Add legend
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: jQuery.parseJSON('<?= $tripsStatus['all'] ?>')
                        },

                        // Add custom colors
                        color: ['#3bafda', '#da4453', '#f6bb42', '#37bc9b', '#da4453', '#da4453'],

                        // Display toolbox
                        toolbox: {
                            show: true,
                            orient: 'vertical',
                            feature: {
                                mark: {
                                    show: false,
                                    title: {
                                        mark: 'Markline switch',
                                        markUndo: 'Undo markline',
                                        markClear: 'Clear markline'
                                    }
                                },
                                dataView: {
                                    show: true,
                                    readOnly: false,
                                    title: 'View data',
                                    lang: ['View chart data', 'Close', 'Update']
                                },
                                magicType: {
                                    show: true,
                                    title: {
                                        pie: 'Switch to pies',
                                        funnel: 'Switch to funnel',
                                    },
                                    type: ['pie', 'funnel']
                                },
                                restore: {
                                    show: true,
                                    title: 'Restore'
                                },
                                saveAsImage: {
                                    show: true,
                                    title: 'Same as image',
                                    lang: ['Save']
                                }
                            }
                        },

                        // Enable drag recalculate
                        calculable: true,

                        // Add series
                        series: [{
                            name: 'Browsers',
                            type: 'pie',
                            radius: '70%',
                            center: ['50%', '57.5%'],
                            data: jQuery.parseJSON('<?= $tripsStatus['result'] ?>')
                        }]
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
