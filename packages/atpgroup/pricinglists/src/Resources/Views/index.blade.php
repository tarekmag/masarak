@extends('layouts.main')
@section('title', __('menu.PricingLists'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.PricingLists')" :currentPageTitle="__('menu.PricingLists')" :haveSearch="auth()->user()->company_id ? false : true" :linkCache="false" :haveCalendarSearch="false"
        :pagesBreadcrumb="[]" :routePageCreate="route('pricingList.create')" :routeNamePageCreate="__('partials.Create')" dataMethodCreate="pricingList.create" />
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
                                    <table class="table-striped table-bordered table" style="text-align: center">
                                        <thead>
                                            <tr>
                                                @if (!auth()->user()->company_id)
                                                    <th>{{ __('pricingList::language.field.company') }}</th>
                                                @endif
                                                <th>{{ __('pricingList::language.field.station_from') }}</th>
                                                <th>{{ __('pricingList::language.field.station_to') }}</th>
                                                <th>{{ __('pricingList::language.field.client_single_cost') }}</th>
                                                <th>{{ __('pricingList::language.field.client_waiting_cost') }}</th>
                                                @if (!auth()->user()->company_id)
                                                    <th>{{ __('pricingList::language.field.driver_single_cost') }}</th>
                                                    <th>{{ __('pricingList::language.field.driver_waiting_cost') }}</th>
                                                    <th>{{ __('partials.Settings') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $row)
                                                <tr>
                                                    @if (!auth()->user()->company_id)
                                                        <td>{{ optional($row->company)->name }}</td>
                                                    @endif
                                                    <td>{{ $row->station_from }}</td>
                                                    <td>{{ $row->station_to }}</td>
                                                    <td>{{ $row->client_single_cost }}</td>
                                                    <td>{{ $row->client_waiting_cost }}</td>
                                                    @if (!auth()->user()->company_id)
                                                        <td>{{ $row->driver_single_cost }}</td>
                                                        <td>{{ $row->driver_waiting_cost }}</td>
                                                        <td>
                                                            <x-edit :href="route('pricingList.edit', [$row->id])" data-method="pricingList.edit" />
                                                            <x-delete :href="route('pricingList.destroy', [$row->id])" data-method="pricingList.destroy" />
                                                        </td>
                                                    @endif
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
                                <div class="form-group control-group">
                                    <x-company-dropdown-company :companyId="request()->company_id" :required="false" name="company_id" />
                                </div>
                            </fieldset>
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
    </div>
@endsection
