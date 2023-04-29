@extends('layouts.main')
@section('title', __('menu.Vehicles'))

@section('page-header')
<x-page-header 
    :pageTitle="__('menu.Vehicles')" 
    :currentPageTitle="__('menu.Vehicles')"
    :haveSearch="true" 
    :linkCache="false" 
    :haveCalendarSearch="false" 
    :pagesBreadcrumb="[]"
    :routePageCreate="route('vehicle.create')" 
    :routeNamePageCreate="__('partials.Create')" 
    dataMethodCreate="vehicle.create" 
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
                                            <th>#</th>
                                            <th>{{__('vehicle::language.field.brand')}}</th>
                                            <th>{{__('vehicle::language.field.plate_number')}}</th>
                                            <th>{{__('vehicle::language.field.brand_model')}}</th>
                                            <th>{{__('vehicle::language.field.color')}}</th>
                                            {{-- <th>{{__('vehicle::language.field.color_code')}}</th> --}}
                                            <th>{{__('vehicle::language.field.number_seats')}}</th>
                                            <th>{{__('vehicle::language.field.vehicle_year')}}</th>
                                            <th>{{__('partials.Settings')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($result as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{optional($row->brand)->name}}</td>
                                            <td>{{optional($row->brandModel)->name}}</td>
                                            <td>{{$row->plate_number}}</td>
                                            <td>{{$row->color}}</td>
                                            {{-- <td><span class="badge badge" style="background-color: {{$row->color_code}}">{{$row->color_code}}</span></td> --}}
                                            <td>{{$row->number_seats}}</td>
                                            <td>{{$row->vehicle_year}}</td>
                                            <td>
                                                <x-edit :href="route('vehicle.edit',[$row->id])" data-method="vehicle.edit" />
                                                <x-delete :href="route('vehicle.destroy',[$row->id])"
                                                    data-method="vehicle.destroy" />
                                                <x-toggle :isActive="$row->is_active"
                                                        :url="route('vehicle.activated',[$row->id])"
                                                        dataMethod="vehicle.activated" />
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
                            <label for="id">#</label>
                            <input type="text" name="id" value="{{request()->id}}" class="form-control">
                        </fieldset>
                        <br>
                        <fieldset class="form-group control-group floating-label-form-group control-group">
                            <label for="plate_number">{{__('vehicle::language.field.plate_number')}}</label>
                            <input type="text" name="plate_number" value="{{request()->plate_number}}" class="form-control" id="plate_number"
                                placeholder="{{__('vehicle::language.field.pleaseEnterPlateNumber')}}">
                        </fieldset>
                        <br>
                        <fieldset class="form-group control-group floating-label-form-group control-group">
                            <label for="number_seats">{{__('vehicle::language.field.number_seats')}}</label>
                            <input type="text" name="number_seats" value="{{request()->number_seats}}" class="form-control" id="number_seats"
                                placeholder="{{__('vehicle::language.field.pleaseEnterNumberSeats')}}">
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
