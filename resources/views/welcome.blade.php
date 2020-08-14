@extends('layouts.app')
@section('social-media-meta-tags')
    <script data-ad-client="ca-pub-5579049466595431" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <meta property="og:description" content="Interview Anyone,Share With Everyone, bring out the stories, the opinions and perspectives from the people who you know" />
    <meta property="og:title" content="NOKNOK.qa | Interview Anyone Share With Everyone" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://noknok.qa" />
    <meta property="og:image" content="https://noknok.qa/noknok.jpg" />
    <meta property="fb:app_id" content="2714676228810928" />
@endsection
@section('content')
  <!-- Intro Banner -->
  <div id="demo" class="carousel slide" data-ride="carousel">

    
    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/banner.jpg" alt="Los Angeles">
        <div class="carousel-caption">
          <a href="{{ url('create-interview') }}" class="btn btn-primary btn-lg font-weight-bold text-uppercase">Create Media House</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/banner2.jpg" alt="Chicago">
        <div class="carousel-caption">
          <a href="{{ url('noknok/give-your-interview') }}" class="btn btn-primary btn-lg font-weight-bold text-uppercase">Give your interview</a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/banner3.jpg" alt="Chicago">
        <div class="carousel-caption">
          <a href="{{ url('create-interview') }}" class="btn btn-primary btn-lg font-weight-bold text-uppercase">Create an Interview</a>
        </div>
      </div>
      
    </div>
    
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
  


        
      

  <x-home.ask-question></x-home.ask-question>
  
  <div class="section margin-top-60 margin-bottom-50">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
            <span>NOKNOK</span>
            <h3>Best Interviews</h3>
            <div class="utf-headline-display-inner-item">your opinions</div>
          </div>
        </div>        
        <x-home.best-interviews />
      </div>
    </div>
  </div>

  <div class="section margin-top-60 margin-bottom-50">
    <div class="container">
      <div class="row">
        <div class="col-xl-12">
          <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
            <span>NOKNOK</span>
            <h3>Exclusive Interviews</h3>
            <div class="utf-headline-display-inner-item">your opinions</div>
          </div>
        </div>        
        <x-home.exclusive-interviews />
      </div>
    </div>
  </div>
  
@endsection

