<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}" data-textdirection="{{ $currentLangauge->direction }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('asset/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/app-assets/images/ico/favicon.ico') }}">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,400,500,700') }}"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/app-assets/css' . $textDirection . '/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/app-assets/vendors/css/extensions/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/css' . $textDirection . '/app.css') }}">
    @if ($textDirection == '-rtl')
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/css-rtl/custom-rtl.css') }}">
    @endif
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/app-assets/css' . $textDirection . '/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('asset/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/assets/css/style' . $textDirection . '.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/css/pages/error.css') }}">
    <link href="{{ asset('asset/app-assets/css/plugins/codemirror/codemirror.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/app-assets/css/plugins/codemirror/ambiance.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/app-assets/css/plugins/codemirror/erlang-dark.css') }}" rel="stylesheet">
</head>

<body
    class="horizontal-layout horizontal-menu horizontal-menu-padding 1-column bg-cyan bg-lighten-2 menu-expanded fixed-navbar"
    data-open="hover" data-menu="horizontal-menu" data-col="1-column">
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="col-sm-12 col-md-12 col-lg-12 box-shadow-2">
                    <div class="card border-grey border-lighten-3 row">
                        <div class="card-header no-border pb-1">
                            <div class="card-body">
                                <h4 class="text-uppercase text-center"></h4>
                            </div>
                        </div>
                        <div class="card-content px-2">
                            <div class="form-body">
                                <form action="" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group control-group">
                                                <label for="name">File Path</label>
                                                <input type="text" name="file_path"
                                                    value="{{ request()->file_path }}" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <button type="submit" class="btn btn-blue" id="submit">
                                                <i class="fa fa-check-square-o"></i> Get File
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <form action="" method="post" id="save">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <button type="submit" class="btn btn-blue">
                                                <i class="fa fa-check-square-o"></i> Save File
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row py-2">
                                <div class="col-12">
                                    <textarea name="content" class="code_text" id="code_files" data-id="files">
@if (request()->file_path)
{{ \File::get(base_path(request()->file_path)) }}
@endif
</textarea>
                                </div>
                            </div>
                        </div>


                        <div class="card-content px-2">
                            <div class="form-body">
                                <form action="" method="post" id="savedb">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mt-2">
                                            <button type="submit" class="btn btn-blue">
                                                <i class="fa fa-check-square-o"></i> Save DB
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row py-2">
                                <div class="col-12">
                                    <textarea name="content_db" class="code_text" id="code_db" data-id="db"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('asset/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('asset/app-assets/vendors/js/ui/prism.min.js') }}"></script>
    <script src="{{ asset('asset/app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('asset/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('asset/app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('asset/app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('asset/app-assets/js/scripts/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('asset/app-assets/js/scripts/codemirror/mode/javascript/javascript.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var editor = CodeMirror.fromTextArea(document.getElementById("code_files"), {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                lineWrapping: true,
                autoCloseTags: true,
                indentUnit: 5,
                height: 1200,
                searchMode: 'inline',
                theme: "ambiance"
            });

            $("#save").on("submit", function(e) {
                e.preventDefault();
                var source_file = $("input[name=file_path]").val();
                var content = editor.getValue();
                $.ajax({
                    url: '{{ route('language.changeLanguage') }}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        source_file: source_file,
                        content: content,
                        is_file: true
                    },
                    success: function(result) {
                        alert('Done');
                    }
                });
            });

            var editorDB = CodeMirror.fromTextArea(document.getElementById("code_db"), {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                lineWrapping: true,
                autoCloseTags: true,
                indentUnit: 5,
                height: 1200,
                searchMode: 'inline',
                theme: "erlang-dark"
            });

            $("#savedb").on("submit", function(e) {
                e.preventDefault();
                var content = editorDB.getValue();
                $.ajax({
                    url: '{{ route('language.changeLanguage') }}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        content: content,
                        is_db: true
                    },
                    success: function(result) {
                        alert('Done');
                    }
                });
            });
        });
    </script>
</body>

</html>
