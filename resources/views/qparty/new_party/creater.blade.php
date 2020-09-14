@extends('layouts.app')
@section('social-media-meta-tags')
<title>NOKNOK | Q PARTY | {{ $qparty->title }}</title>
@endsection
@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-xl-3">
            <div class="utf-order-confirm-aera pt-0">
                
                <img src="{{ url('assets/qparty_thumbnails') }}/{{ $qparty->image }}">
                <div class="col-md-8 offset-xl-2">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">{{ $qparty->title }}</h2>
                            
                            <p class="card-text">{{ $qparty->description }}</p>
                            <h5 class="text-danger">Q Party Invitation has been send.</h5>            
                            <h5 class="mt-3"><a href="{{ url('/') }}" class="font-weight-bold text-primary text-underline">Go Home</a></h5>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
		});
	</script>
@endsection
@endsection