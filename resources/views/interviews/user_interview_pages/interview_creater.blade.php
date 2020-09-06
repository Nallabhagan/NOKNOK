@extends('layouts.app')
@section('social-media-meta-tags')
    <script data-ad-client="ca-pub-5579049466595431" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e6c61d570a78000121d9aa3&product=inline-share-buttons' async='async'></script>
    @php
        $title = "";
        if(Helper::user_media_house_id($interview->user_id) != NULL)
        {
            $title = Helper::media_name(Helper::user_media_house_id($interview->user_id))." would like to interview you | ".$interview->title;
        } else {
            $title = Helper::username($interview->user_id)." would like to interview you | ".$interview->title;
        }
        
    @endphp
    
    <meta property="og:description" content="{{ $interview->description }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url('/') }}/{{ $interview->slug }}" />
    <meta property="og:image" content="{{ url('assets/interview_thumbnails') }}/{{ $interview->thumbnail_image }}" />
    <meta property="og:image:width" content="200" />
    <meta property="og:image:height" content="200" />
    <meta property="og:site_name" content="NOKNOK.qa" />
    <meta property="fb:app_id" content="2714676228810928" />
    
@endsection
@section('content') 
<div class="container">
    <div class="row">
        <div class="col-xl-12 text-center">
            <h1 class="interview_title_desktop">{{ $interview->title}}</h1>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="utf-single-page-section-aera">
                    <div class="job-description-image-aera">
                        <img class="mt-3" src="{{ url('assets/interview_thumbnails/') }}/{{ $interview->thumbnail_image }}" alt="" style="width: 100%;" />
                        <div class="post-heading">
                            <div class="post-avature">
                                <img src="{{ Helper::user_profile_pic($interview->user_id) }}" alt="">
                            </div>
                            <div class="post-title">
                                <h4><a href="#"> {{ Helper::username($interview->user_id) }} </a></i> Created an Interview</h4>
                                <p> {{ $interview->created_at->diffForHumans() }} </p>
                            </div>
                        </div>
                        <h1 class="interview_title_mobile">{{ $interview->title}}</h1>
                    </div>
                    <p class="interview_description">{{ $interview->description}}</p>
                   
                    <div class="utf-submit-field">
                        @for ($i = 0; $i < count($interview->questions); $i++)
                            <h5>{{ $i+1 }}. {{ $interview->questions[$i] }}</h5>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class="card-title">SHARE YOUR INTERVIEW</h2>
                        
                        <p class="card-text">You can share the interview by sharing it on social media or by copying the interview link and send the interview link through email, SMS, whatsapp etc.</p>
                        <div class="sharethis-inline-share-buttons"></div>
                        
                        <button onclick="copylink('{{ Request::url() }}')" class="btn btn-outline-primary margin-top-10 font-weight-bold" style="width: 100%;">Copy Interview Link <i class="icon-feather-link"></i></button>
                    </div>
                </div>

                <x-interview.read-others-interview id="{{ $interview->id }}"/>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    function copylink(link){
        var dummy = $('<input>').val(link).appendTo('body').select()
        document.execCommand('copy');
        alert("link copied");
    }
</script>
@endsection