{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('auth.layout.master')
@section('title', 'Admin :: ' . __('Login'))

@section('content')

<style>
    .theme-cyan {
        overflow: hidden;
        background: url('https://blogcontrols.fansclubworld.com/public/assets/images/bg.png') no-repeat center center;
        background-size: cover !important;
        background-position: center;
        height: 100vh;
    }
</style>

<div class="container d-flex justify-content-center align-items-center w-100">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="auth-box align-items-center">
                <div class="top text-center mb-4">
                    {{-- <img src="{{ asset('front_end/media/logo-white.png') }}" alt="MintCoin-Logo" class="logo-class"> --}}
                    <h1 style="color: white">iGambling.network</h1>
                </div>
                @if (session('error_msg'))
                    <div class="ResponseMessage alert alert-danger alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                            </polygon>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        <strong>Error!</strong> {{ $errorMessage ?? 'Invalid email or password.!' }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                            <span><i class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                @endif
                <div class="body from-outer">
                    <form class="form-auth-small form" action="{{ route('SendOTP') }}" name="user_login" id="login-form"
                        method="post">
                        @csrf
                        @method('POST')
                        <div class="header text-center mb-4">
                            <p class="heading mb-0">Login to your account</p>
                            <p class="lead">Welcome back! Please enter your details.
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="email_id" class="control-label sr-only mb-2">Email</label>
                            <input type="email" class="form-control mb-2" placeholder='Enter Email' name="email"
                                id='email_id' required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label sr-only mb-2">Password</label>
                            <div class="input-group  mb-2">
                                <input type="password" class="form-control" type="password" placeholder='Enter password'
                                    name="password" id='password' required autocomplete="off">
                                <span class="password-toggle input-group-text" onclick="togglePasswordVisibility()">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="text-end mb-3">
                            <span class="helper-text mb-5 control-label"><a
                                    href="{{ route('password.request') }}">Forgot password?</a></span>
                        </div>
                        <button type="submit" class="btn btn-sm form-control btn-block btn-submit-cls"
                                id="login_frm_submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="custom-wrapper d-none">
    <span class="site-loader"> </span>
</div>

@endsection

@push('after-scripts')
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script>
        // Clear input values on page load
        document.addEventListener('DOMContentLoaded', function() {
            let email = document.getElementById('email_id');
            let pass = document.getElementById('password');

            const value2 = email ? email.value : '';
            const value3 = pass ? pass.value : '';
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#login-form').submit(function() {
                $('#login_frm_submit').prop('disabled', true);
                $(".custom-wrapper").removeClass('d-none');
            });
        });
    </script>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var passwordToggle = document.querySelector('.password-toggle');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                passwordToggle.innerHTML = '<i class="fa fa-eye"></i>';
            }
        }
        setTimeout(function() {
            $('.ResponseMessage').css("display", "none");
        }, 2000);
    </script>

@endpush
