<div class="post-state">
    @auth
        @if(Helper::like_check(Auth::id(),$id))
            <div class="post-state-btns like-button text-primary" nokit_token="{{ Hashids::connection('nokit')->encode($id) }}" like_type="Like"> <i class="icon-feather-thumbs-up mb-1"></i> {{ Helper::like_count($id) }}<span> Liked </span>
            </div>
        @else
            <div class="post-state-btns like-button" nokit_token="{{ Hashids::connection('nokit')->encode($id) }}" like_type="Like"> <i class="icon-feather-thumbs-up mb-1"></i> {{ Helper::like_count($id) }}<span> Liked </span>
            </div>
        @endif
    @else
        <a href="{{ url('login') }}" class="post-state-btns"> <i class="icon-feather-thumbs-up mb-1"></i> {{ Helper::like_count($id) }}<span> Liked </span>
            </a href="{{ url('login') }}">
    @endauth
    
    <div class="post-state-btns"> <i class="icon-feather-message-circle"></i> {{ Helper::comment_count($id) }} <span> Answers</span>
    </div>
    <div class="post-state-btns" uk-toggle="target: #modal-close-default{{ $id }}"> <i class="icon-feather-share-2"></i><span> Share </span>
    </div>
</div>


<!-- This is the modal with the default close button -->
<div id="modal-close-default{{ $id }}" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Share</h2>
        

        <div class="utf-social-login-buttons-block">
        	<button data-sharer="facebook" data-url="{{ url('nokit') }}/{{ Hashids::connection('nokit')->encode($id) }}" class="facebook-login ripple-effect">
        		<i class="icon-brand-facebook-f"></i> Facebook
        	</button> 
        	<button data-sharer="twitter" data-url="{{ url('nokit') }}/{{ Hashids::connection('nokit')->encode($id) }}" class="twitter-share ripple-effect"><i class="icon-brand-twitter"></i> Twitter
        	</button>
        	<button data-title="" data-sharer="whatsapp" data-url="{{ url('nokit') }}/{{ Hashids::connection('nokit')->encode($id) }}" class="whatsapp-share ripple-effect" data-web="true"><i class="icon-brand-whatsapp"></i> Whats App
        	</button>
        </div>


        <input class="fancybox-share__input" type="text" value="{{ url('nokit') }}/{{ Hashids::connection('nokit')->encode($id) }}" onclick="select()">
    </div>
</div>