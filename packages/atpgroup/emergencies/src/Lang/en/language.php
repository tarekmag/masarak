<?php

return [

    /*
    |--------------------------------------------------------------------------
    | English Language Lines
    |--------------------------------------------------------------------------
     */

    // Fields
    'field.emergency' => 'Emergency',
    'field.name' => 'Name',
    'field.name_ar' => 'Name Ar',
    'field.name_en' => 'Name En',
    'field.mobile_number' => 'Mobile Number',
    'field.message' => 'Message',
    'field.trip' => 'Trip',
    'field.image' => 'Image',
    'field.created_at' => 'Created At',
    'field.pleaseEnterName' => 'Please Enter Name',
    'field.pleaseEnterMobileNumber' => 'Please Enter Mobile Number',

    // Validation
    'validation.name_ar.required' => 'The Name Ar field is required',
    'validation.name_en.required' => 'The Name En field is required',
    'validation.name_ar.unique' => 'The Name Ar has already been taken.',
    'validation.name_en.unique' => 'The Name En has already been taken.',

    'validation.emergency_id.required' => 'The Emargency field is required',
    'validation.emergency_id.exists' => 'The Emargency field Not exists.',
    'validation.trip_id.required' => 'The Trip field is required',
    'validation.driver_name.required' => 'The Driver Name field is required',
    'validation.message.required' => 'The Message field is required',
    'validation.mobile_number.invalid' => 'Wrong phone must be 11 digits.',


    // Messages
    'message.created' => 'The Emergency Created Successfully',
    'message.updated' => 'The Emergency Updated Successfully',
    'message.deleted' => 'The Emergency Deleted Successfully',
    'message.notFound' => 'The Emergency Not Found',
    'message.notify.title.newRequest' => 'New Emergency Request Arrived',
    'message.notify.body.newRequest' => 'For :tripName <br> Driver Name :driverName <br> Message :message',
];
