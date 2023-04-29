<?php
    use ATPGroup\Upload\Upload;
?>
<div class="form-body">
    <div class="row">
        @csrf
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="name_en">{{__('supplier::language.field.name_en')}} <span class="danger">*</span> </label>
                <input type="text" name="name_en" value="{{ inputValidation('name_en', $supplier) }}" id="name_en"
                    class="form-control" placeholder="{{__('supplier::language.field.name_en')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="name_ar">{{__('supplier::language.field.name_ar')}} <span class="danger">*</span> </label>
                <input type="text" name="name_ar" value="{{ inputValidation('name_ar', $supplier) }}" id="name_ar"
                    class="form-control" placeholder="{{__('supplier::language.field.name_ar')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>
    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>