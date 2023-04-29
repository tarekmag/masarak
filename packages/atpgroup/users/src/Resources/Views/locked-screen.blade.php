<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}" data-textdirection="{{ $currentLangauge->direction }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('asset/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('asset/app-assets/images/ico/favicon.ico')}}">
    <link
        href="{{asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,400,500,700')}}"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css'.$textDirection.'/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/ui/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/vendors/css/extensions/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css'.$textDirection.'/app.css')}}">
    @if ($textDirection == '-rtl')
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css-rtl/custom-rtl.css')}}">
    @endif
    <link rel="stylesheet" type="text/css"
        href="{{asset('asset/app-assets/css'.$textDirection.'/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/assets/css/style'.$textDirection.'.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css/pages/error.css')}}">
</head>

<body
    class="horizontal-layout horizontal-menu horizontal-menu-padding 1-column  bg-cyan bg-lighten-2 menu-expanded fixed-navbar"
    data-open="hover" data-menu="horizontal-menu" data-col="1-column">
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="col-sm-5 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4 box-shadow-2">
                    <div class="card border-grey border-lighten-3 px-2 my-0 row">
                        <div class="card-header no-border pb-1">
                            <div class="card-body">
                                <h2 class="error-code text-center mb-2">403</h2>
                                <h4 class="text-uppercase text-center">
                                    {{__('role::language.message.permission.denied')}}</h4>
                            </div>
                        </div>
                        <div class="card-content px-2">
                            <div class="row py-2">
                                <div class="col-12">
                                    <a href="{{route('dashboard.index')}}" class="btn btn-primary btn-block btn-lg"><i
                                            class="fa fa-home"></i>
                                        {{__('role::language.message.permission.backToDashboard')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
    <script src="{{asset('asset/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('asset/app-assets/vendors/js/ui/prism.min.js')}}"></script>
    <script src="{{asset('asset/app-assets/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/app-assets/js/core/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('asset/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
</body>

</html>