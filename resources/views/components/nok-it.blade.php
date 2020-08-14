<div class="post-newer">
  <div class="post-new border bg-success" uk-toggle="target: body ; cls: post-focus" style="box-shadow: none;">
    <div class="post-new-media">
      <div class="post-new-media-user">
        <img src="{{ Helper::user_profile_pic(Auth::id()) }}" alt="">
      </div>
      <div class="post-new-media-input">
        <input type="text" class="uk-input" placeholder="What's Your Mind ? {{ Auth::user()->name }}">
      </div>
    </div>
  </div>
  <div class="post-pop">
    <div class="post-new-overyly" uk-toggle="target: body ; cls: post-focus"></div>
    <form action="{{ route('nok-it') }}" method="POST" class="post-new uk-animation-slide-top-small">
      @csrf
      <div class="post-new-header">
        <h4> NOK IT</h4>
        <!-- close button-->
        <span class="post-new-btn-close" uk-toggle="target: body ; cls: post-focus"
          uk-tooltip="title:Close; pos: left "></span>
      </div>
      <div class="post-new-media">
        <div class="post-new-media-user">
          <img src="{{ Helper::user_profile_pic(Auth::id()) }}" alt="">
        </div>
        <div class="post-new-media-input">
          <textarea style="box-shadow: none;" placeholder="What's Your Mind ? {{ Auth::user()->name }}!" name="nokit_content" required></textarea>
        </div>
      </div>
      <hr>
      <div class="uk-flex uk-flex-between">
        <button type="submit" class="btn btn-primary btn-sm ml-auto"> Share </button>
      </div>
    </form>
  </div>
</div>