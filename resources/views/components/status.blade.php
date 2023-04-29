@switch($status)
    @case('pending')
        <div class="badge border-warning warning badge-border">
            <i class="fa fa-clock-o font-medium-2"></i>
            <span>{{ __('partials.field.status.pending') }}</span>
        </div>
        @break

    @case('approved')
        <div class="badge border-green green badge-border">
            <i class="fa fa-thumbs-o-up font-medium-2"></i>
            <span>{{ __('partials.field.status.approved') }}</span>
        </div>
        @break
        
    @case('declined')
        <div class="badge border-danger danger badge-border">
            <i class="fa fa-thumbs-o-down font-medium-2"></i>
            <span>{{ __('partials.field.status.declined') }}</span>
        </div>
        @break

    @case('completed')
        <div class="badge border-blue blue badge-border">
            <i class="fa fa-check font-medium-2"></i>
            <span>{{ __('partials.field.status.completed') }}</span>
        </div>
        @break
@endswitch