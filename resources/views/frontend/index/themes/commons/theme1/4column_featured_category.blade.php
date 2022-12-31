
@if ($setting->is_featured_category == 1)
    <section class="selected-product-section featured_cat_sec sps-two mt-50" style="padding-bottom: 6rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        @if(isset($feature_category_title ))
                        <h2 class="h3">{{ $feature_category_title }}</h2>
                        @endif
                        <div class="links">
                            @if(isset($feature_categories ))
                            @foreach ($feature_categories as $key => $feature_category)
                            <a class="category_get {{$loop->first ? 'active' : ''}}" data-target="feature_category_view"  data-href="{{route('front.popular.category',[$feature_category->slug_en,'feature_category','normal'])}}" href="javascript:;" class="{{$loop->first ? 'active' : ''}}">{{$feature_category->name_en}}</a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature_category_view d-none">
                <img  src="{{asset('assets/images/ajax_loader.gif')}}" alt="">
            </div>
            <div class="row g-3" id="feature_category_view">
                @if(isset($feature_category_items ))
                @foreach ($feature_category_items as $feature_category_item)
                <div class="col-gd">
                    <div class="product-card">
                        <div class="product-thumb" >
                       
                            @if (!$feature_category_item->is_stock())
                                <div class="product-badge bg-secondary border-default text-body
                                ">{{__('out of stock')}}</div>
                            @endif
                            @if($feature_category_item->previous_price && $feature_category_item->previous_price !=0)
                            <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($feature_category_item)}}</div>
                            @endif
                                <img class="lazy" data-src="{{asset('images/product_images/'.$feature_category_item->thumbnail)}}" alt="Product">
                                <div class="product-button-group">
                                    @php $countWishlist = 0 @endphp
                                    @if(Auth::check())
                                    @php $countWishlist = App\Models\Wishlist::countWishlist($feature_category_item->id) @endphp
                                    <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$feature_category_item->id)}}" title="{{__('Wishlist')}}">
                                        @if($countWishlist > 0)
                                        <i class="fa fa-heart" style="color: #FFFFFF;"></i>
                                        @else
                                        <i class="icon-heart"></i>
                                        @endif
                                       </a>
                                       @else
                                        <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$feature_category_item->id)}}" title="{{__('Wishlist')}}">
                                        @if($countWishlist > 0)
                                        <i class="fa fa-heart" style="color: #FFFFFF;"></i>
                                        @else
                                        <i class="icon-heart"></i>
                                        @endif
                                       </a>
                                           @endif

                                    <a data-target="{{route('front.compare.product',$feature_category_item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>

                                    @include('frontend.includes.item_footer',['sitem'=>$feature_category_item])

                                </div>
                        </div>
                        <div class="product-card-body">
                            <div class="product-category"><a href="{{route('front.category').'?category='.$feature_category_item->category->slug_en}}">{{$feature_category_item->category->name_en}}</a></div>
                            <h3 class="product-title"><a href="{{route('product.details',$feature_category_item->slug_en)}}">
                                {{ strlen(strip_tags($feature_category_item->name_en)) > 35 ? substr(strip_tags($feature_category_item->name_en), 0, 35) : strip_tags($feature_category_item->name_en) }}
                            </a></h3>
                            <div class="rating-stars">
                            <i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i>
                            </div>
                            <h4 class="product-price">
                                @if ($feature_category_item->previous_price != 0)
                                <del>{{PriceHelper::setPreviousPrice($feature_category_item->previous_price)}}</del>
                                @endif
                                {{PriceHelper::grandCurrencyPrice($feature_category_item)}}
                                </h4>
                        </div>

                    </div>
                </div>
                @endforeach
@endif
            </div>
        </div>
    </section>
@endif
