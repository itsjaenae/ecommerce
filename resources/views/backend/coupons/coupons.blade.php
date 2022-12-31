@extends('backend.back_master.master')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row col-sm-6">
        
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Coupons</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" 
            style="margin-top: 10px;">
                {{ Session::get('success_message') }}
              <button type="button" class="close" coupon-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Coupons</h3>
              <a href="{{ url('admin/add-edit-coupon') }}" 
              style="max-width: 150px; float:right; display: inline-block;" 
              class="btn btn-block btn-success">Add Coupon</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="coupons" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Coupon Type</th>
                  <th>discount</th>
                  <th>Expiry Date</th>
                  <th>{{ __('Status') }}</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coupons as $coupon)
                <tr>
                  <td>{{ $coupon['id'] }}</td>
                  <td>{{ $coupon['code_name'] }}</td>
                  <td>{{ $coupon['no_of_times'] }}</td>
                  <td>
                      {{ $coupon['discount'] }}
                      @if($coupon['type']=="Percentage")
                        %
                      @else
                        INR
                      @endif
                  </td>
                  <td>{{ $coupon['expiry_date'] }}</td>
                  <td>
                    <div class="dropdown">
                        <button class="btn btn-{{  $coupon['status'] == 1 ? 'success' : 'danger'  }} 
                        btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          {{  $coupon['status'] == 1 ? __('Enabled') : __('Disabled')  }}
                        </button>
                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="{{ route('admin.coupon.status',[$coupon['id'],1]) }}">{{ __('Enable') }}</a>
                          <a class="dropdown-item" href="{{ route('admin.coupon.status',[$coupon['id'],0]) }}">{{ __('Disable') }}</a>
                        </div>
                      </div>
                </td>

                  <td>
                  
                    <a title="Edit Coupon" href="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}"><i class="fas fa-edit"></i></a>
                    &nbsp;&nbsp;
               

                    <a title="Delete Coupon" href="javascript:void(0)" class="confirmDelete" record="coupon" recordid="{{ $coupon['id'] }}"><i class="fas fa-trash"></i></a>
                    &nbsp;&nbsp;
                 
                 
                  	{{-- @if($coupon['status']==1)
                  		<a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                  	@else
                  		<a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                  	@endif --}}
                  
                  </td>
                </tr>
                @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection