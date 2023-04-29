@push('js')
<script>
    function uploadImage(selector) {
        var file_data = selector.prop("files")[0];
        var config =  selector.parent().find(".config").val();
        config = JSON.parse(config);

        var form_data = new FormData();
        form_data.append("file", file_data);
        for(i in config){
            form_data.append(i, config[i]);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            xhr: function() {
                var $progress_div = selector.parent().find(".progress") ;
                var $progress_bar = selector.parent().find(".progress-bar") ;
                $progress_div.show();
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $progress_bar.width(percentComplete + '%');
                        $progress_bar.html(percentComplete+'%');
                        if(percentComplete==100){
                            $progress_div.hide();
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'post',
            url: "{{url('upload-image')}}",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,

            complete: function (result) {
                var content = $.parseJSON(result.responseText);
                if (content.status =='error')
                {
                    alert(content.error);
                    return;
                }

                var element = selector.parent().find('.preview-container');
                name = config.name;
                folder = config.folder;
                if(typeof config.is_file == 'undefined'){
                    var text = '\n\
                    <li class="image_container" >\n\
                            <a href="#" style="bottom:0%;left:110%;" class="delete_image" >x</a>\n\
                            <img style="width:100px;margin:0 3px" id=""  src="{{url('./')}}/'+folder+'/'+ content.name +'" />\n\
                            <input type="hidden" name="' + name + '"  value="' + content.name + '" />\n\
                    </li> \n\
                    ';
                }else{
                    var text = '\n\
                    <li class="image_container" >\n\
                            <a href="#" class="delete_image" >x</a>\n\
                            <a target="_blank" href="{{url('./')}}/'+folder+'/'+ content.name +'" >Preview</a> \n\
                            <input type="hidden" name="' + name + '"  value="' + content.name + '" />\n\
                    </li> \n\
                    ';
                }

                if (typeof element.attr('data-hasOne') == 'undefined')
                    element.append(text).show();
                else
                    element.html(text).show();
            }
        });
    }
    function uploadImages(selector) {
        var config =  selector.parent().find(".config").val();
        config = JSON.parse(config);

        var form_data = new FormData();
        $.each(selector[0].files, function(i, file) {
            form_data.append('file[]', file);
        });
        for(i in config){
            form_data.append(i, config[i]);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            xhr: function() {
                var $progress_div = selector.parent().find(".progress") ;
                var $progress_bar = selector.parent().find(".progress-bar") ;
                $progress_div.show();
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $progress_bar.width(percentComplete + '%');
                        $progress_bar.html(percentComplete+'%');
                        if(percentComplete==100){
                            $progress_div.hide();
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'post',
            url: "{{url('upload-images')}}",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,

            complete: function (result) {
                var content = $.parseJSON(result.responseText);
                if (content.status =='error')
                {
                    alert(content.error);
                    return;
                }

                var element = selector.parent().find('.preview-container');
                name = config.name;
                folder = config.folder;
                var text = '';
                $.each(content.names, function(i, filename) {
                    if(typeof config.is_file == 'undefined'){
                            text+= '<li class="image_container" >\n\
                                <a href="#" style="bottom:0%;left:110%;" class="delete_image" >x</a>\n\
                                <img style="width:100px;margin:0 3px" id=""  src="{{url("./")}}/'+folder+'/'+ filename +'" />\n\
                                <input type="hidden" name="' + name + '"  value="' + filename + '" />\n\
                        </li> \n\
                        ';
                    }else{
                        text+= '<li class="image_container mr-1" ><a href="#" class="delete_image" >x</a>';
                            text+= fileIcon(filename);
                            text+='<a style="margin-left:0px;" target="_blank" href="{{url("./")}}/'+folder+'/'+ filename +'" >Preview</a> \n\
                            <input type="hidden" name="' + name + '"  value="' + filename + '" />\n\
                        </li> \n\
                        ';
                    }
                });
                if (typeof element.attr('data-hasOne') == 'undefined')
                    element.append(text).show();
                else
                    element.html(text).show();
            }
        });
    }

    function fileIcon(name){
        var pattern = /(?:\.([^.]+))?$/;
        var ext = pattern.exec(name)[1];
        switch (ext) {
            case 'docx':
            case 'doc':
                return '<i style="margin-left:15px;margin-right: 3px;font-size: 17px;" class="fa fa-file-word-o" aria-hidden="true"></i>';
                break;
            case 'pdf':
                    return '<i style="margin-left:15px;margin-right: 3px;font-size: 17px;" class="fa fa-file-pdf-o" aria-hidden="true"></i>';
                break;
            case 'xlsx':
            case 'xls':
            case 'csv':
                    return '<i style="margin-left:15px;margin-right: 3px;font-size: 17px;" class="fa fa-file-excel-o" aria-hidden="true"></i>';
                break;
            case 'jpeg':
            case 'png':
            case 'jpg':
                    return '<i style="margin-left:15px;margin-right: 3px;font-size: 17px;" class="fa fa-file-image-o" aria-hidden="true"></i>';
                break;

            default:
                return '<i style="margin-left:15px;margin-right: 3px;font-size: 17px;" class="fa fa-file-o" aria-hidden="true"></i>';
                break;
        }
    }
    $(document).ready(function () {
        //--------------------------
        $(document).on("change", "input:file.image", function () {
            uploadImage($(this));
        });
        $(document).on("change", "input:file.images", function () {
            uploadImages($(this));
        });
        $(document).on('click', '.delete_image', function (e) {
            e.preventDefault();
            var id = $(this).parent().find('img').attr('id');
            if (id > 0)
            {
                $('form').append("<input type='hidden' name='deleted_images[]' value='" + id + "' >");
            }
            $(this).parent().remove();
        });
        $('.fileIcon').each(function(){
            const name = $(this).data('name');
            const html = fileIcon(name) ;
            $(this).replaceWith(html);
        })
    });
        //--------------------------
</script>
@endpush
