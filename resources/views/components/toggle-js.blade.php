<div>
    @push('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('asset/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    @endpush

    @push('js')
    <script src="{{asset('asset/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript">
    </script>

    <script>
        $(".switchBootstrap").bootstrapSwitch({
        // state: false,
        size: 'mini',
        animate: true,
        onText: 'ON',
        offText: 'OFF',
    });

    $('.switchBootstrap').on('switchChange.bootstrapSwitch', function(event, state) {
      let url = $(this).data('url');
      $.ajax({
          method: "GET",
          url: url,
          data: {
              "_token": "{{ csrf_token() }}"
          },
          success: function (response) {
              if (response.status === 'ok') {
                  toastr.success(response.message, "{{__('partials.Success')}}", {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 2000});
              }else{
                  toastr.error(response.message, "{{__('partials.Error')}}", {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 2000});
              }
          }
        });
    });
    </script>
    @endpush
</div>