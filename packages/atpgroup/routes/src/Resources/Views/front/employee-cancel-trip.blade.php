@extends('layouts.front')
@section('title', __('route::language.field.cancelTheTrip'))



@push('css')


@endpush


@section('content')
    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">

                    <div class="card-header border-0 pb-0">
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>{{__('route::language.field.cancelTheTrip')}}</span></h6>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" action="index.html" novalidate>

                                <div class="row mb-12">
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <p class="text-center font-small-6 pt-6" style="font-size:20px">{{__('route::language.field.toCancelTheTripPleaseClickOnThisButton')}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12">
                                        <a href="login-advanced.html" class="btn btn-danger btn-lg btn-block">
                                            <i class="fa fa-window-close"></i> {{__('route::language.field.cancelTheTrip')}}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@push('js')


@endpush
