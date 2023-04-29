<?php

return [

    /*
    |--------------------------------------------------------------------------
    | English Language Lines
    |--------------------------------------------------------------------------
     */   

    // Fields
    
    'field.brand' => 'Brand',
    'field.brand_model' => 'Brand Model',
    'field.vehicle_type' => 'Vehicle Type',
    'field.plate_number' => 'Plate Number',
    'field.color_en' => 'Color En',
    'field.color' => 'Color',
    'field.color_ar' => 'Color Ar',
    'field.color_code' => 'Color Code',
    'field.number_seats' => 'Number Seats',
    'field.vehicle_year' => 'Vehicle Year',

    'field.pleaseEnterVehicleType' => 'Please Enter Vehicle Type',
    'field.pleaseEnterPlateNumber' => 'Please Enter Plate Number',
    'field.pleaseEnterBusModel' => 'Please Enter Bus Model',
    'field.pleaseEnterNumberSeats' => 'Please Enter Number Seats',

    'field.documents' => 'Documents',
    'field.vehicle' => 'Vehicle',
    'field.document_type' => 'Document Type',
    'field.document' => 'Document',
    'field.status' => 'Status',
    'field.type' => 'Type',
    'field.documentStatus.pending' => 'Pending',
    'field.documentStatus.approved' => 'Approved',
    'field.documentStatus.declined' => 'Declined',
    'field.documentType.license' => 'License',
    'field.documentType.fa7s' => 'Fa7s',
    'field.document.print' => 'Print',


    // Validation
    'validation.vehicle_type.required' => 'The Vehicle Type field is required',
    'validation.plate_number.required' => 'The Plate Number field is required',
    'validation.plate_number.unique' => 'The Plate Number has already been taken.',
    'validation.bus_model_en.required' => 'The Bus Model field is required',
    'validation.bus_model_en.required' => 'The Bus Model Ar Model field is required',
    'validation.color_en.required' => 'The Color field is required',
    'validation.color_ar.required' => 'The Color Ar field is required',
    'validation.number_seats.required' => 'The Number Seats field is required',
    'validation.brand_id.required' => 'The Brand field is required',
    'validation.brand_model_id.required' => 'The Brand Model field is required',

    'validation.vehicle_id.required' => 'The Vehicle field is required',
    'validation.document_type.required' => 'The Vehicle Document Type field is required',
    'validation.status.required' => 'The Status field is required',
    'validation.document.required' => 'The Vehicle Document field is required',

    // Messages
    'message.created' => 'The Vehicle Created Successfully',
    'message.updated' => 'The Vehicle Updated Successfully',
    'message.deleted' => 'The Vehicle Deleted Successfully',
    'message.notFound' => 'The Vehicle Not Found',

    'message.document.created' => 'The Vehicle Document Created Successfully',
    'message.document.updated' => 'The Vehicle Document Updated Successfully',
    'message.document.deleted' => 'The Vehicle Document Deleted Successfully',
    'message.document.notFound' => 'The Vehicle Document Not Found',
];
