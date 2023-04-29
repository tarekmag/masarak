<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Arabic Language Lines
    |--------------------------------------------------------------------------
     */  

    // Fields
    
    'field.brand' => 'العلامة التجارية',
    'field.brand_model' => 'نوع العلامة التجارية',
    'field.vehicle_type' => 'نوع المركبة',
    'field.plate_number' => 'رقم  اللوحة',
    'field.color_en' => 'اللون بالإنجليزية',
    'field.color_ar' => 'اللون بالعربية',
    'field.color_code' => 'رقم اللون',
    'field.color' => 'اللون',
    'field.number_seats' => 'عدد المقاعد',
    'field.vehicle_year' => 'سنة المركبة',

    'field.pleaseEnterVehicleType' => 'الرجاء ادخال نوع  المركبة',
    'field.pleaseEnterPlateNumber' => 'الرجاء ادخال رقم اللوحة',
    'field.pleaseEnterBusModel' => 'الرجاء ادخال اسم المركبة',
    'field.pleaseEnterNumberSeats' => 'الرجاء ادخال عدد المقاعد',

    'field.documents' => 'المستندات',
    'field.vehicle' => 'المركبة',
    'field.document_type' => 'نوع المستند',
    'field.document' => 'المستند',
    'field.status' => 'الحالة',
    'field.type' => 'النوع',
    'field.documentStatus.pending' => 'قيد الإنتظار',
    'field.documentStatus.approved' => 'موافقة',
    'field.documentStatus.declined' => 'مرفوض',
    'field.documentType.license' => 'رخصة',
    'field.documentType.fa7s' => 'فحص',
    'field.document.print' => 'طباعة',

    // Validation
    'validation.vehicle_type.required' => 'نوع المركبة مطلوب',
    'validation.plate_number.required' => 'رقم اللحوة مطلوبة',
    'validation.plate_number.unique' => 'رقم اللوحة مستخدم من قبل',
    'validation.bus_model_ar.required' => 'اسم المركبة مطلوب',
    'validation.bus_model_en.required' => 'اسم المركبة بالإنجليزية مطلوب',
    'validation.color_en.required' => 'اللون بالإنجليزية مطلوب',
    'validation.color_ar.required' => 'اللون مطلوب',
    'validation.number_seats.required' => 'عدد المقاعد مطلوب',
    'validation.brand_id.required' => 'حقل العلامة التجارية مطلوب',
    'validation.brand_model_id.required' => 'حقل نوع العلامة التجارية مطلوب',

    'validation.vehicle_id.required' => 'رقم المركبة مطلوب',
    'validation.document_type.required' => 'نوع مستندات المركبة مطلوب',
    'validation.status.required' => 'الحالة مطلوبة',
    'validation.document.required' => 'مستندات المركبة مطلوبة',

    // Messages
    'message.created' => 'تم إنشاء المركبة بنجاح',
    'message.updated' => 'تم تحديث المركبة بنجاح',
    'message.deleted' => 'تم حذف المركبة بنجاح',
    'message.notFound' => 'المركبة غير موجودة',

    'message.document.created' => 'تم إنشاء مستندات المركبة بنجاح',
    'message.document.updated' => 'تم تحديث مستندات المركبة بنجاح',
    'message.document.deleted' => 'تم حذف مستندات المركبة بنجاح',
    'message.document.notFound' => 'مستندات المركبة غير موجودة',
];
