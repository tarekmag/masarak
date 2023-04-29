<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Defines
    |--------------------------------------------------------------------------
    |
     */

    /**
     * Login
     * Weeks Numbers
     */
    'rememberMe' => 3,

    /**
     * Partials
     * Page Length
     * Date Time Format
     * Date Format
     * Schedule Timezone
     * Password Numbers Minutes
     */
    'paginate' => 12,
    'dateTimeFormat12' => 'Y-m-d h:i A',
    'dateTimeFormat24' => 'Y-m-d h:i:s',
    'dateFormat' => 'Y-m-d',
    'dateFormatArabic' => 'd-m-Y',
    'exportDateFormat' => 'd/m/Y',
    'exportDateTimeFormat' => 'd/m/Y h:i A',
    'timeFormat' => 'H:i',
    'timeFormat12' => 'h:i A',
    'googleMapLatLngDigitsCount' => 7,
    'timeToCanConfirmTrip' => 5,

    /**
     * Languages
     */
    'defaultLanguageFiles' => [
        ['name' => 'auth', 'nameSpace' => 'auth', 'fileName' => 'auth.php', 'path' => resource_path('lang/')],
        ['name' => 'menu', 'nameSpace' => 'menu', 'fileName' => 'menu.php', 'path' => resource_path('lang/')],
        ['name' => 'partials', 'nameSpace' => 'partials', 'fileName' => 'partials.php', 'path' => resource_path('lang/')],
        ['name' => 'passwords', 'nameSpace' => 'passwords', 'fileName' => 'passwords.php', 'path' => resource_path('lang/')],
    ],
    'packagesLanguageFiles' => [
        // ['name' => 'dashboard', 'nameSpace' => 'dashboard::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/dashboard/src/Lang/')],
        ['name' => 'routes', 'nameSpace' => 'route::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/routes/src/Lang/')],
        // ['name' => 'notifications', 'nameSpace' => 'notification::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/notifications/src/Lang/')],
        ['name' => 'companies', 'nameSpace' => 'company::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/companies/src/Lang/')],
        ['name' => 'employees', 'nameSpace' => 'employee::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/employees/src/Lang/')],
        ['name' => 'vehicles', 'nameSpace' => 'vehicle::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/vehicles/src/Lang/')],
        ['name' => 'brands', 'nameSpace' => 'brand::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/brands/src/Lang/')],
        ['name' => 'brandmodels', 'nameSpace' => 'brandModel::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/brandmodels/src/Lang/')],
        ['name' => 'emergencies', 'nameSpace' => 'emergency::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/emergencies/src/Lang/')],
        ['name' => 'stations', 'nameSpace' => 'station::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/stations/src/Lang/')],
        ['name' => 'districts', 'nameSpace' => 'district::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/districts/src/Lang/')],
        ['name' => 'drivers', 'nameSpace' => 'driver::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/drivers/src/Lang/')],
        ['name' => 'suppliers', 'nameSpace' => 'supplier::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/suppliers/src/Lang/')],
        ['name' => 'languages', 'nameSpace' => 'language::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/languages/src/Lang/')],
        ['name' => 'settings', 'nameSpace' => 'setting::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/settings/src/Lang/')],
        ['name' => 'roles', 'nameSpace' => 'role::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/roles/src/Lang/')],
        ['name' => 'admin users', 'nameSpace' => 'user::language', 'fileName' => 'language.php', 'path' => base_path('packages/epalsolutions/users/src/Lang/')],
    ],
];
