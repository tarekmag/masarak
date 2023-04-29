@extends('layouts.main')
@section('title', __('menu.Routes'))

@section('page-header')
<x-page-header
    :pageTitle="__('menu.Routes')"
    :currentPageTitle="__('route::language.page.create_trip')"
    :haveSearch="false"
    :linkCache="false"
    :haveCalendarSearch="false"
    :pagesBreadcrumb="[['title'=> __('menu.Routes'), 'link'=> route('route.edit', [$route->id])]]"
    :routePageCreate="false"
    :routeNamePageCreate="false"
    dataMethodCreate=""
/>
@endsection

@section('content')
    <div class="content-body">
        <section id="social-cards">
            <form class="form" id="manualTripForm" action="{{ route('route.storeTrip', [$route->id]) }}" method="POST">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-6 order-md-1">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">{{ __('route::language.page.stations') }}</span>
                        </h4>
                        <div class="row col-md-12 mt-1 itemStation" style="display: none;">
                            <div class="col-md-10">
                                <fieldset class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ft-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control inputAutocomplete"
                                            placeholder="{{ __('route::language.field.station') }}" />
                                        <input type="hidden" class="station_ids">
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-1">
                                <button type="button"
                                    class="btn btn-danger btn-min-width btn-glow remove-station">X</button>
                            </div>

                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-lg text-center">
                                    <thead>
                                        <tr>
                                            <th class="sort text-center" data-sort="name">{{ __('route::language.field.employee') }}</th>
                                            <th>{{ __('route::language.field.settings') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list"></tbody>
                                </table>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-lg mt-2 mb-2">
                                    <tr>
                                        <td class="row name">
                                            <select id="employee_id" class="form-control col-md-8 employee_select"></select>
                                            <div class="col-md-3">
                                                <button id="add_employee" type="button" class="btn btn-success">{{ __('route::language.field.add_employee') }}</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row col-md-12 list-group mb-3 card" id="resultStations"></div>

                        <x-loader id="loader_id_1" />

                        <div class="row col-md-12">
                            <button type="button" id="addStation" class="btn btn-success btn-lg btn-block"><i
                                    class="fa fa-plus"></i>{{ __('route::language.field.add_station') }}</button>
                        </div>
                    </div>

                    <div class="col-md-6 order-md-2">
                        <h4 class="mb-3">{{ __('route::language.field.trip_informations') }}</h4>
                        <div class="needs-validation p-2 bg-white card">
                            <div class="row col-md-12">
                                <div class="col-md-0 m-1" id="icheck-isReturn">
                                    <input type="checkbox" name="is_return">
                                    <label for="input-isReturn"
                                        class="lable-isReturn">{{ __('route::language.field.isReturn') }}</label>
                                </div>
                            </div>

                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <label>
                                        {{ __('route::language.field.clientPrice') }}
                                        <span class="danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" name="client_price" class="form-control price_format">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>
                                        {{ __('route::language.field.driverPrice') }}
                                        <span class="danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" name="driver_price" class="form-control price_format">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-1">
                                    <div class="form-group control-group">
                                        <label>
                                            {{ __('route::language.field.date') }}
                                            <span class="danger">*</span>
                                        </label>
                                        <input type="text" name="start_date" class="form-control date">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-1">
                                    <div class="form-group control-group">
                                        <label>
                                            {{ __('route::language.field.time') }}
                                            <span class="danger">*</span>
                                        </label>
                                        <input type="text" name="start_time" class="form-control time">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-supplier-dropdown-list :supplierId="null" :required="false" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-driver-dropdown-driver :supplierId="null" :driverId="null" :required="true" :getAll="false" name="driver_id" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-vehicle-dropdown-vehicle :driverId="null" :vehicleId="null" :required="true" name="vehicle_id" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-route-dropdown-trip-status :tripStatus="null" :required="true" name="status" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <x-route-dropdown-type :routeType="null" :required="true" name="class" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group control-group">
                                        <label>
                                            {{ __('route::language.field.riderCode') }}
                                        </label>
                                        <input type="text" name="rider_code" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <x-loader id="loader_id_form" />

                            <button class="btn btn-blue btn-lg btn-block" type="submit"><i
                                    class="fa fa-check-square-o"></i> {{ __('partials.Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/css/plugins/ui/jqueryui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/extensions/dragula.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('asset/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('asset/app-assets/vendors/js/extensions/dragula.min.js') }}"></script>
    <script src="{{ asset('asset/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}"
        type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            stationSortable();
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

            $('#manualTripForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let inputs = $(this).serialize();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: inputs,
                    beforeSend: function() {
                        $('#loader_id_form').show();
                    },
                    success: function(response) {
                        swal("{{ __('partials.GoodJob') }}", response.message, "success");
                        $('#loader_id_form').hide();
                        location.reload();
                    },
                    error: function(response) {
                        $('#loader_id_form').hide();
                        var errors = response.responseJSON.data;
                        var el = document.createElement("div");
                        $.each(errors, function(index, value) {
                            $('<p/>', {
                                class: 'text-danger',
                                html: value
                            }).appendTo(el);
                        });
                        swal({
                            icon: "{{ asset('asset/app-assets/images/icons/errorcode.png') }}",
                            title: "{{ __('partials.Error') }}",
                            content: {
                                element: el,
                            }
                        });
                    },
                });
            });
        });

        //Unique Employees
        const uniqueEmployeesArray = new Set(jQuery.parseJSON('<?= $employess;?>'));

        // Add New Station
        $(document).on('click', '#addStation', function(e) {
            var min = -100;
            var max = 100;
            // and the formula is:
            var random = Math.floor(Math.random() * (max - min + 1)) + min;
            let length = $(".itemStation").length + random;


            $(".itemStation").first().clone().removeAttr('style').appendTo("#resultStations");

            $(".itemStation").last().find('#list').attr('id', 'list-' + length);
            $(".itemStation").last().find('#employee_id').attr('id', 'employee_id-' + length);
            $(".itemStation").last().find('#add_employee').attr('id', 'add_employee-' + length);
            $(".itemStation").last().find('.inputAutocomplete').prop('required', true);

            let employee = $(".itemStation").last().find('.employee_select');
            getEmployeeDropdown(employee);

            stationAutocomplete(length);
            addEmployee(length, 'list-' + length, 'employee_id-' + length, 'add_employee-' + length);
        });

        // Remove Station
        $(document).on('click', '.remove-station', function(e) {
            let _this = $(this);
            if (confirm('Are you sure ?')) {
                _this.closest('.itemStation').remove();
            }
        });

        // Stations Autocomplete
        function stationAutocomplete(length)
        {
            $(".inputAutocomplete").autocomplete({
                minLength: 1,
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('station.getAutocomplete') }}",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    value: item.name,
                                    id: item.id
                                }
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $(this).val(ui.item.value); // display the selected text
                    $(this).closest('.itemStation').find('.station_ids').attr('name', 'station_ids['+length+']');
                    $(this).closest('.itemStation').find('.station_ids').val(ui.item.id); // save selected id to input
                    return false;
                }
            });
        }

        // Stations Sortable
        function stationSortable() {
            dragula([document.getElementById('resultStations')]);
        }

        // Add Employee
        function addEmployee(length, list, employee, addEmployee)
        {
            $("#"+addEmployee).on('click', function(e){
                e.preventDefault();

                let employee_id = $("#"+employee+' option:selected').val();
                let employee_name = $("#"+employee+' option:selected').text();

                if(employee_id == undefined)
                {
                    toastr.error("{{__('route::language.trip.message.pleaseChooseEmployeeFirst')}}", "{{__('partials.Error')}}", {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 2000});
                    return;
                }

                $("#"+list).append('<tr> \n\
                    <td class="name">'+employee_name+'</td>\n\
                    <td class="remove"><button \n\
                        class="btn btn-outline-danger remove-item-btn">Remove</button></td> \n\
                    <input type="hidden" class="input_employee_id" name="employee_ids['+length+'][]" value="'+employee_id+'" /> \n\
                </tr>');

                $(".employee_select option[value='"+employee_id+"']").remove();
                removeEmployeeFromArray(employee_id);
            });
        }

        // Remove Station
        $(document).on('click', '.remove-item-btn', function(e) {
            e.preventDefault();
            let _this = $(this);
            if (confirm('Are you sure ?')) {

                let name = _this.closest('tr').find('.name').text();
                let employee_id = _this.closest('tr').find('.input_employee_id').val();
                let newOption = new Option(name, employee_id, false, false);
                $(".employee_select").append(newOption).trigger('change');

                _this.closest('tr').remove();
            }
        });

        //Get Employee Dropdown
        function getEmployeeDropdown(employee)
        {
            uniqueEmployeesArray.forEach(function(value) {
                let newOption = new Option(value.name, value.id, false, false);
                employee.append(newOption).trigger('change');
            });
        }

        //Remove Employee From Array
        function removeEmployeeFromArray(employee_id)
        {
            uniqueEmployeesArray.forEach(function(value) {
                if(value.id == employee_id)
                {
                    uniqueEmployeesArray.delete(value);
                }
            });
        }

    </script>
@endpush
