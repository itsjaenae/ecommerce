@if ($setting->campaign_status == 1)
<div class="deal-of-day-section mt-20" >
    <div class="container"style="background: #FFFFFF">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title flash-sales">
                    <h3 class="h3 header-title">{{ $setting->campaign_title }}</h3>
                    <div class="right-area">
                            <span class="countdown countdown-alt timer" 
                            data-date-time="{{$setting->campaign_end_date}}"
                                style="background: #dd0000 !important; color: #ffffff;
                                  "></span>
                            <a class="right_link view-all" href="{{route('front.campaign')}}"style="color:#000 !important">{{ __('View All') }} 
                                <i class="icon-chevron-right"></i></a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-12">
            <div class="popular-category-slider owl-carousel">
                {{-- @if(isset($campaign_items)) --}}
                @foreach ($campaign_items as $compaign_item)

                <div class="slider-item">
                    <div class="product-card">
                        <div class="product-thumb">
                            @if (!$compaign_item->item->is_stock())
                                 <div class="product-badge bg-secondary border-default text-body
                                ">{{__('out of stock')}}</div>
                            @endif

                            @if($compaign_item->item->previous_price && $compaign_item->item->previous_price !=0)
                                <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($compaign_item->item)}}</div>
                            @endif

                           
                            <img class="lazy" data-src="{{asset('images/product_images/'.$compaign_item->item->thumbnail)}}" alt="Product">
                            <div class="product-button-group">

                               @php $countWishlist = 0 @endphp
                                    @if(Auth::check())
                                    @php $countWishlist = App\Models\Wishlist::countWishlist($compaign_item->item->id) @endphp
                                    <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$compaign_item->item->id)}}" title="{{__('Wishlist')}}">
                                        @if($countWishlist > 0)
                                        <i class="fa fa-heart" style="color: #FFFFFF;"></i>
                                        @else
                                        <i class="icon-heart"></i>
                                        @endif
                                       </a>
                                       @else
                                        <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$compaign_item->item->id)}}" title="{{__('Wishlist')}}">
                                        @if($countWishlist > 0)
                                        <i class="fa fa-heart" style="color: #FFFFFF;"></i>
                                        @else
                                        <i class="icon-heart"></i>
                                        @endif
                                       </a>
                                           @endif
    
                                <a data-target=" {{route('front.compare.product',$compaign_item->item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                @if ($compaign_item->item->is_stock())
                                    <a class="product-button add_to_single_cart"  data-target="{{ $compaign_item->item->id }}" href="javascript:;"  title="{{__('To Cart')}}"><i class="icon-shopping-cart"></i>
                                    </a>
                                @else
                                    <a class="product-button" href=" {{route('product.details',$compaign_item->item->slug_en)}}" title="{{__('Details')}}"><i class="icon-arrow-right"></i></a>
                                @endif
                            </div>
                        </div>
                            <div class="product-card-body">
                                <div class="product-category">
                                    <a href="{{url('/category/'.$compaign_item->item->category->id.'/'.$compaign_item->item->category->slug_en)}}">
                                        @if(session()->get('language') == 'hindi') {{ $compaign_item->item->category->name_hin }} 
                                        @elseif(session()->get('language') == 'french') {{$compaign_item->item->category->name_frn }} 
                                        @else {{ $compaign_item->item->category->name_en }} @endif 
                                    </a></div>
                                <h3 class="product-title">
                                    <a href="{{route('product.details',$compaign_item->item->slug_en)}} ">
                                        @if(session()->get('language') == 'hindi') 
                                        {{Str::limit($compaign_item->item->name_hin, 33)  }}
                                        @elseif(session()->get('language') == 'french') 
                                        {{ strlen(strip_tags($compaign_item->item->name_frn)) > 35 ? substr(strip_tags($compaign_item->item->name_frn), 0, 35) : strip_tags($compaign_item->item->name_frn) }}
                                        @else                                
                                          {{ strlen(strip_tags($compaign_item->item->name_en)) > 35 ? substr(strip_tags($compaign_item->item->name_en), 0, 35) : strip_tags($compaign_item->item->name_en) }}
                                         @endif 
                                </a></h3>
                                <div class="rating-stars">
                                    {!! renderStarRating($compaign_item->item->reviews->avg('rating')) !!}
                                </div>
                                <h4 class="product-price">
                                @if ($compaign_item->item->previous_price != 0)
                                    <del>{{PriceHelper::setPreviousPrice($compaign_item->item->previous_price)}}</del>
                                @endif

                                {{PriceHelper::grandCurrencyPrice($compaign_item->item)}}
                                </h4>

                            </div>

                    </div>
                </div>
                @endforeach
                {{-- @endif --}}
            </div>

        </div>

        </div>
    </div>
</div>
@endif