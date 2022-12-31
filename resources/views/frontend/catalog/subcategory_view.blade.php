@extends('frontend.master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
    {{__('Products')}}
@endsection

@section('content')
        {{-- SIDE BAR --}}
        
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">{{__('Home')}}</a> </li>
                <li class="separator"></li>
                <li>{{__('Shop')}}</li>
                <li class="separator"></li>
                @foreach($subcat as $item)
                <li class='active'>
                  @if(session()->get('language') == 'hindi') {{ $item->category->name_hin }} 
                  @elseif(session()->get('language') == 'french') {{ $item->category->name_frn }} 
                  @else {{ $item->category->name_en }} @endif
                </li>
                @endforeach
                <li class="separator"></li>
                @foreach($subcat as $item)
                <li class='active'>
                  @if(session()->get('language') == 'hindi') {{ $item->name_hin }} 
                  @elseif(session()->get('language') == 'french') {{ $item->name_frn }} 
                  @else {{ $item->name_en }} @endif
                </li>
                @endforeach
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-top-filter-wrapper">
                    <div class="row">
                        <div class="col-md-10 gd-text-sm-center">
                            <div class="sptfl">
                                <div class="quickFilter">
                                    <h4 class="quickFilter-title"><i class="fas fa-filter"></i>{{__('Quick filter')}}</h4>
                                    <ul id="quick_filter">
                                        <li><a datahref=""><i class="icon-chevron-right pr-2"></i>{{__('All products')}} </a></li>
                                        <li class=""><a href="javascript:;" data-href="feature"><i class="icon-chevron-right pr-2"></i>{{__('Featured products')}} </a></li>
                                        <li class=""><a href="javascript:;" data-href="best"><i class="icon-chevron-right pr-2"></i>{{__('Best sellers')}} </a></li>
                                        <li class=""><a href="javascript:;" data-href="top"><i class="icon-chevron-right pr-2"></i>{{__('Top rated')}} </a></li>
                                        <li class=""><a href="javascript:;" data-href="new"><i class="icon-chevron-right pr-2"></i>{{__('New Arrival')}} </a></li>
                                    </ul>
                                </div>
                                <div class="shop-sorting">
                                    <label for="sorting">{{__('Sort by')}}:</label>
                                    <select class="form-control" id="sorting">
                                    <option value="">{{__('All Products')}}</option>
                                    <option value="low_to_high" {{request()->input('low_to_high') ? 'selected' : ''}}>{{__('Low - High Price')}}</option>
                                    <option value="high_to_low" {{request()->input('high_to_low') ? 'selected' : ''}}>{{__('High - Low Price')}}</option>
                                    </select><span class="text-muted">{{__('Showing')}}:</span><span>1 - {{$setting->view_product}} {{__('items')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 gd-text-sm-center">
                            <div class="shop-view"><a class="list-view {{Session::has('view_catalog') && Session::get('view_catalog') == 'grid' ? 'active' : ''}} " data-step="grid" href="javascript:;" data-href="{{route('front.category').'?view_check=grid'}}"><i class="fas fa-th-large"></i></a>
                                <a class="list-view {{Session::has('view_catalog') && Session::get('view_catalog') == 'list' ? 'active' : ''}}" href="javascript:;" data-step="list" data-href="{{route('front.category').'?view_check=list'}}"><i class="fas fa-list"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">

          <div class="col-lg-9 order-lg-2" id="list_view_ajax">
            @include('frontend.catalog.product_list')
          </div>
     
          
          <!-- Sidebar          -->
          <div class="col-lg-3 order-lg-1">
            <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
            <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
              <!-- Widget Categories-->
              <section class="widget widget-categories card rounded p-4">
                <h3 class="widget-title">{{__('Shop Categories')}}</h3>
                <ul id="category_list" class="category-scroll" >
                    <ul id="subcategory_list">
                        @foreach ($subcat as $getsubcategory)
                        <li class="{{isset($subcategory) && $subcategory->id == $getsubcategory->id ? 'active' : ''}}">
                          <a class="subcategory" href="javascript:;" data-href="{{$getsubcategory->slug_en}}">
                            @if(session()->get('language') == 'hindi') {{ $getsubcategory->name_hin }} 
                            @elseif(session()->get('language') == 'french') {{ $getsubcategory->name_frn }} 
                            @else {{ $getsubcategory->name_en }} @endif
                          </a>
                  
                          <ul id="childcategory_list">
                            @foreach ($getsubcategory->childcategory as $getchildcategory)
                            <li class="{{isset($childcategory) && $getchildcategory->id == $getchildcategory->id ? 'active' : ''}}">
                              <a class="childcategory" href="javascript:;" data-href="{{$getchildcategory->slug_en}}">
                                @if(session()->get('language') == 'hindi') {{ $getchildcategory->name_hin }} 
                                @elseif(session()->get('language') == 'french') {{ $getchildcategory->name_frn }} 
                                @else {{ $getchildcategory->name_en }} @endif
                              </a>
                  
                            </li>
                            @endforeach
                        </ul>
                        </li>
                        @endforeach
                    </ul>
                        </ul>
              </section>

              @if ($setting->is_range_search == 1)
                   <!-- Widget Price Range-->
              <section class="widget widget-categories card rounded p-4">
                <h3 class="widget-title">{{ __('Filter by Price') }}</h3>
                <form class="price-range-slider" method="post" data-start-min="{{request()->input('minPrice') ? request()->input('minPrice') : '0'}}" data-start-max="{{request()->input('maxPrice') ? request()->input('maxPrice') : $setting->max_price}}" data-min="0" data-max="{{$setting->max_price}}" data-step="5">
                  <div class="ui-range-slider"></div>
                  <footer class="ui-range-slider-footer">
                    <div class="column">
                      <button class="btn btn-primary btn-sm" id="price_filter" type="button"><span>{{__('Filter')}}</span></button>
                    </div>
                    <div class="column">
                      <div class="ui-range-values">
                        <div class="ui-range-value-min">{{PriceHelper::setCurrencySign()}}<span class="min_price"></span>
                          <input type="hidden">
                        </div>-
                        <div class="ui-range-value-max">{{PriceHelper::setCurrencySign()}}<span class="max_price"></span>
                          <input type="hidden">
                        </div>
                      </div>
                    </div>
                  </footer>
                </form>
              </section>
              @endif


                <section class="widget widget-categories card rounded p-4">
                <h3 class="widget-title">{{__('Filter by Brand')}}</h3>
                <div id="category_list" class="category-scroll"style="height: 200px">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input brand-select" type="checkbox" value="" id="all-brand">
                  <label class="custom-control-label" for="all-brand">{{__('All Brands')}}</label>
                </div>
                @foreach ($brands as $getbrand)
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input brand-select" {{isset($brand) && $brand->id == $getbrand->id ? 'checked' : ''}} type="checkbox" value="{{$getbrand->slug_en}}" id="{{$getbrand->slug_en}}">
                    <label class="custom-control-label" for="{{$getbrand->slug_en}}">{{$getbrand->name_en}}</label>
                  </div>
                @endforeach
               </div>
              </section>

              @foreach ($subcat as $getsubcategory)
              @if ($getsubcategory->category->serial == 1) 
                        <section class="widget widget-categories card rounded p-4">
                          <h3 class="widget-title">{{__('Filter by Fabric')}}</h3>
                          <div id="category_list" class="category-scroll" style="height: 100px">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input fabric-select" type="checkbox" value="" id="all-fabric">
                            <label class="custom-control-label" for="all-fabric">{{__('All Fabric')}}</label>
                          </div>
                          @foreach ($fabrics as $fab)
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input fabric-select" {{isset($fabric) && $fabric->id == $fab->id ? 'checked' : ''}} type="checkbox" value="{{$fab->fabric}}" id="{{$fab->fabric}}">
                            <label class="custom-control-label" for="{{$fab->fabric}}">{{$fab->fabric}}</label>
                          </div>
                          @endforeach
                          </div>
                        </section>
                      
                      
                        <section class="widget widget-categories card rounded p-4">
                          <h3 class="widget-title">{{__('Filter by fit')}}</h3>
                          <div id="category_list" class="category-scroll"style="height: 80px">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input fit-select" type="checkbox" value="" id="all-fit">
                            <label class="custom-control-label" for="all-fit">{{__('All fit')}}</label>
                          </div>
                          @foreach ($fits as $fab)
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input fit-select" {{isset($fit) && $fit->id == $fab->id ? 'checked' : ''}} type="checkbox" value="{{$fab->fit}}" id="{{$fab->fit}}">
                            <label class="custom-control-label" for="{{$fab->fit}}">{{$fab->fit}}</label>
                          </div>
                          @endforeach
                          </div>
                        </section>
                      
                        <section class="widget widget-categories card rounded p-4">
                          <h3 class="widget-title">{{__('Filter by sleeve')}}</h3>
                          <div id="category_list" class="category-scroll"style="height: 80px">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input sleeve-select" type="checkbox" value="" id="all-sleeve">
                            <label class="custom-control-label" for="all-sleeve">{{__('All sleeve')}}</label>
                          </div>
                          @foreach ($sleeves as $fab)
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input sleeve-select" {{isset($sleeve) && $sleeve->id == $fab->id ? 'checked' : ''}} type="checkbox" value="{{$fab->sleeve}}" id="{{$fab->sleeve}}">
                            <label class="custom-control-label" for="{{$fab->sleeve}}">{{$fab->sleeve}}</label>
                          </div>
                          @endforeach
                          </div>
                        </section>
                      
                        
                      <section class="widget widget-categories card rounded p-4">
                      <h3 class="widget-title">{{__('Filter by neck')}}</h3>
                      <div id="category_list" class="category-scroll"style="height: 80px">
                      <div class="custom-control custom-checkbox">
                      <input class="custom-control-input neck-select" type="checkbox" value="" id="all-neck">
                      <label class="custom-control-label" for="all-neck">{{__('All neck')}}</label>
                      </div>
                      @foreach ($necks as $fab)
                      <div class="custom-control custom-checkbox">
                      <input class="custom-control-input neck-select" {{isset($neck) && $neck->id == $fab->id ? 'checked' : ''}} type="checkbox" value="{{$fab->neck}}" id="{{$fab->neck}}">
                      <label class="custom-control-label" for="{{$fab->neck}}">{{$fab->neck}}</label>
                      </div>
                      @endforeach
                      </div>
                      </section>
                      
                      <section class="widget widget-categories card rounded p-4">
                      <h3 class="widget-title">{{__('Filter by occasion')}}</h3>
                      <div id="category_list" class="category-scroll"style="height: 80px">
                      <div class="custom-control custom-checkbox">
                      <input class="custom-control-input occasion-select" type="checkbox" value="" id="all-occasion">
                      <label class="custom-control-label" for="all-occasion">{{__('All occasion')}}</label>
                      </div>
                      @foreach ($occasions as $fab)
                      <div class="custom-control custom-checkbox">
                      <input class="custom-control-input occasion-select" {{isset($occasion) && $occasion->id == $fab->id ? 'checked' : ''}} type="checkbox" value="{{$fab->occasion}}" id="{{$fab->occasion}}">
                      <label class="custom-control-label" for="{{$fab->occasion}}">{{$fab->occasion}}</label>
                      </div>
                      @endforeach
                      </div>
                      </section>
                      
                      <section class="widget widget-categories card rounded p-4">
                      <h3 class="widget-title">{{__('Filter by pattern')}}</h3>
                      <div id="category_list" class="category-scroll"style="height: 80px">
                      <div class="custom-control custom-checkbox">
                      <input class="custom-control-input pattern-select" type="checkbox" value="" id="all-pattern">
                      <label class="custom-control-label" for="all-pattern">{{__('All pattern')}}</label>
                      </div>
                      @foreach ($patterns as $fab)
                      <div class="custom-control custom-checkbox">
                      <input class="custom-control-input pattern-select" {{isset($pattern) && $pattern->id == $fab->id ? 'checked' : ''}} type="checkbox" value="{{$fab->pattern}}" id="{{$fab->pattern}}">
                      <label class="custom-control-label" for="{{$fab->pattern}}">{{$fab->pattern}}</label>
                      </div>
                      @endforeach
                      </div>
                      </section>
                      @endif
                   @endforeach

     
            </aside>
          </div>
        </div>
      </div>



      <form id="search_form" class="d-none" action="{{route('front.category')}}" method="GET">
        <input type="text" name="maxPrice" id="maxPrice" value="{{request()->input('maxPrice') ? request()->input('maxPrice') : ''}}">
        <input type="text" name="minPrice" id="minPrice" value="{{request()->input('minPrice') ? request()->input('minPrice') : ''}}">
        <input type="text" name="brand" id="brand" value="{{isset($brand) ? $brand->slug_en : ''}}">
        <input type="text" name="brand" id="brand" value="{{isset($brand) ? $brand->slug_en : ''}}">
       
        <input type="text" name="fabric" id="fabric" value="{{isset($fabric) ? $fabric->fabric : ''}}">
        <input type="text" name="fit" id="fit" value="{{isset($fit) ? $fit->fit : ''}}">
        <input type="text" name="sleeve" id="sleeve" value="{{isset($sleeve) ? $sleeve->sleeve : ''}}">
        <input type="text" name="pattern" id="pattern" value="{{isset($pattern) ? $pattern->pattern : ''}}">
        <input type="text" name="neck" id="neck" value="{{isset($neck) ? $neck->neck : ''}}">
        <input type="text" name="occasion" id="occasion" value="{{isset($occasion) ? $occasion->occasion : ''}}">
        
        <input type="text" name="category" id="category" value="{{isset($category) ? $category->slug_en : ''}}">
        <input type="text" name="quick_filter" id="quick_filter" value="">
        <input type="text" name="childcategory" id="childcategory" value="{{isset($childcategory) ? $childcategory->slug_en : ''}}">
        <input type="text" name="page" id="page" value="{{isset($page) ? $page : ''}}">
        <input type="text" name="subcategory" id="subcategory" value="{{isset($subcategory) ? $subcategory->slug_en : ''}}">
        <input type="text" name="sorting" id="sorting" value="{{isset($sorting) ? $sorting : ''}}">
        <input type="text" name="view_check" id="view_check" value="{{isset($view_check) ? $view_check : ''}}">
        <button type="submit" id="search_button" class="d-none"></button>
    </form>
@endsection

