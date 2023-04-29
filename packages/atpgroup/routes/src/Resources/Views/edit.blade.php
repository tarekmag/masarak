@extends('layouts.main')
@section('title', __('menu.Routes'))

@section('page-header')
<x-page-header
    :pageTitle="__('menu.Routes')"
    :currentPageTitle="__('partials.Update')"
    :haveSearch="false"
    :linkCache="false"
    :haveCalendarSearch="false"
    :pagesBreadcrumb="[['title'=> __('menu.Routes'), 'link'=> route('route.index')]]"
    :routePageCreate="false"
    :routeNamePageCreate="false"
    dataMethodCreate=""
/>
@endsection

@section('content')
    <div class="content-body">
        <section id="icon-tabs">
            <!-- Route Information -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('route::language.page.route_info') }}</h4>
                            <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right mt-1">
                                    <a href="{{ route('route.dispatchTrips', [$route->id]) }}" class="btn btn-outline-warning btn-min-width"><i class="fa fa-bolt"></i> {{ __('route::language.page.dispatch_trips') }}</a>
                                    <a href="{{ route('route.createTrip', [$route->id]) }}" class="btn btn-outline-primary btn-min-width"><i class="fa fa-map-signs"></i> {{ __('route::language.page.create_trip') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form class="form" id="routeForm" action="{{ route('route.update', [$route->id]) }}"
                                    method="POST" novalidate>
                                    @method('PUT')
                                    <div class="form-body">
                                        @include('route::partials.route_form')
                                    </div>

                                    <div class="form-actions right">
                                        <button type="submit" class="btn btn-blue">
                                            <i class="fa fa-check-square-o"></i> {{ __('partials.Save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('route::language.page.map') }}</h4>
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
                                @include('route::partials.route_map', ['coordinates' => $route->stations_coordinates, 'stations' => $route->stations_coordinates])
                                {{-- @include('route::partials.route_map_2', ['coordinates' => $route->stations_coordinates, 'stations' => $route->stations_coordinates]) --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stations -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('route::language.page.stations') }}</h4>
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
                                @include('route::partials.stations', ['route' => $route])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('route::language.page.schedule') }}</h4>
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
                                @include('route::partials.schedule', ['route' => $route])
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trips -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('route::language.page.trips') }}</h4>
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
                                @include('route::partials.trips', ['route' => $route])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
