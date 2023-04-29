<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Arabic Language Lines
    |--------------------------------------------------------------------------
     */

    // Fields
    'field.station' => 'المحطة',
    'field.district' => 'منطقة',
    'field.name' => 'اﻻسم',
    'field.name_ar' => 'اﻻسم عربى',
    'field.name_en' => 'الاسم بالإنجليزية',
    'field.lat' => 'خط الطول',
    'field.lng' => 'خط العرض',
    'field.address' => 'العنوان',
    'field.address_ar' => 'العنوان',
    'field.address_en' => 'العنوان بالإنجليزية',
    'field.map' => 'الخريطة',
    'field.pleaseEnterName' => 'الرجاء ادخال الاسم ',
    'field.pleaseEnterName_ar' => 'الرجاء ادخال الاسم ',
    'field.pleaseEnterName_en' => 'الرجاء ادخال الاسم بالانجليزية',
    'field.pickup_name_en' => 'محطة الصعود En',
    'field.pickup_name_ar' => 'محطة الصعود Ar',
    'field.drop_name_en' => 'محطة النزول En',
    'field.drop_name_ar' => 'محطة النزول En',
    'field.pickup_lat' => 'التقاط خطوط العرض',
    'field.pickup_lng' => 'التقاط خط الطول',
    'field.drop_lat' => 'نزول خطوط العرض',
    'field.drop_lng' => 'نزول خط الطول',
    'field.pickup_map' => 'خريطة السعود',
    'field.drop_map' => 'خريطة النزول',


    // Validation
    'validation.name_ar.required' => 'حقل الأسم مطلوب',
    'validation.name_en.required' => 'حقل الاسم بالانجليزية مطلوب',
    'validation.lat.required' => 'حقل خط الطول مطلوب',
    'validation.lng.required' => 'حقل خط العرض مطلوب',
    'validation.name_ar.unique' => 'الاسم مستخدم من قبل',
    'validation.name_en.unique' => 'الاسم بالإنجلزية مستخدم من قبل',
    'validation.district_id.required' => 'حقل المنطقة مطلوب',
    'validation.pickup_lat.required_if' => 'خط الطول للصعود مطلوب عندما يكون خط الطول للنزول فارغ',
    'validation.pickup_lng.required_if' => 'خط العرض للصعود مطلوب عندما يكون خط العرض للنزول فارغ',

    // Messages
    'message.created' => 'تم إنشاء المحطة بنجاح',
    'message.updated' => 'تم تحديث المحطة بنجاح',
    'message.deleted' => 'تم حذف المحطة بنجاح',
    'message.notFound' => 'المحطة غير موجودة',
];
