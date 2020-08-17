<div class="utf-dashboard-sidebar-item">
  <div class="utf-dashboard-sidebar-item-inner" data-simplebar>
    <div class="utf-dashboard-nav-container">
      <!-- Responsive Navigation Trigger --> 
      <a href="#" class="utf-dashboard-responsive-trigger-item"> <span class="hamburger utf-hamburger-collapse-item" > <span class="utf-hamburger-box-item"> <span class="utf-hamburger-inner-item"></span> </span> </span> <span class="trigger-title">Dashboard Navigation Menu</span> </a> 
      <!-- Navigation -->
      <div class="utf-dashboard-nav">
        <div class="utf-dashboard-nav-inner">
          <div class="dashboard-profile-box">
            <span class="avatar-img">
            <img alt="" src="{{ Helper::user_profile_pic(Auth::id()) }}" class="photo">
            </span>
            <div class="user-profile-text">
              <span class="fullname">{{ Helper::username(Auth::id()) }}</span>
            </div>
          </div>
          <div class="clearfix"></div>
          <ul>
            
            <li class="@if (Request::path() == 'dashboard/profile') active @endif">
              <a href="{{ url('dashboard/profile') }}">
                <i class="icon-feather-user"></i> My Profile
              </a>
            </li>

            <li class="@if (Request::path() == 'dashboard/interviews') active @endif">
              <a href="{{ url('dashboard/interviews') }}">
                <i class="icon-material-outline-rate-review"></i> Interviews
              </a>
            </li>

            <li class="@if (Request::path() == 'dashboard/qparties') active @endif">
              <a href="{{ url('dashboard/qparties') }}">
                <i class="icon-material-outline-group"></i> Q Party
              </a>
            </li>
            <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" role="button">
                <i class="icon-material-outline-power-settings-new"></i> Logout
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </a>
              
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Dashboard Sidebar / End --> 