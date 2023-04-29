<?php
    use ATPGroup\Upload\Upload;
?>
<div class="form-body">
    <div class="row">
        @csrf

        <div class="col-md-4">
            <div class="form-group control-group">
                <x-brand-dropdown-list :brandId="$brandModel->brand_id" :required="true" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name_en">{{__('brandModel::language.field.name_en')}} <span class="danger">*</span> </label>
                <input type="text" name="name_en" value="{{ inputValidation('name_en', $brandModel) }}" id="name_en"
                    class="form-control" placeholder="{{__('brandModel::language.field.name_en')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name_ar">{{__('brandModel::language.field.name_ar')}} <span class="danger">*</span> </label>
                <input type="text" name="name_ar" value="{{ inputValidation('name_ar', $brandModel) }}" id="name_ar"
                    class="form-control" placeholder="{{__('brandModel::language.field.name_ar')}}" required
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