@extends('layouts.app')
@section('social-media-meta-tags')
  <title>NOKNOK | ASK IT | {{ Helper::username($user_id) }}</title>
  @if(Helper::user_media_house_id($user_id) != NULL)
    <meta property="og:description" content="{{ $content }}" />
    <meta property="og:title" content="NokIt | {{ Helper::username($user_id) }} has asked an question" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url('nokit') }}/{{ Hashids::connection('nokit')->encode($id) }}" />
    <meta property="og:image" content="{{ Helper::user_profile_pic($user_id) }}" />
    <meta property="og:image:width" content="200" />
    <meta property="og:image:height" content="200" />
    <meta property="fb:app_id" content="2714676228810928" />
  @endif
@endsection
@section('content')

<x-profile.information id="{{ $user_id }}" />
<div class="col-md-12 box-shadow" uk-sticky="offset:53;media : @s">
  <div class="container">
    <div class="nav-profile" style="box-shadow: inherit;">
      <div class="py-md-2 uk-flex-last">
        <a href="{{ url('create-interview') }}" class="btn btn-primary p-2 font-weight-bold mr-2"> <i class="uil-plus"></i> Create an Interview</a>
        <a href="{{ url('qparty/create_profile') }}" class="btn btn-primary p-2 font-weight-bold mr-2"> <i class="uil-plus"></i> Create Q Party</a>
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
<div class="col-md-12 pt-4">
  <div class="container">
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
            
            <x-nok-it.single-feed id="{{ $id }}"/>
          </div>
          
        </div>
      </div> 
  </div>
</div>

  
@endsection

@section('scripts')

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