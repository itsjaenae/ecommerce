
    @if ($setting->is_highlighted == 1)
    <section class="selected-product-section speacial-product-sec mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <div class="links">
                            <a data-href="{{route('front.get.product','feature')}}" data-target="type_product_view" href="javascript:;" class="product_get active">{{__('Featured')}}</a>
                            <a data-href="{{route('front.get.product','best')}}" data-target="type_product_view" class="product_get" href="javascript:;">{{__('Best Seller')}}</a>
                            <a data-href="{{route('front.get.product','top')}}" data-target="type_product_view" class="product_get" href="javascript:;">{{__('Top Rated')}}</a>
                            <a data-href="{{route('front.get.product','new')}}" data-target="type_product_view" class="product_get" href="javascript:;">{{__('New Product')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="type_product_view d-none">
                    <img  src="{{asset('assets/images/ajax_loader.gif')}}" alt="">
                </div>
                <div class="col-lg-12" id="type_product_view">

                    <div class="features-slider  owl-carousel" >
                        @if(isset($products))
                        @foreach ($products->orderBy('id','DESC')->get()  as $item)
                            @if ($item->is_type == 'feature')
                                <div class="slider-item">
                                    <div class="product-card ">
                                        <div class="product-thumb">
                                            @if (!$item->is_stock())
                                                <div class="product-badge bg-secondary border-default text-body
                                                ">{{__('out of stock')}}</div>
                                            @endif
                                            @if($item->previous_price && $item->previous_price !=0)
                                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($item)}}</div>
                                            @endif
                                            <img class="lazy" data-src="{{asset('images/product_images/'.$item->thumbnail)}}" alt="Product">
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
                                       @else
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
                                        <div class="product-card-inner">
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
                                </div>
                            @endif
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif
