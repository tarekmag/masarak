@extends('layouts.auth')
@section('title', __('auth.ForgotPasswordPage'))

@section('content')
<section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                        <span>{{ __('auth.WeWillSendYouALinkToResetPassword') }}</span>
                    </h6>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}" novalidate>
                            @csrf

                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="email" class="form-control form-control-lg input-lg" id="user-email"
                                    placeholder="{{ __('auth.EmailAddress') }}" @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                                <div class="form-control-position">
                                    <i class="ft-mail"></i>
                                </div>
                                @error('email')
                                <div class="help-block font-small-4 danger">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <button type="submit" class="btn btn-outline-blue btn-lg btn-block"><i
                                    class="fa fa-paper-plane"></i> {{ __('auth.SendPasswordResetLink') }}</button>
                        </form>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <p class="float-sm-left text-center"><a href="{{ route('login') }}"
                            class="card-link" style="color:#0870ce">{{ __('auth.BackToLogin') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection