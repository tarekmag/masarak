@can($attributes->get('data-method'))
<a {{ $attributes }} class="btn btn-sm delete-item btn-outline-danger" data-tooltip="tooltip" data-placement="top" title="{{ __('partials.Delete') }}"><i class="fa fa-trash"></i></a>
@endcan