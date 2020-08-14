<header id="utf-header-container-block">
	<div id="header">
		<div class="container">
			<div class="utf-left-side">
				<div id="logo"> <a href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}" alt=""></a> </div>
				<nav id="navigation">
					<ul id="responsive">
						<li><a href="{{ url('/') }}" class="@if (Request::path() == '/') current @endif">Home</a></li>
						
						<li><a href="{{ url('noknok/give-your-interview') }}" class="@if (Request::path() == 'noknok/give-your-interview') current @endif">Give your Interview</a></li>

						<li>
							<a href="{{ url('create-interview') }}" class="@if (Request::path() == 'create-interview') current @endif">Create Interview</a>
						</li>
						{{-- <li>
							<a href="{{ url('brand/ask-on-question') }}" class="@if (Request::path() == 'brand/ask-on-question') current @endif">Ask a Question</a>
						</li> --}}
					</ul>
				</nav>
				<div class="clearfix"></div>
			</div>
			<div class="utf-right-side">
				@auth
				<div class="utf-header-widget-item hide-on-mobile">
					<div class="utf-header-notifications">
						<div class="utf-header-notifications-trigger notifications-trigger-icon"> 
							<a href="#">
								<i class="icon-feather-bell"></i>
								@if(count(auth()->user()->unreadNotifications) != 0)
		                            <span class="noti_count">
		                                {{ count(auth()->user()->unreadNotifications) }}
		                            </span>
		                        @endif
								
							</a> 
						</div>
						<div class="utf-header-notifications-dropdown-block">
							<div class="utf-header-notifications-headline">
								<h4>View All Notifications</h4>
								<a href="{{ route('markRead') }}" class="text-white" style="float: right;">Mark all as Read</a>
							</div>
							<div class="utf-header-notifications-content">
								<div class="utf-header-notifications-scroll" data-simplebar="init" style="height: 228px;">
									<div class="simplebar-track vertical" style="visibility: visible;">
										<div class="simplebar-scrollbar" style="visibility: visible; top: 0px; height: 128px;"></div>
									</div>
									<div class="simplebar-track horizontal" style="visibility: visible;">
										<div class="simplebar-scrollbar" style="visibility: visible; left: 0px; width: 25px;"></div>
									</div>
									<div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;">
										<div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">
											<ul>
												@if(count(auth()->user()->unreadNotifications) != 0)
												@foreach(auth()->user()->unreadNotifications as $notification)
												<li class="notifications-not-read"><a href="{{ $notification->data['url'] }}"><span class="notification-icon"><i class="icon-material-outline-group"></i></span> <span class="notification-text"> <strong>{{ Helper::username($notification->data['user_id']) }}</strong> {{ $notification->data['message'] }}</a></li>
												@endforeach
												@else 
													<li class="notifications-not-read"><a href="{{ url('/') }}"><span class="notification-icon"></span> <span class="notification-text">No Notification </span></a></li>
												@endif
											</ul>
										</div>
									</div>
								</div>
							</div>
							{{-- <a href="javascript:void(0);" class="utf-header-notifications-button ripple-effect utf-button-sliding-icon">See All Notifications<i class="icon-feather-chevrons-right"></i></a> --}}
						</div>
					</div>
				</div>
				@endauth


				<div class="utf-header-widget-item">
					<div class="utf-header-notifications user-menu">
						<div class="utf-header-notifications-trigger user-profile-title">
							@auth
								<a href="#">
									<div class="user-avatar"><img src="{{ Auth::user()->profile_pic  }}" alt=""> </div>
									<div class="user-name">Hi, {{ Auth::user()->name }}</div>
								</a>
							@else 
								<a href="#">
									<div class="user-avatar status-online"><img src="{{ url('images/user_small_1.jpg') }}" alt=""> </div>
									<div class="user-name">Sign In/Sign Up</div>
								</a>
							@endauth
						</div>
						<div class="utf-header-notifications-dropdown-block">
							<ul class="utf-user-menu-dropdown-nav">
								@auth
									<li><a href="{{ url('user') }}/{{ Hashids::connection('user')->encode(Auth::user()->id) }}"><i class="icon-feather-user"></i> My Profile</a></li>
									@if(Auth::user()->id == 1)
										<li><a href="{{ url('brand/create_profile') }}"><i class="icon-feather-user"></i> Create Brand</a></li>
									@endif
									<li>
										<a href="{{ route('logout') }}" 
			                                 onclick="event.preventDefault();
			                                 document.getElementById('logout-form').submit();" role="button"><i class="icon-material-outline-power-settings-new"></i> Logout
			                            </a>
			                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					                       	@csrf
					                    </form>
			                        </li>
			                    @else 
			                    	<li><a href="{{ route('login') }}"><i class="icon-feather-log-in"></i> Sign In</a></li>
			                    @endauth		
							</ul>
						</div>
					</div>
				</div>
				<span class="mmenu-trigger">
				<button class="hamburger utf-hamburger-collapse-item" type="button"> <span class="utf-hamburger-box-item"> <span class="utf-hamburger-inner-item"></span> </span> </button>
				</span> 
			</div>
		</div>
	</div>
</header>


<div class="clearfix"></div>