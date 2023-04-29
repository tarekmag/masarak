@push('css')
<link rel="stylesheet" type="text/css"
    href="{{ asset('asset/app-assets/vendors/css/extensions/raty/jquery.raty.css') }}">
@endpush


@push('js')
<script src="{{ asset('asset/app-assets/vendors/js/extensions/jquery.raty.js') }}"></script>
<script>
    $(document).ready(function(){
        $.fn.raty.defaults.path = "{{ asset('asset/app-assets/images/raty/') }}";

        $("[data-rating-id]").each(function(){
            let id = $(this).data('rating-id');
            let rating = $(this).data('rating');

            $('#rating-'+id).raty({
                readOnly: true,
                score: rating
            });

        });
    });
</script>
@endpush