<div class="form-body">
    <div class="row">

        @csrf

        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="name">{{__('language::language.field.name')}} <span class="danger">*</span></label>
                <input type="text" name="name" value="{{ inputValidation('name', $language) }}" id="name"
                    class="form-control" placeholder="{{__('language::language.field.name')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group control-group">
                <label for="symbol">{{__('language::language.field.symbol')}} <span class="danger">*</span></label>
                <input type="string" name="symbol" value="{{ inputValidation('symbol', $language) }}" id="symbol"
                    class="form-control" placeholder="{{__('language::language.field.symbol')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

        <div class="col-md-4 skin skin-square">
            <label for="symbol">{{__('language::language.field.direction')}} <span class="danger">*</span></label>
            <div class="form-group control-group">
                <input type="radio" name="direction" value="ltr" {!! checked('ltr', $language->direction) !!} id="input-radio-ltr" required
                data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
                <label for="input-radio-ltr">LTR</label>
                &nbsp; &nbsp; &nbsp;
                <input type="radio" name="direction" value="rtl" {!! checked('rtl', $language->direction) !!} id="input-radio-rtl" required
                data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
                <label for="input-radio-rtl">RTL</label>
            </div>
        </div>

    </div>
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>