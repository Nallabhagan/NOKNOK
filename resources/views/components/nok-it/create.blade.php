<div class="post-newer">
  <div class="post-new border box-shadow">
    @auth
      <div class="post-new-media">
        <div class="post-new-media-user">
          <img src="{{ Helper::user_profile_pic(Auth::id()) }}" alt="">
        </div>
        <div class="post-new-media-input">
          <input type="text" class="uk-input" uk-toggle="target: body ; cls: post-focus" placeholder="Ask your question here.. {{ Auth::user()->name }}" style="background-color: #f1f3f4;">
        </div>
      </div>
    @else
      <div class="post-new-media">
        <div class="post-new-media-user">
          <img src="{{ url("images/user_small_1.jpg") }}" alt="">
        </div>
        <div class="post-new-media-input">
          <a href="{{ url('login') }}" class="uk-input" style="background-color: #f1f3f4;border:0px;">Ask your question here..</a>
        </div>
      </div>
    @endauth
    <hr>


    <div class="post-new-type">
      
      @if($id == Auth::id())
        <a href="{{ url('create-interview') }}" class="btn btn-primary mr-2 font-weight-bold d-inline-block">Create an Interview</a>
        <a href="{{ url('qparty/create_profile') }}" class="btn btn-primary mr-2 font-weight-bold d-inline-block">Create Q Party</a>
      @else
        <a href="{{ url('create-interview?member=') }}{{ Hashids::connection('user')->encode($id) }}" class="btn btn-primary mr-2 font-weight-bold d-inline-block">Ask for an Interview</a>
        <a href="{{ url('qparty/create_profile?member=') }}{{ Hashids::connection('user')->encode($id) }}" class="btn btn-primary mr-2 font-weight-bold d-inline-block">Invite Q Party</a>
      @endif
      <a href="{{ url('noknok/give-your-interview') }}" class="btn btn-primary font-weight-bold d-inline-block">
        Give your Interview
      </a>
    </div>


  </div>
  @auth
  <div class="post-pop">
    <div class="post-new-overyly" uk-toggle="target: body ; cls: post-focus"></div>
    <form action="{{ route('nok-it') }}" method="POST" class="post-new uk-animation-slide-top-small">
      @csrf
      <div class="post-new-header">
        <h4> ASK IT</h4>
        <!-- close button-->
        <span class="post-new-btn-close" uk-toggle="target: body ; cls: post-focus"
          uk-tooltip="title:Close; pos: left "></span>
      </div>
      <div class="post-new-media">
        <div class="post-new-media-user">
          <img src="{{ Helper::user_profile_pic(Auth::id()) }}" alt="">
        </div>
        <div class="post-new-media-input">
          <textarea style="box-shadow: none;" placeholder="Ask your question here.. {{ Auth::user()->name }}!" name="nokit_content" required></textarea>
        </div>
      </div>
      <hr>
      <div class="uk-flex uk-flex-between">
        <button type="submit" class="btn btn-primary btn-sm ml-auto"> Share </button>
      </div>
    </form>
  </div>
  @endauth
</div>