@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/forms/icheck/custom.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/plugins/forms/checkboxes-radios.css')}}">
@endpush

<div class="form-body">
    <div class="row">

        @csrf

        <div class="col-md-3">
            <div class="form-group control-group">
                <label for="name">{{__('role::language.field.name')}} <span class="danger">*</span></label>
                <input type="text" name="name" value="{{$role->name}}" id="name" class="form-control"
                    placeholder="{{__('role::language.field.name')}}" required
                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
            </div>
        </div>

        <div class="controls">
            <div class="skin skin-line">
                <label for="name"> <br> </label>
                <div class="col-md-12 col-sm-12">
                    <input type="checkbox" class="check-all" id="input-CheckAll">
                    <label for="input-CheckAll">{{__('role::language.field.checkAll')}}</label>
                </div>

            </div>
        </div>

    </div>

    @if ($role->is_super == false)
    <hr>
    <div class="row">
        <div class="col-md-12">

            @foreach($permissions as $permission)
            <div class="form-group control-group">

                <h5>{{ucwords($permission['permission_name'])}}</h5>
                <div class="controls">
                    <div class="row skin skin-line">
                        @foreach ($permission['permission_actions'] as $action)
                        <div class="col-md-2 col-sm-3" data-name="{{$action['name']}}">
                            <input type="checkbox" class="rule-actions" id="input-{{$action['id']}}" name="actions[]"
                                value="{{$action['id']}}" {!! checked($action['checked'], $action['id']) !!}>
                            <label for="input-{{$action['id']}}">{{ucwords($action['name'])}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            @if (!$loop->last)
            <hr>
            @endif

            @endforeach
        </div>
    </div>
    @endif
</div>

<div class="form-actions right">
    <button type="submit" class="btn btn-blue">
        <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
    </button>
</div>

@push('js')
<script src="{{asset('asset/app-assets/js/scripts/forms/checkbox-radio.js')}}" type="text/javascript"></script>

<script>
    $(document).ready(function () {

    $('.check-all').on('ifChecked', function () {
        $('.rule-actions').iCheck('check');
    });

    $('.check-all').on('ifUnchecked', function () {
        $('input').iCheck('uncheck');
    });
        

    $(".rule-actions").each(function(index,row) {
        var checkInput = $(row).is(':checked');
        if(checkInput)
        {
            $(row).closest('div').attr('class','icheckbox_line-green checked');
        }
        else
        {
            $(row).closest('div').attr('class','icheckbox_line-red');
        }
	});
        

    $('.rule-actions').on('ifChecked', function () {
        var me = $(this);
        me.closest('div').attr('class','icheckbox_line-green checked');
    });
       
    $('.rule-actions').on('ifUnchecked', function () {
        var me = $(this);
        me.closest('div').attr('class','icheckbox_line-red');
    });
});
</script>
@endpush