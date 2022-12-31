<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	 <title>{{ $setting->title }}</title> 
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon"  type="image/x-icon" href="{{ asset('assets/images/'.$setting->favicon) }}"/>

	<!-- Fonts and icons -->  
	<script src="{{ asset('assets/back/js/plugin/webfont/webfont.min.js') }}"></script>
	<script id="setFont" data-src="{{ asset("assets/back/css/fonts.css") }}" src="{{ asset('assets/back/js/plugin/webfont/setfont.js') }}"></script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/back/css/azzara.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap-iconpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/magnific-popup.css') }}">

	<!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/custom.css') }}">


   @if(DB::table('languages')->where('type', 'Dashboard')->where('is_default',1)->first()->rtl == 1)
    <link rel="stylesheet" href="{{ asset('assets/back/css/rtl.css') }}">
    @endif

    @yield('styles')

</head>
<body>
	
	<div class="wrapper">
		@include('backend.body.header')

		<!-- Sidebar -->
		@include('backend.body.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
                    @yield('content')
				</div>
			</div>
        </div>

    </div>
    @php
        $mainbs = [];
        $mainbs['is_announcement'] = $setting->is_announcement;
        $mainbs['announcement_delay'] = $setting->announcement_delay;
        $mainbs['overlay'] = $setting->overlay;
        $mainbs = json_encode($mainbs);
    @endphp 

<script>
    var mainbs = {!! $mainbs !!};
</script> 
	<!--   Core JS Files   -->
	<script src="{{ asset('assets/back/js/core/jquery.3.6.0.min.js') }}"></script>
	<script src="{{ asset('assets/back/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/back/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('assets/back/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/back/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('assets/back/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

	<!-- Moment JS -->
	<script src="{{ asset('assets/back/js/plugin/moment/moment.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('assets/back/js/plugin/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('assets/back/js/plugin/datatables/dataTables.bootstrap4.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>


	<!-- Bootstrap Notify -->
	<script src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- Chartjs -->
	<script src="{{ asset('assets/back/js/plugin/chart.min.js') }}"></script>

	<!-- Editor -->
	<script src="{{ asset('assets/back/js/plugin/editor.js') }}"></script>
    <script src="{{ asset('assets/back/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Tagify -->
    <script src="{{ asset('assets/back/js/tagify.js') }}"></script>

    <!-- JS Color -->
    <script src="{{ asset('assets/back/js/jscolor.js') }}"></script>

    <!-- Magnific Popup -->
    <script src="{{ asset('assets/back/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- Sortable -->
    <script src="{{ asset('assets/back/js/sortable.js') }}"></script>

    <!-- Icon Picker -->
    <script src="{{ asset('assets/back/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

	<!-- Azzara JS -->
    <script src="{{ asset('assets/back/js/ready.min.js') }}"></script>

	<!-- Azzara JS -->
    <script src="{{ asset('assets/back/js/category.js') }}"></script>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<!-- Custom JS -->
	<script src="{{ asset('assets/back/js/custom.js') }}"></script>
	<script src="{{ asset('assets/back/js/coupon.js') }}"></script>
    @stack('js')
    @yield('scripts')

<script>
	// Confirm Deletion with SweetAlert
	$(document).on("click",".confirmDelete",function(){	
		var record = $(this).attr("record");
		var recordid = $(this).attr("recordid");
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.value) {
		    window.location.href="/admin/delete-"+record+"/"+recordid;		    
		  }
		});
	});

</script>
	

</body>
</html>
