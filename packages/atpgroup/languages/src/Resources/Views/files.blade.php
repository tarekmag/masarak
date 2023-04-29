@extends('layouts.main')
@section('title', __('menu.Languages'))

@section('page-header')
<x-page-header 
    :pageTitle="__('menu.Languages')" 
    :currentPageTitle="__('partials.Update')" 
    :haveSearch="false"
    :linkCache="false"
    :haveCalendarSearch="false" 
    :pagesBreadcrumb="[['title'=> __('menu.Languages'), 'link'=> route('language.index')]]" 
    :routePageCreate="false"
    :routeNamePageCreate="false"
    dataMethodCreate=""
/>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/ui/jquery-ui.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/plugins/ui/jqueryui.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/plugins/loaders/loaders.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/core/colors/palette-loader.css')}}">
@endpush

@section('content')
<div class="content-body">
    <section id="icon-tabs">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('partials.FormData')}}</h4>
                        <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show constrain-movement-container">
                        <div class="card-body">

                            <div class="jqueryui-ele-container">
                                <div class="accordion-default">

                                    @foreach ($result as $key=>$item)
                                    <form class="form" action="{{route('language.updateFile', [$language->id])}}"
                                        method="POST" data-file-path="{{$item['filePath']}}"
                                        data-file-full-path="{{$item['fileFullPath']}}" data-file-name="{{$item['fileName']}}" novalidate>
                                        <h3>{{ucfirst($item['name'])}}</h3>
                                        <div>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('language::language.field.key') }}</th>
                                                            <th>{{ __('language::language.field.value') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($item['file'] as $key=>$row)
                                                        <tr>
                                                            <td>{{$key}}</td>
                                                            <td>
                                                                <input type="string" name="{{$key}}" value="{{$row}}"
                                                                    class="form-control" required
                                                                    data-validation-required-message="{{__('partials.ThisFieldIsRequired')}}">
                                                            </td>

                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="loader-wrapper">
                                                <div class="loader-container">
                                                    <div class="ball-pulse loader-primary">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions right" data-method="language.updateFile">
                                                <button type="submit" class="btn btn-blue">
                                                    <i class="fa fa-check-square-o"></i> {{__('partials.Save')}}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
<script src="{{asset('asset/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript">
</script>

<script>
    $(document).ready( function(){
        $('.loader-wrapper').hide();
        $(".accordion-default").accordion({ header: "h3", collapsible: true, active: false, heightStyle: "content" });

        $('.form').on('submit', function(e){
            e.preventDefault();
            let form = $(this);
            $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: {
                    "_token": "{{ csrf_token() }}",
                    "filePath" : form.data('file-path'),
                    "fileFullPath" : form.data('file-full-path'),
                    "fileName" : form.data('file-name'),
                    "file" : form.serializeArray(),
                    },
                    beforeSend: function () {
                        $('.loader-wrapper').show();
                    },
                    success: function (response)
                    {
                        if (response.status === 'ok') {
                            $('.loader-wrapper').hide();
                            swal("{{__('partials.GoodJob')}}", response.message, "success");
                        }else{
                            swal("{{__('partials.Error')}}!", response.message, "error");
                        }
                    }
                });
        });
});
</script>
@endpush