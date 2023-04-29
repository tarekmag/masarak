<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Arabic Language Lines
    |--------------------------------------------------------------------------
     */

    // Fields
    'field.emergency' => 'طارئ',
    'field.name' => 'الإسم',
    'field.name_ar' => 'الإسم بالعربية',
    'field.name_en' => 'الإسم بالإنجليزية',
    'field.mobile_number' => 'رقم الموبايل',
    'field.message' => 'رسالة',
    'field.trip' => 'الرحلة',
    'field.image' => 'صورة',
    'field.created_at' => 'أنشئت في',
    'field.pleaseEnterName' => 'الرجاء إدخال الاسم',
    'field.pleaseEnterMobileNumber' => 'الرجاء إدخال رقم الهاتف المحمول',

    // Validation
    'validation.name_ar.required' => 'حقل الاسم بالعربية مطلوب',
    'validation.name_en.required' => 'حقل الاسم بالإنجليزية مطلوب',
    'validation.name_ar.unique' => 'تم استخدام الاسم بالعربية بالفعل.',
    'validation.name_en.unique' => 'تم استخدام الاسم بالإنجليزية بالفعل.',

    'validation.emergency_id.required' => 'حقل الطوارئ مطلوب',
    'validation.emergency_id.exists' => 'حقل الطوارئ غير موجود.',
    'validation.trip_id.required' => 'حقل الرحلة مطلوب',
    'validation.driver_name.required' => 'حقل اسم السائق مطلوب',
    'validation.message.required' => 'حقل الرسالة مطلوب',
    'validation.mobile_number.invalid' => 'يجب أن يتكون الهاتف الخطأ من 11 رقمًا.',


    // Messages
    'message.created' => 'تم إنشاء حالة الطوارئ بنجاح',
    'message.updated' => 'تم تحديث حالة الطوارئ بنجاح',
    'message.deleted' => 'تم حذف حالة الطوارئ بنجاح',
    'message.notFound' => 'لم يتم العثور على حالة الطوارئ',
    'message.notify.title.newRequest' => 'وصل طلب طوارئ جديد',
    'message.notify.body.newRequest' => ':tripName <br> اسم السائق :driverName <br> رسالة :message',
];
