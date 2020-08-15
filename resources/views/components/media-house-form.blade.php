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