@extends('backend.auth.login_master')

@section('content')

        <div class="wrapper wrapper-login">
            <div class="container container-login animated fadeIn">
                <h3 class="text-center">{{ __('Sign In To Admin') }}</h3>
                <div class="login-form">

                    <form action="{{ route('admin.login') }}" method="POST">

                        @csrf

                       @include('alerts.alerts') 

                        <div class="form-group form-floating-label">
                            <input id="username" name="email" 
                            type="email" class="form-control input-border-bottom" 
                           style="border: 1px solid #333">
                            <label for="username" class="placeholder">{{ __('Email Address') }}</label>
                        </div>
                        <div class="form-group form-floating-label">
                            <input id="password" name="password" type="password"
                             class="form-control input-border-bottom"style="border: 1px solid #333">
                            <label for="password" class="placeholder">{{ __('Password') }}</label>
                            
                        </div>

                        <div class="row justify-content-center form-sub m-0">
                            <a href="{{ route('admin.forgot') }}" 
                            class="link float-right">{{ __('Forget Password ?') }}</a>
                        </div>

                        <div class="form-action mb-3">
                            <button type="submit" class="btn btn-secondary  btn-login">
                                {{ __('Sign In') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

@endsection
