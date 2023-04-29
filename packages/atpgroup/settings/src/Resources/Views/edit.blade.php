@extends('layouts.main')
@section('title', __('menu.Settings'))

@section('page-header')
<x-page-header 
    :pageTitle="__('menu.Settings')" 
    :currentPageTitle="__('partials.Update')" 
    :haveSearch="false"
    :linkCache="false"
    :haveCalendarSearch="false" 
    :pagesBreadcrumb="[]" 
    :routePageCreate="false"
    :routeNamePageCreate="__('partials.Create')"
    dataMethodCreate=""
/>
@endsection

@section('content')
<div class="content-body">
    <section id="icon-tabs">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('partials.FormData')}}</h4>
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

                            <form class="form" action="{{route('setting.update')}}" method="POST" novalidate>
                                @include('setting::form')
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection