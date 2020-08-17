@extends('layouts.dashboard')

@section('content')


<div class="utf-dashboard-content-inner-aera" style="min-height: 182px;">
	<div class="row">
		<div class="col-xl-12">
			<div class="dashboard-box margin-top-0">
				<div class="headline">
					<h3>Manage Q Party</h3>
				</div>
				<div class="content">
					<ul class="utf-dashboard-box-list">
						@foreach($qparties as $qparty)
							<li>
								<div class="utf-boxed-list-item-item">
									<div class="item-content">
										<h4>{{ $qparty->title }}</h4>
										<div class="item-details margin-top-10">
											<div class="utf-detail-item"><i class="icon-material-outline-date-range"></i> {{ $qparty->created_at->diffForHumans() }}</div>
											
										</div>
										<div class="utf-item-description">
											<p>{{ $qparty->description }}</p>
										</div>
									</div>
								</div>
								<div class="utf-buttons-to-right">
									<a href="{{ url('qparty') }}/{{ $qparty->slug }}" class="button dark ripple-effect margin-top-5 margin-bottom-10" target="_blank"><i class="icon-feather-eye"></i> View Q Party</a>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
			
		</div>
	</div>
	
</div>


@endsection