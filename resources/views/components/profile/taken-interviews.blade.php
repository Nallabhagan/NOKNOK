<div class="row">
	@foreach($interviews as $interview)
		<div class="star_answer col-md-4">
			
			
			<div class="photo-box photo-category-box small box-shadow border">
	  			
	  			<div class="utf-opening-box-content-part">
	  				
	  				@php
	  					$questions = json_decode($interview->questions);
	  					$question_key = array_rand($questions);

	  					$answers = json_decode($interview->answers);
	  				@endphp
	  				
	  				<p class="mt-1">
	  					{{ Str::limit($questions[$question_key], 70) }}
	  				</p>
	  				<h3 class="mt-1">"{{ Str::limit($answers[$question_key], 70) }}"
					</h3>
	  				
					<div class="post-heading p-0 mt-1">
						<div class="post-avature">
							<img src="{{ Helper::user_profile_pic($interview->user_id) }}" alt="">
						</div> 
						<div class="post-title mt-2">
							<h4>
								<a href="{{ url("user") }}/{{ Hashids::connection("user")->encode($interview->user_id) }}">{{ Helper::username($interview->user_id) }} </a> 
							</h4>
						</div>
						<div class="post-btn-action">
						    <a href="{{ url("interview") }}/{{ Hashids::connection("answer_slug")->encode($interview->user_id) }}/{{ $interview->slug }}" class="btn btn-primary btn-sm font-weight-bold mt-1">Read full interview</a>
						</div>
					</div>	
					
	  			</div>
			</div>
			
		</div>
	@endforeach
</div>

<div class="m-3">
	{{ $interviews->links() }}
</div>
