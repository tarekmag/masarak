<div>
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="navigation-header">
                    <span data-i18n="nav.category.layouts">{{__('menu.Statistics')}}</span>
                    <i class="ft-more-horizontal ft-minus" data-tooltip="tooltip" data-placement="right"
                        data-original-title="Layouts"></i>
                </li>

                <li class="nav-item {{(request()->is('/'))?'active':''}}">
                    <a href="{{route('dashboard.index')}}">
                        <i style="margin-right: 0px;" class="fa fa-dashboard"></i>
                        <span class="menu-title"
                            data-i18n="nav.dashboard.main">{{__('menu.Dashboard')}}</span>
                    </a>
                </li>

                <li class="navigation-header">
                    <span data-i18n="nav.category.layouts">{{__('menu.Content')}}</span>
                    <i class="ft-more-horizontal ft-minus" data-tooltip="tooltip" data-placement="right"
                        data-original-title="Layouts"></i>
                </li>

                @canany(['route.index', 'locationEmployeeRequest.index', 'route.getAllTrips'])
                <li class="nav-item {{(request()->is('route'))?'active open':''}} "><a href="#">
                    <i style="margin-right: 0px;" class="fa fa-road"></i>
                    <span class="menu-title"
                        data-i18n="nav.route.main">{{__('menu.Routes')}}</span></a>
                    <ul class="menu-content">

                        @can('route.index')
                        <li class="{{(request()->is('route*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('route.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-road"></i>
                                <span class="menu-title"
                                    data-i18n="nav.route.main">{{__('menu.Routes')}}</a>
                        </li>
                        @endcan

                        {{-- @can('locationEmployeeRequest.index')
                        <li class="{{(request()->is('locationEmployeeRequest*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('locationEmployeeRequest.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-users"></i>
                                <span class="menu-title"
                                    data-i18n="nav.locationEmployeeRequest.main">{{__('menu.LocationEmployeeRequests')}}</a>
                        </li>
                        @endcan --}}

                        @can('route.getAllTrips')
                        <li class="{{(request()->is('trips*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('route.getAllTrips') }}">
                                <i style="margin-right: 0px;" class="fa fa-map-signs"></i>
                                <span class="menu-title"
                                    data-i18n="nav.getAllTrips.main">{{__('menu.AllTrips')}}</a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcanany

                @can('notification.index')
                <li class="nav-item {{(request()->is('notification*'))?'active':''}}">
                    <a href="{{ route('notification.index') }}">
                        <i style="margin-right: 0px;" class="fa fa-bell"></i>
                        <span class="menu-title"
                            data-i18n="nav.notifications.main">{{__('menu.Notifications')}}</span>
                    </a>
                </li>
                @endcan

                @can('trips.liveTracking')
                <li class="nav-item {{(request()->is('liveTracking*'))?'active':''}}">
                    <a href="{{ route('trips.liveTracking') }}">
                        <i style="margin-right: 0px;" class="fa fa-map danger"></i>
                        <span class="menu-title"
                            data-i18n="nav.notifications.main">{{__('menu.LiveTracking')}}</span>
                    </a>
                </li>
                @endcan

                @canany(['company.index', 'branch.index'])
                <li class="nav-item {{(request()->is('company'))?'active open':''}} "><a href="#">
                    <i style="margin-right: 0px;" class="fa fa-building"></i>
                    <span class="menu-title"
                        data-i18n="nav.company.main">{{__('menu.Companies')}}</span></a>
                    <ul class="menu-content">

                        @can('company.index')
                        <li class="{{(request()->is('company*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('company.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-building"></i>
                                <span class="menu-title"
                                    data-i18n="nav.company.main">{{__('menu.Companies')}}</a>
                        </li>
                        @endcan

                        @can('branch.index')
                        <li class="{{(request()->is('branch*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('branch.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-home"></i>
                                <span class="menu-title"
                                    data-i18n="nav.branch.main">{{__('menu.Branches')}}</a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcanany

                @can('employee.index')
                <li class="nav-item {{(request()->is('employee*'))?'active':''}}">
                    <a href="{{ route('employee.index') }}">
                        <i style="margin-right: 0px;" class="fa fa-users"></i>
                        <span class="menu-title"
                            data-i18n="nav.employees.main">{{__('menu.Employees')}}</span>
                    </a>
                </li>
                @endcan

                @canany(['vehicle.index', 'vehicleDocument.index', 'brand.index', 'brandModel.index'])
                <li class="nav-item {{(request()->is('vehicle'))?'active open':''}} "><a href="#">
                    <i style="margin-right: 0px;" class="fa fa-bus"></i>
                    <span class="menu-title"
                        data-i18n="nav.vehicle.main">{{__('menu.Vehicles')}}</span></a>
                    <ul class="menu-content">

                        @can('vehicle.index')
                        <li class="{{(request()->is('vehicle*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('vehicle.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-bus"></i>
                                <span class="menu-title"
                                    data-i18n="nav.vehicle.main">{{__('menu.Vehicles')}}</a>
                        </li>
                        @endcan

                        @can('vehicleDocument.index')
                        <li class="{{(request()->is('vehicleDocument*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('vehicleDocument.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-list-alt"></i>
                                <span class="menu-title"
                                    data-i18n="nav.vehicleDocument.main">{{__('menu.VehiclesDocument')}}</a>
                        </li>
                        @endcan

                        @can('brand.index')
                        <li class="{{(request()->is('brand*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('brand.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-bus"></i>
                                <span class="menu-title"
                                    data-i18n="nav.brand.main">{{__('menu.Brands')}}</a>
                        </li>
                        @endcan

                        @can('brandModel.index')
                        <li class="{{(request()->is('brandModel*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('brandModel.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-bus"></i>
                                <span class="menu-title"
                                    data-i18n="nav.brandModel.main">{{__('menu.BrandModels')}}</a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcanany

                @canany(['emergency.index', 'emergencyRequest.index'])
                <li class="nav-item {{(request()->is('emergency'))?'active open':''}} "><a href="#">
                    <i style="margin-right: 0px;" class="fa fa-medkit"></i>
                    <span class="menu-title"
                        data-i18n="nav.emergency.main">{{__('menu.Emergencies')}}</span></a>
                    <ul class="menu-content">

                        @can('emergency.index')
                        <li class="{{(request()->is('emergency*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('emergency.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-medkit"></i>
                                <span class="menu-title"
                                    data-i18n="nav.emergency.main">{{__('menu.Emergencies')}}</a>
                        </li>
                        @endcan

                        @can('emergencyRequest.index')
                        <li class="{{(request()->is('emergencyRequest*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('emergencyRequest.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-medkit"></i>
                                <span class="menu-title"
                                    data-i18n="nav.emergencyRequest.main">{{__('menu.EmergenciesRequests')}}</a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcanany

                @canany(['station.index', 'district.index'])
                <li class="nav-item {{(request()->is('station'))?'active open':''}} "><a href="#">
                    <i style="margin-right: 0px;" class="fa fa-map-marker"></i>
                    <span class="menu-title"
                        data-i18n="nav.station.main">{{__('menu.Stations')}}</span></a>
                    <ul class="menu-content">

                        @can('station.index')
                        <li class="{{(request()->is('station*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('station.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-map-marker"></i>
                                <span class="menu-title"
                                    data-i18n="nav.station.main">{{__('menu.Stations')}}</a>
                        </li>
                        @endcan

                        @can('district.index')
                        <li class="{{(request()->is('district*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('district.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-globe"></i>
                                <span class="menu-title"
                                    data-i18n="nav.district.main">{{__('menu.Districts')}}</a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcanany

                @canany(['driver.index', 'driverDocument.index', 'supplier.index'])
                <li class="nav-item {{(request()->is('driver'))?'active open':''}} "><a href="#">
                    <i style="margin-right: 0px;" class="fa fa-address-card"></i>
                    <span class="menu-title"
                        data-i18n="nav.driver.main">{{__('menu.Drivers')}}</span></a>
                    <ul class="menu-content">

                        @can('driver.index')
                        <li class="{{(request()->is('driver*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('driver.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-users"></i>
                                <span class="menu-title"
                                    data-i18n="nav.driver.main">{{__('menu.Drivers')}}</a>
                        </li>
                        @endcan

                        @can('driverDocument.index')
                        <li class="{{(request()->is('driverDocument*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('driverDocument.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-id-card-o"></i>
                                <span class="menu-title"
                                    data-i18n="nav.driverDocument.main">{{__('menu.DriversDocuments')}}</a>
                        </li>
                        @endcan

                        {{-- @can('driverVehicle.index')
                        <li class="{{(request()->is('driverVehicle*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('driverVehicle.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-bus"></i>
                                <span class="menu-title"
                                    data-i18n="nav.driverVehicle.main">{{__('menu.DriversVehicles')}}</a>
                        </li>
                        @endcan --}}

                        @can('supplier.index')
                        <li class="{{(request()->is('supplier*'))?'active':''}}">
                            <a class="menu-item" href="{{ route('supplier.index') }}">
                                <i style="margin-right: 0px;" class="fa fa-users"></i>
                                <span class="menu-title"
                                    data-i18n="nav.supplier.main">{{__('menu.Suppliers')}}</a>
                        </li>
                        @endcan

                    </ul>
                </li>
                @endcanany

                @can('language.index')
                <li class="nav-item {{(request()->is('language*'))?'active':''}}">
                    <a href="{{ route('language.index') }}">
                        <i style="margin-right: 0px;" class="fa fa-language"></i>
                        <span class="menu-title"
                            data-i18n="nav.languages.main">{{__('menu.Languages')}}</span>
                    </a>
                </li>
                @endcan

                @can('pricingList.index')
                <li class="nav-item {{(request()->is('pricingList*'))?'active':''}}">
                    <a href="{{ route('pricingList.index') }}">
                        <i style="margin-right: 0px;" class="fa fa-usd"></i>
                        <span class="menu-title"
                            data-i18n="nav.pricingList.main">{{__('menu.PricingLists')}}</span>
                    </a>
                </li>
                @endcan

                @canany(['setting.index', 'role.index', 'user.index'])
                <li class="navigation-header">
                    <span data-i18n="nav.category.layouts">{{__('menu.AdminSettings')}}</span>
                    <i class="ft-more-horizontal ft-minus" data-tooltip="tooltip" data-placement="right"
                        data-original-title="Layouts"></i>
                </li>
                @endcanany

                @can('setting.index')
                <li class="nav-item {{(request()->is('setting*'))?'active':''}}">
                    <a href="{{route('setting.index')}}">
                        <i style="margin-right: 0px;" class="fa fa-cogs"></i>
                        <span class="menu-title"
                            data-i18n="nav.settings.main">{{__('menu.Settings')}}</span>
                    </a>
                </li>
                @endcan

                @can('role.index')
                <li class="nav-item {{(request()->is('role*'))?'active':''}}">
                    <a href="{{route('role.index')}}">
                        <i style="margin-right: 0px;" class="fa fa-magic"></i>
                        <span class="menu-title" data-i18n="nav.roles.main">{{__('menu.Roles')}}</span>
                    </a>
                </li>
                @endcan

                @can('user.index')
                <li class="nav-item {{(request()->is('user*'))?'active':''}}">
                    <a href="{{route('user.index')}}">
                        <i style="margin-right: 0px;" class="fa fa-user-secret"></i>
                        <span class="menu-title" data-i18n="nav.users.main">{{__('menu.Users')}}</span>
                    </a>
                </li>
                @endcan

            </ul>
        </div>
    </div>
</div>
