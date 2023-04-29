<?php
    use ATPGroup\Upload\Upload;
?>

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/extensions/datedropper.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/extensions/timedropper.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('asset/app-assets/vendors/css/pickers/miniColors/jquery.minicolors.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/pickers/spectrum/spectrum.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('asset/app-assets/css/plugins/pickers/colorpicker/colorpicker.css')}}">
@endpush

<div class="form-body">
    <div class="row">

        @csrf

        @foreach ($result as $item)

        @if ($item->setting_form_type == 'input' && !in_array($item->setting_type, ['time', 'date', 'color']))
        <div class="col-md-12">
            <div class="form-group control-group">
                <label for="settingKeys[{{$item->id}}]">{{__('setting::language.field.'.$item->setting_key)}}</label>
                <input type="{{ $item->setting_type }}" name="settingKeys[{{$item->id}}]"
                    value="{{ $item->setting_value }}" id="settingKeys[{{$item->id}}]" class="form-control"
                    placeholder="{{__('setting::language.field.'.$item->setting_key)}}">
            </div>
        </div>
        @endif

        @if ($item->setting_type == 'time')
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="settingKeys[{{$item->id}}]">{{__('setting::language.field.'.$item->setting_key)}}</label>
                <input type="time" name="settingKeys[{{$item->id}}]" value="{{ $item->setting_value }}"
                    id="settingKeys[{{$item->id}}]" class="form-control"
                    placeholder="{{__('setting::language.field.'.$item->setting_key)}}">
            </div>
        </div>
        @endif

        @if ($item->setting_type == 'date')
        <div class="col-md-12">
            <div class="form-group control-group">
                <label for="settingKeys[{{$item->id}}]">{{__('setting::language.field.'.$item->setting_key)}}</label>
                <input type="input" name="settingKeys[{{$item->id}}]" value="{{ $item->setting_value }}"
                    id="settingKeys[{{$item->id}}]" class="form-control dropDate"
                    placeholder="{{__('setting::language.field.'.$item->setting_key)}}">
            </div>
        </div>
        @endif

        @if ($item->setting_type == 'color')
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="settingKeys[{{$item->id}}]">{{__('setting::language.field.'.$item->setting_key)}}</label>
                <input type="input" name="settingKeys[{{$item->id}}]" value="{{ $item->setting_value }}"
                    id="settingKeys[{{$item->id}}]" class="form-control minicolors"
                    placeholder="{{__('setting::language.field.'.$item->setting_key)}}" data-control="hue">
            </div>
        </div>
        @endif

        @if ($item->setting_form_type == 'textarea')
        <div class="col-md-12">
            <div class="form-group control-group">
                <label>{{__('setting::language.field.'.$item->setting_key)}}</label>
                <textarea class="form-control" name="settingKeys[{{$item->id}}]" cols="30"
                    rows="10">{{ $item->setting_value }}</textarea>
            </div>
        </div>
        @endif

        @endforeach

    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>

@push('js')
<script src="{{asset('asset/app-assets/vendors/js/extensions/datedropper.min.js')}}"></script>
<script src="{{asset('asset/app-assets/vendors/js/extensions/timedropper.min.js')}}"></script>
<script src="{{asset('asset/app-assets/vendors/js/pickers/miniColors/jquery.minicolors.min.js')}}"></script>
<script src="{{asset('asset/app-assets/vendors/js/pickers/spectrum/spectrum.js')}}"></script>
<script src="{{asset('asset/app-assets/js/scripts/pickers/colorpicker/picker-color.js')}}"></script>

<script>
    $('.dropTime').timeDropper({
        primaryColor: '#2fb594',
        textColor: '#e8273a',
        meridians: true
    });

    $('.dropDate').dateDropper({
        dropWidth: 200,
        init_animation: 'bounce',
        format: 'j l, F, Y'
    });
</script>
@endpush