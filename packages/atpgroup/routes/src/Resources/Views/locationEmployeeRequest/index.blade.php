@extends('layouts.main')
@section('title', __('menu.LocationEmployeeRequests'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.LocationEmployeeRequests')" :currentPageTitle="__('menu.LocationEmployeeRequests')" :haveSearch="true" :linkCache="false" :haveCalendarSearch="false"
        :pagesBreadcrumb="[]" :routePageCreate="false" :routeNamePageCreate="false" dataMethodCreate="false" />
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/forms/icheck/custom.css') }}">
@endpush

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

                                <div class="form-group control-group mb-2">
                                    <button type="button" data-status="approved"
                                        class="btn btn-float btn-outline-success btn-round btnAction"><i
                                            class="fa fa-thumbs-o-up">
                                            {{ __('route::language.field.approve') }}</i></button>
                                    <button type="button" data-status="declined"
                                        class="btn btn-float btn-outline-danger btn-round btnAction"><i
                                            class="fa fa-thumbs-o-down">
                                            {{ __('route::language.field.decline') }}</i></button>
                                </div>


                                <div class="row">
                                    <div class="icheck1 col-md-12">
                                        <input type="checkbox" id="checkAll">
                                        <label>{{ __('partials.ChooseAll') }}</label>
                                    </div>
                                </div>

                                <x-loader id="loader_id" />

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('partials.Choose') }}</th>
                                                <th>{{ __('route::language.field.route_id') }}</th>
                                                <th>{{ __('route::language.field.employee') }}</th>
                                                <th>{{ __('route::language.field.old_station_id') }}</th>
                                                <th>{{ __('route::language.field.station_id') }}</th>
                                                <th>{{ __('route::language.field.startTime') }}</th>
                                                <th>{{ __('route::language.field.updated_by_id') }}</th>
                                                <th>{{ __('route::language.field.updated_at') }}</th>
                                                <th>{{ __('route::language.field.status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $row)
                                                <tr>
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
                                                    <td>{{ $row->route_id }}</td>
                                                    <td>{!! optional($row->employee)->employee_name !!}</td>
                                                    <td>{{ optional($row->oldStation)->name }}</td>
                                                    <td>{{ optional($row->station)->name }}</td>
                                                    <td>{{ $row->start_time }}</td>
                                                    <td>{{ $row->updated_by }}</td>
                                                    <td>{{ $row->updated_at->format(config('helpers.dateTimeFormat12')) }}
                                                    </td>
                                                    <td>
                                                        <x-route-employee-location-requests-status :status="$row->status" />
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
                                <label for="phone">{{ __('route::language.field.employee_phone') }}</label>
                                <input type="text" name="phone" value="{{ request()->phone }}" class="form-control"
                                    id="phone" placeholder="{{ __('route::language.field.pleaseEnterEmployeePhone') }}">
                            </fieldset>
                            <br>

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
        <x-toggle-js />
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
                    url: '{{ route('locationEmployeeRequest.changeStatus') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: status,
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
