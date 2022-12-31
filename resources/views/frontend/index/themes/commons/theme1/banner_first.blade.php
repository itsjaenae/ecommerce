@if ($setting->is_three_c_b_first == 1)
<div class="bannner-section mt-60">
    <div class="container ">
        @if(isset($banner_first))
        <div class="row gx-3">
            <div class="col-md-4">
                <a href="{{$banner_first['firsturl1']}}" class="genius-banner">
                    <div class="banner_img">
                    <img  src="{{ asset('images/home_page_images/'.$banner_first['img1']) }}" alt="">
                </div>
                    <div class="inner-content">
                        @if (isset($banner_first['subtitle1']))
                            <p>{{$banner_first['subtitle1']}}</p>
                        @endif
                        @if (isset($banner_first['title1']))
                            <h4>{{$banner_first['title1']}}</h4>
                        @endif
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{$banner_first['firsturl2']}}" class="genius-banner">
                    <img src="{{ asset('images/home_page_images/'.$banner_first['img2']) }}" alt="">
                    <div class="inner-content">
                        @if (isset($banner_first['subtitle2']))
                            <p>{{$banner_first['subtitle2']}}</p>
                        @endif
                        @if (isset($banner_first['title2']))
                            <h4>{{$banner_first['title2']}}</h4>
                        @endif
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{$banner_first['firsturl3']}}" class="genius-banner">
                    <img src="{{ asset('images/home_page_images/'.$banner_first['img3']) }}" alt="">
                    <div class="inner-content">
                        @if (isset($banner_first['subtitle3']))
                            <p>{{$banner_first['subtitle3']}} </p>
                        @endif
                        @if (isset($banner_first['title3']))
                            <h4>{{$banner_first['title3']}}</h4>
                        @endif
                    </div>
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endif
