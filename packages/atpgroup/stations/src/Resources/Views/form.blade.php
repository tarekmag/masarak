<?php
    use ATPGroup\Upload\Upload;
?>
<div class="form-body">
    <div class="row">
        @csrf
        <div class="col-md-4">
            <div class="form-group control-group">
                <x-district-dropdown-list :districtId="$station->district_id" :required="true" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name_en">{{__('station::language.field.name_en')}}</label>
                <input type="text" name="name_en" value="{{ inputValidation('name_en', $station) }}" id="name_en"
                    class="form-control" placeholder="{{__('station::language.field.name_en')}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name_ar">{{__('station::language.field.name_ar')}}</label>
                <input type="text" name="name_ar" value="{{ inputValidation('name_ar', $station) }}" id="name_ar"
                    class="form-control" placeholder="{{__('station::language.field.name_ar')}}">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="pickup_name_en">{{__('station::language.field.pickup_name_en')}}</label>
                <input type="text" name="pickup_name_en" value="{{ inputValidation('pickup_name_en', $station) }}" id="pickup_name_en"
                    class="form-control" placeholder="{{__('station::language.field.pickup_name_en')}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="pickup_name_ar">{{__('station::language.field.pickup_name_ar')}}</label>
                <input type="text" name="pickup_name_ar" value="{{ inputValidation('pickup_name_ar', $station) }}" id="pickup_name_ar"
                    class="form-control" placeholder="{{__('station::language.field.pickup_name_ar')}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="pickup_lat">{{__('station::language.field.pickup_lat')}}</span> </label>
                <input type="text" name="pickup_lat" value="{{ inputValidation('pickup_lat', $station) }}" id="pickup_lat"
                    class="form-control" placeholder="{{__('station::language.field.pickup_lat')}}" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="pickup_lng">{{__('station::language.field.pickup_lng')}}</span> </label>
                <input type="text" name="pickup_lng" value="{{ inputValidation('pickup_lng', $station) }}" id="pickup_lng"
                    class="form-control" placeholder="{{__('station::language.field.pickup_lng')}}" >
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="drop_name_en">{{__('station::language.field.drop_name_en')}}</label>
                <input type="text" name="drop_name_en" value="{{ inputValidation('drop_name_en', $station) }}" id="drop_name_en"
                    class="form-control" placeholder="{{__('station::language.field.drop_name_en')}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="drop_name_ar">{{__('station::language.field.drop_name_ar')}}</label>
                <input type="text" name="drop_name_ar" value="{{ inputValidation('drop_name_ar', $station) }}" id="drop_name_ar"
                    class="form-control" placeholder="{{__('station::language.field.drop_name_ar')}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="drop_lat">{{__('station::language.field.drop_lat')}}</span> </label>
                <input type="text" name="drop_lat" value="{{ inputValidation('drop_lat', $station) }}" id="drop_lat"
                    class="form-control" placeholder="{{__('station::language.field.drop_lat')}}" >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="drop_lng">{{__('station::language.field.drop_lng')}}</span> </label>
                <input type="text" name="drop_lng" value="{{ inputValidation('drop_lng', $station) }}" id="drop_lng"
                    class="form-control" placeholder="{{__('station::language.field.drop_lng')}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="address_en">{{__('station::language.field.address_en')}} </label>
                <input type="text" name="address_en" value="{{ inputValidation('address_en', $station) }}" id="address_en"
                    class="form-control" placeholder="{{__('station::language.field.address_en')}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group control-group">
                <label for="address_ar">{{__('station::language.field.address_ar')}} </label>
                <input type="text" name="address_ar" value="{{ inputValidation('address_ar', $station) }}" id="address_ar"
                    class="form-control" placeholder="{{__('station::language.field.address_ar')}}">
            </div>
        </div>        
    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>