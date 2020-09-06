@php
	$social_links = Helper::user_social_links($id);
@endphp
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
						    
							@if($media_id != NULL)
								<h3 class="text-primary">Q Space: {{ Helper::media_name($media_id) }}<span class="utf-verified-badge" data-tippy-placement="top" data-tippy="" data-original-title="Verified"></span>
									@if(Auth::id() == $id)
										<small>
											<a href="#utf-signin-dialog-block" class="text-underline text-primary popup-with-zoom-anim log-in-button">Edit</a>
										</small>
									@endif
								</h3>
								@elseif(Auth::id() == $id)
								<h5><a href="#utf-signin-dialog-block" class="popup-with-zoom-anim log-in-button">Create Q Space</a></h5>
							@endif
							<h4 style="font-size: 20px;margin: 5px 0px;">
								<i class="icon-feather-user" style="color: #fff;font-size: 20px;"></i>{{ Helper::username($id) }} 
								@auth
									@if($social_links['fb'] == NULL && $social_links['twitter'] == NULL && $social_links['linkedin'] == NULL && $social_links['insta'] == NULL && Auth::id() == $id)
										<a href="{{ url('dashboard/profile') }}" class="btn btn-primary btn-sm font-weight-bold ml-2">
											Link social Accounts
										</a>
									@endif
								@endauth
							</h4>

							@if($media_id != NULL)
								<p class="text-white">{{ Helper::media_description($media_id) }}</p>
							@endif

							<div class="utf-detail-social-sharing">
								<ul class="margin-top-15">
									
									@if($social_links['fb'] != NULL)
										<li><a href="{{ $social_links['fb'] }}" data-tippy-placement="top" data-tippy="" data-original-title="Facebook" target="_blank"><i class="icon-brand-facebook-f"></i></a></li>
									@endif
									
									@if($social_links['twitter'] != NULL)
										<li><a href="{{ $social_links['twitter'] }}" data-tippy-placement="top" data-tippy="" data-original-title="Twitter" target="_blank"><i class="icon-brand-twitter"></i></a></li>
									@endif
									
									@if($social_links['linkedin'] != NULL)
										<li><a href="{{ $social_links['linkedin'] }}" data-tippy-placement="top" data-tippy="" data-original-title="LinkedIn" target="_blank"><i class="icon-brand-linkedin-in"></i></a></li>
									@endif
									
									@if($social_links['insta'] != NULL)
										<li><a href="{{ $social_links['insta'] }}" data-tippy-placement="top" data-tippy="" data-original-title="Instagram" target="_blank"><i class="icon-brand-instagram" style="color: #DD2A7B;"></i></a></li>
									@endif
									
									<li><h5><i class="icon-feather-users"></i> <span>{{ Helper::follow_count($id) }}</span> Followers</h5></li>
									<li>
										@auth
											@if(Auth::id() != $id)
												<span id="follow_status">
													@if(Helper::follow_check(Auth::id(),$id))
														<button data-id="{{ Hashids::connection('user')->encode($id) }}" class="unfollow btn btn-primary btn-sm font-weight-bold ml-2 mb-1"><i class="icon-feather-user-check"></i> following</button>
													@else
														<button data-id="{{ Hashids::connection('user')->encode($id) }}" class="follow btn btn-primary btn-sm font-weight-bold ml-2 mb-1"><i class="icon-feather-user-x"></i> follow</button>
													@endif
													
												</span>
											@else
												@if($media_id != NULL)
													<button class="btn btn-primary btn-sm font-weight-bold ml-2" uk-toggle="target: #get-followers">
														<i class="icon-feather-users"></i> Get followers
													</button>
												@endif
											@endif
										@else
											<a href="{{ url('login') }}" class="follow btn btn-primary btn-sm font-weight-bold ml-2 mb-1"><i class="icon-feather-user-x"></i> follow</a>
										@endauth
									</li>
								</ul>
							</div>
							
							
							
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
			<!-- Create Q Space PopUp -->
			<div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
				<div class="utf-signin-form-part">
					<!-- Login -->
					<div class="utf-popup-tab-content-item" id="login">
						<div class="utf-welcome-text-item">
							<h3>Create Q Space</h3>
							
						</div>
						<form method="POST" id="login-form" action="{{ route('create-media-house') }}">
							@csrf
							<div class="utf-no-border">
								<input type="text" class="utf-with-border" name="media_name" id="emailaddress" placeholder="Q Space Name" required/>
							</div>
							<div class="utf-no-border">
								<textarea class="utf-with-border" placeholder="About Your Q Space" name="about_media_house" required></textarea>
							</div>
						</form>
						<button class="button full-width utf-button-sliding-icon ripple-effect" type="submit" form="login-form">Create <i class="icon-feather-chevrons-right"></i></button>
						
					</div>
				</div>
			</div>
			<!--Create Q Space Popup End -->
		@else
			<!-- Edit Q Space PopUp -->
			<div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
				<div class="utf-signin-form-part">
					<!-- Login -->
					<div class="utf-popup-tab-content-item" id="login">
						<div class="utf-welcome-text-item">
							<h3>Edit Q Space</h3>
							
						</div>
						<form method="POST" id="login-form" action="{{ route('update-media-house') }}">
							@csrf

							<input type="hidden" name="media_token" value="{{ Hashids::connection('user')->encode($media_id) }}">
							<div class="utf-no-border">
								<input type="text" class="utf-with-border" value="{{ Helper::media_name($media_id) }}" name="media_name" id="emailaddress" placeholder="Q Space Name" required/>
							</div>
							<div class="utf-no-border">
								<textarea class="utf-with-border" placeholder="About Your Q Space" name="about_media_house" required>{{ Helper::media_description($media_id) }}</textarea>
							</div>
						</form>
						<button class="button full-width utf-button-sliding-icon ripple-effect" type="submit" form="login-form">Update <i class="icon-feather-chevrons-right"></i></button>
						
					</div>
				</div>
			</div>
			<!--Edit Q Space Popup End -->
		@endif
	@endif
	<div id="get-followers" uk-modal>
	    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
	        <button class="uk-modal-close-default" type="button" uk-close></button>
	        <h2 class="uk-modal-title">Get Followers</h2>
	        

	        <div class="utf-social-login-buttons-block">
	        	<button data-sharer="facebook" data-url="{{ url('user') }}/{{ Hashids::connection('user')->encode($id) }}" class="facebook-login ripple-effect">
	        		<i class="icon-brand-facebook-f"></i> Facebook
	        	</button> 
	        	<button data-sharer="twitter" data-url="{{ url('user') }}/{{ Hashids::connection('user')->encode($id) }}" class="twitter-share ripple-effect"><i class="icon-brand-twitter"></i> Twitter
	        	</button>
	        	<button data-title="" data-sharer="whatsapp" data-url="{{ url('user') }}/{{ Hashids::connection('user')->encode($id) }}" class="whatsapp-share ripple-effect" data-web="true"><i class="icon-brand-whatsapp"></i> Whats App
	        	</button>
	        </div>


	        <input class="fancybox-share__input" type="text" value="{{ url('user') }}/{{ Hashids::connection('user')->encode($id) }}" onclick="select()">
	    </div>
	</div>
@endauth







