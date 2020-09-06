@extends('layouts.app')
@section('social-media-meta-tags')
  @if(Helper::user_media_house_id($user_id) != NULL)
    <meta property="og:description" content="{{ Helper::media_description(Helper::user_media_house_id($user_id)) }}" />
    <meta property="og:title" content="{{ Helper::media_name(Helper::user_media_house_id($user_id)) }} | Follow My Q Space" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url('user') }}/{{ Hashids::connection('user')->encode($user_id) }}" />
    <meta property="og:image" content="{{ Helper::user_profile_pic($user_id) }}" />
    <meta property="fb:app_id" content="2714676228810928" />
  @endif
@endsection
@section('content')

<x-profile.information id="{{ $user_id }}" />
<div class="col-md-12 box-shadow" uk-sticky="offset:53;media : @s">
  <div class="container">
    <div class="nav-profile" style="box-shadow: inherit;">
      <div class="py-md-2 uk-flex-last">
        @if($user_id == Auth::id())
          <a href="{{ url('create-interview') }}" class="btn btn-primary p-2 font-weight-bold mr-2"> <i class="uil-plus"></i> Create an Interview</a>
          <a href="{{ url('qparty/create_profile') }}" class="btn btn-primary p-2 font-weight-bold mr-2"> <i class="uil-plus"></i> Create Q Party</a>
        @else
          <a href="{{ url('create-interview?member=') }}{{ Hashids::connection('user')->encode($user_id) }}" class="btn btn-primary p-2 font-weight-bold mr-2"> <i class="uil-plus"></i> Ask for an Interview</a>
          <a href="{{ url('qparty/create_profile?member=') }}{{ Hashids::connection('user')->encode($user_id) }}" class="btn btn-primary p-2 font-weight-bold mr-2"> <i class="uil-plus"></i> Invite Q Party</a>
        @endif
        
      </div>
      <div>
        <nav class="responsive-tab">
          <ul>
            <li class="tablinks" onclick="openTab(event, 'nokit')" id="defaultOpen"><a>Nok It</a></li>
            <li class="tablinks" onclick="openTab(event, 'qparty')"><a>Q Party</a></li>
            <li class="tablinks" onclick="openTab(event, 'givenInterview')" id="defaultOpen"><a>Interview Given</a></li>
            <li class="tablinks" onclick="openTab(event, 'takenInterview')"><a>Interview Taken</a></li>
          </ul>
        </nav>
        
      </div>
    </div>
  </div>
</div>
<div class="container pt-4">
  <div id="qparty" class="tabcontent">
    <x-profile.q-party id="{{ $user_id }}"/>
  </div>
  <div id="givenInterview" class="tabcontent">
    <x-profile.given-interviews id="{{ $user_id }}"/>
  </div>

  <div id="takenInterview" class="tabcontent">
    <x-profile.taken-interviews id="{{ $user_id }}"/>
  </div> 
  <div id="nokit" class="tabcontent">
    <div class="row">
      
      <div class="col-md-6">
        @if($user_id == Auth::id())
          <x-nok-it.create />
        @endif
        @foreach($feeds as $feed)
          <x-nok-it.single-feed id="{{ $feed->id }}"/>
        @endforeach
      </div>
      
    </div>
  </div> 
</div>

  
@endsection

@section('scripts')
@csrf
<script>
  
function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" uk-active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " uk-active";
}

document.getElementById("defaultOpen").click();


</script>

@include('_includes.follow_control_script')
@include('_includes.nokit_feed_scripts')

@endsection