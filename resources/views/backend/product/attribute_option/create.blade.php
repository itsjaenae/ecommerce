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
                                        <select name="attribute_id" class="form-control" id="attribute_id"required>
                                            <option value="">{{ __('Select Attribute') }}</option>
                                            @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->id }}" 
                                                {{ $attribute->id == old('attribute_id') ? 'selected' : '' }}>
                                                {{ $attribute->name }}</option>
                                            @endforeach
                                        
                                        </select>
									</div>


            <div class="form-group">
                <label for="color">{{ __('Color') }} *</label>
                <select type="text" class="form-control" required
                name="name"
                placeholder="{{ __('Name') }}" value="">
                <option value="">{{ __(' Select') }}</option>
                <option value="Red" >Red</option>
                <option value="Yellow" >Yellow</option>
                <option value="Green" >Green</option>
                <option value="Orange" >Orange</option>
                <option value="Black" >Black</option>
                <option value="Blue" >Blue</option>
                <option value="Brown" >Brown</option>
                <option value="Peach" >Peach</option>
                <option value="Purple" >Purple</option>
                <option value="Pink" >Pink</option>
                <option value="White" >White</option>
                <option value="Gray" >Gray</option>
                <option value="Violet" >Violet</option>
                <option value="Cyan" >Cyan</option>
                <option value="Coral" >Coral</option>
                <option value="Teal" >Teal</option>
                <option value="Indigo" >Indigo</option>
                <option value="Lime" >Lime</option>
                <option value="Navy Blue" >Navy Blue</option>
                <option value="Maroon" >Maroon</option>
                <option value="Mustard" >Mustard</option>
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
