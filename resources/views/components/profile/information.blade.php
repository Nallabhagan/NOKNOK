<div class="single-page-header mb-0">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@if($errors->any())
					<h4 class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						{{ implode('', $errors->all(':message')) }}
					</h4>
				@endif
				
				<div class="utf-single-page-header-inner-aera">
					<div class="utf-left-side">
						<div class="utf-header-image">
							<img src="{{ Helper::user_profile_pic($id) }}" alt="">
						</div>
						<div class="utf-header-details">
						    <h4 style="font-size: 25px">Welcome to {{ Helper::username($id) }}'s Media House</h4>
							@if($media_id != NULL)
								<h3 class="text-primary"><i class="icon-feather-tv"></i> {{ Helper::media_name($media_id) }}<span class="utf-verified-badge" data-tippy-placement="top" data-tippy="" data-original-title="Verified"></span>
									@if(Auth::id() == $id)
										<small>
											<a href="#utf-signin-dialog-block" class="text-underline text-primary popup-with-zoom-anim log-in-button">Edit</a>
										</small>
									@endif
								</h3>
								@elseif(Auth::id() == $id)
								<h5><a href="#utf-signin-dialog-block" class="popup-with-zoom-anim log-in-button">Create Media House</a></h5>
							@endif
							
							@if($media_id != NULL)
								<p class="text-white">{{ Helper::media_description($media_id) }}</p>
							@endif
							<h5><i class="icon-feather-users"></i> <span>{{ Helper::follow_count($id) }}</span> Followers</h5>
							@if(Auth::id() != $id)

							<span id="follow_status">
								@if(Helper::follow_check(Auth::id(),$id))
									<button data-id="{{ Hashids::connection('user')->encode($id) }}" class="unfollow btn btn-primary btn-sm font-weight-bold ml-2 mb-1"><i class="icon-feather-user-check"></i> following</button>
								@else
									<button data-id="{{ Hashids::connection('user')->encode($id) }}" class="follow btn btn-primary btn-sm font-weight-bold ml-2 mb-1"><i class="icon-feather-user-x"></i> follow</button>
								@endif
								
							</span>
								
							@endif
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

@auth
	@if(Auth::id() == $id)
		@if($media_id == NULL)
			<!-- Create Media House PopUp -->
			<div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
				<div class="utf-signin-form-part">
					<!-- Login -->
					<div class="utf-popup-tab-content-item" id="login">
						<div class="utf-welcome-text-item">
							<h3>Create Media House</h3>
							
						</div>
						<form method="POST" id="login-form" action="{{ route('create-media-house') }}">
							@csrf
							<div class="utf-no-border">
								<input type="text" class="utf-with-border" name="media_name" id="emailaddress" placeholder="Media House Name" required/>
							</div>
							<div class="utf-no-border">
								<textarea class="utf-with-border" placeholder="About Your Media House" name="about_media_house" required></textarea>
							</div>
						</form>
						<button class="button full-width utf-button-sliding-icon ripple-effect" type="submit" form="login-form">Create <i class="icon-feather-chevrons-right"></i></button>
						
					</div>
				</div>
			</div>
			<!--Create Media House Popup End -->
		@else
			<!-- Edit Media House PopUp -->
			<div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
				<div class="utf-signin-form-part">
					<!-- Login -->
					<div class="utf-popup-tab-content-item" id="login">
						<div class="utf-welcome-text-item">
							<h3>Edit Media House</h3>
							
						</div>
						<form method="POST" id="login-form" action="{{ route('update-media-house') }}">
							@csrf

							<input type="hidden" name="media_token" value="{{ Hashids::connection('user')->encode($media_id) }}">
							<div class="utf-no-border">
								<input type="text" class="utf-with-border" value="{{ Helper::media_name($media_id) }}" name="media_name" id="emailaddress" placeholder="Media House Name" required/>
							</div>
							<div class="utf-no-border">
								<textarea class="utf-with-border" placeholder="About Your Media House" name="about_media_house" required>{{ Helper::media_description($media_id) }}</textarea>
							</div>
						</form>
						<button class="button full-width utf-button-sliding-icon ripple-effect" type="submit" form="login-form">Update <i class="icon-feather-chevrons-right"></i></button>
						
					</div>
				</div>
			</div>
			<!--Edit Media House Popup End -->
		@endif
	@endif
@endauth







