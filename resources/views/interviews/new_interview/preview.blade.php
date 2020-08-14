@extends('layouts.app')

@section('content')
	<!-- Titlebar -->
	<div id="titlebar" class="gradient">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Preview Interview</h2>
					<nav id="breadcrumbs">
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li>Preview Interview</li>
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
					<h3>ADD AN IMAGE FOR YOUR INTERVIEW & PUBLISH</h3>
					
					<p class="utf-slogan-text">A representative image or image of the person who is being interviewed or any HQ image will add value to the visibility of your interview.</p>
				</div>
			</div>
		</div>
		<div class="col-xl-8 offset-xl-2 margin-bottom-50">
			<div class="row">
		        {{-- <div class="col-md-6">
					
					<preview-interview interview_id="{{ $id }}"></preview-interview>
					
		        </div> --}}
		        <div class="col-md-8 offset-xl-2">
		            <div class="utf-sidebar-widget-item">
		            	@if($errors->any())
							<h4 class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								{{$errors->first()}}
							</h4>
						@endif
		                <h3>{{ $title }}</h3> 
		                <p>{{ $description }}</p> 
		                <form action="{{ route('publish_interview') }}" method="POST" enctype="multipart/form-data">
		                	@csrf
		                	<input type="hidden" name="interview_id" value="{{ $id }}">
		                	<div class="utf-avatar-wrapper m-0" data-tippy-placement="top" title="Change Interview Thumnail">
		                		<input class="file-upload" name="interview_thumbnail" type="file" accept="image/*" required/>
			                    <img class="profile-pic" src="{{ url('images/upload.gif') }}" alt="Upload Image" />
			                    <div class="upload-button"></div>
			                    
			                </div>
			                <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" data-tippy-placement="top" title="Publish Interview">PUBLISH INTERVIEW</button>
		                </form>
		                
		            </div>
		        </div>
		    </div>
			
		</div>
	</div>
	<!-- Sign In Popup -->
    <div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
        <div class="utf-signin-form-part">
            <ul class="utf-popup-tabs-nav-item">
                <li><a href="#login">Edit</a></li>
                <li><a href="#register">Preview</a></li>
            </ul>
            <div class="utf-popup-container-part-tabs">
                <!-- Edit Interview -->
                <edit-interview></edit-interview>
                
                <!-- Preview Interview -->
                <interview-preview></interview-preview>
                
            </div>
        </div>
    </div>
    <!-- Sign In Popup / End -->
@endsection