@if ($setting->is_two_c_b == 1)
<div class="bannner-section mt-50">
    <div class="container ">
        @if(isset($banner_third ))
        <div class="row gx-3">
            <div class="col-md-6">
                <a href="{{$banner_third['url1']}}" class="genius-banner">
                    <img class="lazy" data-src="{{ asset('images/home_page_images/'.$banner_third['img1']) }}" alt="">
                    <div class="inner-content">
                        @if (isset($banner_third['subtitle1']))
                            <p>{{$banner_third['subtitle1']}}</p>
                        @endif
                        @if (isset($banner_third['title1']))
                            <h4>{{$banner_third['title1']}}</h4>
                        @endif
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{$banner_third['url2']}}" class="genius-banner">
                    <img class="lazy" data-src="{{ asset('images/home_page_images/'.$banner_third['img2']) }}" alt="">
                    <div class="inner-content">
                        @if (isset($banner_third['subtitle2']))
                            <p>{{$banner_third['subtitle2']}} </p>
                        @endif
                        @if (isset($banner_third['title2']))
                            <h4>{{$banner_third['title2']}}</h4>
                        @endif
                    </div>
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endif