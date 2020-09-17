@extends('layouts.app')
@section('social-media-meta-tags')
	<title>NOKNOK | GIVE YOUR INTERVIEW </title>
@endsection
@section('content')

	<div class="container"> 
        <div class="row">
        	<div class="col-xl-12">
				<div class="utf-section-headline-item centered mt-5 margin-bottom-40">
					<span>PUBLIC INTERVIEWS</span>
					<h3>Give Your Interview</h3>
					
					<p class="utf-slogan-text">Below are some of the interview questions under various subjects. Please give your interview by answering the questions under each interview.</p>
					<p class="text-dark font-weight-bold">If you would like to create a public interview <a href="{{ url("create-interview?public_interview=true") }}" class="text-underline font-weight-bold">click here</a></p>
				</div>
			</div>
		</div>
		<x-give-interview />
	</div>
@endsection