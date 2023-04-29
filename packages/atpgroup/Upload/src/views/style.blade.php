@push('css')
<style>

    ul.preview-container {
            padding: 0;
            margin-top: 5px;
        }

        ul.preview-container li {
            list-style: none;
            display: inline-block;
            position: relative;
            cursor: grab;
        }

        ul.preview-container li img {
            border-radius: 20px;
            transform: translate(10px, 4px);
        }

        ul.preview-container li a {
            margin-left: 15px;
            ;
        }

        ul.preview-container li .delete_image {
            position: absolute;
            top: 0;
            left: -15px;
            color: red;
        }



</style>
@endpush
