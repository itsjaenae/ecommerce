@extends('frontend.master.front')
@section('title')
    {{__('Compare')}}
@endsection
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('content')
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">{{__('Home')}}</a> </li>
                <li class="separator"></li>
                <li>{{__('Compare Products')}}</li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
        <div class="card">
            <div class="card-body">
                <div class="comparison-table">
                    <table class="table table-bordered">

                      <tbody>
                          @if(count($items) > 0)
                          <tr class="bg-secondary">
                             <th class="text-uppercase">{{__('Summary')}}</th>
                             @foreach ($items as $keys => $item)
                             <td><span class="text-medium">
                              @if(session()->get('language') == 'hindi') {{ $item->name_hin }} 
                            @elseif(session()->get('language') == 'french') {{$item->name_frn }} 
                            @else {{ $item->name_en }} @endif 
                    
                            </span></td>

                             @endforeach
                          </tr>
                        @if(count($items) != 1)
                          <tr>
                              <td>
                              <h6>
                                @if(session()->get('language') == 'hindi') {{ $item[0]->name_hin }} 
                                @elseif(session()->get('language') == 'french') {{$item[0]->name_frn }} 
                                @else {{ $item[0]->name_en }} @endif 
                                  {{-- {{$items[0]->name_en}} --}}
                              </h6>
                                <p><b>{{__('Brand')}}</b> :  {{$items[0]->brand->name_en}}
                                   , <b>{{__('Price')}}</b> :  {{PriceHelper::grandCurrencyPrice($items[0])}}
                              </p>

                                <hr>
                                <h6 class="mt-2">
                                  @if(session()->get('language') == 'hindi') {{ $item[1]->name_hin }} 
                                  @elseif(session()->get('language') == 'french') {{$item[1]->name_frn }} 
                                  @else {{ $item[1]->name_en }} @endif 
                                  {{-- {{$items[1]->name_en}} --}}
                              </h6>
                                <p><b>{{__('Brand')}}</b> :  {{$items[1]->brand->name_en}}
                                  , <b>{{__('Price')}}</b> :  {{PriceHelper::grandCurrencyPrice($items[1])}}</p>
                              </td>
                             @foreach ($items as $item)
   
                             <td>
                              <div class="comparison-item">
                                <span class="remove-item compare_remove" data-href="{{route('front.compare.remove',$item->id)}}">
                                  <i class="icon-x"></i></span>
                                  <a class="comparison-item-thumb" href="{{route('product.details',$item->slug_en)}}">
                                    <img src="{{asset('images/product_images/'.$item->thumbnail)}}" alt="Image"></a>
                                    <a class="comparison-item-title" href="{{route('product.details',$item->slug_en)}}">
                                    
                                      @if(session()->get('language') == 'hindi') {{ $item->name_hin }} 
                            @elseif(session()->get('language') == 'french') {{$item->name_frn }} 
                            @else {{ $item->name_en }} @endif 
                                   
                                    </a>
                                      <a class="btn btn-outline-primary btn-sm add_to_single_cart" href="javascript:;"  data-target="{{$item->id}}" >
                                        {{__('Add to Cart')}}
                                      </a></div>
                            </td>
                             @endforeach
                          </tr>
                          @php
                             // dd($sname,$sdesc)
                          @endphp
                          @foreach ($sname as $key => $name)
                          <tr>
                              <th>{{$name}}</th>
                              <td>
                                @if($items[0]->specification_name)
                                 @if(in_array($name,json_decode($items[0]->specification_name,true)))
                                 @if (isset($sdesc[0][$key]))
                                 {{$sdesc[0][$key]}}
                                 @endif
                                 @endif
                                 @endif
                              </td>
                              <td>
                                @if($items[1]->specification_name)
                                  @if(in_array($name,json_decode($items[1]->specification_name,true)))
                                  @if (isset($sdesc[1][$key]))
                                  {{$sdesc[1][$key]}}
                                  @endif
                                 @endif
                                 @endif
                              </td>
                           </tr>
                          @endforeach
                          @else
                          <tr>
                              <td>
                              <h4>
                                  {{$items[0]->name_en}}
                              </h4>
                                <p><b>{{__('Brand')}}</b> :  {{$items[0]->brand->name_en}}
                                   , <b>{{__('Price')}}</b> :  {{PriceHelper::grandCurrencyPrice($items[0])}}
                              </p>
                             @foreach ($items as $item)
                             <td>
                              <div class="comparison-item"><span class="remove-item compare_remove" data-href="{{route('front.compare.remove',$item->id)}}"><i class="icon-x"></i></span><a class="comparison-item-thumb" href="{{route('product.details',$item->slug_en)}}"><img src="{{asset('images/product_images/'.$item->thumbnail)}}" alt="Image"></a><a class="comparison-item-title" href="{{route('product.details',$item->slug_en)}}">{{$item->name_en}}</a><a class="btn btn-outline-primary btn-sm add_to_single_cart" href="javascript:;"  data-target="{{$item->id}}" >{{__('Add to Cart')}}</a></div>
                            </td>
                             @endforeach
                          </tr>


                          @foreach ($sname as $key => $name)
                          @if($items[0]->specification_name)
                          <tr>
                              <th>{{$name}}</th>
                              <td>
                                 @if(in_array($name,json_decode($items[0]->specification_name,true)))
                                  @if (isset($sdesc[0][$key]))
                                  {{$sdesc[0][$key]}}
                                  @endif
                                 @endif
                              </td>
                           </tr>
                           @endif
                          @endforeach
                         @endif

                          <tr>
                             <th></th>
                             @foreach ($items as $item)
                             <td>
                               <a class="btn btn-outline-primary btn-sm btn-block add_to_single_cart" href="javascript:;" data-target="{{$item->id}}">{{__('Add to Cart')}}</a>
                              </td>

                             @endforeach
                          </tr>
                          @else
                          <tr>
                              <td class="text-center"><strong>{{__('Product not found')}}</strong></td>
                          </tr>
                          @endif
                       </tbody>



                    </table>
                  </div>
            </div>
        </div>
  </div>
@endsection
