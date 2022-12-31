@extends('backend.back_master.master')
@section('content')


<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Update Brand') }}</b> </h3>
                <a class="btn btn-primary  btn-sm" href="{{route('admin.brand.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
								<form class="admin-form" action="{{ route('admin.brand.update',$brand->id) }}"
									method="POST" enctype="multipart/form-data">

                                    @csrf

                                    @method('PUT')

									@include('alerts.alerts')
									<div class="row">
										<div class="col-md-9">
									<div class="form-group">
										<label for="name">{{ __('Current Image') }} *</label>
										<br>
											<img class="admin-img"
												src="{{ $brand->photo ? asset('images/brand_images/'.$brand->photo) : asset('assets/images/placeholder.png') }}"
												alt="No Image Found">
										<br>
										<span class="mt-1">{{ __('Image Size Should Be 110 x 81.') }}</span>
									</div>

									<div class="form-group position-relative">
										<label class="file">
											<input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file"
												aria-label="File browser example">
											<span class="file-custom text-left">{{ __('Upload Image...') }}</span>
										</label>
                                    </div>
								</div>
							</div>

									<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">{{ __('Name English') }} *</label>
											<input type="text" name="name_en" class="form-control item-name" id="name"
												placeholder="{{ __('Enter Name') }}" value="{{ $brand->name_en }}" >
										</div>
									</div>
	
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">{{ __('Name Hindi') }} </label>
											<input type="text" name="name_hin" class="form-control item-name" id="name"
												placeholder="{{ __('Enter Name') }}" value="{{ $brand->name_hin }}" >
										</div>
									</div>
							
									
							
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">{{ __('Name French') }} </label>
											<input type="text" name="name_frn" class="form-control item-name" id="name"
												placeholder="{{ __('Enter Name') }}" value="{{ $brand->name_frn}}" >
										</div>
									</div>
								</div>
	
									<div class="row">
										<div class="col-md-4">
										<div class="form-group">
											<label for="slug">{{ __('Slug English') }} *</label>
											<input type="text" name="slug_en" class="form-control" id="slug"
												placeholder="{{ __('Enter Slug') }}" value="{{ $brand->slug_en }}" >
										</div>
										</div>
	
										<div class="col-md-4">
										<div class="form-group">
											<label for="slug">{{ __('Slug Hindi') }} *</label>
											<input type="text" name="slug_hin" class="form-control" id="slug"
												placeholder="{{ __('Enter Slug') }}" value="{{ $brand->slug_hin}}" >
										</div>
										</div>
								
										<div class="col-md-4">
										<div class="form-group">
											<label for="slug">{{ __('Slug French') }} *</label>
											<input type="text" name="slug_frn" class="form-control" id="slug"
												placeholder="{{ __('Enter Slug') }}" value="{{ $brand->slug_frn}}" >
										</div>
										</div>
									</div>
							

								<div class="form-group">
										<button type="submit"
											class="btn btn-secondary ">{{ __('Submit') }}</button>
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
