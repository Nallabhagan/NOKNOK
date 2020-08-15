@extends('layouts.app')

@section('content')
	
	<div class="container pt-2"> 
        <div class="row">
        	<div class="col-xl-12">
				<div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
					<span>NOKNOK</span>
					<h3>Create Q Party</h3>
					
					<p class="utf-slogan-text">You can create an interview with minimum three questions. The created interview could be sent to the person who you want the answers from. You could also create a common interview link which could be sent to multiple people to get their answers.</p>
				</div>
			</div>
			
			<div class="col-xl-8 col-lg-7 offset-xl-2">
				@if(Auth::user()->media_house == NULL)
					<x-media-house-form />
				@else
					@if($errors->any())
						<h4 class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							{{ implode('', $errors->all(':message')) }}
						</h4>
					@endif
					<div class="utf-login-register-page-aera margin-bottom-50">
						<form action="{{ route('create_qparty') }}" method="POST" enctype="multipart/form-data">
							@csrf
							
							<div class="utf-submit-field">
								<h5>Q Party Title</h5>
								<input type="text" placeholder="Enter Q Party Title" required="required" id="title" class="utf-with-border" name="qparty_title"> <!---->
							</div>
							<div class="utf-submit-field">
								<h5>Q Party Description</h5>
								<textarea question="notes" cols="20" rows="3" placeholder="Enter Q Party Description" id="description" required="required" class="utf-with-border" name="qparty_description"></textarea>
							</div>
							
							<div class="utf-submit-field">
								<h5>Q Party Image </h5>
								<div class="utf-avatar-wrapper" data-tippy-placement="top" title="Add Brand Thumnail" style="width: 50%;margin: 0 auto;">
			                		<input class="file-upload" name="qparty_image" type="file" accept="image/*" id="image" required/>
				                    <img class="profile-pic" src="{{ url('images/upload.gif') }}" alt="Upload Image" />
				                    <div class="upload-button"></div>
				                    
				                </div>
							</div>
							
							<div class="utf-submit-field">
								<h5>Invite Email Id</h5>
								<input type="email" id="email" placeholder="Enter Email Id" required="required" class="utf-with-border" name="invite_email"> <!---->
							</div>

							
							<button type="submit" id="change_action" class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" style="font-size: 20px; font-weight: bold;">Create Q Party<i class="icon-feather-chevrons-right"></i></button>
						</form>
					</div>
				@endif
			</div>

		</div>
	</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$(document).on("click","#change_action",function(){
		if($("#title").val() != ""){
			if($("#description").val() != ""){
				if($("#image").val() != ""){
					if($("#email").val() != ""){
						$("#change_action").attr("disabled","disabled");
						$("#change_action").html("Creating...");
					}
				}
			}
		}
		
	});
</script>
@endsection



