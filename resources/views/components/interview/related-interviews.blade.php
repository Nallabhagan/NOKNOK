
<div class="uk-position-relative" uk-slider="finite: true">
    <div class="uk-slider-container px-lg-1 py-3">
        <ul class="uk-slider-items uk-child-width-1-2@m uk-child-width-1-3@s uk-grid">
            @foreach($interviews as $interview)
                <li>
                    <div class="star_answer">
                        <div data-background-image="{{ url('images/job-category-01.jpg') }}" class="photo-box photo-category-box small" style="height: 280px;">
                            <div class="utf-opening-box-content-part">
                                @php
                                    $data = Helper::get_star_answer($interview->interview_id,$interview->answer_index);
                                @endphp
                                <p style="color: #dc0e0e;font-size: 25px;font-weight: 600;">Interview</p>
                                <h3 style="font-size: 20px;line-height: 30px;">"{{ Str::limit($data['answer'], 70) }}"
                                    
                                    <a href="{{ $data['profile_url'] }}">- {{ $data['user_name'] }}</a>
                                </h3>   
                                <p><a href="{{ $data['interview_url'] }}" class="btn btn-primary btn-sm font-weight-bold mt-3">View More</a></p>
                                </div>
                        </div>
                    </div>
                </li>
            @endforeach
            
        </ul>
        <a class="uk-position-center-left-out uk-position-small uk-hidden-hover slidenav-prev" href="#"
            uk-slider-item="previous"></a>
        <a class="uk-position-center-right-out uk-position-small uk-hidden-hover slidenav-next" href="#"
            uk-slider-item="next"></a>
    </div>
</div>