@extends('layouts.app')

@section('social-media-meta-tags')
    <title>NOKNOK | PUBLISHED INTERVIEW</title>
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
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
@endsection
@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-xl-3 mt-5">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="card-title text-primary">Congratulations {{ Helper::username($interview->user_id) }}</h2>
                    <h3>Thankyou for giving your Interview</h3>
                    <div class="utf-detail-social-sharing margin-top-25">
                        <span><strong>Share your Interview</strong></span>
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
                    <div class="text-center margin-top-10">
                        <h3><a href="{{ $url }}" class="font-weight-bold text-danger text-underline">View Interview</a></h3>
                    </div>
                    <div class="row mt-3 box-shadow border pt-1 pb-2">
                        <div class="col-md-6">
                            <p>Here are other interviews where you could your answers and opinions. </p>
                            <a class="btn btn-primary btn-sm" href="{{ url('noknok/give-your-interview') }}">Give your interview</a>
                        </div>
                        <div class="col-md-6">
                            <p>Inspiration is around you, Interview them</p>
                            <a class="btn btn-primary btn-sm" href="{{ url('user') }}/{{ Hashids::connection("user")->encode($interview->user_id) }}">Take an interview</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
		});
	</script>
@endsection
@endsection