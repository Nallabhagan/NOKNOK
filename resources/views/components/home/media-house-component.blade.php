@foreach($media_houses as $media_house)
	<div class="col-xl-3 col-md-6 col-sm-12">
	  	<div class="utf-company-inner-alignment">
		    <div class="company">
		      	<span class="company-logo">
		      		<img src="{{ Helper::user_profile_pic($media_house->user_id) }}" alt="">
		      	</span>
		      	<h4><a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($media_house->user_id) }}">{{ $media_house->name }}</a></h4>
		      	<p class="text-muted">{{ Helper::username($media_house->user_id) }}</p>
		      	<p>{{ Str::limit($media_house->description, 50)}}</p>
		      	@auth
		      		<span id="follow_status{{ Hashids::connection('user')->encode($media_house->user_id) }}">
		      			@if(Helper::follow_check(Auth::id(),$media_house->user_id))
		      				<button data-id="{{ Hashids::connection('user')->encode($media_house->user_id) }}" class="unfollow btn btn-primary font-weight-bold ml-2 mb-1"><i class="icon-feather-user-check text-white"></i> following</button>
		      			@else
		      				<button data-id="{{ Hashids::connection('user')->encode($media_house->user_id) }}" class="follow btn btn-primary font-weight-bold ml-2 mb-1"><i class="icon-feather-user-x text-white"></i> follow</button>
		      			@endif
		      			
		      		</span>
		      	@else
		      		<a href="{{ url('login') }}" class="follow btn btn-primary font-weight-bold ml-2 mb-1"><i class="icon-feather-user-x text-white"></i> follow</a>
		      	@endauth
		    </div>
	  	</div>
	</div>
@endforeach
