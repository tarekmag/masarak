<div>
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">

            <h3 class="content-header-title mb-0 d-inline-block"> {{ isset($pageTitle) ? $pageTitle : '' }} </h3>
            @if (request()->route()->getName() != 'dashboard.index')
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">{{ __('menu.Dashboard') }}</a>
                            </li>

                            @foreach ($pagesBreadcrumb as $item)
                                <li class="breadcrumb-item"><a href="{{ $item['link'] }}">{{ $item['title'] }}</a>
                                </li>
                            @endforeach

                            <li class="breadcrumb-item active">
                                {{ isset($currentPageTitle) ? $currentPageTitle : '' }}
                            </li>

                        </ol>
                    </div>
                </div>
            @endif

        </div>
        <div class="content-header-right col-md-4 col-12">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">

                    @if ($haveCalendarSearch)
                        <div id="calendarSearch"
                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>
                            <span>
                                @isset(request()->start_date)
                                    {{ date('d, F Y', strtotime(request()->start_date)) }} -
                                    {{ date('d, F Y', strtotime(request()->end_date)) }}
                                @endisset
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </div>
                    @endif

                    @if ($haveSearch)
                        <button type="button" class="btn btn-blue" data-toggle="modal" data-target="#searchModel"><i
                                class="fa fa-search-plus"></i></button>
                    @endif

                    @if ($linkCache)
                        <a class="btn btn-outline-primary" href="{{ $linkCache }}"><i class="fa fa-refresh"></i></a>
                    @endif

                    @if ($routePageCreate)
                        @can($dataMethodCreate)
                            <a class="btn btn-outline-blue"
                                href="{{ $routePageCreate }}">{{ __('partials.Create') }}</a>
                        @endcan
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('js')
    <script src="{{ asset('asset/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('asset/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}" type="text/javascript">
    </script>
    <script>
        $('#calendarSearch').daterangepicker({
            opens: ('left'),
            timePicker: false,
            timePickerIncrement: 30,
            showDropdowns: true,
            autoUpdateInput: false,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
                'Last 30 Days': [moment().subtract('days', 29), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf(
                    'month')]
            },
            buttonClasses: ['btn'],
            applyClass: 'primary',
            cancelClass: 'default',
            separator: ' To ',
            locale: {
                cancelLabel: 'Clear',
                applyLabel: 'Apply',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                    "October", "November", "December"
                ],
                firstDay: 1,
                format: 'YYYY-MM-DD',
            }
        });

        $('#calendarSearch').on('apply.daterangepicker', function(ev, picker) {
            $('#calendarSearch span').html(picker.startDate.format('D, MMMM YYYY') + ' - ' + picker.endDate.format(
                'D, MMMM YYYY'));
            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);
            params.set('start_date', picker.startDate.format('YYYY-MM-DD'));
            params.set('end_date', picker.endDate.format('YYYY-MM-DD'));
            window.history.replaceState({}, '', `${location.pathname}?${params}`);
            window.location.href = window.location.href;
        });

        $('#calendarSearch').on('cancel.daterangepicker', function(ev, picker) {
            $('#calendarSearch span').html('');
        });
    </script>
@endpush
