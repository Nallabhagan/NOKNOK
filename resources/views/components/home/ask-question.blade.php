@if(count($brands) > 0)
<div class="section padding-top-65 padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
                    <span>NOKNOK</span>
                    <h3>NOKNOK STARS</h3>
                    <div class="utf-headline-display-inner-item">Your Questions</div>
                </div>
                <div class="uk-position-relative mb-2" uk-slider="finite: true">
                    <div class="uk-slider-container video-grid-slider pb-3">
                        <ul class="uk-slider-items uk-child-width-1-3@m uk-child-width-1-3@s  pr-lg-1 uk-grid"
                            uk-scrollspy="target: > div; cls: uk-animation-slide-bottom-small; delay: 100">
                            @foreach($brands as $brand)
                            <li>
                                <a href="{{ url('brand') }}/{{ $brand->slug }}">
                                    <div class="course-card">
                                        <img src="{{ url('assets/brand_thumbnails') }}/{{ $brand->image }}">
                                        <div class="course-card-body">
                                            
                                            <h4 class="btn btn-primary">Ask Question</h4>
                                           
                                        </div>
                                    </div>
                                </a>
                            </li>
                            
                            @endforeach
                        </ul>
                    </div>
                    <a class="uk-position-center-left-out uk-position-small uk-hidden-hover slidenav-prev" href="#"
                        uk-slider-item="previous"></a>
                    <a class="uk-position-center-right-out uk-position-small uk-hidden-hover slidenav-next" href="#"
                        uk-slider-item="next"></a>
                </div>
            </div>
        </div>
    </div>
</div> 
@endif 


