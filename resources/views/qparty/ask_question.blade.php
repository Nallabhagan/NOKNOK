@extends('layouts.app')
@section('social-media-meta-tags')
	<title>NOKNOK | Q PARTY | ASK QUESTION | {{ $qparty->slug }}</title>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e6c61d570a78000121d9aa3&product=inline-share-buttons' async='async'></script>
    <meta property="og:url"           content="{{ url('qparty') }}/{{ $qparty->slug }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Q PARTY | Ask a Question to {{ Helper::username($qparty->member_id) }}" />
    <meta property="og:description"   content="{{ $qparty->description }}" />
    <meta property="og:image"         content="{{ url('assets/qparty_thumbnails') }}/{{ $qparty->image }}" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="fb:app_id" content="2714676228810928" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .ask-question-box {
            bottom: 0px;position: absolute;width: 100%;
        }
        .live-btn {
        	width: 15%;
        }
        .mobile_add {
            display:block;
        }
        @media(max-width: 767px) {
           .ask-question-box {
                bottom: 0px;width: 100%;
            } 
            .live-btn {
	        	width: 35%;
	        }
        }
        @media(max-width:767px){
            .mobile_add{
                display:none;
            }
        }
    </style>
@endsection
@section('content')
	<div class="container pt-3">
		<div class="col-md-12">
			<div class="row">
				<div class="blog-post border">
					<div class="utf-blog-post-thumbnail" style="height: auto;">
						<div class="utf-blog-post-thumbnail-inner" style="height: auto;box-shadow: inherit;"> 
							<img src="{{ url('assets/qparty_thumbnails') }}/{{ $qparty->image }}" alt="" style="position: relative;"> 
						</div>
						<div class="bottom text-center">
							@if($qparty->twitter != NULL)	
				                <a class="btn twitter btn-twitter btn-sm" href="{{ $qparty->twitter }}" target="_blank">
				                    <i class="fa fa-twitter"></i>
				                </a>
			                @endif
			                @if($qparty->insta != NULL)

				                <a class="btn instagram btn-sm" rel="publisher"
				                       href="{{ $qparty->insta }}" target="_blank">
				                    <i class="fa fa-instagram"></i>
				                </a>
				            @endif

				            @if($qparty->fb != NULL)                    
				                <a class="btn facebook btn-sm" rel="publisher"
				                       href="{{ $qparty->fb }}" target="_blank">
				                    <i class="fa fa-facebook"></i>
				                </a>
				            @endif
				            @if($qparty->website != NULL)
				                <a class="btn btn-primary btn-sm" rel="publisher" href="{{ $qparty->website }}" target="_blank">
				                    <i class="fa fa-link"></i>
				                </a>
				            @endif
			            </div>
					</div>
					<div class="utf-blog-post-content pl-0 pt-0">
						<div class="post-heading">

							<div class="post-avature"><img src="{{ Helper::user_profile_pic($qparty->member_id) }}" alt=""></div>
							<div class="post-title">
								<h4>
									<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($qparty->member_id) }}"> {{ Helper::username($qparty->member_id) }} </a>
								</h4>
								<p> {{ $qparty->created_at->diffForHumans() }} </p>
							</div>
						
							<img class="ml-auto mt-0 live-btn" src="{{ url('images/LIVE.gif') }}">
							
						</div>
						<div class="post-description pl-3 mt-3 mb-5 text-justify">
							<p>{{ $qparty->description }}</p>
							
						</div>
						
				        <div class="ask-question-box">
							@auth
								@if($qparty->member_id != Auth::user()->id)
									<form action="{{ url('qparty/ask_question') }}" method="POST" class="quiz-block-add-replay">
										@csrf
										<img src="{{ Helper::user_profile_pic(Auth::user()->id) }}" alt="">
										
										<textarea style="min-width:10%;overflow:hidden;border-radius:10px;line-height:30px;" class="uk-input" placeholder="Ask Question" name="question" onkeyup="textAreaAdjust(this)" required></textarea>
										<input type="hidden" name="qparty_token" value="{{ Hashids::connection('qparty')->encode($qparty->id) }}">
										<button type="submit" class="btn btn-primary btn-sm font-weight-bold">Ask Question</button>
									</form>
								@endif
							@else
								<div class="quiz-block-add-replay">
									<img src="{{ url('images/user_small_1.jpg') }}" alt="">
									<a href="{{ url('login') }}" class="uk-input">Ask a Question</a>
									<button type="submit" class="btn btn-primary btn-sm font-weight-bold">Ask Question</button>
								</div>
							@endauth
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
		    <div class="col-md-3">
		        
		        
		    </div>
			<div class="col-md-9">
			    
				@foreach($questions as $question)
				<div class="post">
					<div class="post-heading pt-3">
						<div class="post-avature">
							<img src="{{ Helper::user_profile_pic($question->user_id) }}" alt="">
						</div> 
						<div class="post-title">
							<h4>
								<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($question->user_id) }}"> 
									{{ Helper::username($question->user_id) }} 
								</a> Asked 
                                    
                                <a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($qparty->member_id) }}">{{ Helper::username($qparty->member_id) }}</a>
                            </h4>
							<p> {{ $question->created_at->diffForHumans() }}</p>
						</div>
					</div> 
					<div class="post-description">
						<h3>{{ $question->question }}</h3> 
						<div class="post mt-3 mb-2" style="background-color: #f7f7f7;">
							<div class="post-heading pt-3">
								<div class="post-avature">
									<img src="{{ Helper::user_profile_pic($qparty->member_id) }}" alt="">
								</div> 
								<div class="post-title">
									@if($question->answer == NULL)
										<h4>
											Awaiting an answer from
											<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($qparty->member_id) }}">
												{{ Helper::username($qparty->member_id) }}
											</a>
										</h4>
									@else
										<h4> 
											<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($qparty->member_id) }}">
												{{ Helper::username($qparty->member_id) }}
											</a> Answered 
										</h4>
									@endif
									<p> {{ $question->created_at->diffForHumans() }}</p>
								</div>
							</div> 
							<div class="post-description">
								<p> 
									{{ $question->answer }}
								</p>

							</div>
							@auth
								@if($qparty->member_id == Auth::user()->id && $question->answer == NULL)
									<form action="{{ url('qparty/answer_a_question') }}" class="quiz-block-add-replay" method="POST">
										@csrf
										<img src="{{ Helper::user_profile_pic($question->user_id) }}" alt="">
										<input type="hidden" name="question_token" value="{{ Hashids::connection('qparty')->encode($question->id) }}">
										
										<textarea style="min-width:10%;overflow:hidden;border-radius:10px;line-height:30px;" class="uk-input" placeholder="Add Reply" name="answer" onkeyup="textAreaAdjust(this)" required></textarea>
										<button type="submit" class="btn btn-primary btn-sm font-weight-bold">Add Reply</button>
									</form>
								@endif
							
							@endauth
						</div>
						
					</div>
				</div>
				
				@endforeach
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
</script>
@endsection
