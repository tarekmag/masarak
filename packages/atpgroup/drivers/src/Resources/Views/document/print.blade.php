<img src="{{$driverDocument->document_url}}" style="width: 100%" />

<script src="{{asset('asset/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        window.print();
        setTimeout(function(){window.close();}, 1);
    });
</script>