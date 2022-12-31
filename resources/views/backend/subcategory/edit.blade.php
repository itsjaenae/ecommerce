@extends('backend.back_master.master')
@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Edit Sub Category') }}</b> </h3>
                <a class="btn btn-primary btn-sm" href="{{route('admin.subcategory.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
								<form class="admin-form" action="{{ route('admin.subcategory.update',$subcategory->id) }}" method="POST"
									enctype="multipart/form-data">

                                    @csrf
									@method('PUT')
									@include('alerts.alerts')
									<div class="row">
										<div class="col-md-4">
									<div class="form-group">
										<label for="category_id">{{ __('Select Category') }} *</label>
										<select name="category_id" id="category_id" class="form-control" >
											@foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
											<option value="{{ $cat->id }}" {{$subcategory->category_id == $cat->id ? 'selected' :''}} >{{ $cat->name_en }}</option>
											@endforeach
										</select>
									</div>
										</div>
							
										<div class="col-md-4">
											<div class="form-group">
												<label for="name">{{ __('Name English') }} *</label>
												<input type="text" name="name_en" class="form-control item-name" id="name"
													placeholder="{{ __('Enter Name') }}" value="{{ $subcategory->name_en }}" >
											</div>
										</div>
		
										<div class="col-md-4">
											<div class="form-group">
												<label for="name">{{ __('Name Hindi') }} </label>
												<input type="text" name="name_hin" class="form-control item-name" id="name"
													placeholder="{{ __('Enter Name') }}" value="{{ $subcategory->name_hin }}" >
											</div>
										</div>
									</div>
										
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="name">{{ __('Name French') }} </label>
												<input type="text" name="name_frn" class="form-control item-name" id="name"
													placeholder="{{ __('Enter Name') }}" value="{{ $subcategory->name_frn}}" >
											</div>
										</div>
									
		
									
											<div class="col-md-4">
											<div class="form-group">
												<label for="slug">{{ __('Slug English') }} *</label>
												<input type="text" name="slug_en" class="form-control" id="slug"
													placeholder="{{ __('Enter Slug') }}" value="{{ $subcategory->slug_en }}" >
											</div>
											</div>
		
											<div class="col-md-4">
											<div class="form-group">
												<label for="slug">{{ __('Slug Hindi') }} *</label>
												<input type="text" name="slug_hin" class="form-control" id="slug"
													placeholder="{{ __('Enter Slug') }}" value="{{ $subcategory->slug_hin}}" >
											</div>
											</div>
										</div>
		
										<div class="row">
											<div class="col-md-4">
											<div class="form-group">
												<label for="slug">{{ __('Slug French') }} *</label>
												<input type="text" name="slug_frn" class="form-control" id="slug"
													placeholder="{{ __('Enter Slug') }}" value="{{ $subcategory->slug_frn}}" >
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
