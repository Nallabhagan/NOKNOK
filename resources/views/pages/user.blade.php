@extends('layouts.app')

@section('content')

<x-profile.information id="{{ $user_id }}" />
<div class="col-md-12 box-shadow" uk-sticky="offset:53;media : @s">
  <div class="container">
    <div class="nav-profile" style="box-shadow: inherit;">
      @if(Auth::id() == $user_id)
        <div class="py-md-2 uk-flex-last">
          <a href="{{ url('create-interview') }}" class="btn btn-primary p-2 font-weight-bold mr-2"> <i class="uil-plus"></i> Create an Interview</a>
          <a href="{{ url('qparty/create_profile') }}" class="btn btn-primary p-2 font-weight-bold mr-2"> <i class="uil-plus"></i> Create Q Party</a>
        </div>
      @endif
      <div>
        <nav class="responsive-tab">
          <ul>
            <li class="tablinks" onclick="openTab(event, 'nokit')" id="defaultOpen"><a>Nok It</a></li>
            <li class="tablinks" onclick="openTab(event, 'giveInterview')"><a>Give your Interview</a></li>
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
      <div id="giveInterview" class="tabcontent">
        <x-give-interview />
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
              <x-nok-it />
            @endif
            <x-profile.nok-it-feed id="{{ $user_id }}"/>
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

@endsection