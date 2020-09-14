@extends('layouts.app')
@section('social-media-meta-tags')
<title>NOKNOK | CREATE INTERVIEW</title>
@endsection
@section('content')
	<!-- Titlebar -->
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Create Interview</h2>
					<nav id="breadcrumbs">
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li>Create Interview</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="container"> 
        <div class="row">
        	<div class="col-xl-12">
				<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
					<span>NOKNOK</span>
					<h3>Create An Interview</h3>
					
					<p class="utf-slogan-text">You can create an interview with minimum three questions. The created interview could be sent to the person who you want the answers from. You could also create a common interview link which could be sent to multiple people to get their answers.</p>
				</div>
			</div>
			<div class="col-xl-8 col-lg-7 offset-xl-2">

				@if(Auth::user()->media_house == NULL)
					<x-media-house-form />
				@else

				<!-- CreateInterviewForm.vue -->
				<create-interview></create-interview>
				<!-- // CreateInterviewForm.vue -->
				@endif
			</div>
		</div>
	</div>
@endsection




