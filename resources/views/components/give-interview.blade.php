<div class="row">
	@foreach($interviews as $interview)
		<div class="star_answer col-md-4">
			<div class="photo-box photo-category-box small box-shadow border" style="background-image: url(&quot;undefined&quot;);">
				<div class="utf-opening-box-content-part">

					<p class="mt-1" style="font-size: 24px;line-height: 32px;">
						{{ Helper::interview_question_details($interview->question_id)->title }}
					</p>
					<h3 class="mb-1" style="font-size:16px;color:#373737;">
						{{ Str::limit(Helper::interview_question_details($interview->question_id)->description, 110)}}
						
					</h3>
					<div class="text-center">
						@if($interview->answer_count != 0)
							<a href="{{ url('answers') }}/{{ Helper::interview_question_details($interview->question_id)->slug }}" class="btn btn-success btn-sm font-weight-bold mt-1">{{ $interview->answer_count }} Answers</a>
						@endif
						<a href="{{ url('/') }}/{{ Helper::interview_question_details($interview->question_id)->slug }}" class="btn btn-primary btn-sm font-weight-bold mt-1">Give your interview</a>
					</div>
				</div>
			</div>
		</div>
	@endforeach


</div>
<div class="m-3">
	{{ $interviews->links() }}
</div>