@extends('layouts.auth')
@section('title', __('auth.LoginPage'))

@push('css')
<link rel="stylesheet" type="text/css"
    href="{{asset('asset/app-assets/css'.$textDirection.'/pages/login-register.css')}}">
@endpush

@section('content')
<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <img class="img-fluid mb-2" style="height: 100px;" src="{{ asset('images/Transic_Icon.svg') }}"
                            alt="{{__('partials.AppName')}}">
                        <h3 style="color:#0870ce">{{__('partials.AppName')}}</h3>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}" novalidate>
                            @csrf

                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="email" class="form-control input-lg @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                                    placeholder="{{ __('auth.EmailAddress') }}" tabindex="1" required
                                    data-validation-required-message="{{ __('auth.PleaseEnterYourEmailAddress') }}">
                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                                @error('email')
                                <div class="help-block font-small-4 danger">{{ $message }}</div>
                                @enderror
                            </fieldset>

                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password"
                                    class="form-control input-lg @error('password') is-invalid @enderror" id="password"
                                    placeholder="{{ __('auth.Password') }}" name="password"
                                    autocomplete="current-password" tabindex="2" required
                                    data-validation-required-message="{{ __('auth.PleaseEnterValidPasswords') }}">
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                                @error('password')
                                <div class="help-block font-small-4 danger">{{ $message }}</div>
                                @enderror
                            </fieldset>

                            <div class="form-group row">
                                <div class="col-md-6 col-12 text-center text-md-left">
                                    <fieldset>
                                        <input type="checkbox" id="remember-me" class="chk-remember" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember-me">{{ __('auth.RememberMe') }}</label>
                                    </fieldset>
                                </div>

                                @if (Route::has('password.request'))
                                <div class="col-md-6 col-12 text-center text-md-right"><a
                                        href="{{ route('password.request') }}"
                                        class="card-link" style="color:#0870ce">{{ __('auth.ForgotYourPassword') }}</a></div>
                                @endif

                            </div>
                            <button type="submit" class="btn btn-outline-blue btn-block btn-lg"><i
                                    class="ft-unlock"></i>
                                {{ __('auth.Login') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="{{asset('asset/app-assets/js/scripts/forms/form-login-register.js')}}" type="text/javascript"></script>
@endpush
