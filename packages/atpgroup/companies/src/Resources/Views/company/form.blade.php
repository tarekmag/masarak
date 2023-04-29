<?php
    use ATPGroup\Upload\Upload;
?>

<div class="form-body">
    <div class="row">
        @csrf
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="name_en">{{__('company::language.field.name_en')}} <span class="danger">*</span></label>
                <input type="text" name="name_en" value="{{ inputValidation('name_en', $company) }}" id="name_en"
                    class="form-control" placeholder="{{__('company::language.field.name_en')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="name_ar">{{__('company::language.field.name_ar')}} <span class="danger">*</span></label>
                <input type="text" name="name_ar" value="{{ inputValidation('name_ar', $company) }}" id="name_ar"
                    class="form-control" placeholder="{{__('company::language.field.name_ar')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="logo">
                    {{__('company::language.field.logo')}}
                </label>
                <?=
                Upload::image([
                    'name' => 'logo',
                    'value' => old('logo' , $company->logo),
                ])
                ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="image">
                    {{__('company::language.field.display_employee_image')}}
                </label>
                <x-form-toggle :isActive="$company->display_employee_image" name="display_employee_image" iconOn="fa fa-thumbs-up" iconOff="fa fa-thumbs-down" colorOn="success" colorOff="danger" />
            </div>
        </div>
    </div>

</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>