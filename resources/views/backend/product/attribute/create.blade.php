@extends('backend.back_master.master')

@section('content')

<div class="container-fluid">

	<!-- Attribute Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create Attribute') }}</b> </h3>
                <a class="btn btn-primary   btn-sm" href="{{route('admin.attribute.index',$product->id)}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
								<form class="admin-form" action="{{ route('admin.attribute.store',$product->id) }}" method="POST"
									enctype="multipart/form-data">

                                    @csrf

									@include('alerts.alerts')

									{{-- <div class="form-group">
										<label for="attr_name">{{ __('Name') }} *</label>
										<input type="text" name="name" class="form-control" id="attr_name"
											placeholder="{{ __('Enter Name') }}" value="{{ old('name') }}" >
									</div> --}}
									<div class="row">
										<div class="col-md-6">
									<div class="form-group">
										<select type="text" class="form-control" required
											name="name"
											placeholder="{{ __('Name') }}" value="">
											<option value="">{{ __(' Select') }}</option>
											{{-- @foreach(DB::table('colors')->whereStatus(1)->get() as $attribute) --}}
											<option value="Color" >Color</option>
											<option value="Size" >Size</option>
											{{-- @endforeach --}}
										</select>
										</div>

										{{-- <div class="form-group">
											<select type="text" class="form-control"
												name="size"
												placeholder="{{ __('size') }}" value="">
												<option value="">{{ __('Size') }}</option>
												@foreach(DB::table('sizes')->whereStatus(1)->get() as $attribute)
												<option value="{{ $attribute->id }}" {{ $attribute->id == old('size_id') ? 'selected' : '' }}>{{ $attribute->size }}</option>
												@endforeach
											</select>
											</div> --}}
										</div>
										</div>
                                    <input type="hidden" id="attr_keyword" name="keyword" value="{{ old('keyword') }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

									<div class="form-group">
										<button type="submit" class="btn btn-secondary ">{{ __('Submit') }}</button>
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
