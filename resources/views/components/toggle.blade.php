@can($dataMethod)
<input type="checkbox" @if($isActive == true) checked @endif class="switchBootstrap" data-url="{{$url}}"
    data-method="{{$dataMethod}}" data-tooltip="tooltip" data-placement="top" title="{{ __('partials.ChangeStatus') }}">
@endcan
