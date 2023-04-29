@extends('layouts.main')
@section('title', __('menu.Emergencies'))

@section('page-header')
<x-page-header 
    :pageTitle="__('menu.Emergencies')" 
    :currentPageTitle="__('menu.Emergencies')"
    :haveSearch="true" 
    :linkCache="false" 
    :haveCalendarSearch="false" 
    :pagesBreadcrumb="[]"
    :routePageCreate="route('emergency.create')" 
    :routeNamePageCreate="__('partials.Create')" 
    dataMethodCreate="emergency.create" 
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
                                            <th>{{__('emergency::language.field.name')}}</th>
                                            <th>{{__('emergency::language.field.mobile_number')}}</th>
                                            <th>{{__('partials.Settings')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($result as $row)
                                        <tr>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->mobile_number}}</td>
                                            <td>
                                                <x-edit :href="route('emergency.edit',[$row->id])" data-method="emergency.edit" />
                                                <x-delete :href="route('emergency.destroy',[$row->id])"
                                                    data-method="emergency.destroy" />
                                                <x-toggle :isActive="$row->is_active"
                                                    :url="route('emergency.activated',[$row->id])"
                                                    dataMethod="emergency.activated" />
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
                            <label for="name">{{__('emergency::language.field.name')}}</label>
                            <input type="text" name="name" value="{{request()->name}}" class="form-control" id="name"
                                placeholder="{{__('emergency::language.field.pleaseEnterName')}}">
                        </fieldset>
                        <br>

                        <fieldset class="form-group control-group floating-label-form-group control-group">
                            <label for="mobile_number">{{__('emergency::language.field.mobile_number')}}</label>
                            <input type="text" name="mobile_number" value="{{request()->mobile_number}}" class="form-control" id="mobile_number"
                                placeholder="{{__('emergency::language.field.pleaseEnterMobileNumber')}}">
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
    <x-toggle-js />
</div>
@endsection
