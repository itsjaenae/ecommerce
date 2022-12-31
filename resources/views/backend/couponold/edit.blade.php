@extends('backend.back_master.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/back/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('assets/back/css/datepicker.css')}}">
@endsection
@section('content')

<div class="container-fluid">

	<!-- Code Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0 bc-title"><b>{{ __('Update Coupon') }}</b> </h3>
                <a class="btn btn-primary btn-sm" href="{{route('admin.coupon.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
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
                            <form class="admin-form" action="{{ route('admin.coupon.update',$code->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @include('alerts.alerts')

                            

                                <div class="form-group">
                                    <label for="title">{{ __('Title') }} *</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        placeholder="{{ __('Enter Title') }}" value="{{ $code->title }}" >
                                </div>

                            <div class="form-group">
                                    <label for="code">{{ __('Code') }} *</label>
                                    <input type="text" name="code_name" class="form-control" id="code"
                                        placeholder="{{ __('Enter Code') }}" value="{{ $code->code_name }}" >
                                </div> 

                                <div class="form-group">
                                    <label for="no_of_times">{{ __('Number Of Times') }} *</label>
                                    <input type="number" name="no_of_times" class="form-control" id="no_of_times"
                                        placeholder="{{ __('Enter Number Of Times') }}" value="{{ $code->no_of_times }}" min="1" >
                                </div>

                                
                                <div class="form-group">
                                    <label for="discount">{{ __('Discount') }}
                                        *</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <select name="type" class="form-control">
                                                    <option value="percentage" {{$code->type == 'percentage' ? 'selected' : ''}}>{{__('Percentage')}} (%)</option>
                                                    <option value="amount" {{$code->type == 'amount' ? 'selected' : ''}}>{{__('Amount')}} ({{ PriceHelper::adminCurrency() }})</option>
                                                </select>
                                            </span>
                                        </div>
                                        <input type="number" id="discount"
                                            name="discount" class="form-control"
                                            placeholder="{{ __('Enter Discount') }}"
                                            min="0" step="0.1"
                                            value="{{ $code->type == 'amount' ? round($code->discount / $curr->value,2) : $code->discount }}" >
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="categories">Select Categories</label>
                                        <select name="categories[]" class="form-control select2" multiple="" required="">
                                          <option value="">Select</option>
                                     
                                          @foreach($categories as $category)
                                            <optgroup label="{{ $category['name_en'] }}"></optgroup>
                                            {{-- @foreach($section['categories'] as $category) --}}
                                              <option value="{{ $category['id'] }}" 
                                    
                                              @if(in_array($category['id'],array())) 
                                              selected="" @endif>&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp; 
                                              {{ $category['name_en']}}</option>
                                              @foreach($category['subcategory'] as $subcategory)
                                                <option value="{{ $subcategory['id'] }}" 
                                                @if(in_array($subcategory['id'],array())) 
                                                selected="" 
                                                @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['name_en']}}</option>
                                              @endforeach  
                                            @endforeach
                                          {{-- @endforeach --}}
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label for="users">Select Users</label>
                                        <select name="users[]" class="form-control select2" multiple="">
                                        <option value="">Select</option>
                                        @foreach($users as $user)
                                          <option value="{{ $user['email'] }}" @if(in_array($user['email'],array())) selected="" @endif>{{ $user['email'] }}</option>  
                                        @endforeach
                                      </select>
                                    </div> 
                                    <div class="form-group">
                                        <label for="expiry_date">Expiry Date</label>
                                        <input type="text" required class="form-control" name="expiry_date" 
                                        placeholder="{{__('Enter Date')}}" id="datepicker"
                             
                                      required="" @if(isset($coupon['expiry_date'])) 
                                         value="{{ $coupon['expiry_date'] }}" @endif>
                                    </div>
                                  

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
@section('scripts')
    <script type="" src="{{asset('assets/back/js/select2.js')}}"></script>
    <script>
        $('#basic').select2({
			theme: "bootstrap"
		});
    </script>
@endsection