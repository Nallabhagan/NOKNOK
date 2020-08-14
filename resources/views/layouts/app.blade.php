<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="author" content="">
        <meta name="description" content="">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @section('social-media-meta-tags')
            @show
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>:: NOKNOK - Interview Anyone Share With Everyone ::</title>
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!--  Favicon -->
        <link rel="shortcut icon" href="{{ url('images/favicon.png') }}">
        <!-- CSS -->
        <link rel="stylesheet" href="{{ url('css/bootstrap-grid.css') }}">
        <link rel="stylesheet" href="{{ url('css/icons.css') }}">
        {{-- <link rel="stylesheet" href="https://voteracts.com/assets/css/icons.css"> --}}
        <link rel="stylesheet" href="{{ url('css/style.css') }}">
        <link rel="stylesheet" href="{{ url('css/main.css') }}">
        <link rel="stylesheet" href="{{ url('css/framework.css') }}">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"> 
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> 
        <script type="text/javascript" src="{{ url('js/framework.js') }}"></script>
    </head>
    <body>
        
        <!--Loader-->
        <div class="vfx-loader">
            <div class="loader-wrapper">
                <div class="loader-content">
                    <div class="loader-dot dot-1"></div>
                    <div class="loader-dot dot-2"></div>
                    <div class="loader-dot dot-3"></div>
                    <div class="loader-dot dot-4"></div>
                    <div class="loader-dot dot-5"></div>
                    <div class="loader-dot dot-6"></div>
                    <div class="loader-dot dot-7"></div>
                    <div class="loader-dot dot-8"></div>
                    <div class="loader-dot dot-center"></div>
                </div>
            </div>
        </div>
        <!-- Loader end -->
        <!-- Wrapper -->
        <div id="wrapper">
            <div id="app">
                @include('_includes.header')
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
        
        <!-- Wrapper / End --> 
        <!-- Scripts -->  
        
        <script src="{{ url('js/jquery-migrate-3.0.0.min.js') }}"></script> 
        <script src="{{ url('js/mmenu.min.js') }}"></script> 
        <script src="{{ url('js/tippy.all.min.js') }}"></script> 
        <script src="{{ url('js/simplebar.min.js') }}"></script> 
        <script src="{{ url('js/bootstrap-slider.min.js') }}"></script> 
        <script src="{{ url('js/bootstrap-select.min.js') }}"></script> 
        <script src="{{ url('js/snackbar.js') }}"></script> 
        <script src="{{ url('js/clipboard.min.js') }}"></script> 
        <script src="{{ url('js/magnific-popup.min.js') }}"></script> 
        <script src="{{ url('js/slick.min.js') }}"></script> 
        <script src="{{ url('js/typed.js') }}"></script>
        <script src="{{ url('js/custom_jquery.js') }}"></script> 
        
        
        @section('scripts')
            @show()
            
        <!-- Global site tag (gtag.js) - Google Analytics -->
        {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-159162800-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-159162800-1');
        </script> --}}
    </body>

</html>
