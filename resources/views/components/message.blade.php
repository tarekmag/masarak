<div>
    @if(session()->has('toastrSuccess'))
    <script type="text/javascript">
        $(document).ready(function () {
        toastr.success("{{session('toastrSuccess')}}", "{{__('partials.Success')}}", {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 2000});
    });
    </script>
    @endif

    @if(session()->has('success'))
    <script type="text/javascript">
        $(document).ready(function () {
        swal("{{__('partials.GoodJob')}}", "{{session('success')}}", "success");
    });
    </script>
    @endif

    @if(session()->has('warning'))
    <script type="text/javascript">
        $(document).ready(function () {
            swal("{{__('partials.Warning')}}", "{{session('warning')}}", "warning");
        });
    </script>
    @endif

    @if(session()->has('error'))
    <script type="text/javascript">
        $(document).ready(function () {
        var errors = <?= json_encode(session('error')); ?>;
        var el = document.createElement("div");
        $.each(errors, function(index, value) {
            $('<p/>', {
                class: 'text-danger',
                html: value
            }).appendTo(el);
        });
		swal({
            icon:"{{asset('asset/app-assets/images/icons/errorcode.png')}}",
			title: "{{__('partials.Error')}}",
			content: {
				element: el,
			}
		});
    });
    </script>
    @endif
</div>