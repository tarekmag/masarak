<!DOCTYPE html>
<html class="loading" lang="{{ $currentLangauge->symbol }}" data-textdirection="{{ $currentLangauge->direction }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="EpalSolutions">
  <title>@yield('title') | {{ config('app.name') }}</title>
  <link rel="apple-touch-icon" href="{{ asset('asset/app-assets/images/ico/apple-icon-120.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,400,500,700"
    rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/css'.$textDirection.'/vendors.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/forms/icheck/icheck.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/forms/icheck/custom.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/css'.$textDirection.'/app.css') }}">

  @if ($textDirection == '-rtl')
  <link rel="stylesheet" type="text/css" href="{{asset('asset/app-assets/css-rtl/custom-rtl.css')}}">
  @endif

  <link rel="stylesheet" type="text/css"
    href="{{ asset('asset/app-assets/css'.$textDirection.'/core/menu/menu-types/vertical-menu.css') }}">
  <link rel="stylesheet" type="text/css"
    href="{{ asset('asset/app-assets/css'.$textDirection.'/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/assets/css/style'.$textDirection.'.css') }}">
  @stack('css')
</head>

<body class="vertical-layout vertical-menu 1-column menu-expanded fixed-navbar" data-open="click"
  data-menu="vertical-menu" data-col="1-column" style="background-color: rgba(8, 112, 206, 0.08)">

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-body">
        @yield('content')
      </div>
    </div>
  </div>

  <x-footer />

  <script src="{{ asset('asset/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('asset/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"
    type="text/javascript">
  </script>
  <script src="{{ asset('asset/app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('asset/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ asset('asset/app-assets/js/core/app.js') }}" type="text/javascript"></script>
  <script src="{{ asset('asset/app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>

  @stack('js')
</body>

</html>