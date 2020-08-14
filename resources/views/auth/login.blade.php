@extends('layouts.app')

@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-uppercase">One click away from starting your own media House</h2>
                
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="utf-login-register-page-aera margin-bottom-50">
                <div class="utf-welcome-text-item">
                    <h3>Log In or Sign Up</h3>
                     
                </div>
                <form method="post" action="{{ route('login') }}">
                    @csrf
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
                    <div class="checkbox margin-top-10">

                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember"><span class="checkbox-icon"></span> Remember Me</label>
                    </div>
                    @if (Route::has('password.request'))
                        
                        <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                    @endif

                    <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit">Log In <i class="icon-feather-chevrons-right"></i></button>
                </form>
                
                <div class="utf-social-login-separator-item"><span>or</span></div>

                <div class="utf-social-login-buttons-block">
                    <a href="{{ url('login/facebook') }}" class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Facebook</a>
                    <a href="{{ url('login/google') }}" class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Google+</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
