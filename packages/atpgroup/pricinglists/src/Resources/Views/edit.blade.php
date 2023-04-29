@extends('layouts.main')
@section('title', __('menu.PricingLists'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.PricingLists')" :currentPageTitle="__('partials.Update')" :haveSearch="false" :linkCache="false" :haveCalendarSearch="false"
        :pagesBreadcrumb="[['title' => __('menu.PricingLists'), 'link' => route('pricingList.index')]]" :routePageCreate="false" :routeNamePageCreate="false" dataMethodCreate="" />
@endsection

@section('content')
    <div class="content-body">
        <section id="icon-tabs">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('partials.FormData') }}</h4>
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

                                <form class="form" action="{{ route('pricingList.update', [$pricingList->id]) }}"
                                    method="POST" novalidate>
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            @csrf
                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <x-company-dropdown-company :companyId="$pricingList->company_id" :required="true"
                                                        name="company_id" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <label
                                                        for="station_from">{{ __('pricingList::language.field.station_from') }}
                                                        <span class="danger">*</span> </label>
                                                    <input type="text" name="station_from"
                                                        value="{{ inputValidation('station_from', $pricingList) }}"
                                                        id="station_from" class="form-control"
                                                        placeholder="{{ __('pricingList::language.field.station_from') }}"
                                                        required
                                                        data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group control-group">
                                                    <label
                                                        for="station_to">{{ __('pricingList::language.field.station_to') }}
                                                        <span class="danger">*</span> </label>
                                                    <input type="text" name="station_to"
                                                        value="{{ inputValidation('station_to', $pricingList) }}"
                                                        id="station_to" class="form-control"
                                                        placeholder="{{ __('pricingList::language.field.station_to') }}"
                                                        required
                                                        data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group control-group">
                                                    <label
                                                        for="client_single_cost">{{ __('pricingList::language.field.client_single_cost') }}
                                                        <span class="danger">*</span> </label>
                                                    <input type="text" name="client_single_cost"
                                                        value="{{ inputValidation('client_single_cost', $pricingList) }}"
                                                        id="client_single_cost" class="form-control"
                                                        placeholder="{{ __('pricingList::language.field.client_single_cost') }}"
                                                        required
                                                        data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group control-group">
                                                    <label
                                                        for="client_waiting_cost">{{ __('pricingList::language.field.client_waiting_cost') }}
                                                        <span class="danger">*</span> </label>
                                                    <input type="text" name="client_waiting_cost"
                                                        value="{{ inputValidation('client_waiting_cost', $pricingList) }}"
                                                        id="client_waiting_cost" class="form-control"
                                                        placeholder="{{ __('pricingList::language.field.client_waiting_cost') }}"
                                                        required
                                                        data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group control-group">
                                                    <label
                                                        for="driver_single_cost">{{ __('pricingList::language.field.driver_single_cost') }}
                                                        <span class="danger">*</span> </label>
                                                    <input type="text" name="driver_single_cost"
                                                        value="{{ inputValidation('driver_single_cost', $pricingList) }}"
                                                        id="driver_single_cost" class="form-control"
                                                        placeholder="{{ __('pricingList::language.field.driver_single_cost') }}"
                                                        required
                                                        data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group control-group">
                                                    <label
                                                        for="driver_waiting_cost">{{ __('pricingList::language.field.driver_waiting_cost') }}
                                                        <span class="danger">*</span> </label>
                                                    <input type="text" name="driver_waiting_cost"
                                                        value="{{ inputValidation('driver_waiting_cost', $pricingList) }}"
                                                        id="driver_waiting_cost" class="form-control"
                                                        placeholder="{{ __('pricingList::language.field.driver_waiting_cost') }}"
                                                        required
                                                        data-validation-required-message="{{ __('partials.ThisFieldIsRequired') }}">
                                                </div>
                                            </div>
                                        </div>
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
        </section>
    </div>
@endsection
