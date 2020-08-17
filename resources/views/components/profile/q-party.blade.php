<div class="row">
	@foreach($qparties as $qparty)
		<div class="col-md-3">
			<div class="course-card">
				<div class="course-card-thumbnail">
					<img src="{{ url('assets/qparty_thumbnails') }}/{{ $qparty->image }}">
				</div>
				<div class="course-card-body">
					<h4>{{ $qparty->title }}</h4>
					<p> {{ $qparty->description }}</p>
					<a href="{{ url('qparty') }}/{{ $qparty->slug }}" class="btn btn-sm">View Q Party</a>
				</div>
			</div>
		</div>
	@endforeach
</div>
