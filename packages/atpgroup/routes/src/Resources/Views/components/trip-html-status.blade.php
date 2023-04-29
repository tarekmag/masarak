@switch($status)
    @case(App\Enums\RouteType::TRIP_STATUS_AVAILABLE)
        <div class="badge border-info info badge-border">
            <i class="fa fa-clock-o font-medium-2"></i>
            <span>
                {{ __('route::language.field.trip.status.' . $status) }}
            </span>
        </div>
    @break

    @case(App\Enums\RouteType::TRIP_STATUS_NOT_STARTED)
        <div class="badge border-danger danger badge-border">
            <i class="fa fa-pause font-medium-2"></i>
            <span>
                {{ __('route::language.field.trip.status.' . $status) }}
            </span>
        </div>
    @break

    @case(App\Enums\RouteType::TRIP_STATUS_STARTED)
        <div class="badge border-warning warning badge-border">
            <i class="fa fa-play font-medium-2"></i>
            <span>
                {{ __('route::language.field.trip.status.' . $status) }}
            </span>
        </div>
    @break

    @case(App\Enums\RouteType::TRIP_STATUS_COMPLETED)
        <div class="badge border-success success badge-border">
            <i class="fa fa-thumbs-up font-medium-2"></i>
            <span>
                {{ __('route::language.field.trip.status.' . $status) }}
            </span>
        </div>
    @break

    @case(App\Enums\RouteType::TRIP_STATUS_CANCELLED)
        <div class="badge border-danger danger badge-border">
            <i class="fa fa-thumbs-down font-medium-2"></i>
            <span>
                {{ __('route::language.field.trip.status.' . $status) }}
            </span>
        </div>
    @break

    @case(App\Enums\RouteType::TRIP_STATUS_STOPPED)
        <div class="badge border-danger danger badge-border">
            <i class="fa fa-stop font-medium-2"></i>
            <span>
                {{ __('route::language.field.trip.status.' . $status) }}
            </span>
        </div>
    @break
@endswitch
