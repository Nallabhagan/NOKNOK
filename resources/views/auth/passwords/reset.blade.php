@extends('layouts.app')

@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Reset Password</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Reset Password</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="utf-login-register-page-aera margin-bottom-50">
                <div class="utf-welcome-text-item">
                    <h3>{{ __('Reset Password') }}</h3>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="utf-no-border">
                        <input id="email" type="email" class="utf-with-border @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span style="color: #e3342f!important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="utf-no-border">
                        <input id="password" type="password" class="utf-with-border @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                        @error('password')
                            <span style="color: #e3342f!important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="utf-no-border">
                        <input id="password-confirm" type="password" class="utf-with-border" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    </div>
                    <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit">{{ __('Reset Password') }} <i class="icon-feather-chevrons-right"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
