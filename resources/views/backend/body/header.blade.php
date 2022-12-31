<div class="main-header " >
    <!-- Logo Header -->
    <div class="logo-header">

        <a href="{{route('admin.dashboard')}}" class="logo">
            <span style="font-weight: 700; font-size: 1.8rem;color:#fc6900">
                Deluxe 
            </span>
 {{-- <img src="{{ $setting->logo ? asset('assets/images/'.$setting->logo) : asset('assets/images/placeholder.png') }}" alt="navbar brand" class="navbar-brand">  --}}
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
        <div class="navbar-minimize">
            <button class="btn btn-minimize ">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item mr-4">
                    <a class="btn btn-sm btn-primary py-1 text-white" title="website"
                     href="{{url('/')}}" target="_blank">
                    <b> {{ __('View Website') }}</b>
                    </a>
                </li>
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" 
                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span  class="badge badge-danger badge-counter">
                        {{ App\Models\Notification::countRegistration() + App\Models\Notification::countOrder() }}</span>
                    </a> 
                    <!-- Dropdown - Alerts -->
                  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" 
                    aria-labelledby="alertsDropdown" id="display-notf" data-href={{ route('admin.notifications') }}>
                        @include('backend.notification.index')
                    </div>
                </li>

                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" 
                    href="{{route('admin.dashboard')}}" aria-expanded="false">
                        <div class="avatar-sm avatar avatar-sm">
                            <img src="{{ Auth::guard('admin')->user()->photo ? asset('images/admin_images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/placeholder.png') }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <li>
                         <div class="user-box">
                                <div class="avatar-lg"><img src="{{ Auth::guard('admin')->user()->photo ? asset('images/admin_images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/placeholder.png') }}" alt="image profile" class="avatar-img rounded"></div>

                                <div class="u-text">
                                    <h4>{{ Auth::guard('admin')->user()->name }}</h4>
                                    <p class="text-muted">{{ Auth::guard('admin')->user()->email }}</p><a href="{{ route('admin.profile') }}" class="btn  btn-secondary btn-sm">{{ __('Update Profile') }}</a>
                                </div>
                            </div> 
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="{{ route('admin.profile') }}">{{ __('Update Profile') }}</a>
                            <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="{{ route('admin.password') }}">{{ __('Change Password') }}</a> 
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}">{{ __('Logout') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>