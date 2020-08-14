@extends('layouts.app')

@section('content')
	
	<div class="container pt-2"> 
        <div class="row">
        	<div class="col-xl-12">
				<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
					<span>NOKNOK</span>
					<h3>Create Branding</h3>
					
					<p class="utf-slogan-text">You can create an interview with minimum three questions. The created interview could be sent to the person who you want the answers from. You could also create a common interview link which could be sent to multiple people to get their answers.</p>
				</div>
			</div>
			
			<div class="col-xl-8 col-lg-7 offset-xl-2">
				<div class="utf-login-register-page-aera margin-bottom-50">
					<form action="{{ route('create_brand') }}" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="utf-submit-field">
							<h5>Select User</h5>
							<select name="brand_user_id" class="utf-with-border" required="">
								<option>--SELECT--</option>
								@foreach($users as $user)
									<option value="{{ $user->id }}"><img src="{{ url('images/user_small_1.jpg') }}" alt="">{{ $user->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="utf-submit-field">
							<h5>Brand Name</h5>
							<input type="text" placeholder="Enter Brand Name" required="required" class="utf-with-border" name="brand_name"> <!---->
						</div>
						<div class="utf-submit-field">
							<h5>Brand Description</h5>
							<textarea question="notes" cols="20" rows="3" placeholder="Enter Brand Description" required="required" class="utf-with-border" name="brand_description"></textarea>
						</div>
						
						<div class="utf-submit-field">
							<h5>Brand Image </h5>
							<div class="utf-avatar-wrapper" data-tippy-placement="top" title="Add Brand Thumnail" style="width: 50%;margin: 0 auto;">
		                		<input class="file-upload" name="brand_thumbnail" type="file" accept="image/*" required/>
			                    <img class="profile-pic" src="{{ url('images/upload.gif') }}" alt="Upload Image" />
			                    <div class="upload-button"></div>
			                    
			                </div>
						</div>

						<button type="submit" class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" style="font-size: 20px; font-weight: bold;">Create Branding <i class="icon-feather-chevrons-right"></i></button>
					</form>
				</div>
			</div>

		</div>
	</div>
@endsection




