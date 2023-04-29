@extends('layouts.main')
@section('title', __('menu.Employees'))

@section('page-header')
<x-page-header
    :pageTitle="__('menu.Employees')"
    :currentPageTitle="__('menu.Employees')"
    :haveSearch="true"
    :linkCache="false"
    :haveCalendarSearch="false"
    :pagesBreadcrumb="[]"
    :routePageCreate="route('employee.create')"
    :routeNamePageCreate="__('partials.Create')"
    dataMethodCreate="employee.create"
/>
@endsection

@section('content')
<div class="content-body">
    <section id="icon-tabs">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('partials.DataResult')}}</h4>
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
                                            {{-- <th>{{__('employee::language.field.mainBranch')}}</th> --}}
                                            <th>{{__('employee::language.field.branch')}}</th>
                                            <th>{{__('employee::language.field.station')}}</th>
                                            <th>{{__('employee::language.field.name')}}</th>
                                            <th>{{__('employee::language.field.phone')}}</th>
                                            <th>{{__('employee::language.field.email')}}</th>
                                            <th>{{__('partials.Settings')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($result as $row)
                                        <tr>
                                            {{-- <td>{{optional($row->company)->name}}</td> --}}
                                            <td>{{optional($row->branch)->name}}</td>
                                            <td>{{optional($row->station)->name}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->phone}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>
                                                <x-edit :href="route('employee.edit',[$row->id])" data-method="employee.edit" />
                                                    @if ($row->station)
                                                    <x-custom-action :title="__('station::language.field.pickup_map')" routeName="http://maps.google.com/?q={{ $row->station->pickup_lat }},{{ $row->station->pickup_lng }}" icon="map" color="blue" target="_blank" dataMethod="employee.index" />
                                                    <x-custom-action :title="__('station::language.field.drop_map')" routeName="http://maps.google.com/?q={{ $row->station->drop_lat }},{{ $row->station->drop_lng }}" icon="map" color="blue" target="_blank" dataMethod="employee.index" />
                                                    @endif
                                                <x-delete :href="route('employee.destroy',[$row->id])" data-method="employee.destroy" />
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$result->render()}}
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
                    <h3 class="modal-title" id="myModalLabel35">{{__('partials.SearchModel')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="GET">
                    <div class="modal-body">
                        <fieldset class="form-group control-group floating-label-form-group control-group">
                            <x-company-dropdown-company :companyId="request()->company_id" :required="false" name="company_id" />
                        </fieldset>
                        <br>
                        <fieldset class="form-group control-group floating-label-form-group control-group">
                            <x-company-dropdown-branch :companyId="request()->company_id" :branchId="request()->branch_id" :required="false" name="branch_id" />
                        </fieldset>
                        <br>
                        <fieldset class="form-group control-group floating-label-form-group control-group">
                            <label for="name">{{__('employee::language.field.name')}}</label>
                            <input type="text" name="name" value="{{request()->name}}" class="form-control" id="name"
                                placeholder="{{__('employee::language.field.pleaseEnterName')}}">
                        </fieldset>
                        <br>
                        <fieldset class="form-group control-group floating-label-form-group control-group">
                            <label for="phone">{{__('employee::language.field.phone')}}</label>
                            <input type="text" name="phone" value="{{request()->phone}}" class="form-control" id="phone"
                                placeholder="{{__('employee::language.field.pleaseEnterPhone')}}">
                        </fieldset>
                        <br>
                        <fieldset class="form-group control-group floating-label-form-group control-group">
                            <label for="email">{{__('employee::language.field.email')}}</label>
                            <input type="email" name="email" value="{{request()->email}}" class="form-control" id="email"
                                placeholder="{{__('employee::language.field.pleaseEnterEmail')}}">
                        </fieldset>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-outline-blue btn-sm" value="{{__('partials.Search')}}">
                        <input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal"
                            value="{{__('partials.Close')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-delete-js />
</div>
@endsection
