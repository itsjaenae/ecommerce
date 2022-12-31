

    @if ($setting->is_three_c_b_second == 1)
    <div class="bannner-section mt-60">
        <div class="container ">
            @if(isset($banner_second))
            <div class="row gx-3">
                <div class="col-md-4">
                    <a href="{{$banner_second['url1']}}" class="genius-banner">
                        <img class="lazy" data-src="{{ asset('images/home_page_images/'.$banner_second['img1']) }}" alt="">
                        <div class="inner-content">
                            @if (isset($banner_second['subtitle1']))
                                <p>{{$banner_second['subtitle1']}}</p>
                            @endif

                            @if (isset($banner_second['title1']))
                                <h4>{{$banner_second['title1']}}</h4>
                            @endif
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{$banner_second['url2']}}" class="genius-banner">
                        <img class="lazy" data-src="{{ asset('images/home_page_images/'.$banner_second['img2']) }}" alt="">
                        <div class="inner-content">
                            @if (isset($banner_second['subtitle2']))
                                <p>{{$banner_second['subtitle2']}}</p>
                            @endif

                            @if (isset($banner_second['title2']))
                                <h4> {{$banner_second['title2']}}</h4>
                            @endif
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{$banner_second['url3']}}" class="genius-banner">
                        <img class="lazy" data-src="{{ asset('images/home_page_images/'.$banner_second['img3']) }}" alt="">
                        <div class="inner-content">
                            @if (isset($banner_second['subtitle3']))
                                <p>{{$banner_second['subtitle3']}} </p>
                            @endif

                            @if (isset($banner_second['title3']))
                                <h4>{{$banner_second['title3']}}</h4>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
@endif