@extends('layouts.app')

@section('content')

	<div class="container pt-3"> 
        <div class="row">
        	<div class="col-xl-12">
				<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
					<span>NOKNOK</span>
					<h3>Ask a Question</h3>
					
					<p class="utf-slogan-text">Below are some of the interview questions under various subjects. Please give your interview by answering the questions under each interview.</p>
				</div>
			</div>
		</div>
		{{-- <div class="row">
			@foreach($interviews as $interview)
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
			@endforeach
		</div>
		<div class="m-3">
			{{ $interviews->links() }}
		</div> --}}
	</div>
@endsection