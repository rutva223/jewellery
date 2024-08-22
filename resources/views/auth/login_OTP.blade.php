@extends('auth.layout.master')
@section('title', 'Admin :: ' . __('Login'))

@section('content')
    <style>
        .theme-cyan {
            overflow: hidden;
            background: url('https://zaropay.com//images/black_theme.png');
            background-size: cover !important;
            background-position: center;
            height: 100vh;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/css/custom-loader.css') }}" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div class="container d-flex justify-content-center align-items-center w-100">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="auth-box align-items-center">
                    <div class="top text-center mb-4">
                        {{-- <img src="{{ asset('assets/images/black_theme.png') }}" alt="Iconic" class="logo-class"> --}}
                        <h1 style="color: white">iGambling.network</h1>
                    </div>

                    <div class="body from-outer">
                        <form class="form-auth-small form g-3" method="post" action="{{ route('login') }}"
                            name="login_form" id="login-form-otp">
                            @csrf
                            @method('POST')

                            <div class="header text-center mb-4">
                                <p class="heading mb-0">Enter Your OTP</p>
                            </div>

                            <div class="form-group">
                                <input type="email" class="readonly-class form-control mb-2" name="email" id="email_id"
                                    required autocomplete="off" value="{{ Session::get('email') }}" readonly>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control mb-2" name="otp_val" id="otp_val" required
                                    autocomplete="off" placeholder="Enter OTP">
                                <div id="otp-error" class="text-danger"></div>
                            </div>

                            <div class="timer mb-2">OTP Resend in <span id="timer">1 minute
                                    00</span></div>

                            <button type="submit" id="login"
                                class="btn btn-sm form-control btn-block btn-submit-cls">Login</button>
                            &nbsp;

                            <button type="button" id="resend-otp"
                                class="btn btn-sm form-control btn-block btn-submit-cls">Resend OTP?</button>
                            <a href="{{ route('login') }}" style="color: #000000; float: right;"
                                class="lead mt-2">Back to Login?</a>
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
        $(document).ready(function() {
            console.log('adad');
            $('#login-form-otp').submit(function() {
                $('#login').prop('disabled', true);
            });

            $('#resend-otp').hide();

            var otpSent = @json(session('otp_sent', true));
            if (otpSent) {
                startTimer(120); // Start with 2 minutes
            }

            $('#login-form-otp').submit(function(event) {
                $(".custom-wrapper").removeClass('d-none');
                event.preventDefault();
                $('#login').prop('disabled', true);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect_url;
                        } else {
                            $('#login').prop('disabled', false);
                            $('#otp-error').text(response.message); // Display error message
                        }
                        $(".custom-wrapper").addClass('d-none');
                    },
                    error: function(response) {
                        $('#login').prop('disabled', false);
                        $('#otp-error').text('An error occurred. Please try again.');
                    }
                });
            });

            // Clear error message when the user starts typing in the OTP field
            $('#otp_val').on('input', function() {
                $('#otp-error').text('');
            });

            // Handle resend OTP button click
            $('#resend-otp').click(function() {
                $.ajax({
                    url: '{{ route("otpResend") }}', // Adjust the URL to your actual resend OTP route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: $('#email_id').val()
                    },
                    success: function(data) {
                        if (data.status) {
                            Swal.fire({
                                icon: "success",
                                title: "Mail sent successfully!",
                                showConfirmButton: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#otp_val').val('');
                                    startTimer(120); // Call the startTimer function
                                    $('#login').show();
                                    $('#resend-otp').hide();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Mail not sent!",
                                showConfirmButton: true
                            });
                            $('#login').hide();
                            $('#resend-otp').show();
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "An error occurred while resending OTP.",
                            showConfirmButton: true
                        });
                    }
                });
            });
        });

        var timerInterval;

        function startTimer(secondsLeft) {
            console.log(secondsLeft);
            $('.timer').show();
            secondsLeft = parseInt(secondsLeft, 10);
            updateTimerDisplay(secondsLeft);
            var timerInterval = setInterval(function() {
                secondsLeft--;
                localStorage.setItem('secondsLeft', secondsLeft);
                if (secondsLeft < 0) {
                    clearInterval(timerInterval);
                    clearTimerStorage();
                    $('.timer').hide();
                    $('#login').hide();
                    $('#resend-otp').show();

                    $('#otp_val').val('');
                    return;
                }
                updateTimerDisplay(secondsLeft);
            }, 1000);
        }

        function resetTimer() {
            clearInterval(timerInterval);
            clearTimerStorage();
            localStorage.setItem('secondsLeft', 120);
        }

        function updateTimerDisplay(secondsLeft) {
            var minutes = Math.floor(secondsLeft / 60);
            var seconds = secondsLeft % 60;
            $('#timer').text(minutes + ' minute ' + (seconds < 10 ? '0' : '') + seconds + ' seconds');
        }

        function clearTimerStorage() {
            localStorage.removeItem('secondsLeft');
        }

        window.addEventListener('beforeunload', function() {
            clearInterval(timerInterval);
            var secondsLeft = parseInt(localStorage.getItem('secondsLeft'), 10);
            if (secondsLeft && !isNaN(secondsLeft)) {
                localStorage.setItem('secondsLeft', secondsLeft);
            } else {
                clearTimerStorage();
            }
        });
    </script>
@endpush

