<div class="row">
	@foreach($interviews as $interview)
		<div class="col-md-3">
			<div class="course-card">
				<div class="course-card-thumbnail">
					<img src="{{ url('assets/interview_thumbnails') }}/{{ Helper::interview_question_details($interview->question_id)->thumbnail_image }}">
				</div>
				<div class="course-card-body">
					<h4>{{ Helper::interview_question_details($interview->question_id)->title }}</h4>
					<p> {{ Helper::interview_question_details($interview->question_id)->description }}</p>
					<a href="{{ url('interview') }}/{{ Hashids::connection('answer_slug')->encode($interview->user_id) }}/{{ $interview->slug }}" class="btn btn-sm">Read Interview</a>
				</div>
			</div>       
			
		</div>
	@endforeach
</div>