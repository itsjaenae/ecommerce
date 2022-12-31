@if ($setting->is_slider == 1)
<div class="slider-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block">
                @include('frontend.includes.categories')

            </div>

            <div class="col-lg-9" >
                <!-- Main Slider-->
                <div class="hero-slider">
                    <div class="hero-slider-main owl-carousel dots-inside" >
                      
                        @foreach ($sliders as $slider)
                            <div class="item slider-image
                            @if (DB::table('languages')->where('is_default',1)->first()->rtl == 1)
                            d-flex justify-content-end
                            @endif
                            "
                                style="background: url('{{ asset('images/slider_images/'.$slider->photo) }}')
                                " >
                                <div class="item-inner">
                                    <div class="from-bottom">
                                 
                                        @if ($slider->logo)
                                            <img class="d-inline-block brand-logo"
                                            src="{{ asset('images/slider_images/'.$slider->logo) }}"
                                            alt="logo" >
                                        @endif
                                        <div class="title text-body">{{ $slider->title }}</div>
                                        <div class="subtitle text-body">{{ $slider->details }}</div>
                                    </div>
                                    <a class="btn btn-primary scale-up delay-1"
                                        href="{{ $slider->link }}"> <span>{{ __('Buy Now') }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                     
                    </div>
                </div>


                
            </div>

    

        </div>
    </div>
</div>
@endif
