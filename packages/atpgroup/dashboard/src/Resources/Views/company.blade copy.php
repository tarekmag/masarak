@extends('layouts.main')
@section('title', __('menu.Dashboard'))

@section('page-header')

<x-page-header
    :pageTitle="__('menu.Dashboard')"
    :currentPageTitle="__('menu.Dashboard')"
    :haveSearch="false"
    :linkCache="false"
    :haveCalendarSearch="false"
    :pagesBreadcrumb="[]"
    :routePageCreate="false"
    :routeNamePageCreate="false"
    dataMethodCreate=""
/>
@endsection

@section('content')
<div class="content-body">

  {{-- <x-maps.open-street-map.static-marker :lat="30.164130" :lng="31.307050" :zoom="15" width="100%" height="450px;" /> --}}
  {{-- <x-maps.open-street-map.add-marker :lat="30.164130" :lng="31.307050" :zoom="15" width="100%" height="450px;" /> --}}
  {{-- <x-maps.open-street-map.add-marker :lat="null" :lng="null" :zoom="15" width="100%" height="450px;" /> --}}
  {{-- <x-maps.open-street-map.routing
    :coordinates="json_encode([
      [30.031384, 31.450060],
    [30.021278, 31.431508],
    [30.021575, 31.411067],
    [30.016373, 31.411067],
    [30.016596, 31.403251],
    [30.027074, 31.403079],
    [30.049736, 31.409091],
    [30.051222, 31.411410],
     ])"
    :stations="json_encode([
      [30.031384, 31.450060],
    [30.021278, 31.431508],
    [30.021575, 31.411067],
    [30.016373, 31.411067],
    [30.016596, 31.403251],
    [30.027074, 31.403079],
    [30.049736, 31.409091],
    [30.051222, 31.411410],
    ])"
    :zoom="10"
    width="100%"
    height="450px;"
    /> --}}

  {{-- <x-maps.open-street-map.live-traking
    :tripId="1"
    :coordinates="json_encode([
      [30.031384, 31.450060],
    [30.021278, 31.431508],
    [30.021575, 31.411067],
    [30.016373, 31.411067],
    [30.016596, 31.403251],
    [30.027074, 31.403079],
    [30.049736, 31.409091],
    [30.051222, 31.411410],
     ])"
    :stations="json_encode([
      [30.031384, 31.450060],
    [30.021278, 31.431508],
    [30.021575, 31.411067],
    [30.016373, 31.411067],
    [30.016596, 31.403251],
    [30.027074, 31.403079],
    [30.049736, 31.409091],
    [30.051222, 31.411410],
    ])"
    :zoom="10"
    width="100%"
    height="450px;"
    /> --}}

</div>
@endsection
