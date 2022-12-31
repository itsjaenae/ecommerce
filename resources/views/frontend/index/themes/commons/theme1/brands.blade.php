
    @if ($setting->is_popular_brand == 1)
    <section class="brand-section mt-30 mb-60">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="section-title recommended2">
                        <h3 class="h3 header-view">{{ __('Popular Brands') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="brand-slider owl-carousel">
                        @if(isset($brands ))
                        @foreach ($brands as $brand)
                        <div class="slider-item">
                            <a class="text-center" href="{{ route('front.brands') . '?brand=' . $brand->slug_en }}">
                                <img class="d-block hi-50 lazy"
                                data-src="{{ asset('images/brand_images/' . $brand->photo) }}"
                                    alt="{{ $brand->name_en }}" title="{{ $brand->name_en }}" 
                                    style="height: 80px;width:180px">
                            </a>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif