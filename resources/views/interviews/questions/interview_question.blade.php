@extends('layouts.app')
@section('social-media-meta-tags')

    <meta property="og:url"           content="{{ url('/') }}/{{ $interview->slug }}" />
    <meta property="og:type"          content="website" />
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
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> {{ Session::get('error') }}
                </div>    
            @endif
            <h1 class="interview_title_desktop">{{ $interview->title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-xl-3">
            <div class="utf-single-page-section-aera">
                <div class="job-description-image-aera">
                    <img class="mt-3" src="{{ url('assets/interview_thumbnails') }}/{{ $interview->thumbnail_image }}" alt="" />
                    <h4 class="mb-3">
                        <a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($interview->user_id) }}">
                            @if(Helper::user_media_house_id($interview->user_id) != NULL)
                                <span>{{ Helper::media_name(Helper::user_media_house_id($interview->user_id)) }}</span>
                            @else
                                <span>{{ Helper::username($interview->user_id) }}</span>
                            @endif
                        </a> 
                        Created an Interview
                    </h4>
                    <h1 class="interview_title_mobile">{{ $interview->title }}</h1>

                </div>
                <p class="interview_description">{{ $interview->description }}</p>
               
                <form action="{{ route('submit_interview') }}" method="POST">
                    @csrf
                    <input type="hidden" name="question_token" value="{{ Hashids::connection('create_question')->encode($interview->id) }}">
                    <input type="hidden" name="title" value="{{ $interview->title }}">

                    @for ($i = 0; $i < count($interview->questions); $i++)
                        <div class="utf-submit-field">
                            <h5>{{ $i+1 }}. {{ $interview->questions[$i] }}</h5>
                            @auth
                                <textarea class="utf-with-border" id="answer{{ $i }}" rows="1" placeholder="Enter your Answer" onkeyup="textAreaAdjust(this)" style="overflow:hidden" name="answers[]" required></textarea>
                            @endauth
                        </div>
                    @endfor
                    @auth
                        <button type="submit" class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" style="font-size: 20px; font-weight: bold;" id="change_action">Finish Interview <i class="icon-feather-chevrons-right"></i></button>
                    @else 
                        <a href="{{ route('login') }}" class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" style="font-size: 20px; font-weight: bold;">Give Your Interview</a>
                    @endauth
                </form>
            </div>
        </div>
    </div>
    
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    function textAreaAdjust(o) {
      o.style.height = "1px";
      o.style.height = (25+o.scrollHeight)+"px";
    }
    //to disable button until redirect to next page
    $(document).on("click","#change_action",function(){
        var i,flag=0;
        var count = parseInt("{{ $i }}");
        for(i=0;i<count;i++) {
            if($("#answer"+i).val() != "") {
                flag++;
            }
        }
        if(flag == count)
        {
            $("#change_action").attr("disabled","disabled");
            $("#change_action").html("Finishing...");  
        }
    });
</script>
@endsection