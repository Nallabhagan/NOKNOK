@extends('layouts.app')
@section('social-media-meta-tags')
	<title>NOKNOK | Q PARTY | ASK QUESTION | {{ $brand->slug }} | {{ Helper::username($brand->brand_user_id) }}</title>
    <meta property="og:url"           content="{{ url('brand') }}/{{ $brand->slug }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="NOKNOK STARS | Ask a Question to {{ Helper::username($brand->brand_user_id) }}" />
    <meta property="og:description"   content="{{ $brand->description }}" />
    <meta property="og:image"         content="{{ url('assets/brand_thumbnails') }}/{{ $brand->image }}" />
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
        @media(max-width: 768px) {
           .ask-question-box {
                bottom: 0px;width: 100%;
            } 
            .live-btn {
	        	width: 35%;
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
							<img src="{{ url('assets/brand_thumbnails') }}/{{ $brand->image }}" alt="" style="position: relative;"> 
						</div>{{ $brand->twitter }}
						<div class="bottom text-center">
								@if($brand->twitter != NULL)	
				                    <a class="btn twitter btn-twitter btn-sm" href="{{ $brand->twitter }}" target="_blank">
				                        <i class="fa fa-twitter"></i>
				                    </a>
			                    @endif
			                    @if($brand->insta != NULL)

				                    <a class="btn instagram btn-sm" rel="publisher"
				                       href="{{ $brand->insta }}" target="_blank">
				                        <i class="fa fa-instagram"></i>
				                    </a>
				                @endif

				                @if($brand->fb != NULL)                    
				                    <a class="btn facebook btn-sm" rel="publisher"
				                       href="{{ $brand->fb }}" target="_blank">
				                        <i class="fa fa-facebook"></i>
				                    </a>
				                @endif
				                @if($brand->website != NULL)
				                    <a class="btn btn-primary btn-sm" rel="publisher" href="{{ $brand->website }}" target="_blank">
				                        <i class="fa fa-link"></i>
				                    </a>
				                @endif
			                </div>
					</div>
					<div class="utf-blog-post-content pl-0 pt-0">
						<div class="post-heading">

							<div class="post-avature"><img src="{{ Helper::user_profile_pic($brand->brand_user_id) }}" alt=""></div>
							<div class="post-title">
								<h4>
									<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($brand->brand_user_id) }}"> {{ Helper::username($brand->brand_user_id) }} </a>
								</h4>
								<p> {{ $brand->created_at->diffForHumans() }} </p>
							</div>
							@if($brand->created_at->diffForHumans() < Carbon\Carbon::now()->subDay()->diffForHumans())
								<img class="ml-auto mt-0 live-btn" src="{{ url('images/LIVE.gif') }}">
							@endif
						</div>
						<div class="post-description pl-3 mt-3 mb-5 text-justify">
							<p>{{ $brand->description }}</p>
							
						</div>
						@if($brand->created_at->diffForHumans() < Carbon\Carbon::now()->subDay()->diffForHumans())
				
					    <div class="ask-question-box">
							@auth
								@if($brand->brand_user_id != Auth::user()->id)
									<form action="{{ url('brand/ask_question') }}" method="POST" class="quiz-block-add-replay">
										@csrf
										<img src="{{ Helper::user_profile_pic(Auth::user()->id) }}" alt="">
										<input type="text" class="uk-input" placeholder="Ask Question" name="question" required>
										<input type="hidden" name="brand_token" value="{{ $brand->id }}">
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
					@endif
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			
			<div class="col-md-8 offset-xl-2 offset-md-2">
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
                                    
                                <a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($brand->brand_user_id) }}">{{ Helper::username($brand->brand_user_id) }}</a>
                            </h4>
							<p> {{ $question->created_at->diffForHumans() }}</p>
						</div>
					</div> 
					<div class="post-description">
						<h3>{{ $question->question }}</h3> 
						<div class="post mt-3 mb-2" style="background-color: #f7f7f7;">
							<div class="post-heading pt-3">
								<div class="post-avature">
									<img src="{{ Helper::user_profile_pic($brand->brand_user_id) }}" alt="">
								</div> 
								<div class="post-title">
									@if($question->answer == NULL)
										<h4>
											Awaiting an answer from
											<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($brand->brand_user_id) }}">
												{{ Helper::username($brand->brand_user_id) }}
											</a>
										</h4>
									@else
										<h4> 
											<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($brand->brand_user_id) }}">
												{{ Helper::username($brand->brand_user_id) }}
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
								@if($brand->brand_user_id == Auth::user()->id && $question->answer == NULL)
									<form action="{{ url('brand/answer_a_question') }}" class="quiz-block-add-replay" method="POST">
										@csrf
										<img src="{{ Helper::user_profile_pic($question->user_id) }}" alt="">
										<input type="hidden" name="question_token" value="{{ $question->id }}">
										<input type="text" class="uk-input" placeholder="Add Reply" name="answer" required>
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
