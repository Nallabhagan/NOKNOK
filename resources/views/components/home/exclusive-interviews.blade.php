<div class="col-xl-12">
	<div class="row">
		@foreach($interviews as $interview)
			<div class="col-md-3">
				<div class="events-list">
					<a href="#" class="event-cover">
					<img src="{{ url('assets/interview_thumbnails') }}/{{ Helper::interview_question_details($interview->question_id)->thumbnail_image }}" alt="">
					</a>
					<div class="event-info">
						<div class="event-info-date">
							<img src="{{ Helper::user_profile_pic($interview->user_id) }}" alt="">
						</div>
						<h4 class="events-list-name">
							<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($interview->user_id) }}"> {{ Helper::username($interview->user_id) }}</a>
						</h4>
						<p class="mt-3">{{ Str::limit(Helper::interview_question_details($interview->question_id)->description, 100)}}</p>
					</div>
					<div class="event-btns uk-flex">
						<a href="{{ url('interview') }}/{{ Hashids::connection('answer_slug')->encode($interview->user_id) }}/{{ $interview->slug }}" class="button primary block small uk-width-expand"> <i class="uil-star"></i> Read Interview </a>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>