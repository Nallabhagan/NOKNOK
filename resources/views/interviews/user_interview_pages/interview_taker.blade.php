@extends('layouts.app')
@section('social-media-meta-tags')
	<title>NOKNOK | INTERVIEW | {{ Helper::username($interview->user_id) }} | {{ $interview->title }}</title>
    @php
        $url = url('interview')."/".Hashids::connection('answer_slug')->encode($interview->user_id) ."/".Helper::interview_question_details($interview->question_id)->slug;
        $title = Helper::username($interview->user_id)."'s Interview | ".Helper::interview_question_details($interview->question_id)->title;
    @endphp
    <meta property="og:url" content="{{ $url }}" />
    <meta property="og:type"          content="article" />
    <meta property="og:title"         content="{{ $title }}" />
    <meta property="og:description"   content="{{ Helper::interview_question_details($interview->question_id)->description }}" />
    <meta property="og:image"         content="{{ url('assets/interview_thumbnails/') }}/{{ Helper::interview_question_details($interview->question_id)->thumbnail_image }}" />
    <meta property="og:image:width" content="200" />
    <meta property="og:image:height" content="200" />
    <meta property="fb:app_id" content="2714676228810928" />

    <script data-ad-client="ca-pub-5579049466595431" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
@endsection

@section('content') 


<div class="col-md-12 pl-0 pr-0">
	<div class="row">
        <div class="col-xl-12 text-center">
            <h1 class="interview_title_desktop">{{ Helper::interview_question_details($interview->question_id)->title }}</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-xl-8 col-lg-8 offset-xl-2 pl-0 pr-0">
			<div class="blog-post single-post">
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
				<div class="utf-blog-post-content">

					<h1 class="interview_title_mobile">{{ Helper::interview_question_details($interview->question_id)->title }}</h1>
					
					<p class="interview_description">{{ Helper::interview_question_details($interview->question_id)->description }}</p>
					<div class="utf-submit-field">
					    @if(count($interview->answers) == count(Helper::interview_question_details($interview->question_id)->questions))
					        @for ($i=0; $i<count($interview->answers); $i++)
					            <h5>{{ $i+1 }}. {{ Helper::interview_question_details($interview->question_id)->questions[$i] }}
					            </h5>
					            <p>{{ $interview->answers[$i] }}</p>
					        @endfor
					    @endif
					</div>
					<div class="utf-detail-social-sharing margin-top-25">
						<span><strong>Social Sharing:-</strong></span>
						<ul class="margin-top-15">
							<li>
								<a data-sharer="facebook" data-hashtag="inspiration" data-url="{{ $url }}" data-tippy-placement="top" data-tippy="" data-original-title="Facebook"><i class="icon-brand-facebook-f"></i></a>
							</li>
							<li>
								<a data-sharer="twitter" data-title="{{ $title }}" data-hashtags="inspiration" data-url="{{ $url }}" data-tippy-placement="top" data-tippy="" data-original-title="Twitter"><i class="icon-brand-twitter"></i></a>
							</li>
							<li>
								<a data-sharer="linkedin" data-url="{{ $url }}" data-tippy-placement="top" data-tippy="" data-original-title="LinkedIn"><i class="icon-brand-linkedin-in"></i></a>
							</li>
							
							<li>
								<a data-sharer="whatsapp" data-title="{{ $title }}" data-url="{{ $url }}" data-web data-tippy-placement="top" data-tippy="" data-original-title="Whatsapp"><i class="icon-brand-whatsapp"></i></a>
							</li>
							<li>
								<a data-sharer="telegram" data-title="{{ $title }}" data-url="{{ $url }}" data-to="+44555-5555" data-tippy-placement="top" data-tippy="" data-original-title="Telegram"><i class="icon-brand-telegram" style="color: #34ADE1;"></i></a>
							</li>
							<li>
								<a data-sharer="telegram" data-title="{{ $title }}" data-url="{{ $url }}" data-to="+44555-5555" data-tippy-placement="top" data-tippy="" data-original-title="Blogger"><i class="icon-brand-blogger" style="color: #EB8104;"></i></a>
							</li>
						</ul>
					</div>
				</div>
				<hr />
				<span class="pl-3 font-weight-bold" style="font-size: 18px;color: #000;"><strong>Comments:-</strong></span>
				<x-interview.interview-comments slug="{{ Helper::interview_question_details($interview->question_id)->slug }}" />
			</div>
			
			<div class="row">
				<div class="col-xl-12">
					<div class="utf-inner-blog-section-title">
						<h3><i class="icon-brand-bimobject"></i> You May Also Like</h3>
					</div>
				</div>
				<div class="col-md-12">
                    <x-interview.related-interviews />
                </div>
			</div>
		</div>
		
	</div>
</div>
@endsection