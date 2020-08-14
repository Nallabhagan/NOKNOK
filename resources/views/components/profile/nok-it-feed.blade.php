@foreach($feeds as $feed)
<div class="post">
    <div class="post-heading">
        <div class="post-avature">
            <img src="{{ Helper::user_profile_pic($feed->user_id) }}" alt="">
        </div>
        <div class="post-title">
            <h4> {{ Helper::username($feed->user_id) }} </h4>
            <p> {{ $feed->created_at->diffForHumans() }} </p>
        </div>
        
    </div>
    <div class="post-description">
        <p>{{ $feed->content }}</p>
    </div>

</div>
@endforeach