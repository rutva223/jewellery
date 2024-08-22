
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
        label#email-error {
            color: red;
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
                    <form class="form-auth-small form" action="{{ route('password.email') }}" method="post" id="forgotPasswordForm">
                        @csrf
                        @method('POST')
                        <div class="header text-center mb-4">
                            <p class="heading mb-0">Forgot Your Password ?</p>
                            <hr>
                            <p>
                                To reset your account password, enter your registered email. We'll send a secure
                                link via email for you to reset your password.
                            </p>
                        </div>
                        <div class="form-group mb-4">
                            <label for="email" class="control-label sr-only mb-2">Email</label>
                            <input type="email" class="form-control mb-2" id="email" value="" autocomplete="email"
                                placeholder="Enter Email" name="email">
                        </div>

                        <button type="submit" class="btn btn-sm form-control btn-block btn-submit-cls" id="email-frm-submit">
                            Send Password Reset Link</button>

                        <div class="text-center mt-3 forget-password">Already have an account?
                            <span class="helper-text control-label"> <a href="{{ route('login') }}">Back To
                                    Login</a></span>
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
    @if (session('success'))
        <script>
            // Display SweetAlert with success message
            Swal.fire({
                icon: 'success',
                title: 'Email Sent',
                text: '{{ session('success') }}',
                allowOutsideClick: false,
                didClose: () => {
                    window.location.replace("{{ route('login') }}");
                }
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: "Sorry, we couldn't find your account in our system. Please double-check your information and try again or contact support for assistance.",
                icon: "error",
                allowOutsideClick: false,
                didClose: () => {
                    window.location.replace("{{ route('login') }}");
                }
            });
        </script>
    @else
    @endif

    <script>
        $(document).ready(function() {
            // Initialize validation
            $('#forgotPasswordForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address.",
                        email: "Please enter a valid email address."
                    }
                },
                submitHandler: function(form) {
                    $('.custom-wrapper').removeClass('d-none'); // Show loader

                    $.ajax({
                        url: $(form).attr('action'),
                        type: $(form).attr('method'),
                        data: $(form).serialize(),
                        success: function(response) {
                            $('.custom-wrapper').addClass('d-none'); // Hide loader

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Email Sent',
                                    text: response.success,
                                    allowOutsideClick: false,
                                    didClose: () => {
                                        window.location.replace("{{ route('login') }}");
                                    }
                                });
                            } else if (response.error) {
                                Swal.fire({
                                    title: "Error!",
                                    text: response.error,
                                    icon: "error",
                                    allowOutsideClick: false,
                                    didClose: () => {
                                        // Optionally redirect or stay on the same page
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            $('.custom-wrapper').addClass('d-none'); // Hide loader
                            Swal.fire({
                                title: "Error!",
                                text: "An unexpected error occurred. Please try again.",
                                icon: "error",
                                allowOutsideClick: false
                            });
                        }
                    });
                    return false; // Prevent default form submission
                }
            });
        });
    </script>
@endpush

@endsection
