@extends('layouts.app')
@section('social-media-meta-tags')
<title>NOKNOK | LOGIN</title>
@endsection
@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Register</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Register</li>
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
                    <h3>Create Your New Account!</h3>
                    <span>Don't Have an Account? <a href="{{ route('login') }}">Log In!</a></span> 
                </div>
                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="utf-no-border">
                        <input id="name" type="text" class="utf-with-border @error('name') is-invalid @enderror" name="name" placeholder="User Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="utf-no-border">
                        <input id="email" type="email" class="utf-with-border @error('email') is-invalid @enderror" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="utf-no-border">
                        <input id="password" type="password" class="utf-with-border @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="utf-no-border">
                        <input id="password-confirm" type="password" class="utf-with-border form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    </div>
                    <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit">Create An Account <i class="icon-feather-chevrons-right"></i></button>
                </form>
                <div class="utf-social-login-separator-item"><span>or</span></div>
                <div class="utf-social-login-buttons-block">
                    <a href="#" class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Facebook</a>
                    <a href="#" class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Google+</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

