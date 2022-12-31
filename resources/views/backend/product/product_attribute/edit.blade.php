@extends('backend.back_master.master')
@section('content')

<div class="container-fluid">

	<!-- Option Heading -->
    


    <!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
                  
					<!-- Nested Row within Card Body -->
					<div class="row justify-content-center">
						<div class="col-lg-12">
                            @foreach($pdata as $data)
                       
                            <form class="admin-form" action="{{ route('admin.attr.edit',[$data['id']]) }}"
                            method="POST" >

                            @csrf
                  
              <input  type="hidden" name="product_id[]" value="{{ $data['id'] }}">   
									@include('alerts.alerts')
                                   

                           <div id="section">
                                                <div class="d-flex" style="margin-bottom: 3rem">
                                                  
                                                    <div class="flex-grow-1">
                                                        <div class="form-group">
                                                            <label for="color_id">{{ __('Color') }} *</label>
                                                            <select name="color_id[]" class="form-control" id="color_id" >
                                                                <option value="">{{ __('Color') }}</option>
                                                                @foreach(DB::table('colors')->whereStatus(1)->get() as $attribute)
                                                                <option value="{{ $attribute->id }}" {{ $attribute->id == $data['color_id'] ? 'selected' : '' }}>{{ $attribute->color }}</option>
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
                                                                <option value="{{ $attribute->id }}" {{ $attribute->id == $data['size_id'] ? 'selected' : ''}}>{{ $attribute->size }}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                    </div>

                                              

                                    <div class="flex-grow-1">
                                        <label for="stock">{{ __('Stock') }} *</label>
										<input type="text" name="stock[]" class="form-control" id="stock"
											placeholder="{{ __('Enter Stock') }}" value="{{ $data['stock']}}" >
                                            <label for="unlimited">
                                                <input type="checkbox" {{$data['stock'] == 'unlimited' ? 'checked' : ''}} class="my-2" id="unlimited">
                                            {{__('Unlimited Stock')}}
                                            </label>
                                    </div>
                                    @php
                                     $curr = DB::table('currencies')->where('is_default',1)->first();
                                    @endphp
                                    <div class="flex-grow-1">
                                         <div class="form-group">
                                        <label for="price">{{ __('Price') }} *</label>
                                        <small>({{ __('Set 0 to make it free') }})</small>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span
                                                    class="input-group-text">{{ $curr->sign }}</span>
                                            </div>
                                            <input type="text" id="price"
                                                name="price[]" class="form-control"
                                                placeholder="{{ __('Enter Price') }}"

                                                {{-- value="{{ $data['price']}}" > --}}
                                                value="{{ PriceHelper::setPrice($data['price']) }}" >
                                        </div>
                                    </div>

                                    </div>

                             

                                    <div class="action-list">
                                        <button type="submit" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i>{{ __('update') }}
                                        </button>
                                        
                                        <a title="Delete Attribute" href="javascript:void(0)" 
                                        class="confirmDelete btn btn-danger btn-sm" record="attribute" 
                                        recordid="{{ $data['id'] }}"><i class="fas fa-trash">
                                            </i></a> 
                                        

                                    </div>
                           
                                </div>
                            </div>
      
                         
                   
                          

									{{-- <div class="form-group">
										<button type="submit" class="btn btn-secondary">{{ __('Submit') }}</button>
									</div> --}}

									<div>
								</form>
                                @endforeach

						</div>
					</div>
             
                 

				</div>
			</div>

		</div>

	</div>

</div>

@endsection
