<div class="row col-md-12 itemStation" style="display: none;">
    <div class="col-md-7">
        <fieldset class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ft-search"></i></span>
                </div>
                <input type="text" class="form-control inputAutocomplete" name="station_name[]"
                    placeholder="{{ __('route::language.field.station') }}" />
                <input type="hidden" name="station_ids[]" class="station_ids">
            </div>
        </fieldset>
    </div>

    <div class="col-md-1">
        <button type="button" class="btn btn-danger btn-min-width btn-glow remove-station">X</button>
    </div>
</div>

<form class="form" id="stationForm" action="{{ route('route.updateStation', [$route->id]) }}" method="POST"
    novalidate>
    @csrf
    <div class="row col-md-12" id="resultStations">

        @foreach ($route->stations as $station)
            <div class="row col-md-12 itemStation">
                <div class="col-md-7">
                    <fieldset class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ft-search"></i></span>
                            </div>
                            <input type="text" class="form-control inputAutocomplete" name="station_name[]"
                                placeholder="{{ __('route::language.field.station') }}"
                                value="{{ optional($station->station)->name }}" />
                            <input type="hidden" name="station_ids[]" class="station_ids"
                                value="{{ $station->station_id }}">
                        </div>
                    </fieldset>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-min-width btn-glow remove-station">X</button>
                </div>
            </div>
        @endforeach

    </div>

    <x-loader id="loader_id_1" />

    <div class="row">
        <button type="button" id="addStation" class="btn btn-float btn-outline-cyan btn-round"><i
                class="fa fa-plus"></i></button>
    </div>

    <div class="form-actions right">
        <button type="submit" class="btn btn-blue">
            <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
        </button>
    </div>
</form>

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/css/plugins/ui/jqueryui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/app-assets/vendors/css/extensions/dragula.min.css') }}">
@endpush

@push('js')
    <script src="{{ asset('asset/app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('asset/app-assets/vendors/js/extensions/dragula.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            stationAutocomplete();
            stationSortable();

            $('#stationForm').on('submit', function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let inputs = $(this).serialize();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: inputs,
                    beforeSend: function () {
                        $('#loader_id_1').show();
                    },
                    success: function(response) {
                        $("#resultStations").find(".station_ids").each(function() {
                            if(jQuery.inArray($(this).val(), response.data) === -1)
                            {
                                $(this).closest('.itemStation').remove();
                            }
                        });
                        swal("{{ __('partials.GoodJob') }}", response.message, "success");
                        $('#loader_id_1').hide();
                    },
                    error: function(response) {
                        $('#loader_id_1').hide();
                        var errors = response.responseJSON.data;
                        var el = document.createElement("div");
                        $.each(errors, function(index, value) {
                            $('<p/>', {
                                class: 'text-danger',
                                html: value
                            }).appendTo(el);
                        });
                        swal({
                            icon: "{{ asset('asset/app-assets/images/icons/errorcode.png') }}",
                            title: "{{ __('partials.Error') }}",
                            content: {
                                element: el,
                            }
                        });
                    },
                });
            });
        });

        // Add New Station
        $(document).on('click', '#addStation', function(e) {
            $(".itemStation").first().clone().removeAttr('style').appendTo("#resultStations");
            stationAutocomplete();
        });

        // Remove Station
        $(document).on('click', '.remove-station', function(e) {
            let _this = $(this);
            if (confirm('Are you sure ?')) {
                _this.closest('.itemStation').remove();
            }
        });

        // Stations Autocomplete
        function stationAutocomplete() {
            $(".inputAutocomplete").autocomplete({
                minLength: 1,
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('station.getAutocomplete') }}",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    value: item.name,
                                    id: item.id
                                }
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $(this).val(ui.item.value); // display the selected text
                    $(this).closest('.itemStation').find('.station_ids').val(ui.item
                        .id); // save selected id to input
                    return false;
                }
            });
        }

        // Stations Sortable
        function stationSortable() {
            dragula([document.getElementById('resultStations')]);
        }
    </script>
@endpush
