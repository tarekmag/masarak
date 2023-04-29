<?php
    use ATPGroup\Upload\Upload;
?>

<div class="form-body">
    <div class="row">
        @csrf
        <div class="col-md-4">
            <div class="form-group control-group">
                <x-company-dropdown-company :companyId="$branch->parent_id" :required="true" name="parent_id" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name_en">{{__('company::language.field.name_en')}} <span class="danger">*</span></label>
                <input type="text" name="name_en" value="{{ inputValidation('name_en', $branch) }}" id="name_en"
                    class="form-control" placeholder="{{__('company::language.field.name_en')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name_ar">{{__('company::language.field.name_ar')}} <span class="danger">*</span></label>
                <input type="text" name="name_ar" value="{{ inputValidation('name_ar', $branch) }}" id="name_ar"
                    class="form-control" placeholder="{{__('company::language.field.name_ar')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

    </div>
     
    <div class="row">
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="lat">{{__('company::language.field.lat')}} <span class="danger">*</span> </label>
                <input type="text" name="lat" value="{{ inputValidation('lat', $branch) }}" id="lat"
                    class="form-control" placeholder="{{__('company::language.field.lat')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="lng">{{__('company::language.field.lng')}} <span class="danger">*</span> </label>
                <input type="text" name="lng" value="{{ inputValidation('lng', $branch) }}" id="lng"
                    class="form-control" placeholder="{{__('company::language.field.lng')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="address_en">{{__('company::language.field.address_en')}} </label>
                <input type="text" name="address_en" value="{{ inputValidation('address_en', $branch) }}" id="address_en"
                    class="form-control" placeholder="{{__('company::language.field.address_en')}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="address_ar">{{__('company::language.field.address_ar')}} </label>
                <input type="text" name="address_ar" value="{{ inputValidation('address_ar', $branch) }}" id="address_ar"
                    class="form-control" placeholder="{{__('company::language.field.address_ar')}}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="image">
                    {{__('company::language.field.main_branch')}}
                </label>
                <x-form-toggle :isActive="$branch->main_branch" name="main_branch" iconOn="fa fa-thumbs-up" iconOff="fa fa-thumbs-down" colorOn="success" colorOff="danger" />
            </div>
        </div>
    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>