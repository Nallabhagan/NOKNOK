<div class="post box-shadow border" id="nokit{{ Hashids::connection('nokit')->encode($feed->id) }}">
    <div class="post-heading">
        <div class="post-avature">
            <img src="{{ Helper::user_profile_pic($feed->user_id) }}" alt="">
        </div>
        <div class="post-title">
            <h4> {{ Helper::username($feed->user_id) }} </h4>
            <p> {{ $feed->created_at->diffForHumans() }} </p>
        </div>
        
        @auth
            @if(Auth::id() == $feed->user_id)
                <div class="post-btn-action">
                    <span class="icon-feather-more-vertical" aria-expanded="false" style="cursor: pointer;"></span>
                    <div class="mt-0 p-2 uk-dropdown uk-dropdown-top-right" uk-dropdown="pos: bottom-right;mode:hover " style="left: 339.75px; top: -173.783px;">
                        <ul class="uk-nav uk-dropdown-nav">
                            
                            <li><a role="button" nokit_token="{{ Hashids::connection('nokit')->encode($feed->id) }}" class="text-danger delete"> <i class="icon-feather-trash-2 mr-1"></i>
                                Delete </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        @endauth


    </div>
    <div class="post-description">
        <p>{{ $feed->content }}</p>
    </div>
    <x-nok-it.feed-state id="{{ $feed->id }}" />

    <x-nok-it.feed-comments id="{{ $feed->id }}" />
</div>