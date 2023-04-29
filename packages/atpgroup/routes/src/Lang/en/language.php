<?php

return [

    /*
    |--------------------------------------------------------------------------
    | English Language Lines
    |--------------------------------------------------------------------------
     */

    // Pages
    'page.submit' => 'Submit',
    'page.actions' => 'Actions',
    'page.form' => 'Form',
    'page.map' => 'Map',
    'page.stations' => 'Stations',
    'page.schedule' => 'Schedule',
    'page.trips' => 'Trips',
    'page.route_info' => 'Route Information',
    'page.trip_info' => 'Trip Information',
    'page.show_trip' => 'Show / Update Trip',
    'page.create_trip' => 'Create Trip',
    'page.dispatch_trips' => 'Dispatch Now Trips',

    //Fields
    'field.searchStation' => 'Search for station',
    'field.station' => 'Station',
    'field.trips' => 'Trips',
    'field.company' => 'company',
    'field.type.economy' => 'Economy',
    'field.type.business' => 'Business',
    'field.type.scheduled' => 'Scheduled',
    'field.type.manual' => 'Manual',
    'field.type.special_request' => 'Special Request',
    'field.from_en' => 'From EN',
    'field.from_ar' => 'From AR',
    'field.to_en' => 'To EN',
    'field.to_ar' => 'To AR',
    'field.type' => 'Route Type',
    'field.route_id' => 'Route Id',
    'field.driver_id' => 'Driver',
    'field.vehicle_id' => 'Vehicle',
    'field.company_id' => 'Company',
    'field.isReturn' => 'Return',
    'field.isActive' => 'Active',
    'field.arrivalAllowance' => 'Arrival Allowance',
    'field.clientPrice' => 'Client Price',
    'field.driverPrice' => 'Driver Price',
    'field.class' => 'Class',
    'field.schedule_type' => 'Schedule Type',
    'field.days' => 'Days',
    'field.startDate' => 'Start Date',
    'field.endDate' => 'End Date',
    'field.startTime' => 'Start Time',
    'field.employee' => 'Employee',
    'field.add_employee' => 'Add Employee',
    'field.add_station' => 'Add Station',
    'field.trip_informations' => 'Trip Informations',
    'field.phone' => 'Phone',
    'field.employee_phone' => 'Employee Phone',
    'field.name' => 'Name',
    'field.status' => 'Status',
    'field.approve' => 'Approve',
    'field.decline' => 'Decline',
    'field.pleaseEnterName' => 'Please Enter Name',
    'field.pleaseEnterPhone' => 'Please Enter Phone',
    'field.pleaseEnterEmployeePhone' => 'Please Enter Employee Phone',
    'field.tripTable.routeName' => 'Route',
    'field.tripTable.date' => 'Date',
    'field.tripTable.driver' => 'Driver',
    'field.tripTable.vehicle' => 'Vehicle',
    'field.tripTable.vehicleType' => 'Vehicle Type',
    'field.tripTable.status' => 'Status',
    'field.tripTable.capacity' => 'Capacity',
    'field.tripTable.clientPrice' => 'Client Price',
    'field.tripTable.driverPrice' => 'Driver Price',
    'field.tripTable.EGP' => 'EGP',
    'field.old_station_id' => 'Old Station',
    'field.station_id' => 'New Station',
    'field.updated_by_id' => 'Updated By',
    'field.updated_at' => 'Updated At',
    'field.date' => 'Date',
    'field.time' => 'Time',
    'field.route' => 'Route',
    'field.settings' => 'Settings',
    'field.employees' => 'Employees',
    'field.arrival_time' => 'Arrival Time',
    'field.diff_arrival_time' => 'Diff Arrival Time',
    'field.reason' => 'Reason',
    'field.allEmployeesCount' => 'The number of all employees',
    'field.arrival_allowance_time' => 'Arrival Allowance Time',
    'field.time_with_arrival_allowance' => 'Time With Arrival Allowance',
    'field.riderCode' => 'R-Q',

    'field.trip.status.available' => 'Available',
    'field.trip.status.not_started' => 'Not Started',
    'field.trip.status.started' => 'Started',
    'field.trip.status.completed' => 'Completed',
    'field.trip.status.cancelled' => 'Cancelled',
    'field.trip.status.stopped' => 'Stopped',
    'field.trip.status.1' => 'Completed',
    'field.trip.status.' => 'Not Completed',

    'field.employee.status.pending' => 'Pending',
    'field.employee.status.approved' => 'Approved',
    'field.employee.status.declined' => 'Declined',

    'field.weekdays.sunday' => 'Sunday',
    'field.weekdays.monday' => 'Monday',
    'field.weekdays.tuesday' => 'Tuesday',
    'field.weekdays.wednesday' => 'Wednesday',
    'field.weekdays.thursday' => 'Thursday',
    'field.weekdays.friday' =>'Friday',
    'field.weekdays.saturday' => 'Saturday',
    'field.toCancelTheTripPleaseClickOnThisButton' => 'To Cancel The Trip Please Click On This Button',
    'field.cancelTheTrip' => 'Cancel The Trip',

    // Validation
    'validation.company_id.required' => 'The Company field is required',
    'validation.branch_id.required' => 'The Branch field is required',
    'validation.type.required' => 'The Type field is required',
    'validation.from_en.required' => 'The From EN field is required',
    'validation.from_ar.required' => 'The From AR field is required',
    'validation.to_en.required' => 'The To EN field is required',
    'validation.to_ar.required' => 'The To AR field is required',
    'validation.station_ids.required' => 'The Stations field is required',

    'validation.route_id.required' => 'The Route Id field is required',
    'validation.route_id.exists' => 'The Route Id Not exists.',
    'validation.employee_id.required' => 'The Employee field is required',
    'validation.start_time.required' => 'The Start Time field is required',
    'validation.employee_ids.required' => 'The Employees field is required',
    'validation.client_price.required' => 'The Client Price field is required',
    'validation.driver_price.required' => 'The Driver Price field is required',
    'validation.start_date.required' => 'The Start Date field is required',
    'validation.driver_id.required' => 'The Driver field is required',
    'validation.vehicle_id.required' => 'The Vehicle field is required',
    'validation.status.required' => 'The Status field is required',
    'validation.class.required' => 'The Class field is required',
    'validation.route_schedule_ids.required' => 'The Route Schedule field is required',
    'validation.client_prices.required' => 'The Client Prices field is required',
    'validation.driver_prices.required' => 'The Driver Prices field is required',
    'validation.route_types.required' => 'The Route Types field is required',
    'validation.supplier_ids.required' => 'The Supplier field is required',
    'validation.driver_ids.required' => 'The Driver field is required',
    'validation.vehicle_ids.required' => 'The Vehicle field is required',
    'validation.days.required' => 'The Days field is required',
    'validation.start_dates.required' => 'The Start Dates field is required',
    'validation.times.required' => 'The Times field is required',
    'validation.trip_id.required' => 'The Trip field is required',
    'validation.driver_confirmed.required' => 'The Driver Confirmed field is required',
    'validation.old_station_id.required' => 'The Old Station field is required',
    'validation.status_action_reasons.required_if' => 'The Reason field is required when :other is :value.',
    'validation.trip.exists' => 'The Trip already exists',
    'validation.updateSchedule.checkStartDates' => 'The Start Date :start_date must be a date after or equal to :date_now. Schedule: :start_time',
    'validation.updateSchedule.checkEndDates' => 'The End Date :end_date must be a date after or equal to :start_date. Schedule: :start_time',


    // Messages
    'message.created' => 'The Route Created Successfully',
    'message.updated' => 'The Route Updated Successfully',
    'message.deleted' => 'The Route Deleted Successfully',
    'message.notFound' => 'The Route Not Found',

    'trip.message.created' => 'The Trip Created Successfully',
    'trip.message.updated' => 'The Trip Updated Successfully',
    'trip.message.deleted' => 'The Trip Deleted Successfully',
    'trip.message.dispatchUpdated' => 'The Trips Dispatched Successfully',
    'trip.message.notFound' => 'The Trip Not Found',
    'trip.message.pleaseChooseEmployeeFirst' => 'Please Choose Employee First',

    'assignEmployee.message.updated' => 'The Assign Employee Updated Successfully',
    'assignEmployee.message.deleted' => 'The Assign Employee Deleted Successfully',

    //Api Messages
    'api.message.updated' => 'The Route Updated Successfully',
    'api.message.updateLocationError' => 'Can not update location until admin approve or decline this request',
    'api.message.driverConfirmError' => 'You have exceeded the time allowed to confirm this trip',
    'api.message.driverNotConfirmError' => 'Please confirm the trip first',

    //Notify Messages
    'message.notify.title.driverNotConfirmTrip' => 'Driver Reject The Trip',
    'message.notify.body.driverNotConfirmTrip' => 'Driver Name :driverName Rejected starting the trip :tripName <br> the reason is :reason',

    'message.notify.title.driverConfirmTrip' => 'Driver Confirmed The Trip',
    'message.notify.body.driverConfirmTrip' => 'Driver Name :driverName <br> Will start the Trip :tripName',

    'message.notify.title.driverNotStartTrip' => 'New Trip Not Started',
    'message.notify.body.driverNotStartTrip' => 'Driver Name :driverName <br> For Trip :tripName',

    //SMS Messages
    'message.sms.informingEmployeeTripCommingWithGoogleLink' => 'Captain :driverName It will reach your point at :minutes minute by car :carModel
    Captain number: :driverPhoneNumber
    Car number : :platesNumber
    Click on this link to go to your point
    :stationLink',

    'message.sms.informingEmployeeTripCommingWithoutLink' => 'Captain :driverName It will reach your point at :minutes minute by car :carModel
    Captain number: :driverPhoneNumber
    Car number : :platesNumber',
];
