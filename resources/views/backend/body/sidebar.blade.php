<div class="sidebar">

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
            <div class="avatar-sm float-left mr-2">
                    <img src="{{ Auth::guard('admin')->user()->photo ? asset('images/admin_images/'.Auth::guard('admin')->user()->photo) : asset('assets/images/placeholder.png') }}" alt="..." class="avatar-img rounded-circle">
                </div> 
             <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::guard('admin')->user()->name }}
                            <span class="user-level">{{ __('Administrator') }}</span>
                        </span>
                    </a>
                </div> 
            </div>

            @if (Auth::guard('admin')->user()->id == 1)
            @include('backend.back_master.inc.super')
            @else
            @include('backend.back_master.inc.normal')
            @endif 

            <div class="sidebar-footer text-primary d-block text-center pt-3">
                <span class="d-inline-block"><b>Version 4.7</b></span>
            </div>

        </div>
    </div>
</div>