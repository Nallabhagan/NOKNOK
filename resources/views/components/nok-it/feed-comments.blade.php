

<div class="post-comments">
	<div id="userComments{{ Hashids::connection('nokit')->encode($id) }}">
        @if(count($comments) > 0) 
			@foreach($comments as $comment)
				<div class="post-comments-single">
	                <div class="post-comment-avatar">
	                    <img src="{{ Helper::user_profile_pic($comment->user_id) }}" alt="">
	                </div>
	                <div class="post-comment-text">
	                    <div class="post-comment-text-inner">
	                        <p><a href="{{ Hashids::connection('user')->encode($comment->user_id) }}" class="text-primary mr-1 font-weight-bold">{{ Helper::username($comment->user_id) }}</a>{{ $comment->comment }}</p>
	                    </div>
	                    <div class="uk-text-small">
	                        <span> {{ $comment->created_at->diffForHumans() }}</span>
	                    </div>
	                </div>
	            </div>
				
			@endforeach
		@endif
	</div>
	
	@auth
		<div class="post-add-comment">
			<div class="post-add-comment-avature">
				<img src="{{ Helper::user_profile_pic(Auth::user()->id) }}" alt="">
			</div>
			<div class="post-add-comment-text-area">
				<form class="commentForm" autocomplete="off" id="{{ Hashids::connection('nokit')->encode($id) }}">
                    @csrf
                    <input type="text" placeholder="Write your comment..." id="addComment{{ Hashids::connection('nokit')->encode($id) }}">
                </form>
			</div>
		</div>
	@else
		<a href="{{ url('login') }}" class="post-add-comment">
			<div class="post-add-comment-avature">
				<img src="{{ url('images/user_small_1.jpg') }}" alt="">
			</div>
			<div class="post-add-comment-text-area">
				<input type="text" placeholder="Write your comment...">
			</div>
		</a>
	@endauth
</div>

