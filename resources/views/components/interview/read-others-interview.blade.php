<div uk-sticky="offset:100 ; bottom:true ; meda : @m" class="card mt-3">
	<div class="card-body">
		<div class="section-header pt-2">
			<div class="section-header-left">
				<h3> Read Interviews</h3>
			</div>
			<div class="section-header-right">
				{{-- <a href="#" class="see-all text-primary"> See all</a> --}}
			</div>
		</div>
		<div class="uk-child-width-1-1@m uk-grid-collapse" uk-grid>
			<!-- list itme 1 -->
			@foreach($interviews as $interview)
			{{-- <div> --}}
				<div class="list-items">
					<div class="list-item-media">
						<img src="{{ Helper::user_profile_pic($interview->user_id) }}" alt="">
					</div>
					<div class="list-item-content">
						<a href="{{ url('user') }}/{{ Hashids::connection('user')->encode($interview->user_id) }}"> 
							<h4 style="top: 10%;">{{ Helper::username($interview->user_id) }}</h4>
						</a>
						{{-- <p> Drinks , Food </p> --}}
					</div>
					<div class="uk-width-auto">
						<a href="{{ url('interview') }}/{{ Hashids::connection('answer_slug')->encode($interview->user_id) }}/{{ $interview->slug }}" class="btn btn-primary btn-sm">View</a>
					</div>
				</div>
			{{-- </div> --}}
			@endforeach
		</div>
	</div>
</div>