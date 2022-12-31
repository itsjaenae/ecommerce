@forelse ($items as $item)
            <div class="col-gd">
                <div class="product-card">
                    <div class="product-thumb" >
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
                                <a data-target="{{route('front.compare.product',$item->id)}}" class="product-button product_compare" href="javascript:;" class="{{__('Compare')}}"><i class="icon-repeat"></i></a>
                                @include('frontend.includes.item_footer',['sitem' => $item])
                            </div>
                    </div>
                    <div class="product-card-body">
                        <div class="product-category">
                            <a href="{{route('front.category').'?category='.$item->category->slug_en}}">
                                @if(session()->get('language') == 'hindi') {{ $item->category->name_hin }} 
                                @elseif(session()->get('language') == 'french') {{$item->category->name_frn }} 
                                @else {{ $item->category->name_en }} @endif 
                            </a></div>
                        <h3 class="product-title">
                            <a href="{{route('product.details',$item->slug_en)}}">
                                @if(session()->get('language') == 'hindi') 
                                {{Str::limit($item->name_hin, 33)  }}
                                @elseif(session()->get('language') == 'french') 
                                {{ strlen(strip_tags($item->name_frn)) > 35 ? substr(strip_tags($item->name_frn), 0, 35) : strip_tags($item->name_frn) }}
                                @else                                
                                  {{ strlen(strip_tags($item->name_en)) > 35 ? substr(strip_tags($item->name_en), 0, 35) : strip_tags($item->name_en) }}
                                 @endif 
                        </a></h3>
                        <div class="rating-stars">
                        <i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i><i class="far fa-star filled"></i>
                        </div>
                        <h4 class="product-price">
                            @if ($item->previous_price !=0)
                            <del>{{PriceHelper::setPreviousPrice($item->previous_price)}}</del>
                            @endif
                            {{PriceHelper::grandCurrencyPrice($item)}}
                            </h4>
                    </div>

                </div>
            </div>
            @empty
            <div class="card">
                <div class="card-body text-center">
                    {{__('No Product Found')}}
                </div>
            </div>
            @endforelse

            <script type="text/javascript" src="{{asset('assets/front/js/extraindex.js')}}"></script>
