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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="utf-no-border">
                        <input id="email" type="email" class="utf-with-border @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span style="color: #e3342f!important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit">{{ __('Send Password Reset Link') }} <i class="icon-feather-chevrons-right"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
