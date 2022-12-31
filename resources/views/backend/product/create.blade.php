@extends('backend.back_master.master')
@section('content')

<div class="container-fluid">

<!-- Page Heading -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-0 bc-title"><b>{{ __('Create Product') }}</b> </h3>
            <a class="btn btn-primary   btn-sm" href="{{route('admin.product.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
        </div>
    </div>
</div>

<!-- Form -->


<div class="row">
    <div class="col-lg-12">
            @include('alerts.alerts')
    </div>
</div>
<!-- Nested Row within Card Body -->
<form class="admin-form tab-form" action="{{ route('admin.product.store') }}" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" value="normal" name="item_type">
                @csrf
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                  
                        <div class="form-group">
                            <label for="name">{{ __('Name English') }} *</label>
                            <input type="text" name="name_en" class="form-control item-name" id="name"
                                placeholder="{{ __('Enter Name') }}" value="{{ old('name_en') }}" >
                        </div>
                    

                        
                        <div class="form-group">
                            <label for="name">{{ __('Name Hindi') }} </label>
                            <input type="text" name="name_hin" class="form-control item-name" id="name"
                                placeholder="{{ __('Enter Name') }}" value="{{ old('name_hin') }}" >
                        </div>
               

                       
                        <div class="form-group">
                            <label for="name">{{ __('Name French') }} </label>
                            <input type="text" name="name_frn" class="form-control item-name" id="name"
                                placeholder="{{ __('Enter Name') }}" value="{{ old('name_frn') }}" >
                        </div>
                  

                   
                        <div class="form-group">
                            <label for="slug_en">{{ __('Slug English') }} *</label>
                            <input type="text" name="slug_en" class="form-control" id="slug"
                                placeholder="{{ __('Enter Slug') }}" value="{{ old('slug_en') }}" >
                        </div>
                  

                     
                        <div class="form-group">
                            <label for="slug_hin">{{ __('Slug Hindi') }} *</label>
                            <input type="text" name="slug_hin" class="form-control" id="slug"
                                placeholder="{{ __('Enter Slug') }}" value="{{ old('slug_hin') }}" >
                        </div>
                   

                      
                        <div class="form-group">
                            <label for="slug_frn">{{ __('Slug French') }} *</label>
                            <input type="text" name="slug_frn" class="form-control" id="slug"
                                placeholder="{{ __('Enter Slug') }}" value="{{ old('slug_frn') }}" >
                        </div>
                   


                </div>
            </div>
            {{-- main image --}}
            <div class="card">
                <div class="card-body">
                    <div class="form-group pb-0  mb-0">
                        <label class="d-block">{{ __('Featured Image') }} *</label>
                    </div>
                    <div class="form-group pb-0 pt-0 mt-0 mb-0">
                    <img class="admin-img lg" src="" >
                    </div>
                    <div class="form-group position-relative ">
                        <label class="file">
                            <input type="file"  accept="image/*"   class="upload-photo" name="photo"
                                id="file"  aria-label="File browser example">
                            <span
                                class="file-custom text-left">{{ __('Upload Image...') }}</span>
                        </label>
                        <br>
                        <span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group pb-0  mb-0">
                        <label>{{ __('Gallery Images') }} </label>
                    </div>
                    <div class="form-group pb-0 pt-0 mt-0 mb-0">
                        <div id="gallery-images" class="">
                            <div class="d-block gallery_image_view">
                            </div>
                        </div>
                    </div>
                    <div class="form-group position-relative ">
                        <label class="file">
                            <input type="file"  accept="image/*"  name="galleries[]" id="gallery_file" aria-label="File browser example" accept="image/*" multiple>
                            <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                        </label>
                        <br>
                        <span class="mt-1 text-info">{{ __('Image Size Should Be 800 x 800. or square size') }}</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="sort_details">{{ __('Short Description') }} *</label>
                        <textarea name="sort_details" id="sort_details"
                            class="form-control"
                            placeholder="{{ __('Short Description') }}"
                            >{{ old('sort_details') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="details">{{ __('Description') }} *</label>
                        <textarea name="details" id="details"
                            class="form-control text-editor"
                            rows="6"
                            placeholder="{{ __('Enter Description') }}"
                            >{{ old('details') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="tags">{{ __('Product Tags') }}
                            </label>
                        <input type="text" name="tags" class="tags"
                            id="tags"
                            placeholder="{{ __('Tags') }}"
                            value="">
                    </div>
                    <div class="form-group">
                        <label class="switch-primary">
                            <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_specification" value="1" checked>
                            <span class="switch-body"></span>
                            <span class="switch-text">{{ __('Specifications') }}</span>
                        </label>
                    </div>
                    <div id="specifications-section">
                        <div class="d-flex">

                            <div class="flex-grow-1">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        name="specification_name[]"
                                        placeholder="{{ __('Specification Name') }}" value="">
                                    </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        name="specification_description[]"
                                        placeholder="{{ __('Specification description') }}" value="">
                                    </div>
                            </div>
                            <div class="flex-btn">
                                <button type="button" class="btn btn-success add-specification" data-text="{{ __('Specification Name') }}" data-text1="{{ __('Specification Description') }}"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="meta_keywords">{{ __('Meta Keywords') }}
                            </label>
                        <input type="text" name="meta_keywords" class="tags"
                            id="meta_keywords"
                            placeholder="{{ __('Enter Meta Keywords') }}"
                            value="">
                    </div>

                    <div class="form-group">
                        <label
                            for="meta_description">{{ __('Meta Description') }}
                            </label>
                        <textarea name="meta_description" id="meta_description"
                            class="form-control" rows="5"
                            placeholder="{{ __('Enter Meta Description') }}"
                        >{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" class="check_button" name="is_button" value="0">
                    <button type="submit" class="btn btn-secondary mr-2">{{ __('Save') }}</button>
                    <button type="submit" class="btn btn-info save__edit">{{ __('Save & Edit') }}</button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="discount_price">{{ __('Current Price') }}
                            *</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text">{{ PriceHelper::adminCurrency() }}</span>
                            </div>
                            <input type="text" id="discount_price"
                                name="discount_price" class="form-control"
                                placeholder="{{ __('Enter Current Price') }}"
                                min="1" step="0.1"
                                value="{{ old('discount_price') }}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="previous_price">{{ __('Previous Price') }}
                            </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text">{{ $curr->sign }}</span>
                            </div>
                            <input type="text" id="previous_price"
                                name="previous_price" class="form-control"
                                placeholder="{{ __('Enter Previous Price') }}"
                                min="1" step="0.1"
                                value="{{ old('previous_price') }}" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="category_id">{{ __('Select Category') }} *</label>
                        <select name="category_id" id="category_id"  class="form-control" >
                            <option value="" selected>{{__('Select One')}}</option>
                            @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name_en }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subcategory_id">{{ __('Select Sub Category') }} </label>
                        <select name="subcategory_id" id="subcategory_id"  class="form-control">
                            <option value="">{{__('Select One')}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="childcategory_id">{{ __('Select Child Category') }} </label>
                        <select name="childcategory_id" id="childcategory_id" class="form-control">
                            <option value="">{{__('Select One')}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand_id">{{ __('Select Brand') }} </label>
                        <select name="brand_id" id="brand_id" class="form-control" >
                            <option value="" selected>{{__('Select Brand')}}</option>
                            @foreach(DB::table('brands')->whereStatus(1)->get() as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="stock">{{ __('Total in stock') }}
                            *</label>
                        <div class="input-group mb-3">
                            <input type="number" id="stock"
                                name="stock" class="form-control"
                                placeholder="{{ __('Total in stock') }}" value="{{ old('stock') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tax_id">{{ __('Select Tax') }} *</label>
                        <select name="tax_id" id="tax_id" class="form-control">
                            <option value="">{{__('Select One')}}</option>
                            @foreach(DB::table('taxes')->whereStatus(1)->get() as $tax)
                            <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sku">{{ __('SKU') }} *</label>
                        <input type="text" name="sku" class="form-control"
                            id="sku" placeholder="{{ __('Enter SKU') }}"
                            value="{{Str::random(10)}}" >
                    </div>
                    <div class="form-group">
                        <label for="video">{{ __('Video Link') }} </label>
                        <input type="text" name="video" class="form-control"
                            id="video" placeholder="{{ __('Enter Video Link') }}"
                            value="{{ old('video') }}">
                    </div>


                    <div class="row">

                        <div class="col-md-6">
                                    <div class="form-group">
                                     
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_2" name="phot_deals" value="1">
                                        <label for="checkbox_2" style="font-size: 0.8rem !important">Hot Deals</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_3" name="pfeatured" value="1">
                                        <label for="checkbox_3"style="font-size: 0.8rem !important">Featured</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                 
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_4" name="pspecial_offer" value="1">
                                        <label for="checkbox_4"style="font-size: 0.8rem !important">Special Offer</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_5" name="pspecial_deals" value="1">
                                        <label for="checkbox_5"style="font-size: 0.8rem !important">Special Deals</label>
                                    </fieldset>
                                </div>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label>Select Fabric</label>
                        <select name="fabric_id" id="fabric" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach(DB::table('fabrics')->whereStatus(1)->get() as $fab)
                            <option value="{{ $fab->id }}">{{ $fab->fabric }}</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Select Sleeve</label>
                        <select name="sleeve_id" id="sleeve" class="form-control select2" style="width: 100%;">
                          <option value="">Select</option>
                          @foreach(DB::table('sleeves')->whereStatus(1)->get() as $fab)
                          <option value="{{ $fab->id }}">{{ $fab->sleeve }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Select Pattern</label>
                        <select name="pattern_id" id="pattern" class="form-control select2" style="width: 100%;">
                          <option value="">Select</option>
                          @foreach(DB::table('patterns')->whereStatus(1)->get() as $fab)
                            <option value="{{ $fab->id }}">{{ $fab->pattern }}</option>
                            @endforeach
                        </select>
                      </div>  


                      <div class="form-group">
                        <label>Select Fit</label>
                        <select name="fit_id" id="fit" class="form-control select2" style="width: 100%;">
                          <option value="">Select</option>
                          @foreach(DB::table('fits')->whereStatus(1)->get() as $fab)
                          <option value="{{ $fab->id }}">{{ $fab->fit}}</option>
                          @endforeach
                        </select>

                      <div class="form-group">
                        <label>Select Occasion</label>
                        <select name="occasion_id" id="occasion" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach(DB::table('occasions')->whereStatus(1)->get() as $fab)
                            <option value="{{ $fab->id }}">{{ $fab->occasion }}</option>
                            @endforeach
                        </select>
                      </div>

                    <div class="form-group">
                        <label>Select Neck</label>
                        <select name="neck_id" id="occasion" class="form-control select2" style="width: 100%;">
                            <option value="">Select</option>
                            @foreach(DB::table('necks')->whereStatus(1)->get() as $fab)
                            <option value="{{ $fab->id }}">{{ $fab->neck }}</option>
                            @endforeach
                        </select>
                      </div>

    
                </div>
            </div>

        </div>

    </div>
</form>


</div>

</div>

@endsection
@push('js')

 <script type="text/javascript">
    $(document).ready(function() {
      $('select[name="category_id"]').on('change', function(){
          var category_id = $(this).val();
          if(category_id) {
              $.ajax({
                  url: "{{  url('/admin/subcategory/product/ajax') }}/"+category_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                      $('select[name="childcategory_id"]').html('');
                     var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.name_en + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });



$('select[name="subcategory_id"]').on('change', function(){
          var subcategory_id = $(this).val();
          if(subcategory_id) {
              $.ajax({
                  url: "{{  url('/admin/childcategory/product/ajax') }}/"+subcategory_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                     var d =$('select[name="childcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="childcategory_id"]').append('<option value="'+ value.id +'">' + value.name_en + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });


  });
  </script>
@endpush