<div class="col-md-12" id="{{ $id }}" style="display: none;">
    <div class="loader-wrapper">
        <div class="loader-container">
            <div class="line-scale-pulse-out loader-deep-orange">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/plugins/loaders/loaders.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/core/colors/palette-loader.css')}}">
@endpush