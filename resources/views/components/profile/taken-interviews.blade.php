<div class="row">
	@foreach($interviews as $interview)
		<div class="col-md-3">
			<div class="course-card">
				<div class="course-card-thumbnail">
					<img src="{{ url('assets/interview_thumbnails') }}/{{ $interview->thumbnail_image }}">
				</div>
				<div class="course-card-body">
					<h4>{{ $interview->title }}</h4>
					<p> {{ $interview->description }}</p>
					@if(Auth::user()->id == $id)
						<a href="{{ url('/') }}/{{ $interview->slug }}" class="btn btn-sm">Share Link</a>
					@endif
				</div>
			</div>
		</div>
	@endforeach
</div>