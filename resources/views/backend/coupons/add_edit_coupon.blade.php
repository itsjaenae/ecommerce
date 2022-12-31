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
                <h3 class=" mb-0 bc-title"><b>{{ __('Create Coupon') }}</b> </h3>
                <a class="btn btn-primary btn-sm" 
                href="{{url('admin/coupons')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card o-hidden border-0 shadow-lg">
          <div class="card-body ">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <div class="col-lg-12">
        @if ($errors->any())
          <div class="alert alert-danger" style="margin-top: 10px;">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        @if(Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
              {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <form name="couponForm" id="couponForm" @if(empty($coupon['id'])) action="{{ url('admin/add-edit-coupon') }}" @else action="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
           
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6"> 
                  @if(empty($coupon['code_name']))
                    <div class="form-group">
                        <label for="coupon_option">Coupon Option</label><br>
                        <span><input id="AutomaticCoupon" type="radio" name="coupon_option" value="Automatic" checked="">&nbsp;Automatic&nbsp;&nbsp;
                        <span><input id="ManualCoupon" type="radio" name="coupon_option" value="Manual">&nbsp;Manual&nbsp;&nbsp;
                    </div>
                    <div class="form-group" style="display: none;" id="couponField">
                        <label for="code_name">Coupon Code</label>
                        <input type="text" class="form-control" name="code_name" id="code_name" placeholder="Enter Coupon Code">
                    </div>
                  @else
                    <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                    <input type="hidden" name="code_name" value="{{ $coupon['code_name'] }}">
                    <div class="form-group">
                        <label for="code_name">Coupon Code: </label>
                        <span>{{ $coupon['code_name'] }}</span>
                    </div>
                  @endif

                  <div class="form-group">
                      <label for="no_of_times">Coupon Type</label><br>
                      <span><input type="radio" name="no_of_times" value="Multiple Times" @if(isset($coupon['no_of_times'])&&$coupon['no_of_times']=="Multiple Times") checked="" @elseif(!isset($coupon['no_of_times'])) checked="" @endif>&nbsp;Multiple Times&nbsp;&nbsp;
                      <span><input type="radio" name="no_of_times" value="Single Times" @if(isset($coupon['no_of_times'])&&$coupon['no_of_times']=="Single Times") checked="" @endif>&nbsp;Single Times&nbsp;&nbsp;
                  </div>
                  <div class="form-group">
                      <label for="type">discount Type</label><br>
                      <span><input type="radio" name="type" value="Percentage" @if(isset($coupon['type'])&&$coupon['type']=="Percentage") checked="" @elseif(!isset($coupon['type'])) checked="" @endif>&nbsp;Percentage&nbsp;(in %)&nbsp;
                      <span><input type="radio" name="type" value="Fixed" @if(isset($coupon['type'])&&$coupon['type']=="Fixed") checked="" @endif>&nbsp;Fixed&nbsp;(in INR or USD)&nbsp;
                  </div>
                  <div class="form-group">
                      <label for="discount">discount</label>
                      <input type="number" class="form-control" name="discount" id="discount" placeholder="Enter discount" required="" @if(isset($coupon['discount'])) value="{{ $coupon['discount'] }}" @endif>
                  </div>
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
                            <option value="{{ $category['id'] }}" @if(in_array($category['id'],$selCats)) selected="" @endif>&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $category['name_en']}}</option>
                            @foreach($category['subcategory'] as $subcategory)
                              <option value="{{ $subcategory['id'] }}" @if(in_array($subcategory['id'],$selCats)) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{ $subcategory['name_en']}}</option>
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
                        <option value="{{ $user['email'] }}" @if(in_array($user['email'],$selUsers)) selected="" @endif>{{ $user['email'] }}</option>  
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
                

                </div>
              </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
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