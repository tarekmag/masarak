<?php
    use ATPGroup\Upload\Upload;
?>
<div class="form-body">
    <div class="row">
        @csrf
       
        <div class="col-md-3">
            <div class="form-group control-group">
                <x-company-dropdown-company :companyId="$employee->company_id" :required="true" name="company_id" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-company-dropdown-branch :companyId="$employee->company_id" :branchId="$employee->branch_id" :required="true"  name="branch_id" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <x-station-dropdown-list :stationId="$employee->station_id" :required="false" />
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="name">{{__('employee::language.field.name')}} <span class="danger">*</span></label>
                <input type="text" name="name" value="{{ inputValidation('name', $employee) }}" id="name"
                    class="form-control" placeholder="{{__('employee::language.field.name')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="phone">{{__('employee::language.field.phone')}} <span class="danger">*</span></label>
                <input type="text" name="phone" value="{{ inputValidation('phone', $employee) }}" id="phone"
                    class="form-control" placeholder="{{__('employee::language.field.phone')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>
     
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="email">{{__('employee::language.field.email')}} </label>
                <input type="email" name="email" value="{{ inputValidation('email', $employee) }}" id="email"
                    class="form-control" placeholder="{{__('employee::language.field.email')}}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="image">
                    {{__('employee::language.field.image')}}
                </label>
                <?=
                Upload::image([
                    'name' => 'image',
                    'value' => old('image' , $employee->image),
                ])
                ?>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="image">
                    {{__('employee::language.field.is_leader')}}
                </label>
                <x-form-toggle :isActive="$employee->is_leader" name="is_leader" iconOn="fa fa-star" iconOff="fa fa-star-o" colorOn="success" colorOff="danger" />
            </div>
        </div>

</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>