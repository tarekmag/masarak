@switch($status)
    @case(App\Enums\RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_PENDING)
        <div class="badge border-info info badge-border">
            <i class="fa fa-clock-o font-medium-2"></i>
            <span>
                {{ __('route::language.field.employee.status.' . $status) }}
            </span>
        </div>
    @break

    @case(App\Enums\RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_APPROVED)
        <div class="badge border-success success badge-border">
            <i class="fa fa-thumbs-o-up"></i>
            <span>
                {{ __('route::language.field.employee.status.' . $status) }}
            </span>
        </div>
    @break

    @case(App\Enums\RouteType::EMPLOYEE_LOCATION_REQUEST_STATUS_DECLINED)
        <div class="badge border-danger danger badge-border">
            <i class="fa fa-thumbs-o-down"></i>
            <span>
                {{ __('route::language.field.employee.status.' . $status) }}
            </span>
        </div>
    @break

@endswitch
