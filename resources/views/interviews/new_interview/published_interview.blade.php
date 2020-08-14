@extends('layouts.app')
@section('social-media-meta-tags')

    @foreach($questions as $interview)
        <meta property="og:url"           content="{{ url('/') }}/{{ $interview->slug }}" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="NOK NOK | {{ $interview->title }}" />
        <meta property="og:description"   content="{{ $interview->description }}" />
        <meta property="og:image"         content="{{ url('assets/interview_thumbnails') }}/{{ $interview->thumbnail_image }}" />
        <meta property="fb:app_id" content="2714676228810928" />
    @endforeach
@endsection
@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-xl-3">
            <div class="utf-order-confirm-aera pt-0">
                
                @foreach($questions as $interview) 
                <img src="{{ url('assets/interview_thumbnails') }}/{{ $interview->thumbnail_image }}">
					<div class="col-md-8 offset-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">SHARE YOUR INTERVIEW</h2>
                                
                                <p class="card-text">You can share the interview by sharing it on social media or by copying the interview link and send the interview link through email, SMS, whatsapp etc.</p>
                                                                
                                <button onclick="copylink('{{ url('') }}/{{ $interview->slug }}')" class="btn btn-outline-primary margin-top-10 font-weight-bold" style="width: 100%;">Copy Interview Link <i class="icon-feather-link"></i></button>
                            </div>
                        </div>
                        <div class="text-center margin-top-10">
                            <h3><a href="{{ url('') }}/{{ $interview->slug }}" class="font-weight-bold text-danger text-underline">View Interview</a></h3>
                        </div>
                    </div>
                @endforeach
                
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
        function copylink(link){
            var dummy = $('<input>').val(link).appendTo('body').select()
            document.execCommand('copy');
            alert("link copied");
          
       }
	</script>
@endsection
@endsection