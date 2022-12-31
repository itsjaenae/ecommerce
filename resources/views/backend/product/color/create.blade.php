@extends('backend.back_master.master')
@section('content')

<div class="container-fluid">

	<!-- color Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b>{{ __('Create color') }}</b> </h3>
                <a class="btn btn-primary   btn-sm" href="{{route('admin.color.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
								<form class="admin-form" action="{{ route('admin.color.store') }}" method="POST">

                                    @csrf

									@include('alerts.alerts')
  
									<div class="form-group">
										<label for="attr_name">{{ __('Name') }} *</label>
										<input type="text" name="color" class="form-control" id="attr_name"
											placeholder="{{ __('Enter Name') }}" value="{{ old('color') }}" >
									</div>
                                    <input type="hidden" id="attr_keyword" name="keyword" value="{{ old('keyword') }}">
    
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
