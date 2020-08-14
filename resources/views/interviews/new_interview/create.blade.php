@extends('layouts.app')

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
				<div class="utf-login-register-page-aera margin-bottom-50">
					@if($errors->any())
						<h4 class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							{{ implode('', $errors->all(':message')) }}
						</h4>
					@endif
					<h4 class="text-danger text-center mb-2">Kindly create your media house first*</h4>
					<form method="POST" id="login-form" action="{{ route('create-media-house') }}">
						@csrf
						<div class="utf-submit-field">
							<h5>Media House Name</h5>
							<input type="text" placeholder="Enter Media House Name" required="required" name="media_name" class="utf-with-border"> <!---->
						</div>
						<div class="utf-submit-field">
							<h5>About Your Media House</h5>
							<textarea name="about_media_house" cols="20" rows="3" placeholder="Enter Media House Description" required="required" class="utf-with-border"></textarea>
							<!---->
						</div>
						
						<button type="submit" class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" style="font-size: 20px; font-weight: bold;">Create Media House <i class="icon-feather-chevrons-right"></i></button>
					</form>
				</div>
				@else

				<!-- CreateInterviewForm.vue -->
				<create-interview></create-interview>
				<!-- // CreateInterviewForm.vue -->
				@endif
			</div>
		</div>
	</div>
@endsection




