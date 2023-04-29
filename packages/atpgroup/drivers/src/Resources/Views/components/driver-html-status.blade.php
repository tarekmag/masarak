@switch($status)
    @case(App\Enums\RouteType::TRIP_STATUS_STARTED)
        <div class="badge border-danger danger badge-border">
            <i class="fa fa-thumbs-down font-medium-2"></i>
            <span>
                {{ __('driver::language.field.not_available') }}
            </span>
        </div>
    @break

    @default
        <div class="badge border-info info badge-border">
            <i class="fa fa-thumbs-up font-medium-2"></i>
            <span>
                {{ __('driver::language.field.available') }}
            </span>
        </div>
@endswitch
