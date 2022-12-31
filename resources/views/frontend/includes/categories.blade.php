
    @php
        $categories = App\Models\Category::with('subcategory')->whereStatus(1)->orderby('serial','asc')->take(9)->get();
    
   @endphp
 

    <div class="left-category-area">
        <div class="category-header">
            <h4><i class="icon-align-justify"></i> {{ __('Categories') }}</h4>
        </div>
        <div class="category-list">
            @foreach ($categories as $key => $category)
                <div class="c-item">
                    <a class="d-block navi-link"
                     href="{{url('/category/'.$category->id.'/'.$category->slug_en)}}">
                    
           <img class="lazy cat-img" height="100" width="100" 
           data-src="{{asset('images/category_images/'.$category->photo)}}"> 
                   
                        <span class="text-gray-dark">
                            @if(session()->get('language') == 'hindi') {{ $category->name_hin }} 
                            @elseif(session()->get('language') == 'french') {{ $category->name_frn }} 
                            @else {{ $category->name_en }} @endif
                            </span>
                        @if ($category->subcategory->count() > 0)
                        <i class="icon-chevron-right"></i>
                        @endif
                    </a>

@php
$subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('name_en','ASC')->get();
@endphp                   
                  
                    @if ($category->subcategory->count() > 0)
                    <div class="sub-c-box">
                            @foreach ($subcategories as $subcategory)
                            <div class="child-c-box">
                              <a class="title" 
            href="{{url('/catalog/subcat/'.$subcategory->id.'/'.$subcategory->slug_en)}}">
            @if(session()->get('language') == 'hindi') {{ $subcategory->name_hin }} 
            @elseif(session()->get('language') == 'french') {{ $subcategory->name_frn }} 
            @else {{ $subcategory->name_en }} @endif 
                                @if ($subcategory->childcategory->count() > 0)
                                <i class="icon-chevron-right"></i>
                                @endif
                                </a>
                                @if ($subcategory->childcategory->count() > 0)

@php
$childcategories = App\Models\ChildCategory::where('subcategory_id',$subcategory->id)->orderBy('name_en','ASC')->get();
@endphp 
                              <div class="child-category">
             @foreach($childcategories as $childcategory)   
     <a href="{{ url('/catalog/childcat/'.$childcategory->id.'/'.$childcategory->slug_en ) }}">
        @if(session()->get('language') == 'hindi') {{ $childcategory->name_hin }} 
        @elseif(session()->get('language') == 'french') {{ $childcategory->name_frn }} 
        @else {{ $childcategory->name_en }} @endif
                </a>
                @endforeach
                              </div>
                              @endif
                            </div>
                            @endforeach
                    </div>
                    @endif
                </div>
            @endforeach
        <a href="{{route('all.catalog')}}" class="d-block navi-link view-all-category">
            <img class="lazy cat-img" height="100" width="100" 
            data-src="{{ asset('images/category_images/category.jpg') }}" alt="">
            <span class="text-gray-dark">{{ __('All Categories')}}</span>
        </a>
    </div>


    </div>


