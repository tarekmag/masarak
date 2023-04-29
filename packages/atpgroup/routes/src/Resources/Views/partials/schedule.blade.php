<div class="row itemSchedule border-top-blue border-top-3 border-bottom-pink border-bottom-3 box-shadow-0 mb-2 mt-2"
    style="display: none;">

    <input type="hidden" id="route_schedule_id">

    <div class="row col-md-12" id="add-employee" style="display: none;">
        <div class="col-md-12 mt-1 text-right">
            <a href="" class="btn btn-outline-success"><i class="fa fa-user-plus fa-lg"></i></a>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-0 m-1" id="icheck-isReturn">
            <input type="checkbox" id="input-isReturn">
            <label for="input-isReturn" class="lable-isReturn">{{ __('route::language.field.isReturn') }}</label>
        </div>

        <div class="col-md-2" id="icheck-isActive">
            <div class="form-group control-group mt-1">
                <input type="checkbox" id="input-isActive">
                <label for="input-isActive" class="lable-isActive">{{ __('route::language.field.isActive') }}</label>
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-2">
            <label>
                {{ __('route::language.field.clientPrice') }}
                <span class="danger">*</span>
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" id="client_price" class="form-control">
            </div>
        </div>

        <div class="col-md-2">
            <label>
                {{ __('route::language.field.driverPrice') }}
                <span class="danger">*</span>
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" id="driver_price" class="form-control">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group control-group">
                <label>{{ __('route::language.field.schedule_type') }} <span class="danger">*</span></label>
                <select class="form-control schedule-type-dropdown schedule-select2" aria-invalid="false">
                    <option value="">{{ __('partials.PleaseChoose') }}</option>
                    @foreach ($scheduleTypes as $type)
                        <option value="{{ $type }}">
                            {{ __('route::language.field.type.' . $type) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group control-group">
                <label>{{ __('route::language.field.type') }} <span class="danger">*</span> </label>
                <select class="form-control type-dropdown schedule-select2" aria-invalid="false">
                    <option value="">{{ __('partials.PleaseChoose') }}</option>
                    @foreach ($types as $type)
                        <option value="{{ $type }}">
                            {{ __('route::language.field.type.' . $type) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-4">
            <div class="form-group control-group">
                <label>{{ __('supplier::language.field.supplier') }} </label>
                <select class="form-control supplier-dropdown schedule-select2" aria-invalid="false">
                    <option value="">{{ __('partials.PleaseChoose') }}</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group control-group">
                <label>{{ __('driver::language.field.driver') }} </label> <span class="danger">*</span>
                </label>
                <select class="form-control driver-dropdown schedule-select2" aria-invalid="false">
                    <option value="">{{ __('partials.PleaseChoose') }}</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}">
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group control-group">
                <label>{{ __('vehicle::language.field.vehicle') }} <span class="danger">*</span> </label>
                <select class="form-control vehicle-dropdown schedule-select2" aria-invalid="false">
                    <option value="">{{ __('partials.PleaseChoose') }}</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->id . ' - ' . $vehicle->plate_number }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-12 mb-1">
            <label>{{ __('route::language.field.days') }} <span class="danger">*</span></label>
            <div class="row" data-toggle="buttons">
                @foreach ($weekdays as $day)
                    <div class="@if (in_array($loop->iteration, [2, 3, 4, 5, 7])) col-md-2 @else col-md-1 @endif inputDays">
                        <div class="btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-block btn-danger active">
                                <input type="checkbox" class="weekdays" value="{{ $day }}" autocomplete="off">
                                {{ __('route::language.field.weekdays.' . $day) }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-2">
            <div class="form-group control-group">
                <label>
                    {{ __('route::language.field.startDate') }}
                    <span class="danger">*</span>
                </label>
                <input type="text" class="form-control start-date date">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group control-group">
                <label>
                    {{ __('route::language.field.endDate') }}
                </label>
                <input type="text" class="form-control end-date date">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group control-group">
                <label>
                    {{ __('route::language.field.startTime') }}
                    <span class="danger">*</span>
                </label>
                <input type="text" class="form-control time">
            </div>
        </div>

        <div class="col-md-2">
            <label>
                {{ __('route::language.field.arrivalAllowance') }}
            </label>
            <div class="input-group">
                <input type="text" id="arrival_allowance" class="form-control">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group control-group">
                <label>
                    {{ __('route::language.field.riderCode') }}
                </label>
                <input type="text" id="rider_code" class="form-control">
            </div>
        </div>
    </div>

    <div class="row col-md-12 m-1 text-right">
        <div class="col-md-12">
            <button type="button" class="btn btn-danger btn-min-width btn-glow remove-schedule">X</button>
        </div>
    </div>
</div>

<form class="form" id="scheduleForm" action="{{ route('route.updateSchedule', [$route->id]) }}" method="POST"
    novalidate>
    @csrf
    <div class="col-md-12" id="resultSchedules"></div>

    <x-loader id="loader_id_schedule" />

    <div class="row">
        <button type="button" id="addSchedule" class="btn btn-float btn-outline-cyan btn-round">
            <i class="fa fa-plus"></i>
        </button>
    </div>

    <div class="form-actions right">
        <button type="submit" class="btn btn-blue">
            <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
        </button>
    </div>
</form>

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
            $('#scheduleForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let inputs = $(this).serialize();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: inputs,
                    beforeSend: function() {
                        $('#loader_id_schedule').show();
                    },
                    success: function(response) {
                        $.each(response.data, function(index, value) {
                            let url = '{{ route('route.assignedEmployee', ':id') }}';
                            url = url.replace(':id', value.id);

                            $('#add-employee' + value.key).removeAttr('style').find('a')
                                .attr('href', url);
                            $('#add-employee' + value.key).find('a').val(value.id);
                        });

                        swal("{{ __('partials.GoodJob') }}", response.message, "success");
                        $('#loader_id_schedule').hide();
                    },
                    error: function(response) {
                        $('#loader_id_schedule').hide();
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

            $.ajax({
                method: 'GET',
                url: "{{ route('route.getSchedules', [$route->id]) }}",
                dataType: 'json',
                beforeSend: function() {
                    $("#loader_id_2").show();
                },
                success: function(response) {
                    $("#resultSchedules").empty();

                    var min = -100;
                    var max = 100;
                    $.each(response, function(key, value) {
                        var random = Math.floor(Math.random() * (max - min + 2)) + min;

                        let length = $(".itemSchedule").length + random;

                        let driver_id = value.driver_id;
                        let vehicle_id = value.vehicle_id;

                        $(".itemSchedule").first().clone().removeAttr('style').appendTo(
                            "#resultSchedules");

                        // Add Employee
                        var url = '{{ route('route.assignedEmployee', ':id') }}';
                        url = url.replace(':id', value.id);
                        $(".itemSchedule").last().find('#add-employee').removeAttr('style')
                            .find('a').attr('href', url);
                        $(".itemSchedule").last().find('#add-employee').find('a').val(value.id);
                        $(".itemSchedule").last().find('#add-employee').attr('id',
                            'add-employee' + length);

                        // Route Schedule Id
                        $(".itemSchedule").last().find('#route_schedule_id').attr('name',
                            'route_schedule_ids[' + length + ']');
                        $(".itemSchedule").last().find('#route_schedule_id').val(value.id);
                        $(".itemSchedule").last().find('#route_schedule_id').attr('id',
                            'route_schedule_id-' + length);

                        // Is Return Section
                        $(".itemSchedule").last().find('#input-isReturn').attr('name',
                            'is_returns[' + length + ']');
                        $(".itemSchedule").last().find('#input-isReturn').prop('checked', value
                            .is_return);
                        $(".itemSchedule").last().find('#input-isReturn').attr('id',
                            'input-isReturn-' + length);
                        $(".itemSchedule").last().find('.lable-isReturn').attr('for',
                            'input-isReturn-' + length);
                        $(".itemSchedule").last().find('#icheck-isReturn').attr('id',
                            'icheck-isReturn-' + length);
                        $('#icheck-isReturn-' + length + ' input').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });

                        // Is Active Section
                        $(".itemSchedule").last().find('#input-isActive').attr('name',
                            'is_actives[' + length + ']');
                        $(".itemSchedule").last().find('#input-isActive').prop('checked', value
                            .is_active);
                        $(".itemSchedule").last().find('#input-isActive').attr('id',
                            'input-isActive-' + length);
                        $(".itemSchedule").last().find('.lable-isActive').attr('for',
                            'input-isActive-' + length);
                        $(".itemSchedule").last().find('#icheck-isActive').attr('id',
                            'icheck-isActive-' + length);
                        $('#icheck-isActive-' + length + ' input').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });

                        // Client Price Section
                        $(".itemSchedule").last().find('#client_price').attr('name',
                            'client_prices[' + length + ']');
                        $(".itemSchedule").last().find('#client_price').val(value.client_price);
                        $(".itemSchedule").last().find('#client_price').attr('id',
                            'client_price-' + length);
                        $("#client_price-" + length).inputmask('decimal', {
                            'alias': 'numeric',
                            // 'groupSeparator': ',',
                            'autoGroup': true,
                            'digits': 2,
                            'radixPoint': ".",
                            'digitsOptional': false,
                            'allowMinus': false,
                            // 'placeholder': '000.00'
                        });

                        // Driver Price Section
                        $(".itemSchedule").last().find('#driver_price').attr('name',
                            'driver_prices[' + length + ']');
                        $(".itemSchedule").last().find('#driver_price').val(value.driver_price);
                        $(".itemSchedule").last().find('#driver_price').attr('id',
                            'driver_price-' + length);
                        $("#driver_price-" + length).inputmask('decimal', {
                            'alias': 'numeric',
                            // 'groupSeparator': ',',
                            'autoGroup': true,
                            'digits': 2,
                            'radixPoint': ".",
                            'digitsOptional': false,
                            'allowMinus': false,
                            // 'placeholder': '000.00'
                        });

                        //Dropdowns Section
                        $(".itemSchedule").last().find('.schedule-type-dropdown').attr('name',
                            'schedule_types[' + length + ']');
                        $(".itemSchedule").last().find('.schedule-type-dropdown').val(value
                            .type);
                        $(".itemSchedule").last().find('.type-dropdown').attr('name',
                            'route_types[' + length + ']');
                        $(".itemSchedule").last().find('.type-dropdown').val(value.class);

                        $(".itemSchedule").last().find('.vehicle-dropdown').attr('name',
                            'vehicle_ids[' + length + ']');
                        $(".itemSchedule").last().find('.vehicle-dropdown').val(value
                            .vehicle_id);

                        $(".itemSchedule").last().find('.supplier-dropdown').attr('name',
                            'supplier_ids[' + length + ']');
                        $(".itemSchedule").last().find('.supplier-dropdown').val(value
                            .supplier_id);
                        $(".itemSchedule").last().find('.supplier-dropdown');

                        $(".itemSchedule").last().find('.driver-dropdown').attr('name',
                            'driver_ids[' + length + ']');

                        if (value.supplier_id) {
                            let driver = $(".itemSchedule").last().find('.driver-dropdown');
                            $.ajax({
                                method: "GET",
                                url: '{{ route('driver.getDrivers') }}',
                                dataType: 'json',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    supplier_id: value.supplier_id
                                },
                                success: function(response) {
                                    if (response.status == 'ok') {
                                        driver.empty();
                                        $.each(response.data, function(index,
                                            value) {
                                            if (value.id == driver_id) {
                                                var newOption = new Option(
                                                    value
                                                    .text, value.id,
                                                    true,
                                                    true);
                                            } else {
                                                var newOption = new Option(
                                                    value
                                                    .text, value.id,
                                                    false,
                                                    false);
                                            }
                                            // driver.append(newOption).trigger('change');
                                            driver.append(newOption);
                                        });
                                    }
                                }
                            });
                        } else {
                            $(".itemSchedule").last().find('.driver-dropdown').val(driver_id);
                        }

                        if (driver_id) {
                            let vehicle = $(".itemSchedule").last().find('.vehicle-dropdown');
                            $.ajax({
                                method: "GET",
                                url: '{{ route('driverVehicle.getVehicles') }}',
                                dataType: 'json',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    driver_id: driver_id
                                },
                                success: function(response) {
                                    if (response.status == 'ok') {
                                        vehicle.empty();
                                        $.each(response.data, function(index,
                                            value) {
                                            if (value.id == vehicle_id) {
                                                var newOption = new Option(
                                                    value
                                                    .text, value.id,
                                                    true,
                                                    true);
                                            } else {
                                                var newOption = new Option(
                                                    value
                                                    .text, value.id,
                                                    false,
                                                    false);
                                            }
                                            vehicle.append(newOption).trigger('change');
                                        });
                                    }
                                }
                            });
                        } else {
                            $(".itemSchedule").last().find('.vehicle-dropdown').val(vehicle_id);
                        }

                        // Weekdays Section
                        $(".itemSchedule").last().find('.weekdays').attr('name', 'days[' +
                            length + '][]');
                        $(".itemSchedule").last().find('.weekdays').each(function(index, day) {
                            let _this = $(this);
                            if (jQuery.inArray(_this.val(), value.days) !== -1) {
                                _this.closest('.inputDays').find(
                                    '[data-toggle="buttons"] .btn').toggleClass(
                                    'btn-success btn-danger active');
                                // toggle checkbox
                                var $chk = _this;
                                $chk.prop('checked', !$chk.prop('checked'));
                            }
                        });


                        // Date Time Section
                        $(".itemSchedule").last().find('.start-date').attr('name',
                            'start_dates[' + length + ']');
                        $(".itemSchedule").last().find('.start-date').val(value.start_date);
                        $(".itemSchedule").last().find('.end-date').attr('name', 'end_dates[' +
                            length + ']');
                        $(".itemSchedule").last().find('.end-date').val(value.end_date);
                        $(".itemSchedule").last().find('.time').attr('name', 'times[' + length +
                            ']');
                        $(".itemSchedule").last().find('.time').val(value.start_time);
                        $('.date').inputmask("yyyy-mm-dd");
                        $('.time').inputmask("hh:mm");

                        //Rider Code
                        $(".itemSchedule").last().find('#rider_code').attr('name',
                            'rider_codes[' + length + ']');
                        $(".itemSchedule").last().find('#rider_code').val(value
                            .rider_code);
                        $(".itemSchedule").last().find('#rider_code').attr('id',
                            'rider_code-' + length);

                        // Arrival Allowance Section
                        $(".itemSchedule").last().find('#arrival_allowance').attr('name',
                            'arrival_allowances[' + length + ']');
                        $(".itemSchedule").last().find('#arrival_allowance').val(value
                            .arrival_allowance);
                        $(".itemSchedule").last().find('#arrival_allowance').attr('id',
                            'arrival_allowance-' + length);
                        $("#arrival_allowance-" + length).inputmask('decimal', {
                            'alias': 'numeric',
                            'autoGroup': true,
                            'digits': 0,
                            // 'radixPoint': ".",
                            'digitsOptional': true,
                            'allowMinus': true,
                        });
                    });

                    //Select2
                    $(".schedule-select2").select2({
                        placeholder: "Please Choose",
                        allowClear: true,
                        width: '100%'
                    });
                },
                complete: function() {
                    $("#loader_id_2").hide();
                }
            });
        });

        // Add New Schedule
        $(document).on('click', '#addSchedule', function(e) {
            var min = -100;
            var max = 100;
            // and the formula is:
            var random = Math.floor(Math.random() * (max - min + 1)) + min;
            let length = $(".itemSchedule").length + random;

            $(".itemSchedule").first().clone().removeAttr('style').appendTo("#resultSchedules");

            //Add Employee
            $(".itemSchedule").last().find('#add-employee').attr('id', 'add-employee' + length);

            // Route Schedule Id
            $(".itemSchedule").last().find('#route_schedule_id').attr('name', 'route_schedule_ids[' + length + ']');
            $(".itemSchedule").last().find('#route_schedule_id').val(0);
            $(".itemSchedule").last().find('#route_schedule_id').attr('id', 'route_schedule_id-' + length);

            // Is Return Section
            $(".itemSchedule").last().find('#input-isReturn').attr('name', 'is_returns[' + length + ']');
            $(".itemSchedule").last().find('#input-isReturn').attr('id', 'input-isReturn-' + length);
            $(".itemSchedule").last().find('.lable-isReturn').attr('for', 'input-isReturn-' + length);
            $(".itemSchedule").last().find('#icheck-isReturn').attr('id', 'icheck-isReturn-' + length);
            $('#icheck-isReturn-' + length + ' input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            // Is Active Section
            $(".itemSchedule").last().find('#input-isActive').attr('name', 'is_actives[' + length + ']');
            $(".itemSchedule").last().find('#input-isActive').attr('id', 'input-isActive-' + length);
            $(".itemSchedule").last().find('.lable-isActive').attr('for', 'input-isActive-' + length);
            $(".itemSchedule").last().find('#icheck-isActive').attr('id', 'icheck-isActive-' + length);
            $('#icheck-isActive-' + length + ' input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            // Client Price Section
            $(".itemSchedule").last().find('#client_price').attr('name', 'client_prices[' + length + ']');
            $(".itemSchedule").last().find('#client_price').attr('id', 'client_price-' + length);
            $("#client_price-" + length).inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'placeholder': '000.00'
            });

            // Driver Price Section
            $(".itemSchedule").last().find('#driver_price').attr('name', 'driver_prices[' + length + ']');
            $(".itemSchedule").last().find('#driver_price').attr('id', 'driver_price-' + length);
            $("#driver_price-" + length).inputmask('decimal', {
                'alias': 'numeric',
                // 'groupSeparator': ',',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ".",
                'digitsOptional': false,
                'allowMinus': false,
                // 'placeholder': '000.00'
            });

            //Dropdowns Section
            $(".itemSchedule").last().find('.schedule-type-dropdown').attr('name', 'schedule_types[' + length +
                ']');
            $(".itemSchedule").last().find('.type-dropdown').attr('name', 'route_types[' + length + ']');
            $(".itemSchedule").last().find('.supplier-dropdown').attr('name', 'supplier_ids[' + length + ']');
            $(".itemSchedule").last().find('.driver-dropdown').attr('name', 'driver_ids[' + length + ']');
            $(".itemSchedule").last().find('.vehicle-dropdown').attr('name', 'vehicle_ids[' + length + ']');

            // Weekdays Section
            $(".itemSchedule").last().find('.weekdays').attr('name', 'days[' + length + '][]');

            // Date Time Section
            $(".itemSchedule").last().find('.start-date').attr('name', 'start_dates[' + length + ']');
            $(".itemSchedule").last().find('.end-date').attr('name', 'end_dates[' + length + ']');
            $(".itemSchedule").last().find('.time').attr('name', 'times[' + length + ']');
            $('.date').inputmask("yyyy-mm-dd");
            $('.time').inputmask("hh:mm");

            // Arrival Allowance Section
            $(".itemSchedule").last().find('#arrival_allowance').attr('name', 'arrival_allowances[' + length + ']');
            $(".itemSchedule").last().find('#arrival_allowance').attr('id', 'arrival_allowance-' + length);
            $("#arrival_allowance-" + length).inputmask('decimal', {
                'alias': 'numeric',
                'autoGroup': true,
                'digits': 0,
                // 'radixPoint': ".",
                'digitsOptional': true,
                'allowMinus': true,
            });

            //Rider Code
            $(".itemSchedule").last().find('#rider_code').attr('name', 'rider_codes[' + length + ']');
            $(".itemSchedule").last().find('#rider_code').attr('id', 'rider_code-' + length);

            //Select2
            var ul = $('.schedule-select2 ul'),
                li = $('.schedule-select2 ul li:last-of-type');

            li.find('.schedule-select2').select2('destroy');
            var cloned = li.clone();

            ul.append(cloned);

            $.each($('.schedule-select2'), function(a) {
                $(this).removeAttr('data-select2-id').select2({
                    placeholder: "Please Choose",
                    allowClear: true,
                    width: '100%'
                });
            });

            $(".itemSchedule").last().find('.schedule-select2').next('span').next('span').remove();
        });

        // Remove Schedule
        $(document).on('click', '.remove-schedule', function(e) {
            let _this = $(this);
            if (confirm('Are you sure ?')) {
                _this.closest('.itemSchedule').remove();
            }
        });

        $(document).on('change', '.supplier-dropdown', function(e) {
            e.preventDefault();
            let id = $(this).find(":selected").val();
            let driver = $(this).closest('.row').find('.driver-dropdown');
            $.ajax({
                method: "GET",
                url: '{{ route('driver.getDrivers') }}',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    supplier_id: id
                },
                success: function(response) {
                    if (response.status == 'ok') {
                        driver.empty();
                        $.each(response.data, function(index, value) {
                            var newOption = new Option(value.text, value.id, false, false);
                            driver.append(newOption).trigger('change');
                        });
                    }
                }
            });
        });

        $(document).on('change', '.driver-dropdown', function(e) {
            e.preventDefault();
            let id = $(this).find(":selected").val();
            let vehicle = $(this).closest('.row').find('.vehicle-dropdown');
            $.ajax({
                method: "GET",
                url: '{{ route('driverVehicle.getVehicles') }}',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    driver_id: id
                },
                success: function(response) {
                    if (response.status == 'ok') {
                        vehicle.empty();
                        $.each(response.data, function(index, value) {
                            var newOption = new Option(value.text, value.id, false, false);
                            vehicle.append(newOption).trigger('change');
                        });
                    }
                }
            });
        });

        $(document).on('click', '[data-toggle="buttons"] .btn', function() {
            console.log('ddd');
            // toggle style
            $(this).toggleClass('btn-success btn-danger active');

            // toggle checkbox
            var $chk = $(this).find('[type=checkbox]');
            $chk.prop('checked', !$chk.prop('checked'));
            return false;
        });
    </script>
@endpush
