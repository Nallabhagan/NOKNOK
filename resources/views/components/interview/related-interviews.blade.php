
<div class="uk-position-relative" uk-slider="finite: true">
    <div class="uk-slider-container px-lg-1 py-3">
        <ul class="uk-slider-items uk-child-width-1-2@m uk-child-width-1-3@s uk-grid">
            @foreach($interviews as $interview)
                <li>
                    <div class="star_answer">
                        
                        
                        <div class="photo-box photo-category-box small box-shadow border">
                            
                            <div class="utf-opening-box-content-part">
                                
                                <div class="post-heading p-0">
                                    <div class="post-avature">
                                        <img src="{{ Helper::user_profile_pic(Helper::interview_question_details($interview->question_id)["user_id"]) }}" alt="">
                                    </div> 
                                    <div class="post-title">
                                        <h4>
                                            <a href="{{ url("user") }}/{{ Hashids::connection("user")->encode(Helper::interview_question_details($interview->question_id)["user_id"]) }}">
                                                {{ Helper::username(Helper::interview_question_details($interview->question_id)["user_id"]) }}
                                            </a> 
                                        </h4> 
                                        <h6> {{ Helper::interview_question_details($interview->question_id)["created_at"]->diffForHumans() }} </h6>
                                    </div>
                                </div>
                                @php
                                    $questions = Helper::interview_question_details($interview->question_id)["questions"];
                                    $question_key = array_rand($questions);

                                    $answers = $interview->answers;
                                @endphp
                                
                                <p class="mt-1">
                                    {{ Str::limit($questions[$question_key], 70) }}
                                </p>
                                <h3 class="mt-1">"{{ Str::limit($answers[$question_key], 70) }}"
                                </h3>
                                
                                <div class="post-heading p-0 mt-1">
                                    <div class="post-avature">
                                        <img src="{{ Helper::user_profile_pic($interview->user_id) }}" alt="">
                                    </div> 
                                    <div class="post-title mt-2">
                                        <h4>
                                            <a href="{{ url("user") }}/{{ Hashids::connection("user")->encode($interview->user_id) }}">{{ Helper::username($interview->user_id) }} </a> 
                                        </h4>
                                    </div>
                                    <div class="post-btn-action">
                                        <a href="{{ url("interview") }}/{{ Hashids::connection("answer_slug")->encode($interview->user_id) }}/{{ $interview->slug }}" class="btn btn-primary btn-sm font-weight-bold mt-1">Read full interview</a>
                                    </div>
                                </div>  
                                
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