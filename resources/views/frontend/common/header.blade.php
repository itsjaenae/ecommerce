<header class="site-header navbar-sticky" >
    <div class="menu-top-area" style="background: #fff !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="t-m-s-a" >
                        <a class="track-order-link compare-mobile d-lg-none" 
                        href="{{route('front.compare.index')}}"> {{ __('Compare') }}</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="right-area">
                        <a class="track-order-link wishlist-mobile d-inline-block d-lg-none" href="{{route('user.wishlist.index')}}"><i class="icon-heart"></i>{{ __('Wishlist') }}</a>
                        <div class="t-h-dropdown ">
                            <a class="main-link top-link" href="#" 
                            style="color: #000;">{{ __('Currency') }}
                            <i class="icon-chevron-down"></i></a>
                            <div class="t-h-dropdown-menu ">
                                @foreach (DB::table('currencies')->get() as $currency)
                                    <a class="{{Session::get('currency') == $currency->id ? 'active' : ($currency->is_default == 1 && !Session::has('currency') ? 'active' : '')}}" href="{{route('front.currency.setup',$currency->id)}}" >
                                        <i class="icon-chevron-right pr-2 "></i>
                                       <span class="top-font"> {{$currency->name}}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="t-h-dropdown ">
                            <a class="main-link top-link" href="#" 
                            style="color: #000;">
                @if(session()->get('language') == 'hindi') भाषा: हिन्दी 
                @elseif(session()->get('language') == 'french') Langue : français 
                @else  Language @endif
                            <i class="icon-chevron-down"></i></a>
                            <div class="t-h-dropdown-menu top-font">
                                @if(session()->get('language') == 'hindi')       
                              <a href="{{ route('english.language') }}">English</a>
                              <a href="{{ route('french.language') }}">French</a>
                              @elseif(session()->get('language') == 'french')  
                              <a href="{{ route('hindi.language') }}">हिन्दी</a>
                              
                              <a href="{{ route('english.language') }}">English</a>
                                @else
                                <a href="{{ route('hindi.language') }}">हिन्दी</a>
                                <a href="{{ route('french.language') }}">français </a>
                                 @endif      
                            </div>
                        </div>

                        <div class="t-h-dropdown ">
                            <a class="main-link top-link" href="#" 
                            style="color: #000;">{{ __('Sell on Deluxe') }}
                        </div>

                         <div class="login-register ">
                            <a class="track-order-link top-link" href="{{route('front.order.track')}}"
                            style="color: #000;">
                                <i class="icon-map-pin"></i>{{ __('Track Order') }}</a>
                         </div>
  
                        <div class="login-register ">
                            @if(!Auth::user())
                            <a class="track-order-link mr-0 top-link " href="{{route('login')}}"style="color: #000">
                            {{__('Login/Register')}}
                            </a>
                            @else
                            <div class="t-h-dropdown">
                                <div class="main-link">
                                    <i class="icon-user pr-2"></i> <span class="text-label" style="color: #000">{{Auth::user()->first_name}}</span>
                                </div>
                                <div class="t-h-dropdown-menu">
                                    <a href="{{route('user.dashboard')}}" class="top-link"><i class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
                                    <a href="{{route('logout')}}"class="top-link"><i class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Topbar-->
    <div class="topbar">
        <div class="container">
            <div class="row">  
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <!-- Logo-->
                        <div class="site-branding">
                            <a class="site-logo align-self-center" 
                            href="{{url('/')}}">
                           
                            <span style="font-weight: 700; font-size: 1.8rem;color:#fc6900">
                                Deluxe 
                            </span></a>
                            </div>
                        <!-- Search / Categories-->
                        <div class="search-box-wrap d-none d-lg-block d-flex">
                        <div class="search-box-inner align-self-center">
                            <div class="search-box d-flex">
                                <select name="category" id="select" class="categoris">
									<option value="">{{__('All')}}</option>
                                    @foreach (DB::table('categories')->whereStatus(1)->get() as $category)
                                    <option value="{{$category->slug_en}}" >{{$category->name_en}}</option>
                                    @endforeach
									</select>
                                <form class="input-group" id="header_search_form" action="{{route('front.search')}}" method="get">
                                    <input type="hidden" name="category" value="" id="search__category">
                                    <span class="input-group-btn">
                                    <button type="submit"><i class="icon-search"></i></button>
                                    </span>
                                    <input class="form-control" type="text" data-target="{{route('front.search.suggest')}}" id="__product__search" name="search" placeholder="{{__('Search by product name')}}">
                                    <div class="serch-result d-none">
                                       {{-- search result --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                            <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                        </div>
                        <!-- Toolbar-->
                        <div class="toolbar d-flex">

                        <div class="toolbar-item close-m-serch visible-on-mobile"><a href="#">
                            <div>
                                <i class="icon-search"></i>
                            </div>
                            </a>
                        </div>
                        <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                            <div><i class="icon-menu"></i><span class="text-label">{{__('Menu')}}</span></div>
                            </a>
                        </div>

                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('front.compare.index')}}">
                            <div><span class="compare-icon"><i class="icon-repeat"></i><span class="count-label compare_count">{{Session::has('compare') ? count(Session::get('compare')) : '0'}}</span></span><span class="text-label">{{ __('Compare') }}</span></div>
                            </a>
                        </div>
                        @if(Auth::check())
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('user.wishlist.index')}}">
                            <div><span class="compare-icon"><i class="icon-heart"></i><span class="count-label wishlist_count">{{Auth::user()->wishlists->count()}}</span></span><span class="text-label">{{__('Wishlist')}}</span></div>
                            </a>
                        </div>
                        @else
                        <div class="toolbar-item hidden-on-mobile"><a href="{{route('user.wishlist.index')}}">
                          <div><span class="compare-icon"><i class="icon-heart"></i></span><span class="text-label">{{__('Wishlist')}}</span></div>
                          </a>
                      </div>
                        @endif
                        <div class="toolbar-item"><a href="{{route('front.cart')}}">
                            <div><span class="cart-icon">
                                <i class="icon-shopping-cart"></i>
                                <span class="count-label cart_count">
                                    {{Session::has('cart') ? count(Session::get('cart')) : '0'}} </span></span>
                                    <span class="text-label">{{ __('Cart') }}</span></div>
                            </a>
                            <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load"
                             data-target="{{route('front.header.cart')}}">
                            @include('frontend.cart.header_cart')
                            </div>
                        </div>
                        </div>

                        <!-- Mobile Menu-->
                        <div class="mobile-menu">
                            <!-- Slideable (Mobile) Menu-->
                            <div class="mm-heading-area">
                                {{ __('Categories') }}
                                <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                                    <a href="#">
                                        <div> <i class="icon-x"></i></div>
                                    </a>
                                </div>
                            </div>
                         
                                  <nav class="slideable-menu">
                                  @include('frontend.includes.mobile-category')
                                </nav>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@php
    $categories = App\Models\Category::with('subcategory')->whereStatus(1)->orderby('serial','asc')->take(8)->get();
@endphp

  



</header>   