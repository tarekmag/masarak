@extends('layouts.main')
@section('title', __('menu.Dashboard'))

@section('page-header')
    <x-page-header :pageTitle="__('menu.Dashboard')" :currentPageTitle="__('menu.Dashboard')" :haveSearch="false" linkCache="" :haveCalendarSearch="false" :pagesBreadcrumb="[]"
        :routePageCreate="false" :routeNamePageCreate="false" dataMethodCreate="" />
@endsection

@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-12 mt-3 mb-1">
                <h4 class="text-uppercase">{{ __('dashboard::language.blank.Welcome') }}: <span class="text-danger">{{ auth()->user()->name }}</span></h4>
            </div>
        </div>
    </div>
@endsection
