<?php
    use ATPGroup\Upload\Upload;
?>
<div class="form-body">
    <div class="row">
        @csrf

        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name_en">{{__('emergency::language.field.name_en')}} <span class="danger">*</span> </label>
                <input type="text" name="name_en" value="{{ inputValidation('name_en', $emergency) }}" id="name_en"
                    class="form-control" placeholder="{{__('emergency::language.field.name_en')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name_ar">{{__('emergency::language.field.name_ar')}} <span class="danger">*</span> </label>
                <input type="text" name="name_ar" value="{{ inputValidation('name_ar', $emergency) }}" id="name_ar"
                    class="form-control" placeholder="{{__('emergency::language.field.name_ar')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="mobile_number">{{__('emergency::language.field.mobile_number')}} </label>
                <input type="text" name="mobile_number" value="{{ inputValidation('mobile_number', $emergency) }}" id="mobile_number"
                    class="form-control" placeholder="{{__('emergency::language.field.mobile_number')}}">
            </div>
        </div>
        
    </div>

</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>