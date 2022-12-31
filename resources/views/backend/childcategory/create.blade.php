@extends('backend.back_master.master')
@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create Child Category') }}</b>
                </h3>
                <a class="btn btn-primary btn-sm" href="{{route('admin.childcat.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
								<form class="admin-form" action="{{ route('admin.childcat.store') }}" method="POST"
									enctype="multipart/form-data">

                                    @csrf

									@include('alerts.alerts') 

									<div class="row">
										<div class="col-md-4">
									<div class="form-group">
										<label for="category_id">{{ __('Select Category') }} *</label>
										<select name="category_id" id="category_id"  class="form-control" >
											<option value="" selected disabled>{{__('Select One')}}</option>
											@foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
											<option value="{{ $cat->id }}">{{ $cat->name_en }}</option>
											@endforeach
										</select>
									</div>
										</div>

								 <div class="col-md-4">
									<div class="form-group">
										<label for="subcategory_id">{{ __('Select subcategory') }} *</label>
										<select name="subcategory_id" id="subcategory_id" 
										 class="form-control" >
											<option value="">{{__('Select One')}}</option>
										</select>
									</div>
								</div> 

								

								<div class="col-md-4">
									<div class="form-group">
										<label for="name">{{ __('Name English') }} *</label>
										<input type="text" name="name_en" class="form-control item-name" id="name"
											placeholder="{{ __('Enter Name') }}" value="{{ old('name_en') }}" >
									</div>
								</div>
									</div>

								<div class="row">
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
	
										<div class="col-md-4">
										<div class="form-group">
											<label for="slug">{{ __('Slug English') }} *</label>
											<input type="text" name="slug_en" class="form-control" id="slug"
												placeholder="{{ __('Enter Slug') }}" value="{{ old('slug_en') }}" >
										</div>
									</div>
								</div>

								<div class="row">
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
@push('js')
<script type="text/javascript">
	$(document).ready(function() {
	  $('select[name="category_id"]').on('change', function(){
		  var category_id = $(this).val();
		  if(category_id) {
			  $.ajax({
				  url: "{{  url('/admin/subcategory/ajax') }}/"+category_id,
				  type:"GET",
				  dataType:"json",
				  success:function(data) {
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
  });
  </script>
@endpush