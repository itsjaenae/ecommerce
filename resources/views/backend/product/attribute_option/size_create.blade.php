@extends('backend.back_master.master')
@section('content')

<div class="container-fluid">

	<!-- Option Heading -->    
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create  Options') }}</b></h3>
                <a class="btn btn-primary   btn-sm" href="{{route('admin.option.index',$product->id)}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
								<form class="admin-form" action="{{ route('admin.option.store',$product->id) }}" method="POST"
									enctype="multipart/form-data">

                                    @csrf

									@include('alerts.alerts')
                                    <div class="form-group">
                                        <label for="attribute_id">{{ __('Attribute') }} *</label>
                                        <select name="attribute_id" class="form-control" id="attribute_id" >
                                            <option value="">{{ __('Select Attribute') }}</option>
                                           @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->id }}" 
                                                {{ $attribute->id == old('attribute_id') ? 'selected' : '' }}>
                                                {{ $attribute->name }}</option>
                                            @endforeach 
                               
                                        </select>
									</div>


           

            <div class="form-group">
                <label for="size">{{ __('size') }} *</label>
                <select name="name" class="form-control" id="size" required>
                    <option value="">{{ __('Select Size') }}</option>
                    <option value="S" >S</option>
                    <option value="XXS" >XXS</option>
                    <option value="XS" >XS</option>
                    <option value="XL" >XL</option>
                    <option value="3XL" >3XL</option>
                    <option value="2XL" >2XL</option>
                    <option value="XXL" >XXL</option>
                    <option value="EU 28" >EU 28</option>
                    <option value="EU 30" >EU  30</option>
                    <option value="EU 32" >EU 32</option>
                    <option value="EU 34" >EU 34</option>
                    <option value="EU 36" >EU 36</option>
                    <option value="EU 40" >EU 40</option>
                    <option value="EU 42" >EU 42</option>
                    <option value="EU 44" >EU 44</option>
                    <option value="EU 46" >EU 46</option>
                    <option value="EU 48" >EU 48</option>
                    <option value="8 INCHES" >8 INCHES</option>
                    <option value="10 INCHES" >10 INCHES</option>
                    <option value="12 INCHES" >12 INCHES</option>
                    <option value="14 INCHES" >14 INCHES</option>
                    <option value="16 INCHES" >16 INCHES</option>
                    <option value="18  INCHES" >18  INCHES</option>
                    <option value="20 INCHES" >20 INCHES</option>
                    <option value="22 INCHES" >22 INCHES</option>
                    <option value="24 INCHES" >24 INCHES</option>
                    <option value="26 INCHES" >26 INCHES </option>
                    <option value="27 INCHES" >27 INCHES</option>
                    <option value="28 INCHES" >28 INCHES</option>
                    <option value="30 INCHES" >30 INCHES</option>
                    <option value="32 INCHES" >32 INCHES</option>
                    <option value="34 INCHES" >34 INCHES</option>
                    <option value="36 INCHES" >36 INCHES</option>
                    <option value="38 INCHES" >38 INCHES</option>
                    <option value="40 INCHES" >40 INCHES</option>
                 
                </select>
            </div>
 
									<div class="form-group">
										<label for="stock">{{ __('Stock') }} *</label>
										<input type="text" name="stock" class="form-control" id="stock"
											placeholder="{{ __('Enter Stock') }}" value="{{ old('stock') }}" >
                                            <label for="unlimited">
                                                <input type="checkbox" class="my-2" id="unlimited">
                                            {{__('Unlimited Stock')}}
                                            </label>
									</div>
                                    

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
                                                name="price" class="form-control"
                                                placeholder="{{ __('Enter Price') }}"
                                                value="{{ old('price') }}" >
                                        </div>
                                    </div>

                                    <input type="hidden" id="attr_keyword" name="keyword" value="{{ old('keyword') }}">

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

</div>

@endsection
