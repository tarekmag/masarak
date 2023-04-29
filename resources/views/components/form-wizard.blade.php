@push('css')
<link rel="stylesheet" type="text/css"
    href="{{asset('asset/app-assets/css'.$textDirection.'/plugins/forms/wizard.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/forms/selects/select2.min.css')}}">

<link rel="stylesheet" type="text/css"
    href="{{asset('asset/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
@endpush

@push('js')
<script src="{{asset('asset/app-assets/vendors/js/extensions/jquery.steps.min.js')}}" type="text/javascript"></script>


<script src="{{asset('asset/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript">
</script>

<script src="{{asset('asset/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}" type="text/javascript">
</script>

<script src="{{asset('asset/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript">
</script>

<script>
    $(document).ready(function () {
        rootwizard();
    });
    function rootwizard() {
    
        // Validate steps wizard
      
      // Show form
      var form = $(".steps-validation").show();
      
      $(".steps-validation").steps({
        headerTag: "h6",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            next: "{{__('partials.Next')}}",
            previous: "{{__('partials.Previous')}}",
            finish: "{{__('partials.Save')}}"
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            $(".select2").select2({
                placeholder: "{{__('partials.PleaseChoose')}}",
                width: '100%',
                allowClear: true
            });

            $(".switchBootstrap").bootstrapSwitch({
                // state: false,
                size: 'small',
                animate: true,
                onText: 'ON',
                offText: 'OFF',
            });
            
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            // Forbid next action on "Warning" step if the user is to young
            if (newIndex === 3 && Number($("#age-2").val()) < 18)
            {
                return false;
            }
            // Needed in some cases if the user went back (clean up)
            if (currentIndex < newIndex)
            {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            form.submit();
        }
      });
      
      // Initialize validation
      $(".steps-validation").validate({
        ignore: 'input[type=hidden]', // ignore hidden fields
        errorClass: 'danger',
        successClass: 'success',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        rules: {
            email: {
                email: true
            }
        }
      });
    }
</script>
@endpush