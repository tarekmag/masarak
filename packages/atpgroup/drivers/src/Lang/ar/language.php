<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Arabic Language Lines
    |--------------------------------------------------------------------------
     */

   // Fields
   'field.name' => 'الاسم',
   'field.mobile_number' => 'رقم الهاتف',
   'field.type' => 'النوع',
   'field.personal_photo' => 'الصورة',
   'field.individual' => 'فرد',
   'field.supplier' => 'مورد',
   'field.location' => 'المكان',
   'field.location_time' => 'وقت المكان :time',
   'field.pleaseEnterName' => 'الرجاء ادخال الاسم',
   'field.pleaseEnterMobileNumber' => 'الرجاء ادخال رقم الهاتف',
   'field.pleaseEnterType' => 'الرجاء اختيار النوع',
   'field.document.print' => 'طباعه',

   'field.documents' => 'الملفات',
   'field.driver' => 'السائق',
   'field.document_type' => 'نوع الملف',
   'field.document' => 'الملف',
   'field.vehicle' => 'عربة',
   'field.vehicle_count' => 'عدد العربات',
   'field.status' => 'الحالات',
   'field.driver_status' => 'حالة السواق',
   'field.trip_status' => 'حالة الرحلة',
   'field.expiration_date' => 'تاريخ الإنتهاء',
   'field.documentStatus.pending' => 'قيد الإنتظار',
   'field.documentStatus.approved' => 'موافق',
   'field.documentStatus.declined' => 'مرفوض',
   'field.documentType.personal_driving_license' => 'رخصة القيادة الشخصية',
   'field.documentType.feesh_we_tashbeeh' => 'فيش وتشبيه',
   'field.documentType.drug_report' => 'تقرير المخدرات',
   'field.document.print' => 'طباعه',

   // Validation
   'validation.name.required' => 'الأسم مطلوب',
   'validation.mobile_number.required' => 'رقم الهاتف مطلوب',
   'validation.mobile_number.unique' => 'رقم الهاتف مستخدم من قبل',
   'validation.mobile_number.exists' => 'رقم الهاتف المحمول غير موجود',
   'validation.personal_photo.required' => 'الصورة مطلوبة',
   'validation.type.required' => 'النوع مطلوب',
   'validation.password.required' => 'حقل كلمة المرور مطلوب',
   'validation.password.min' => 'يجب أن يكون حقل كلمة المرور على الأقل :min.',
   'validation.password_confirmation.required' => 'حقل تأكيد كلمة المرور مطلوب',
   'validation.confirmed.required' => 'تأكيد كلمة المرور لا يتطابق مع كلمة المرور',
   'validation.device_token.required' => 'حقل الرمز المميز للجهاز مطلوب',
   'validation.device_type.required' => 'حقل نوع الجهاز مطلوب',
   'validation.otp_code.required' => 'كود OTP مطلوب',
   'validation.otp_code.numeric' => 'يجب أن يكون رمز otp رقميًا.',
   'validation.driver_id.required' => 'حقل السائق مطلوب',
   'validation.document_type.required' => 'حقل النوع مطلوب',
   'validation.document.required' => 'حقل المستند مطلوب',
   'validation.mobile_number.invalid' => 'يجب أن يتكون الهاتف الخطأ من 11 رقمًا.',
   'validation.current_password.not_match' => 'كلمة المرور الحالية غير صحيحة.',
   'validation.vehicle_ids.required' => 'حقل المركبات مطلوب',
   'validation.vehicle_ids.exists' => 'تم أخذ المركبات بالفعل',


    // Messages
    'message.created' => 'تم إنشاء السائق بنجاح',
    'message.updated' => 'تم تحديث السائق بنجاح',
    'message.deleted' => 'تم حذف السائق بنجاح',
    'message.notFound' => 'السائق غير موجود',

    // Messages.document
    'message.document.created' => 'تم إنشاء المستند بنجاح',
    'message.document.updated' => 'تم تحديث المستند بنجاح',
    'message.document.deleted' => 'تم حذف المستند بنجاح',
    'message.document.notFound' => 'لم يتم العثور على المستند',
    'message.notify.title.driverDocumentIsExpired' => 'ستنتهي صلاحية رخصة القيادة في غضون :daysNumber أيام',
    'message.notify.body.driverDocumentIsExpired' => ':documentType <br> :driverName <br> :driverPhone',

    'message.vehicle.created' => 'تم إنشاء المركبة بنجاح',
    'message.vehicle.updated' => 'المركبة تم تحديثها بنجاح',
    'message.vehicle.deleted' => 'تم حذف المركبة بنجاح',
    'message.vehicle.notFound' => 'لم يتم العثور على المركبة',

    //API
    'api.message.wrongPhoneOrPassword' => 'رقم الهاتف المحمول أو كلمة المرور غير صحيحة',
    'api.message.notFound' => 'غير موجود',
    'api.message.logout' => 'تسجيل خروج',
    'api.message.codeIsInvalid' => 'الكود غير صالح',
    'api.message.codeIsCorrect' => 'الكود صحيح',
    'api.message.successSendCode' => 'تم إرسال الرمز بنجاح',
    'api.message.otp_code' => 'الكود هو :code',

    //Notify
    'message.notify.title.welcome' => 'ازيك يا كابتن :driverName',
    'message.notify.body.welcome' => 'شكرا انك قررت تبقي شريك لترانسيك لخدمات النقل الذكيه المركبه الخاصه بك :vehicleName موديل :modelName رقم اللوحه :plateNumber',

    'message.notify.title.assignTripToDriver' => 'ازيك يا كابتن :driverName',
    'message.notify.body.assignTripToDriver' => 'لقد تم اضافه رحله علي حسابك يوم :tripDate الساعه :tripTime بدايه الخط :startRouteName والنهايه :endRouteName عدد محطات التوقف :stationsCount محطات بعدد :employeesCount راكب',

    'message.notify.title.beforeStartingTrip' => 'ازيك يا كابتن :driverName',
    'message.notify.body.beforeStartingTrip' => 'بنفكرك ان في رحله تبدا :tripDate الساعه :tripTime بدايه الخط :startRouteName والنهايه :endRouteName عدد محطات التوقف :stationsCount محطات بعدد :employeesCount راكب',

    'message.notify.title.confirmationTripBeforeStarting' => 'ازيك يا كابتن :driverName',
    'message.notify.body.confirmationTripBeforeStarting' => 'من فضلك ابدا الرحله واتحرك لاول محطه بدايه الخط :startRouteName والنهايه :endRouteName عدد محطات التوقف :stationsCount محطات بعدد :employeesCount راكب',

    'message.notify.title.driverCompletedTrip' => 'ازيك يا كابتن :driverName',
    'message.notify.body.driverCompletedTrip' => 'شكرا انك اكدت انتهاء الرحله تم اضافه الفلوس علي رصيدك بدايه الخط :startRouteName والنهايه :endRouteName عدد محطات التوقف :stationsCount محطات بعدد :employeesCount راكب',
];
