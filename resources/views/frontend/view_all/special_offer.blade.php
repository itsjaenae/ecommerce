@extends('frontend.master.front')

@section('title')
    {{__('Special Offer Product')}}
@endsection

@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection

@section('content')
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">{{__('Home')}}</a>
                </li>
                <li class="separator"></li>
                <li><a href="{{route('front.campaign')}}">{{__('Special Offer  Products')}}</a>
                </li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Page Content-->

    @php
    function renderStarRating($rating,$maxRating=5) {

            $fullStar = "<i class = 'far fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
        $rating = $rating <= $maxRating?$rating:$maxRating;

        $fullStarCount = (int)$rating;
        $halfStarCount = ceil($rating)-$fullStarCount;
        $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

        $html = str_repeat($fullStar,$fullStarCount);
        $html .= str_repeat($halfStar,$halfStarCount);
        $html .= str_repeat($emptyStar,$emptyStarCount);
        $html = $html;
        return $html;
    }
    @endphp
    <div class="deal-of-day-section pb-5">
        <div class="container">
            
            <div class="row g-3">
                @foreach ($special_offer as $item)
                <div class="col-gd">
                <div class="product-card">
                    <div class="product-thumb">
                        @if ($item->is_stock())
                            <div class="product-badge
                            @if($item->is_type == 'feature')
                            bg-warning
                            @elseif($item->is_type == 'new')

                            @elseif($item->is_type == 'top')
                            bg-info
                            @elseif($item->is_type == 'best')
                            bg-dark
                            @elseif($item->is_type == 'flash_deal')
                            bg-success
                            @endif
                            ">
                            {{empty(ucfirst(str_replace('_',' ',$item->is_type))) ?ucfirst(str_replace('_',' ',$item->is_type)):''   }}
                            </div>

                            @else
                            <div class="product-badge bg-secondary border-default text-body
                            ">{{__('out of stock')}}</div>
                            @endif

                            @if($item->previous_price && $item->previous_price !=0)
                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                            @endif

                        <img src="{{asset('images/product_images/'.$item->thumbnail)}}" alt="Product">
                     
                     <div class="product-button-group">
                            @php $countWishlist = 0 @endphp
                            @if(Auth::check()) 
                            @php $countWishlist = App\Models\Wishlist::countWishlist($item->id) @endphp
                            <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$item->id)}}" title="{{__('Wishlist')}}">
                                @if($countWishlist > 0)
                                <i class="fa fa-heart" style="color: #FFFFFF;"></i>
                                @else
                                <i class="icon-heart"></i>
                                @endif
                               </a>
                               @endif
                           
                            <a data-target="{{route('front.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                            @include('frontend.includes.item_footer',['sitem' => $item])
                        </div> 
                    </div>
                    <div class="product-card-body">

                        <div class="product-category"><a href="{{route('front.category').'?category='.$item->category->slug_en}}">
                            @if(session()->get('language') == 'hindi') {{ $item->category->name_hin }} 
                            @elseif(session()->get('language') == 'french') {{$item->category->name_frn }} 
                            @else {{ $item->category->name_en }} @endif 
                        </a></div>
                        <h3 class="product-title"><a href="{{route('product.details',$item->slug_en)}}">
                            @if(session()->get('language') == 'hindi') 
                            {{Str::limit($item->name_hin, 33)  }}
                            @elseif(session()->get('language') == 'french') 
                            {{ strlen(strip_tags($item->name_frn)) > 35 ? substr(strip_tags($item->name_frn), 0, 35) : strip_tags($item->name_frn) }}
                            @else                                
                              {{ strlen(strip_tags($item->name_en)) > 35 ? substr(strip_tags($item->name_en), 0, 35) : strip_tags($item->name_en) }}
                             @endif 
                        </a></h3>
                        <div class="rating-stars">
                            {!! renderStarRating($item->reviews->avg('rating')) !!}
                        </div>
                        <h4 class="product-price">
                        @if ($item->previous_price != 0)
                        <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                        @endif
                        {{PriceHelper::grandCurrencyPrice($item)}}
                        </h4>

                    </div>

                </div>
            </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection
