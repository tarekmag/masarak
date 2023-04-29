<?php

return [

    /*
    |--------------------------------------------------------------------------
    | English Language Lines
    |--------------------------------------------------------------------------
     */

   // Fields
   'field.name' => 'Name',
   'field.mobile_number' => 'Mobile Number',
   'field.type' => 'Type',
   'field.personal_photo' => 'Personal Photo',
   'field.individual' => 'Individual',
   'field.supplier' => 'Supplier',
   'field.location' => 'Location',
   'field.location_time' => 'Location Time: :time',
   'field.pleaseEnterType' => 'Please Enter Type',
   'field.pleaseEnterMobileNumber' => 'Please Enter Mobile Number',
   'field.pleaseEnterName' => 'Please Enter Name',

   'field.documents' => 'Documents',
   'field.driver' => 'Driver',
   'field.document_type' => 'Document Type',
   'field.document' => 'Document',
   'field.vehicle' => 'Vehicle',
   'field.vehicle_count' => 'Vehicle Count',
   'field.status' => 'Status',
   'field.available' => 'Available',
   'field.not_available' => 'Not Available',
   'field.driver_status' => 'Driver Status',
   'field.trip_status' => 'Trip Status',
   'field.expiration_date' => 'Expiration Date',
   'field.documentStatus.pending' => 'Pending',
   'field.documentStatus.approved' => 'Approved',
   'field.documentStatus.declined' => 'Declined',
   'field.documentType.personal_driving_license' => 'Personal Driving License',
   'field.documentType.feesh_we_tashbeeh' => 'Feesh We Tashbeeh',
   'field.documentType.drug_report' => 'Drug Report',
   'field.document.print' => 'Print',

   // Validation
   'validation.name.required' => 'The Name field is required',
   'validation.mobile_number.required' => 'The Mobile Number field is required',
   'validation.mobile_number.unique' => 'The Mobile Number has already been taken.',
   'validation.mobile_number.exists' => 'The Mobile Number Not exists.',
   'validation.personal_photo.required' => 'The Personal Photo field is required',
   'validation.type.required' => 'The type field is required',
   'validation.password.required' => 'The password field is required',
   'validation.password.min' => 'The password field must be at least :min.',
   'validation.password_confirmation.required' => 'The password confirmation field is required',
   'validation.confirmed.required' => 'The password confirmation not match password',
   'validation.device_token.required' => 'The device token field is required',
   'validation.device_type.required' => 'The device type field is required',
   'validation.otp_code.required' => 'The otp code field is required',
   'validation.otp_code.numeric' => 'The otp code must be numeric.',
   'validation.driver_id.required' => 'The Driver field is required',
   'validation.document_type.required' => 'The Type field is required',
   'validation.document.required' => 'The Document field is required',
   'validation.mobile_number.invalid' => 'Wrong phone must be 11 digits.',
   'validation.current_password.not_match' => 'The current password is incorrect.',
   'validation.vehicle_ids.required' => 'The vehicles field is required',
   'validation.vehicle_ids.exists' => 'The vehicles has already been taken',



    // Messages
    'message.created' => 'The Driver Created Successfully',
    'message.updated' => 'The Driver Updated Successfully',
    'message.deleted' => 'The Driver Deleted Successfully',
    'message.notFound' => 'The Driver Not Found',

    // Messages.document
    'message.document.created' => 'The Document Created Successfully',
    'message.document.updated' => 'The Document Updated Successfully',
    'message.document.deleted' => 'The Document Deleted Successfully',
    'message.document.notFound' => 'The Document Not Found',
    'message.notify.title.driverDocumentIsExpired' => 'The driver license will expire within :daysNumber days',
    'message.notify.body.driverDocumentIsExpired' => ':documentType <br> :driverName <br> :driverPhone',

    'message.vehicle.created' => 'The Vehicle Created Successfully',
    'message.vehicle.updated' => 'The Vehicle Updated Successfully',
    'message.vehicle.deleted' => 'The Vehicle Deleted Successfully',
    'message.vehicle.notFound' => 'The Vehicle Not Found',

    //API
    'api.message.wrongPhoneOrPassword' => 'Wrong mobile number or password',
    'api.message.notFound' => 'Not found',
    'api.message.logout' => 'Logout',
    'api.message.codeIsInvalid' => 'The code is invalid',
    'api.message.codeIsCorrect' => 'The code is correct',
    'api.message.successSendCode' => 'The code send successfully',
    'api.sms.message.otp_code' => 'The Code is :code',

    //Notify
    'message.notify.title.welcome' => 'How are you, captain? :driverName',
    'message.notify.body.welcome' => 'Thank you for deciding to become a partner of Transic for Intelligent Transportation Services Your Vehicle :vehicleName Model :modelName Plate number :plateNumber',

    'message.notify.title.assignTripToDriver' => 'How are you, captain? :driverName',
    'message.notify.body.assignTripToDriver' => 'A trip has been added to your account on :tripDate at :tripTime The beginning of the line is :startRouteName and the end is :endRouteName The number of stops is :stationsCount stations with a capacity of :employeesCount passengers',

    'message.notify.title.beforeStartingTrip' => 'How are you, captain? :driverName',
    'message.notify.body.beforeStartingTrip' => 'We think that a journey begins :tripDate at :tripTime The beginning of the line is :startRouteName and the end is :endRouteName The number of stops is :stationsCount stations with a capacity of :employeesCount passengers',

    'message.notify.title.confirmationTripBeforeStarting' => 'How are you, captain? :driverName',
    'message.notify.body.confirmationTripBeforeStarting' => 'Please start the journey and move to the first stop The beginning of the line is :startRouteName and the end is :endRouteName The number of stops is :stationsCount stations with a capacity of :employeesCount passengers',

    'message.notify.title.driverCompletedTrip' => 'How are you, captain? :driverName',
    'message.notify.body.driverCompletedTrip' => 'Thank you for confirming the end of the trip. The money has been added to your balance, the trip. the first stop The beginning of the line is :startRouteName and the end is :endRouteName The number of stops is :stationsCount stations with a capacity of :employeesCount passengers',

];
