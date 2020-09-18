<div class="row">
	{{-- @foreach($interviews as $interview)
		<div class="col-md-3">
			<div class="course-card">
				<div class="course-card-thumbnail">
					<img src="{{ url('assets/interview_thumbnails') }}/{{ $interview->thumbnail_image }}">
				</div>
				<div class="course-card-body">
					<h4>{{ $interview->title }}</h4>
					<p> {{ $interview->description }}</p>
					<a href="{{ url('/') }}/{{ $interview->slug }}" class="btn btn-sm">Give your Interview</a>
				</div>
			</div>
		</div>
	@endforeach --}}

	@foreach($interviews as $interview)
		<div class="star_answer col-md-4">
			<div class="photo-box photo-category-box small box-shadow border" style="background-image: url(&quot;undefined&quot;);">
				<div class="utf-opening-box-content-part">

					<p class="mt-1" style="font-size: 24px;line-height: 32px;">
						{{ $interview->title }}
					</p>
					<h3 class="mb-1" style="font-size:16px;color:#373737;">
						{{ Str::limit($interview->description, 110)}}
						
					</h3>
					<div class="text-center">
						<a href="http://localhost:8000/interview/xBB/knowing-how-to-fight-covid-19-virus" class="btn btn-primary btn-sm font-weight-bold mt-1">Give your interview</a>
					</div>
				</div>
			</div>
		</div>
	@endforeach


</div>
<div class="m-3">
	{{ $interviews->links() }}
</div>