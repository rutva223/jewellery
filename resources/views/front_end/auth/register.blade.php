@extends('front_end.app')

@section('content')
<div id="title" class="page-title">
    <div class="section-container">
        <div class="content-title-heading">
            <h1 class="text-title-heading">
                Register
            </h1>
        </div>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a><span class="delimiter"></span>Register
        </div>
    </div>
</div>

<div id="content" class="site-content" role="main">
    <div class="section-padding">
        <div class="section-container p-l-r">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                    <div class="register-form-container">
                        <h2 class="text-center mb-4">Create Account</h2>
                        <p class="text-center mb-4 text-muted">Join our community and start shopping!</p>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form id="registerForm" action="{{ route('user-register') }}" method="POST" class="register-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Optional">
                                <div class="invalid-feedback" id="phone-error"></div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password" required minlength="6">
                                    <span class="password-toggle" onclick="togglePassword('password')">
                                        <i class="fa fa-eye" id="password-eye"></i>
                                    </span>
                                </div>
                                <div class="invalid-feedback" id="password-error"></div>
                                <small class="text-muted">Minimum 6 characters</small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                    <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                        <i class="fa fa-eye" id="password_confirmation-eye"></i>
                                    </span>
                                </div>
                                <div class="invalid-feedback" id="password_confirmation-error"></div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="{{ route('terms_condition') }}" target="_blank">Terms & Conditions</a> 
                                        and <a href="{{ route('privacy_policy') }}" target="_blank">Privacy Policy</a>
                                    </label>
                                    <div class="invalid-feedback" id="terms-error"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="button btn-primary w-100" id="registerBtn">
                                    <span class="btn-text">Create Account</span>
                                    <span class="btn-loading d-none">
                                        <i class="fa fa-spinner fa-spin"></i> Creating Account...
                                    </span>
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-4">
                            <p>Already have an account? <a href="{{ route('user.login.form') }}" class="text-decoration-none">Login Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.register-form-container {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.form-control {
    padding: 12px 15px;
    border: 2px solid #e1e1e1;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #333;
    box-shadow: none;
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 10;
}

.button {
    padding: 15px 30px;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #333;
    color: #fff;
}

.btn-primary:hover {
    background-color: #555;
}

.alert {
    padding: 12px 20px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.alert-success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.form-check-input:checked {
    background-color: #333;
    border-color: #333;
}
</style>
@endsection

@push('after-scripts')
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eye = document.getElementById(fieldId + '-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        eye.classList.remove('fa-eye');
        eye.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        eye.classList.remove('fa-eye-slash');
        eye.classList.add('fa-eye');
    }
}

$(document).ready(function() {
    // Password confirmation validation
    $('#password_confirmation').on('keyup', function() {
        const password = $('#password').val();
        const confirmPassword = $(this).val();
        
        if (confirmPassword && password !== confirmPassword) {
            $(this).addClass('is-invalid');
            $('#password_confirmation-error').text('Passwords do not match');
        } else {
            $(this).removeClass('is-invalid');
            $('#password_confirmation-error').text('');
        }
    });
    
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const btn = $('#registerBtn');
        const btnText = $('.btn-text');
        const btnLoading = $('.btn-loading');
        
        // Check password confirmation
        const password = $('#password').val();
        const confirmPassword = $('#password_confirmation').val();
        
        if (password !== confirmPassword) {
            $('#password_confirmation').addClass('is-invalid');
            $('#password_confirmation-error').text('Passwords do not match');
            return;
        }
        
        // Check terms acceptance
        if (!$('#terms').is(':checked')) {
            $('#terms').addClass('is-invalid');
            $('#terms-error').text('Please accept the terms and conditions');
            return;
        }
        
        // Clear previous errors
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').empty();
        
        // Show loading state
        btn.prop('disabled', true);
        btnText.addClass('d-none');
        btnLoading.removeClass('d-none');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    window.location.href = response.redirect;
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(field) {
                        $('#' + field).addClass('is-invalid');
                        $('#' + field + '-error').text(errors[field][0]);
                    });
                } else {
                    alert('Something went wrong. Please try again.');
                }
            },
            complete: function() {
                // Hide loading state
                btn.prop('disabled', false);
                btnText.removeClass('d-none');
                btnLoading.addClass('d-none');
            }
        });
    });
});
</script>
@endpush