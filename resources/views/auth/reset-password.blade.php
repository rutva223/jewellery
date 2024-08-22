{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


@extends('auth.layout.master')
@section('title', 'Admin :: ' . __('Password Reset'))

@section('content')

<style>
    .theme-cyan {
        overflow: hidden;
        background: url('https://blogcontrols.fansclubworld.com/public/assets/images/bg.png');
        background-size: cover !important;
        background-position: center;
        height: 100vh;
    }

    label#password-confirm-error {
        color: red;
    }

    .invalid-feedback {
        display: block !important;
        width: 100%;
        margin-top: .25rem;
        font-size: .875em;
        color: var(--bs-form-invalid-color);
    }
</style>

<link rel="stylesheet" href="{{ asset('assets/css/custom-loader.css') }}" />

<div class="container d-flex justify-content-center align-items-center w-100">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="auth-box align-items-center">
                <div class="top text-center mb-4">
                    {{-- <img src="{{ asset('assets/images/black_theme.png') }}" alt="Iconic" class="logo-class"> --}}
                    <h1 style="color: white">iGambling.network</h1>
                </div>

                <div class="body from-outer">
                    <form class="form-auth-small form" action="{{ route('password.store') }}" method="post"
                        id="resetPasswordForm">
                        @csrf
                        @method('POST')
                        <div class="header text-center mb-4">
                            <p class="heading mb-0">Reset Password</p>
                        </div>
                        <input type="hidden" name="id" value="{{ $encrypt_id }}">
                        <div class="form-group">
                            <label for="email" class="control-label sr-only mb-2">Email</label>
                            <input type="email" id="email" class="form-control mb-2 readonly-class" name="email"
                                value="{{ $email_id }}" placeholder="Email" readonly autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="password" class="control-label sr-only mb-2">New Password</label>
                            <div class="input-group mb-2">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="New Password">
                                <span class="toggle-btn-1 input-group-text" id="toggle-btn-1"
                                    onclick="togglePasswordVisibility('password', 'toggle-btn-1')">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <div class="invalid-feedback"></div> <!-- Error message container -->
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm" class="control-label sr-only mb-2">Confirm New
                                Password</label>
                            <div class="input-group mb-2">
                                <input type="password" class="form-control" id="password-confirm"
                                    name="password_confirmation" placeholder="Confirm New Password">
                                <span class="toggle-btn-2 input-group-text" id="toggle-btn-2"
                                    onclick="togglePasswordVisibility('password-confirm', 'toggle-btn-2')">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <div class="invalid-feedback" id="password-confirm-error"></div>
                        </div>
                        <button type="submit" class="btn btn-sm form-control btn-block btn-submit-cls">
                            Reset Password
                        </button>
                        <div class="text-end note">
                            <span class="helper-text control-label"><a href="{{ route('login') }}"
                                    style="text-decoration: underline !important;">Back To Login</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="custom-wrapper d-none">
    <span class="site-loader"> </span>
</div>
@push('after-scripts')

<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>

<script>
    function togglePasswordVisibility(inputId, toggleBtnId) {
        var input = document.getElementById(inputId);
        var toggleBtn = document.getElementById(toggleBtnId);

        if (input.type === "password") {
            input.type = "text";
            toggleBtn.innerHTML = '<i class="fa fa-eye-slash"></i>'; // Change icon to eye-slash
        } else {
            input.type = "password";
            toggleBtn.innerHTML = '<i class="fa fa-eye"></i>'; // Change icon back to eye
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#resetPasswordForm').validate({
            errorElement: 'div',
            errorClass: 'text-danger',
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                password: {
                    required: "Please enter a new password.",
                    minlength: "Your password must be at least 8 characters long."
                },
                password_confirmation: {
                    required: "Please confirm your new password.",
                    equalTo: "Passwords do not match."
                }
            },
            errorPlacement: function(error, element) {
                var $parent = element.closest('.form-group');
                error.appendTo($parent.find('.invalid-feedback'));
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
                if ($(element).hasClass('form-control')) {
                    $(element).siblings('.input-group-text').addClass('is-invalid');
                }
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
                if ($(element).hasClass('form-control')) {
                    $(element).siblings('.input-group-text').removeClass('is-invalid');
                }
            },
        });
    });
</script>
@endpush

@endsection
