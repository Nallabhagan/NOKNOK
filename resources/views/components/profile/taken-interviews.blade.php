<div class="row">

	@foreach($interviews as $interview)
		<div class="col-md-4">
			
		<div class="box-shadow border p-2 mb-2">
			<div class="uk-width-expand uk-flex uk-flex-middle uk-first-column pl-0">
				<img src="{{ Helper::user_profile_pic($interview->answer_user_id) }}" class="rounded-sm mr-2" alt="" width="50">
				<h4 class="mb-0"> {{ Helper::username($interview->answer_user_id) }} </h4>
				<a href="{{ url('interview') }}/{{ Hashids::connection('answer_slug')->encode($interview->answer_user_id) }}/{{ $interview->slug }}" class="btn btn-primary btn-sm ml-auto"> 
					Read Interview
				</a>
			</div>
			
			<div class="uk-width-1-1 mt-2 uk-first-column pl-0">
				<p class="mb-0"> 
					{{ substr($interview->description, 0, 50) }}
				</p>
			</div>
		</div>




		</div>
	@endforeach
</div>
<div class="m-3">
	{{ $interviews->links() }}
</div>
