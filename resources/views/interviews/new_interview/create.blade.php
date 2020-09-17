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
        		@if(Session::has('public_interview'))
        			<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
        				<span>NOKNOK</span>
        				<h3>Create Public Interview</h3>
        				
        				<p class="utf-slogan-text">You can create an public interview on any subject of your choice where visitors of  NOKNOK.QA could answer. Get opinions and perspectives from people on the subjects you like.</p>
        			</div>
        		@elseif(Session::has('member_id'))
        			<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
        				<span>NOKNOK</span>
        				<h3>Ask An Interview to {{ Helper::username(Hashids::connection('user')->decode(Session::get('member_id'))[0]) }}</h3>
        				
        				<p class="utf-slogan-text">You can ask an interview with minimum three questions. Give a title and description to the interview followed by the questions. {{ Helper::username(Hashids::connection('user')->decode(Session::get('member_id'))[0]) }} will be notified on noknok.qa once you created the interview. You will be notified when {{ Helper::username(Hashids::connection('user')->decode(Session::get('member_id'))[0]) }} had answered your interview.</p>
        			</div>
        		@else
        			<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
        				<span>NOKNOK</span>
        				<h3>Take An Interview</h3>
        				
        				<p class="utf-slogan-text">You can create an interview with minimum three questions. The created interview could be sent to the person who you want the answers from. You could also create a common interview link which could be sent to multiple people to get their answers.</p>
        				<p class="text-dark font-weight-bold">If you would like to create a public interview <a href="{{ url("create-interview?public_interview=true") }}" class="text-underline font-weight-bold">click here</a></p>
        			</div>
        		@endif
				
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




