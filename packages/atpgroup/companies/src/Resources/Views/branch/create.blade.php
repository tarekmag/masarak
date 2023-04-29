@extends('layouts.main')
@section('title', __('menu.Branches'))

@section('page-header')
<x-page-header 
    :pageTitle="__('menu.Branches')" 
    :currentPageTitle="__('partials.Create')" 
    :haveSearch="false"
    :linkCache="false"
    :haveCalendarSearch="false" 
    :pagesBreadcrumb="[['title'=> __('menu.Branches'), 'link'=> route('branch.index')]]" 
    :routePageCreate="false"
    :routeNamePageCreate="false"
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

                            <form class="form" action="{{route('branch.store')}}" method="POST" novalidate>
                                @include('company::branch.form')
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection