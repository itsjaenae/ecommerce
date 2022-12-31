
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
@if (isset($setting))
    
@if (url()->current() == url('/'))
<title>@yield('hometitle')</title>
@else
<title>{{$setting->title}} -@yield('title')</title>
@endif

<!-- SEO Meta Tags-->
@yield('meta')
<meta name="author" content="{{$setting->title}}">
<meta name="distribution" content="web">
<!-- Mobile Specific Meta Tag-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicon Icons-->
<link rel="icon" type="image/png" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/'.$setting->favicon)}}">
<link rel="apple-touch-icon" sizes="167x167" href="{{asset('assets/images/'.$setting->favicon)}}">

<!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
<link rel="stylesheet" media="screen" href="{{asset('assets/front/css/plugins.min.css')}}">
@yield('styleplugins')

<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/styles.min.css')}}">
<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/custom.css')}}">
<link id="mainStyles" rel="stylesheet" media="screen" href="{{asset('assets/front/css/responsive.css')}}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Color css -->
<link href="{{ asset('assets/front/css/color.php?primary_color=').str_replace('#','',$setting->primary_color) }}" rel="stylesheet">
<link href="{{ asset('assets/front/css/background_color.php?background_color=').str_replace('#','',$setting->background_color) }}" rel="stylesheet">

<!-- Modernizr-->
<script src="{{asset('assets/front/js/modernizr.min.js')}}"></script>

@if(DB::table('languages')->where('is_default',1)->first()->rtl == 1 )
    <link rel="stylesheet" href="{{asset('assets/front/css/rtl.css')}}">
@endif
<style>
    {{$setting->custom_css}}
</style>
{{-- Google AdSense Start --}}
@if ($setting->is_google_adsense == '1')
    {!! $setting->google_adsense !!}
@endif
{{-- Google AdSense End --}}

{{-- Google AnalyTics Start --}}
@if ($setting->is_google_analytics == '1')
    {!! $setting->google_analytics !!}
@endif
{{-- Google AnalyTics End --}}

{{-- Facebook pixel  Start --}}
@if ($setting->is_facebook_pixel == '1')
    {!! $setting->facebook_pixel !!}
@endif
{{-- Facebook pixel End --}}
@endif
</head>
@if (isset($setting))
<!-- Body-->
<body class="
@if($setting->theme == 'theme1')
body_theme1
@elseif($setting->theme == 'theme2')
body_theme2
@elseif($setting->theme == 'theme3')
body_theme3
@elseif($setting->theme == 'theme4')
body_theme4
@endif
">
{{-- @if($setting->is_loader == 1) --}}
<!-- Preloader Start -->
@if ($setting->is_loader == 1)
<div id="preloader">
    <img src="{{ asset('assets/images/'.$setting->loader) }}" alt="{{ __('Loading...') }}">
</div>
@endif

<!-- Preloader endif -->
{{-- @endif --}}

<!-- Header-->
@include('frontend.common.header')
<!-- Page Content-->
@yield('content')

<a class="announcement-banner" href="#announcement-modal"></a>
<div id="announcement-modal" class="mfp-hide white-popup">
    @if ($setting->announcement_type == 'newletter')
        <div class="announcement-with-content">
            <div class="left-area">
                <img src="{{ asset('assets/images/'.$setting->announcement) }}" alt="">
            </div>
            <div class="right-area">
                <h3 class="">{{  $setting->announcement_title }}</h3>
                <p>{{ $setting->announcement_details }}</p>
                <form class="subscriber-form" action="{{route('front.subscriber.submit')}}" method="post">
                    @csrf
                    <div class="input-group">
                        <input class="form-control" type="email" name="email" placeholder="{{__('Your e-mail')}}">
                        <span class="input-group-addon"><i class="icon-mail"></i></span> </div>
                    <div aria-hidden="true">
                        <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                    </div>

                    <button class="btn btn-primary btn-block mt-2" type="submit">
                        <span>{{__('Subscribe')}}</span>
                    </button>
                </form>
            </div>
        </div>
    @else
        <a href="{{ $setting->announcement_link }}">
            <img src="{{ asset('assets/images/'.$setting->announcement) }}" alt="">
        </a>
    @endif


</div>
{{-- <!--    announcement banner section start   -->
@include('frontend.common.subscribe_alert')
<!--    announcement banner section end   --> --}}

<!-- Site Footer-->
@include('frontend.common.footer')

<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#">
    <i class="icon-chevron-up"></i>
</a>
<!-- Backdrop-->
<div class="site-backdrop"></div>

<!-- Cookie alert dialog  -->
@if ($setting->is_cookie == 1)
@include('cookieConsent::index')
@endif

<!-- Cookie alert dialog  -->


@php
    $mainbs = [];
    $mainbs['is_announcement'] = $setting->is_announcement;
    $mainbs['announcement_delay'] = $setting->announcement_delay;
    $mainbs['overlay'] = $setting->overlay;
    $mainbs = json_encode($mainbs);
@endphp

<script>
    var mainbs = {!! $mainbs !!};
    var decimal_separator = '{!! $setting->decimal_separator !!}';
    var thousand_separator = '{!! $setting->thousand_separator !!}';
</script>

<script>
    let language = {
        Days : '{{__('Days')}}',
        Hrs : '{{__('Hrs')}}',
        Min : '{{__('Min')}}',
        Sec : '{{__('Sec')}}',
    }

</script>





<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
<script type="text/javascript" src="{{asset('assets/front/js/plugins.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/scripts.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazy.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazy.plugin.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/myscript.js')}}"></script>


@yield('script')

@if($setting->is_facebook_messenger	== '1')
 {!!  $setting->facebook_messenger !!}
@endif



<script type="text/javascript">
    let mainurl = '{{url('/')}}';

    let view_extra_index = 0;
      // Notifications
      function SuccessNotification(title){
            $.notify({
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-check-circle'
                },{
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }

        function DangerNotification(title){
            $.notify({
                // options
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-exclamation-triangle'
                },{
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }
        // Notifications Ends
    </script>

    @if(Session::has('error'))
    <script>
      $(document).ready(function(){
        DangerNotification('{{Session::get('error')}}')
      })

    </script>
    @endif
    @if(Session::has('success'))
    <script>
      $(document).ready(function(){
        SuccessNotification('{{Session::get('success')}}');
      })

    </script>
    @endif


 
   

</body>

@endif
</html>
