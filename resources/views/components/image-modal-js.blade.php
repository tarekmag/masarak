<!-- The Image Modal -->
<div class="modal fade text-left" id="imageModal" tabindex="-1" role="dialog"
aria-labelledby="imageModal2" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <img id="ModalImage" style="width: 100%;">
        </div>
        <div class="modal-footer">
            <input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"
                value="{{__('partials.Close')}}">
        </div>
    </div>
</div>
</div>

@push('js')
<script>
    $(document).ready(function(){
    // Get the modal
    $(".mainImage").on('click', function(e){
        e.preventDefault();

        let img = $(this);
        let modalImg = $("#ModalImage");

        $("#imageModal").modal('show');

        $(document).on('shown.bs.modal', '#imageModal', function (e) {
            modalImg.attr('src', img.attr('src'));
        });
    });
});
</script>
@endpush