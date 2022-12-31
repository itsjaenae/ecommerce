@extends('frontend.master.front')
@section('meta')
    <meta name="keywords" content="{{ $setting->meta_keywords }}">
    <meta name="description" content="{{ $setting->meta_description }}">
@endsection

@section('content')

    @php
        function renderStarRating($rating, $maxRating = 5)
        {
            $fullStar = "<i class = 'fas fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
            $rating = $rating <= $maxRating ? $rating : $maxRating;

            $fullStarCount = (int) $rating;
            $halfStarCount = ceil($rating) - $fullStarCount;
            $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

            $html = str_repeat($fullStar, $fullStarCount);
            $html .= str_repeat($halfStar, $halfStarCount);
            $html .= str_repeat($emptyStar, $emptyStarCount);
            $html = $html;
            return $html;
        }
    @endphp

@include('frontend.index.themes.commons.theme1.slider')
  

    @if ($setting->is_service == 1)
        <section class="service-section">
            <div class="container">
                <div class="row ">
                    @if(isset($services))
                    @foreach ($services as $service)
                        <div class="col-lg-3 col-sm-6 text-center mb-30">
                            <div class="single-service single-service2">
                                <img class="service-img" src="{{ asset('images/services_images/'.$service->photo) }}" alt="Shipping">
                                <div class="content">
                                    <h6 class="mb-2 service-title">{{ $service->title }}</h6>
                                    <p class="text-sm text-muted mb-0">{{ $service->details }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif

@include('frontend.index.themes.commons.theme1.campaign_items')
   
@include('frontend.index.themes.commons.theme1.hot_deals')

@include('frontend.index.themes.commons.theme1.banner_first')

 @include('frontend.index.themes.commons.theme1.special_deals') 

 @include('frontend.index.themes.commons.theme1.special_offer') 

 @include('frontend.index.themes.commons.theme1.2column_banner')

@include('frontend.index.themes.commons.theme1.popular_category')

@include('frontend.index.themes.commons.theme1.3column_banner')

@include('frontend.index.themes.commons.theme1.brands')

@include('frontend.index.themes.commons.theme1.top_rated_column')

@include('frontend.index.themes.commons.theme1.flash_deal_banner')

@include('frontend.index.themes.commons.theme1.featured_category')

@include('frontend.index.themes.commons.theme1.4column_featured_category')

  



@endsection

