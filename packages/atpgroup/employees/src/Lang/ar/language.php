<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Arabic Language Lines
    |--------------------------------------------------------------------------
     */  

    // Fields
    'field.mainBranch' => 'الفرع الرئيسى',
    'field.branch' => 'الفرع',
    'field.station' => 'محطة',
    'field.name' => 'الاسم',
    'field.phone' => 'الهاتف',
    'field.email' => 'البريد الإلكتروني',
    'field.image' => 'الصورة',
    'field.is_leader' => 'قائد',
    'field.employee' => 'الموظف',

    'field.pleaseEnterCompany_id' => 'الرجاء إختيار شركة',
    'field.pleaseEnterName' => 'الرجاء اختيار اسم',
    'field.pleaseEnterPhone' => 'الرجاء اختيار الهاتف',
    'field.pleaseEnterEmail' => 'الرجاء اختيار البريد الإلكتروني',

    // Validation
    'validation.company_id.required' => 'حقل الشركة مطلوب',
    'validation.company_id.numeric' => 'يجب أن يكون حقل الشركة رقميًا.',
    'validation.branch_id.required' => 'حقل الفرع مطلوب',
    'validation.branch_id.required' => 'يجب أن يكون حقل الفرع رقميًا.',
    'validation.name.required' => 'حقل الاسم مطلوب',
    'validation.phone.required' => 'حقل الهاتف مطلوب',
    'validation.phone.unique' => 'رقم الهاتف مستخدم من قبل',
    'validation.phone.invalid' => 'يجب أن يتكون الهاتف من 11 رقمًا.',
    'validation.email.required' => 'حقل البريد الإلكتروني مطلوب',
    'validation.email.unique' => 'البريد الإلكتروني مستخدم من قبل',

    // Messages
    'message.created' => 'تم إنشاء الموظف',
    'message.updated' => 'تم تحديث الموظف',
    'message.deleted' => 'تم حذف الموظف',
    'message.notFound' => 'الموظف غير موجود',
];
