@extends('layouts.app')
@section('social-media-meta-tags')

    <meta property="og:url"           content="{{ url('brand') }}/{{ $brand->slug }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="NOKNOK STARS | Ask a Question to {{ Helper::username($brand->brand_user_id) }}" />
    <meta property="og:description"   content="{{ $brand->description }}" />
    <meta property="og:image"         content="{{ url('assets/brand_thumbnails') }}/{{ $brand->image }}" />
    <meta property="fb:app_id" content="2714676228810928" />
    
@endsection
@section('content')
	<div class="container pt-3">
		<div class="col-md-12 mb-3 post">
			<div class="row">
				<div class="col-md-4 p-0">
					<img src="{{ url('assets/brand_thumbnails') }}/{{ $brand->image }}" alt="" style="width: 100%;"> 
				</div>
				<div class="col-md-8 p-0">
					<div>
						<div class="post-heading">
							<div class="post-avature"><img src="{{ Helper::user_profile_pic($brand->brand_user_id) }}" alt=""></div>
							<div class="post-title">
								<h4>
									<a href="#"> {{ Helper::username($brand->brand_user_id) }} </a>
								</h4>
								<p> {{ $brand->created_at->diffForHumans() }} </p>
							</div>
						</div>
						<div class="post-description">
							<p>{{ $brand->description }}</p>
						</div>
					</div>
					<div style="bottom: 0px;position: absolute;width: 100%;">
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
				</div>
			</div>
		</div>
		

		<div class="row">
			
			<div class="col-md-6 offset-xl-3">
				@foreach($questions as $question)
				<div class="post">
					<div class="post-heading pt-3">
						<div class="post-avature">
							<img src="{{ Helper::user_profile_pic($question->user_id) }}" alt="">
						</div> 
						<div class="post-title">
							<h4>
								<a href="http://localhost:8000/user/{{ Hashids::connection('user')->encode($question->user_id) }}"> 
									{{ Helper::username($question->user_id) }} 
								</a> Asked 
                                    
                                <a href="http://localhost:8000/user/{{ Hashids::connection('user')->encode($brand->brand_user_id) }}">{{ Helper::username($brand->brand_user_id) }}</a>
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
											<a href="http://localhost:8000/user/{{ Hashids::connection('user')->encode($brand->brand_user_id) }}">
												{{ Helper::username($brand->brand_user_id) }}
											</a>
										</h4>
									@else
										<h4> 
											<a href="http://localhost:8000/user/{{ Hashids::connection('user')->encode($brand->brand_user_id) }}">
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
