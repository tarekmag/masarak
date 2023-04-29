<div>
    <input 
        type="checkbox" 
        name="{{ $name }}"
        class="switchBootstrap"
        id="switchBootstrap{{ $name }}"
        data-on-text="<i class='{{ $iconOn }}'></i>"
        data-off-text="<i class='{{ $iconOff }}'></i>"
        data-on-color="{{ $colorOn }}" 
        data-off-color="{{ $colorOff }}"
        @if($isActive == true) checked @endif
    />

    @push('css')
        <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    @endpush

    @push('js')
    <script src="{{asset('asset/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <script>
        $("#switchBootstrap{{ $name }}").bootstrapSwitch({
            // state: false,
            // size: 'mini',
            animate: true,
            html: true,
            color: "#37BC9B"
        });
    </script>
    @endpush
</div>