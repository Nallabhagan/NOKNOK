@extends('layouts.dashboard')

@section('content')


<div class="utf-dashboard-content-inner-aera">
	@if($errors->any())
		<div class="notification error closeable">
			<p><strong>{{ implode('', $errors->all(':message')) }}</strong></p>
			<a class="close"></a>
		</div>
	@endif
	@if(session()->has('message'))
		<div class="notification success closeable">
			<p><strong>{{ session()->get('message') }}</strong></p>
			<a class="close"></a>
		</div>
	@endif
	<div class="row">

		<div class="col-xl-6">
			<div class="dashboard-box margin-top-0 margin-bottom-30">
				<div class="headline">
					<h3>My Profile Details</h3>
				</div>
				<div class="content with-padding padding-bottom-0">
					<div class="row">
						<div class="col">
							<div class="row">

								<div class="col-xl-12">
									<form action="{{ route('change-profile-pic') }}" class="row" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="col-xl-5 col-md-3 col-sm-4">
											<div class="utf-avatar-wrapper" data-tippy-placement="top" title="Change Profile Picture">
												<img class="profile-pic" src="{{ Helper::user_profile_pic(Auth::id()) }}" alt="" />
												<div class="upload-button"></div>
												<input name="profile_pic" class="file-upload" type="file" accept="image/*" required/>
											</div>
										</div>
										<div class="col-xl-7 col-md-9 col-sm-8">
											<div class="utf-submit-field">
												<h5>Change Profile Pic</h5>
												<div class="utf-account-type">
													<button type="submit" class="button ripple-effect big margin-top-10 margin-bottom-20">Change</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<form action="{{ route('change-profile-details') }}" method="POST" class="col-xl-12 p-0">
									@csrf
									<div class="col-xl-12 col-md-6 col-sm-6">
										<div class="utf-submit-field">
											<h5>Your Name</h5>
											<input placeholder="Enter Name" type="text" class="utf-with-border" value="{{ Auth::user()->name }}" name="name">
										</div>
									</div>
									<div class="col-xl-12 col-md-6 col-sm-6">
										<div class="utf-submit-field">
											<h5>Mobile Number</h5>
											<input placeholder="Enter Mobile Number" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" pattern="[0-9]*" class="utf-with-border" value="{{ Auth::user()->mobile_no }}" name="mobile_number">
										</div>
									</div>
									<div class="col-xl-12 col-md-6 col-sm-6">
										<div class="utf-submit-field">
											<h5>Email Address</h5>
											<input type="email" class="utf-with-border" value="{{ Auth::user()->email }}" disabled="true">
										</div>
									</div>
									<div class="col-xl-12 col-md-12 col-sm-12">
										<div class="utf-submit-field">
											<h5>About</h5>
											<textarea class="utf-with-border" placeholder="Enter About" cols="20" rows="3" name="about">{{ Auth::user()->about }}</textarea>
										</div>
									</div>
									<div class="col-xl-12 col-md-12 col-sm-12">
										<button type="submit" href="javascript:void(0);" class="button ripple-effect big margin-top-10 margin-bottom-20">Save Changes</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<div id="test1" class="dashboard-box margin-top-0">
				<div class="headline">
					<h3>Social Links</h3>
				</div>
				<form action="{{ route('social_links') }}" class="content with-padding" method="POST">
					@csrf
					<div class="row">
						<div class="col-xl-12 col-md-6 col-sm-6">
							<div class="utf-submit-field">
								<h5><i class="icon-brand-facebook"></i> Facebook</h5>
								<input type="text" class="utf-with-border" value="{{ Auth::user()->fb }}" name="fb" placeholder="Enter your Facebook accout link">
							</div>
						</div>
						<div class="col-xl-12 col-md-6 col-sm-6">
							<div class="utf-submit-field">
								<h5><i class="icon-brand-twitter"></i> Twitter</h5>
								<input type="text" class="utf-with-border" value="{{ Auth::user()->twitter }}" name="twitter" placeholder="Enter your Twitter accout link">
							</div>
						</div>
						<div class="col-xl-12 col-md-6 col-sm-6">
							<div class="utf-submit-field">
								<h5><i class="icon-brand-linkedin"></i> Linkedin</h5>
								<input type="text" class="utf-with-border" value="{{ Auth::user()->linkedin }}" name="linkedin" placeholder="Enter your Linkedin accout link">
							</div>
						</div>
						<div class="col-xl-12 col-md-6 col-sm-6">
							<div class="utf-submit-field">
								<h5><i class="icon-brand-instagram"></i> Instagram</h5>
								<input type="text" class="utf-with-border" value="{{ Auth::user()->insta }}" name="insta" placeholder="Enter your Instagram accout link">
							</div>
						</div>
					</div>
					<button type="submit" href="javascript:void(0);" class="button ripple-effect big margin-top-10">Update Social Links</button> 
				</form>
			</div>
		</div>
	</div>
</div>


@endsection