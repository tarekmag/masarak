<div>
    @push('js')
    <script type="text/javascript">
    $('.delete-item').click(function (e) {
      let me = $(this);
      e.preventDefault();
      let url = me.attr('href');

      swal({
		    title: "{{__('partials.AreYouSure')}}",
		    text: "{{__('partials.YouWillNotBeAble')}}",
		    icon: "warning",
		    showCancelButton: true,
		    buttons: {
                cancel: {
                    text: "{{__('partials.NoCancel')}}",
                    value: null,
                    visible: true,
                    className: "btn-warning",
                    closeModal: false,
                },
                confirm: {
                    text: "{{__('partials.YesDeleteIt')}}",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: false
                }
		    }
		}).then(isConfirm => {
		    if (isConfirm) {
                 $.ajax({
                    method: "DELETE",
                    url: url,
                    data: {
                    "_token": "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.status === 'ok') {
                            me.closest('tr').remove();
                            swal("{{__('partials.Deleted')}}", response.message, 'success');
                        } else {
    		                swal("{{__('partials.CannotbeDeleted')}}!", response.message, "error");
                        }
                    }
                    });
		    } else {
		        swal("{{__('partials.Cancelled')}}", "{{__('partials.YourImaginaryFileIsSafe')}}", "info");
		    }
		});
    });
    </script>
    @endpush
</div>