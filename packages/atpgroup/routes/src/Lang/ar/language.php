<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Arabic Language Lines
    |--------------------------------------------------------------------------
     */

    // Pages
    'page.submit' => 'Submit',
    'page.actions' => 'إجراء',
    'page.form' => 'شكل',
    'page.map' => 'خريطة',
    'page.stations' => 'محطات',
    'page.schedule' => 'جدولة',
    'page.trips' => 'رحلات',
    'page.route_info' => 'معلومات الطريق',
    'page.trip_info' => 'معلومات الرحلة',
    'page.show_trip' => 'عرض / تحديث الرحلة',
    'page.create_trip' => 'إنشاء رحلة',
    'page.dispatch_trips' => 'إيفاد الرحلات الآن',

    //Fields
    'field.searchStation' => 'ابحث عن محطة',
    'field.station' => 'محطة',
    'field.trips' => 'الرحلات',
    'field.company' => 'شركة',
    'field.type.economy' => 'اقتصادي',
    'field.type.business' => 'رجال اعمال',
    'field.type.scheduled' => 'مجدول',
    'field.type.manual' => 'دليل',
    'field.type.special_request' => 'طلب خاص',
    'field.from_en' => 'من EN',
    'field.from_ar' => 'من AR',
    'field.to_en' => 'إلي EN',
    'field.to_ar' => 'إلي AR',
    'field.type' => 'نوع الرحلة',
    'field.route_id' => 'الرحلة Id',
    'field.driver_id' => 'السائق',
    'field.vehicle_id' => 'المركبة',
    'field.company_id' => 'الشركة',
    'field.isReturn' => 'عودة',
    'field.isActive' => 'نشط',
    'field.arrivalAllowance' => 'بدل التوصيل',
    'field.clientPrice' => 'سعر العميل',
    'field.driverPrice' => 'سعر السائق',
    'field.class' => 'فئة',
    'field.schedule_type' => 'نوع الجدولة',
    'field.days' => 'أيام',
    'field.startDate' => 'تاريخ البدء',
    'field.endDate' => 'تاريخ الإنتهاء',
    'field.startTime' => 'وقت البدء',
    'field.employee' => 'موظف',
    'field.add_employee' => 'إضافة موظف',
    'field.add_station' => 'إضافة محطة',
    'field.trip_informations' => 'معلومات الرحلة',
    'field.phone' => 'الهاتف',
    'field.employee_phone' => 'هاتف الموظف',
    'field.name' => 'الأسم',
    'field.status' => 'الحالة',
    'field.approve' => 'موافق',
    'field.decline' => 'رفض',
    'field.pleaseEnterName' => 'الرجاء إدخال الاسم',
    'field.pleaseEnterPhone' => 'الرجاء إدخال الهاتف',
    'field.pleaseEnterEmployeePhone' => 'الرجاء إدخال هاتف الموظف',
    'field.tripTable.routeName' => 'طريق',
    'field.tripTable.date' => 'تاريخ',
    'field.tripTable.driver' => 'السائق',
    'field.tripTable.vehicle' => 'المركبة',
    'field.tripTable.vehicleType' => 'نوع المركبة',
    'field.tripTable.status' => 'الحالة',
    'field.tripTable.capacity' => 'السعة',
    'field.tripTable.clientPrice' => 'سعر العميل',
    'field.tripTable.driverPrice' => 'سعر السائق',
    'field.tripTable.EGP' => 'جنيه مصري',
    'field.old_station_id' => 'المحطة القديمة',
    'field.station_id' => 'المحطة جديدة',
    'field.updated_by_id' => 'تم التحديث بواسطة',
    'field.updated_at' => 'تم التحديث في',
    'field.date' => 'التاريخ',
    'field.time' => 'الوقت',
    'field.route' => 'الطريق',
    'field.settings' => 'الإعداتات',
    'field.employees' => 'الموظفين',
    'field.arrival_time' => 'وقت الوصول',
    'field.diff_arrival_time' => 'اختلاف وقت الوصول',
    'field.reason' => 'السبب',
    'field.allEmployeesCount' => 'عدد كل الموظفين',
    'field.arrival_allowance_time' => 'وقت الوصول مع السماح',
    'field.time_with_arrival_allowance' => 'وقت الوصول مع السماح',
    'field.riderCode' => 'R-Q',

    'field.trip.status.available' => 'متوفر',
    'field.trip.status.not_started' => 'لم تبدأ',
    'field.trip.status.started' => 'بدأت',
    'field.trip.status.completed' => 'أكتملت',
    'field.trip.status.cancelled' => 'ألغيت',
    'field.trip.status.stopped' => 'توقفت',
    'field.trip.status.1' => 'أكتملت',
    'field.trip.status.' => 'غير مكتمله',

    'field.employee.status.pending' => 'قيد الانتظار',
    'field.employee.status.approved' => 'موافق عليها',
    'field.employee.status.declined' => 'رفضت',

    'field.weekdays.sunday' => 'الأحد',
    'field.weekdays.monday' => 'الاثنين',
    'field.weekdays.tuesday' => 'الثلاثاء',
    'field.weekdays.wednesday' => 'الأربعاء',
    'field.weekdays.thursday' => 'الخميس',
    'field.weekdays.friday' =>'الجمعة',
    'field.weekdays.saturday' => 'السبت',

    // Validation
    'validation.company_id.required' => 'حقل الشركة مطلوب',
    'validation.branch_id.required' => 'حقل الفرع مطلوب',
    'validation.type.required' => 'حقل النوع مطلوب',
    'validation.from_en.required' => 'مطلوب حقل من EN',
    'validation.from_ar.required' => 'مطلوب حقل من AR',
    'validation.to_en.required' => 'مطلوب حقل إلى EN',
    'validation.to_ar.required' => 'مطلوب حقل إلى AR',
    'validation.station_ids.required' => 'حقل المحطات مطلوب',

    'validation.route_id.required' => 'حقل الطريق مطلوب',
    'validation.route_id.exists' => 'رقم الرحلة غير موجود',
    'validation.employee_id.required' => 'حقل الموظف مطلوب',
    'validation.start_time.required' => 'حقل وقت البدء مطلوب',

    'validation.employee_ids.required' => 'حثل الموظفين  مطلوب',
    'validation.client_price.required' => 'حقل سعر العميل مطلوب',
    'validation.driver_price.required' => 'مطلوب حقل سعر السائق',
    'validation.start_date.required' => 'حقل تاريخ البدء مطلوب',
    'validation.driver_id.required' => 'مطلوب حقل السائق',
    'validation.vehicle_id.required' => 'حقل السيارة مطلوب',
    'validation.status.required' => 'حقل الحالة مطلوب',
    'validation.class.required' => 'حقل الفئة مطلوب',
    'validation.route_schedule_ids.required' => 'مطلوب حقل جدول المسار',
    'validation.client_prices.required' => 'حقل أسعار العميل مطلوب',
    'validation.driver_prices.required' => 'حقل أسعار السائق مطلوب',
    'validation.route_types.required' => 'مطلوب حقل أنواع المسار',
    'validation.supplier_ids.required' => 'حقل المورد مطلوب',
    'validation.driver_ids.required' => 'مطلوب حقل السائق',
    'validation.vehicle_ids.required' => 'حقل السيارة مطلوب',
    'validation.days.required' => 'مطلوب حقل الأيام',
    'validation.start_dates.required' => 'مطلوب حقل تواريخ البدء',
    'validation.times.required' => 'مطلوب حقل الأوقات',
    'validation.trip_id.required' => 'حقل الرحلة مطلوب',
    'validation.driver_confirmed.required' => 'مطلوب حقل أكد السائق',
    'validation.old_station_id.required' => 'حقل المحطة القديمة مطلوب',
    'validation.status_action_reasons.required_if' => 'حقل السبب مطلوب فى حالة :other حالة :value.',
    'validation.trip.exists' => 'الرحلة موجودة بالفعل',
    'validation.updateSchedule.checkStartDates' => 'The Start Date :start_date must be a date after or equal to :date_now. Schedule: :start_time',
    'validation.updateSchedule.checkEndDates' => 'The End Date :end_date must be a date after or equal to :start_date. Schedule: :start_time',

    // Messages
    'message.created' => 'الطريق تم إنشاؤه بنجاح',
    'message.updated' => 'تم تحديث الطريق بنجاح',
    'message.deleted' => 'تم حذف الطريق بنجاح',
    'message.notFound' => 'الطريق غير موجود',

    'trip.message.created' => 'تم إنشاء الرحلة بنجاح',
    'trip.message.updated' => 'تم تحديث الرحلة بنجاح',
    'trip.message.deleted' => 'تم حذف الرحلة بنجاح',
    'trip.message.dispatchUpdated' => 'تم اضافة الرحلات بنجاح',
    'trip.message.notFound' => 'لم يتم العثور على الرحلة',
    'trip.message.pleaseChooseEmployeeFirst' => 'الرجاء اختيار الموظف أولا',

    'assignEmployee.message.updated' => 'تم تحديث الموظف المعين بنجاح',
    'assignEmployee.message.deleted' => 'تم حذف الموظف المعين بنجاح',

    //Api Messages
    'api.message.updated' => 'تم تحديث الطريق بنجاح',
    'api.message.updateLocationError' => 'لا يمكن تحديث الموقع حتى يوافق المسؤول على هذا الطلب أو يرفضه',
    'api.message.driverConfirmError' => 'لقد تجاوزت الوقت المسموح به لتأكيد هذه الرحلة',
    'api.message.driverNotConfirmError' => 'الرجاء تأكيد الرحلة أولا',

    //Notify Messages
    'message.notify.title.driverNotConfirmTrip' => 'رحلة جديدة غير مؤكدة',
    'message.notify.body.driverNotConfirmTrip' => 'Driver Name :driverName Rejected starting the trip :tripName <br> the reason is :reason',

    'message.notify.title.driverConfirmTrip' => 'رحلة جديدة مؤكدة',
    'message.notify.body.driverConfirmTrip' => 'Will start the Trip :tripName <br> Driver Name :driverName',

    'message.notify.title.driverNotStartTrip' => 'رحلة جديدة لم تبدأ',
    'message.notify.body.driverNotStartTrip' => 'For Trip :tripName <br> Driver Name :driverName',

    //SMS Messages
    'message.sms.informingEmployeeTripCommingWithGoogleLink' => 'كابتن :driverName هيوصل كمان :minutes دقيقه بعربيه :carModel
    رقم الكابتن: :driverPhoneNumber
    رقم العربيه : :platesNumber
    نقطتك:stationLink',

    'message.sms.informingEmployeeTripCommingWithoutLink' => 'كابتن :driverName هيوصل كمان :minutes دقيقه بعربيه :carModel
    رقم الكابتن: :driverPhoneNumber
    رقم العربيه : :platesNumber',
];
