@if ($setting->is_popular_category == 1)
<section class="newproduct-section popular-category-sec mt-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title recommended2">
                    @if(isset($popular_category_title))
                    <h3 class="h3 header-view h3-cat">{{ $popular_category_title }}</h3>
                    @endif
                    <div class="links">
                        @if(isset($popular_categories))
                        @foreach ($popular_categories as $key => $popular_categorie)
                        <a class="category_get {{$loop->first ? 'active' : ''}}" data-target="popular_category_view" data-href="{{route('front.popular.category',[$popular_categorie->slug_en,'popular_category','slider'])}}"  href="javascript:;" class="{{$loop->first ? 'active' : ''}}">{{$popular_categorie->name_en}}</a>
                        @endforeach
                        @endif 
                    </div>
                </div>
            </div>
        </div>
        <div class="popular_category_view d-none">
            <img  src="{{asset('assets/images/ajax_loader.gif')}}" alt="">
        </div>

        <div class="row" id="popular_category_view">
            <div class="col-lg-12">
                <div class="popular-category-slider  owl-carousel">
                    @if(isset($popular_category_items))
                    @foreach ($popular_category_items as $popular_category_item)
                    <div class="slider-item">
                        <div class="product-card">
                            <div class="product-thumb">

                                @if (!$popular_category_item->is_stock())
                                    <div class="product-badge bg-secondary border-default text-body
                                    ">{{__('out of stock')}}</div>
                                @endif
                                @if($popular_category_item->previous_price && $popular_category_item->previous_price !=0)
                                <div class="product-badge product-badge2 bg-info"> -{{PriceHelper::DiscountPercentage($popular_category_item)}}</div>
                                @endif
                                    <img class="lazy" data-src="{{asset('images/product_images/'.$popular_category_item->thumbnail)}}" alt="Product">
                                    <div class="product-button-group">
                                      
                                         @php $countWishlist = 0 @endphp
                                    @if(Auth::check())
                                    @php $countWishlist = App\Models\Wishlist::countWishlist($popular_category_item->id) @endphp
                                    <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$popular_category_item->id)}}" title="{{__('Wishlist')}}">
                                        @if($countWishlist > 0)
                                        <i class="fa fa-heart" style="color: #FFFFFF;"></i>
                                        @else
                                        <i class="icon-heart"></i>
                                        @endif
                                       </a>
                                       @else
                                        <a class="product-button wishlist_store" href="{{route('user.wishlist.store',$popular_category_item->id)}}" title="{{__('Wishlist')}}">
                                        @if($countWishlist > 0)
                                        <i class="fa fa-heart" style="color: #FFFFFF;"></i>
                                        @else
                                        <i class="icon-heart"></i>
                                        @endif
                                       </a>
                                           @endif
                                       
                                        <a data-target="{{route('front.compare.product',$popular_category_item->id)}}" class="product-button product_compare" href="javascript:;" title="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                        @include('frontend.includes.item_footer',['sitem'=>$popular_category_item])
                                    </div>
                                </div>
                            <div class="product-card-body">
                                <div class="product-category">
                                    <a href="{{route('front.category').'?category='.$popular_category_item->category->slug_en}}">
                                        @if(session()->get('language') == 'hindi') {{ $popular_category_item->category->name_hin }} 
                                        @elseif(session()->get('language') == 'french') {{$popular_category_item->category->name_frn }} 
                                        @else {{ $popular_category_item->category->name_en }} @endif 
                                        {{$popular_category_item->category->name_en}}
                                    </a></div>
                                <h3 class="product-title">
                                    <a href="{{route('product.details',$popular_category_item->slug_en)}}">
                                        @if(session()->get('language') == 'hindi') 
                                        {{Str::limit($popular_category_item->name_hin, 33)  }}
                                        @elseif(session()->get('language') == 'french') 
                                        {{ strlen(strip_tags($popular_category_item->name_frn)) > 35 ? substr(strip_tags($popular_category_item->name_frn), 0, 35) : strip_tags($popular_category_item->name_frn) }}
                                        @else                                
                                          {{ strlen(strip_tags($popular_category_item->name_en)) > 35 ? substr(strip_tags($popular_category_item->name_en), 0, 35) : strip_tags($popular_category_item->name_en) }}
                                         @endif 
                                      
                                </a></h3>
                                <div class="rating-stars">
                                <i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i>
                                </div>
                                <h4 class="product-price">
                                    @if ($popular_category_item->previous_price != 0)
                                    <del>{{PriceHelper::setPreviousPrice($popular_category_item->previous_price)}}</del>
                                    @endif
                                    {{PriceHelper::grandCurrencyPrice($popular_category_item)}}
                                    </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
                </div>
            </div>

        </div>
    </div>
</section>
@endif
