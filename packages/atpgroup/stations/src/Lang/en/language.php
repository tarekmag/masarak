<?php

return [

    /*
    |--------------------------------------------------------------------------
    | English Language Lines
    |--------------------------------------------------------------------------
     */

    // Fields
    'field.station' => 'Station',
    'field.district' => 'District',
    'field.name' => 'Name',
    'field.name_ar' => 'Name Ar',
    'field.name_en' => 'Name En',
    'field.pickup_name_en' => 'Pickup Name En',
    'field.pickup_name_ar' => 'Pickup Name Ar',
    'field.drop_name_en' => 'Drop Name En',
    'field.drop_name_ar' => 'Drop Name En',
    'field.pickup_lat' => 'Latitude Pickup',
    'field.pickup_lng' => 'Longitude Pickup',
    'field.drop_lat' => 'Latitude Drop',
    'field.drop_lng' => 'Longitude Drop',
    'field.address' => 'Address',
    'field.address_ar' => 'Address Ar',
    'field.address_en' => 'Address EN',
    'field.map' => 'Map',
    'field.pickup_map' => 'Pickup Map',
    'field.drop_map' => 'Drop Map',
    'field.pleaseEnterName' => 'Please Enter Name',
    'field.pleaseEnterName_ar' => 'Please Enter Name Ar',
    'field.pleaseEnterName_en' => 'Please Enter Name En',

    // Validation
    'validation.district_id.required' => 'The District field is required',
    'validation.name_ar.required' => 'The Name Ar field is required',
    'validation.name_en.required' => 'The Name En field is required',
    'validation.lat.required' => 'The lat field is required',
    'validation.lng.required' => 'The lng field is required',
    'validation.name_ar.unique' => 'The Name Ar has already been taken.',
    'validation.name_en.unique' => 'The Name En has already been taken.',
    'validation.pickup_lat.required_if' => 'The pickup lat field is required when drop lat is empty.',
    'validation.pickup_lng.required_if' => 'The pickup lng field is required when drop lng is empty.',

    // Messages
    'message.created' => 'The Station Created Successfully',
    'message.updated' => 'The Station Updated Successfully',
    'message.deleted' => 'The Station Deleted Successfully',
    'message.notFound' => 'The Station Not Found',
];
