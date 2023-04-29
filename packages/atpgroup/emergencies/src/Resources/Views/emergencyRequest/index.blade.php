@extends('layouts.main')
@section('title', __('menu.EmergenciesRequests'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.EmergenciesRequests')" :currentPageTitle="__('menu.EmergenciesRequests')"
        :haveSearch="true" :linkCache="false" :haveCalendarSearch="false" :pagesBreadcrumb="[]" :routePageCreate="false"
        :routeNamePageCreate="false" dataMethodCreate="false" />
@endsection

@section('content')
    <div class="content-body">
        <section id="icon-tabs">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('partials.DataResult') }}</h4>
                            <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ __('emergency::language.field.trip') }}</th>
                                                <th>{{ __('emergency::language.field.emergency') }}</th>
                                                <th>{{ __('emergency::language.field.message') }}</th>
                                                <th>{{ __('emergency::language.field.created_at') }}</th>
                                                <th>{{ __('partials.Settings') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $row)
                                                <tr>
                                                    <td>
                                                        @if ($row->trip)
                                                            <a
                                                                href="{{ route('route.showTrip', $row->trip_id) }}">{{ optional($row->trip)->route_name }}</a>
                                                        @endif
                                                    </td>
                                                    <td>{{ optional($row->emergency)->name }}</td>
                                                    <td>{{ $row->message }}</td>
                                                    <td>{{ $row->created_at->format(config('helpers.dateTimeFormat12')) }}
                                                    </td>
                                                    <td>
                                                        <x-delete :href="route('emergencyRequest.destroy',[$row->id])"
                                                            data-method="emergencyRequest.destroy" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $result->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade text-left" id="searchModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel35">{{ __('partials.SearchModel') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="GET">
                        <div class="modal-body">
                            <fieldset class="form-group control-group floating-label-form-group control-group">
                                <x-emergency-dropdown-emergency :emergencyId="request()->emergency_id" :required="false"
                                    name="emergency_id" />
                            </fieldset>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-outline-blue btn-sm" value="{{ __('partials.Search') }}">
                            <input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"
                                value="{{ __('partials.Close') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <x-delete-js />
        <x-toggle-js />
    </div>
@endsection
