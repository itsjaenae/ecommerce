@extends('backend.back_master.master')
@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create Category') }}</b> </h3>
                <a class="btn btn-primary btn-sm" href="{{route('admin.category.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
								<form class="admin-form" action="{{ route('admin.category.store') }}" method="POST"
									enctype="multipart/form-data">

                                    @csrf

									@include('alerts.alerts')
                               <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">{{ __('Set Image') }} *</label>
                                        <br>
										<img class="admin-img" src="{{  asset('assets/images/placeholder.png') }}"
												alt="No Image Found">
                                        <br>
										<span class="mt-1">{{ __('Image Size Should Be 60 x 60.') }}</span>
									</div>
							
									<div class="form-group position-relative">
										<label class="file">
											<input type="file"  accept="image/*"  class="upload-photo" name="photo" id="file"
												aria-label="File browser example" >
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
											placeholder="{{ __('Enter Name') }}" value="{{ old('name_en') }}" >
									</div>
								</div>

									<div class="col-md-4">
									<div class="form-group">
										<label for="name">{{ __('Name Hindi') }} </label>
										<input type="text" name="name_hin" class="form-control item-name" id="name"
											placeholder="{{ __('Enter Name') }}" value="{{ old('name_hin') }}" >
									</div>
								</div>

									<div class="col-md-4">
									<div class="form-group">
										<label for="name">{{ __('Name French') }} </label>
										<input type="text" name="name_frn" class="form-control item-name" id="name"
											placeholder="{{ __('Enter Name') }}" value="{{ old('name_frn') }}" >
									</div>
								</div>
							</div>

								<div class="row">
                                   <div class="col-md-4">
									<div class="form-group">
										<label for="slug">{{ __('Slug English') }} *</label>
										<input type="text" name="slug_en" class="form-control" id="slug"
											placeholder="{{ __('Enter Slug') }}" value="{{ old('slug_en') }}" >
									</div>
								</div>

									<div class="col-md-4">
									<div class="form-group">
										<label for="slug">{{ __('Slug Hindi') }} *</label>
										<input type="text" name="slug_hin" class="form-control" id="slug"
											placeholder="{{ __('Enter Slug') }}" value="{{ old('slug_hin') }}" >
									</div>
								</div>

									<div class="col-md-4">
									<div class="form-group">
										<label for="slug">{{ __('Slug French') }} *</label>
										<input type="text" name="slug_frn" class="form-control" id="slug"
											placeholder="{{ __('Enter Slug') }}" value="{{ old('slug_frn') }}" >
									</div>
								</div>
								</div>
								
								<div class="row">
									<div class="col-md-4">
									<div class="form-group">
										<label for="icon">{{ __('icon') }}
											</label>
										<input type="text" name="icon" class="form-control"
											id="icon"
											placeholder="{{ __('icon') }}"
											value="{{ old('icon') }}">
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="meta_keywords">{{ __('Meta Keywords') }}
											</label>
										<input type="text" name="meta_keywords" class="tags"
											id="meta_keywords"
											placeholder="{{ __('Enter Meta Keywords') }}"
											value="">
									</div>
								</div>  
							</div>

								<div class="row">
									<div class="col-md-9">
									<div class="form-group">
										<label
											for="meta_description">{{ __('Meta Description') }}
											</label>
										<textarea name="meta_descriptions" id="meta_description"
											class="form-control" rows="5"
											placeholder="{{ __('Enter Meta Description') }}"
										></textarea>
									</div>
								</div>

									<div class="col-md-3">
									<div class="form-group">
										<label for="serial">{{ __('Serial') }} *</label>
										<input type="number" name="serial" class="form-control" id="serial"
											placeholder="{{ __('Enter Serial Number') }}" value="0">
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
