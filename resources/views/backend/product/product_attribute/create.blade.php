@extends('backend.back_master.master')
@section('content')

<div class="container-fluid">

	<!-- Option Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create  Options') }}</b></h3>
                <a class="btn btn-primary   btn-sm" href="{{route('admin.attr.edit',$data['id'])}}">
                    <i class="fas fa-chevron-left"></i> {{ __('Edit ') }}</a>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row justify-content-center">
						<div class="col-lg-12">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <img style="width:120px;" src="{{ asset('images/product_images/'.$data['photo']) }}">
                                </div>
                              </div>

                         
                        <form class="admin-form" action="{{ url('/admin/add-attributes/'.$data['id']) }}" 
                        method="POST">

                                    @csrf
                                    <input  type="hidden" name="product_id[]" value="{{ $data['id']}}">   
									@include('alerts.alerts')
                              
                           <div id="section">
                                                <div class="d-flex">
                                                  
                                                    <div class="flex-grow-1">
                                                        <div class="form-group">
                                                            <select type="text" class="form-control"
                                                                name="color_id[]"
                                                                placeholder="{{ __('Color') }}" value="">
                                                                <option value="">{{ __(' Color') }}</option>
                                                                @foreach(DB::table('colors')->whereStatus(1)->get() as $attribute)
                                                                <option value="{{ $attribute->id }}" {{ $attribute->id == old('color_id') ? 'selected' : '' }}>{{ $attribute->color }}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <div class="form-group">
                                                            <select type="text" class="form-control"
                                                                name="size_id[]"
                                                                placeholder="{{ __('size') }}" value="">
                                                                <option value="">{{ __('Size') }}</option>
                                                                @foreach(DB::table('sizes')->whereStatus(1)->get() as $attribute)
                                                                <option value="{{ $attribute->id }}" {{ $attribute->id == old('size_id') ? 'selected' : '' }}>{{ $attribute->size }}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                    </div>

                                              
									{{-- <div class="form-group">
										<label for="attr_name">{{ __('Name') }} *</label>
										<input type="text" name="name" class="form-control" id="attr_name"
											placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}" >
									</div> --}}
                                    <div class="flex-grow-1">
									<div class="form-group">
										<label for="stock">{{ __('Stock') }} *</label>
										<input type="text" name="stock[]" class="form-control" id="stock"
											placeholder="{{ __('Enter Stock') }}" value="{{ old('stock') }}" >
                                            <label for="unlimited">
                                                <input type="checkbox" class="my-2" id="unlimited">
                                            {{__('Unlimited Stock')}}
                                            </label>
									</div>
                                    </div>
                                    @php
                                     $curr = DB::table('currencies')->where('is_default',1)->first();
                                    @endphp
                                    <div class="flex-grow-1">
                                    <div class="form-group">
                                        <label for="price">{{ __('+ Price') }} *</label>
                                        <small>({{ __('Set 0 to make it free') }})</small>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text">{{ $curr->sign }}
                                                </span>
                                            </div>
                                            <input type="text" id="price"
                                                name="price[]" class="form-control"
                                                placeholder="{{ __('Enter Price') }}"
                                                value="{{ old('price') }}" >
                                        </div>
                                    </div>
                                    </div>

                             

                                    <div class="flex-btn">
                                        <button type="button" class="btn btn-success add-specification" > 
                                        <i class="fa fa-plus"></i> </button>
                                    </div>
                                </div>
                            </div>
      

									<div class="form-group">
										<button type="submit" class="btn btn-secondary">{{ __('Submit') }}</button>
									</div>

									<div>
								</form>
                        </div>
			</div>
		</div>


     
         

        </div>



	</div>
</div>

@endsection
@push('js')
	<script>
		  // Appending Specification To Items
		  $('.add-specification').on('click',function(){
   
            $('#section').append(`
            <div class="d-flex">

                <div class="flex-grow-1">
                <div class="form-group">
                <select type="text" class="form-control"
                name="color_id[]"
                placeholder="Color" value="">
                <option value="">{{ __('Color') }}</option>
                @foreach(DB::table('colors')->whereStatus(1)->get() as $attribute)
                <option value="{{ $attribute->id }}" {{ $attribute->id == old('color_id') ? 'selected' : '' }}>{{ $attribute->color }}</option>
                @endforeach
                </select>
                </div>
                </div>

                <div class="flex-grow-1">
    <div class="form-group">
        <select type="text" class="form-control"
            name="size_id[]"
            placeholder="Size" value="">
            <option value="">{{ __('Size') }}</option>
            @foreach(DB::table('sizes')->whereStatus(1)->get() as $attribute)
            <option value="{{ $attribute->id }}" {{ $attribute->id == old('size_id') ? 'selected' : '' }}>{{ $attribute->size }}</option>
            @endforeach
        </select>
        </div>
</div>

        <div class="flex-grow-1">
            <div class="form-group">
            <label for="stock">{{ __('Stock') }} *</label>
            <input type="text" name="stock[]" class="form-control" id="stock"
            placeholder="Enter Stock" value="{{ old('stock') }}" >
            <label for="unlimited">
            <input type="checkbox" class="my-2" id="unlimited">
            Unlimited Stock
            </label>
            </div>
            </div>

            <div class="flex-grow-1">
        <div class="form-group">
        <label for="price">{{ __('+ Price') }} *</label>
        <small>({{ __('Set 0 to make it free') }})</small>
        <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span
        class="input-group-text">{{ $curr->sign }}
        </span>
        </div>
        <input type="text" id="price"
        name="price[]" class="form-control"
        placeholder="Enter Price"
        value="{{ old('price') }}" >
        </div>
        </div>
        </div>
       
     
        <div class="flex-btn">
                    <button type="button"
                        class="btn btn-danger remove-spcification">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
        </div>
            `);

           

        });

		</script>



<script>
    // Products Attributes Add/Remove Script
	var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div ><div style="height:10px;"></div><input type="text" name="size[]" style="width:120px" placeholder="Size" />&nbsp;<input type="text" name="sku[]" style="width:120px" placeholder="SKU" />&nbsp;<input type="text" name="price[]" style="width:120px" placeholder="Price" />&nbsp;<input type="text" name="stock[]" style="width:120px" placeholder="Stock" />&nbsp;<a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
</script>

@endpush