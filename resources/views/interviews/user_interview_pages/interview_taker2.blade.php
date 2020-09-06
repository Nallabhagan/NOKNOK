@extends('layouts.app')
@section('social-media-meta-tags')
    <script data-ad-client="ca-pub-5579049466595431" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e6c61d570a78000121d9aa3&product=inline-share-buttons' async='async'></script>
    @php
        $title = Helper::user_media_house_id(Helper::interview_question_details($interview->question_id)->user_id);
        if(Helper::user_media_house_id(Helper::interview_question_details($interview->question_id)->user_id) != NULL)
        {
            $title = "Media House | ".Helper::media_name(Helper::user_media_house_id(Helper::interview_question_details($interview->question_id)->user_id));
        } else {
            $title = "NOK NOK | ".Helper::username(Helper::interview_question_details($interview->question_id)->user_id);
        }
        $url = url('interview')."/".Hashids::connection('answer_slug')->encode($interview->user_id) ."/".Helper::interview_question_details($interview->question_id)->slug;
    @endphp
    <meta property="og:url" content="{{ $url }}" />
    <meta property="og:type"          content="article" />
    <meta property="og:title"         content="{{ Helper::username($interview->user_id) }}'s Interview on {{ Helper::interview_question_details($interview->question_id)->title }}" />
    <meta property="og:description"   content="{{ Helper::interview_question_details($interview->question_id)->description }}" />
    <meta property="og:image"         content="{{ url('assets/interview_thumbnails/') }}/{{ Helper::interview_question_details($interview->question_id)->thumbnail_image }}" />
    <meta property="og:image:width" content="200" />
    <meta property="og:image:height" content="200" />
    <meta property="fb:app_id" content="2714676228810928" />
    
@endsection
@section('content') 
<div class="container">
    <div class="row">
        <div class="col-xl-12 text-center">
            <h1 class="interview_title_desktop">{{ Helper::interview_question_details($interview->question_id)->title }}</h1>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="utf-single-page-section-aera mb-0">
                    <div class="job-description-image-aera">
                        <img class="mt-3" src="{{ url('assets/interview_thumbnails/') }}/{{ Helper::interview_question_details($interview->question_id)->thumbnail_image }}" alt="" style="width: 100%;" />
                        <div class="post-heading">
                            <div class="post-avature">
                                <img src="{{ Helper::user_profile_pic($interview->user_id) }}" alt="">
                            </div>
                            <div class="post-title">
                                <h4>
                                    <a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($interview->user_id) }}"> {{ Helper::username($interview->user_id) }} </a> Answered 
                                    <a href="{{ url('user') }}/{{ Hashids::connection('user')->encode(Helper::interview_question_details($interview->question_id)->user_id) }}">{{ Helper::username(Helper::interview_question_details($interview->question_id)->user_id) }} Interview</a>
                                </h4>
                                <p> {{ $interview->created_at->diffForHumans() }} </p>
                            </div>
                        </div>
                        
                        <h1 class="interview_title_mobile">{{ Helper::interview_question_details($interview->question_id)->title }}</h1>
                    </div>
                    <p class="interview_description">{{ Helper::interview_question_details($interview->question_id)->description }}</p>
                   
                    <div class="utf-submit-field">
                        @if(count($interview->answers) == count(Helper::interview_question_details($interview->question_id)->questions))
                            @for ($i=0; $i<count($interview->answers); $i++)
                                <h5>{{ $i+1 }}. {{ Helper::interview_question_details($interview->question_id)->questions[$i] }}
                                @auth 
                                    @if(Auth::user()->id == Helper::interview_question_details($interview->question_id)->user_id)
                                        @if(Helper::star_answer_check($interview->id,$i) == 1)
                                            <span class="btn btn-primary btn-sm remove_star" data-index="{{ $i }}" id="StarButton{{ $i }}">stared</span>
                                        @else
                                            <span class="btn btn-outline-primary btn-sm put_star" data-index="{{ $i }}" id="StarButton{{ $i }}">star</span>
                                        @endif
                                    
                                    @endif
                                @endauth
                                </h5>
                                <p>{{ $interview->answers[$i] }}</p>
                            @endfor
                        @endif
                    </div>
                </div>
                <div class="row bg-white box-shadow mb-5">
                    <div class="col-xl-12"> 
                        <div class="utf-section-headline-item margin-top-0 margin-bottom-10 p-2">
                            <h3>You May Also Like</h3>
                        </div>
                    </div>
                    <div class="col-md-12 pb-3">
                        <x-interview.related-interviews />
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class="card-title">SHARE INTERVIEW</h2>
                        
                        <p class="card-text">You can now share the interview with your friends.</p>
                        <div class="sharethis-inline-share-buttons"></div>
                        
                        <button onclick="copylink('{{ Request::url() }}')" class="btn btn-outline-primary margin-top-10 font-weight-bold" style="width: 100%;">Copy Interview Link <i class="icon-feather-link"></i></button>
                    </div>
                </div>
                <x-interview.read-others-interview id="{{ $interview->question_id }}"/>
            </div>
        </div>
    </div>

</div>
@csrf
@endsection
@section('scripts')
<script type="text/javascript">
    function copylink(link){
        var dummy = $('<input>').val(link).appendTo('body').select()
        document.execCommand('copy');
        alert("link copied");
    }
    $(document).on('click', '.put_star', function(event){
        event.preventDefault();
        var answer_id = $(this).attr("data-index");
        $("#StarButton"+answer_id).removeClass('put_star');
        $("#StarButton"+answer_id).removeClass('btn-outline-primary');
        $("#StarButton"+answer_id).addClass('btn-primary');
        $("#StarButton"+answer_id).addClass('remove_star');
        $("#StarButton"+answer_id).removeAttr("data-index");
        $("#StarButton"+answer_id).attr("data-index",answer_id);
        $("#StarButton"+answer_id).html("stared");
        $.ajax({
            url: "{{ url('star_answer/put_star') }}",
            method: "POST",
            data:{
                "interview_id": {{ $interview->id }},
                "answer_index": answer_id,
                '_token': $('input[name=_token]').val()
            },
            success:function(data){
               console.log(data);
            }
        });
    });

    $(document).on('click', '.remove_star', function(event){
        event.preventDefault();
        var answer_id = $(this).attr("data-index");
        $("#StarButton"+answer_id).removeClass('remove_star');
        $("#StarButton"+answer_id).removeClass('btn-primary');
        $("#StarButton"+answer_id).addClass('btn-outline-primary');
        $("#StarButton"+answer_id).addClass('put_star');
        $("#StarButton"+answer_id).removeAttr("data-index");
        $("#StarButton"+answer_id).attr("data-index",answer_id);
        $("#StarButton"+answer_id).html("star");

        $.ajax({
            url: "{{ url('star_answer/remove_star') }}",
            method: "POST",
            data:{
                "interview_id": {{ $interview->id }},
                "answer_index": answer_id,
                '_token': $('input[name=_token]').val()
            },
            success:function(data){
               console.log(data);
            }
        });
        
    });
</script>
@endsection