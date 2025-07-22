@extends('front_end.app')

@section('content')
<div id="title" class="page-title">
    <div class="section-container">
        <div class="content-title-heading">
            <h1 class="text-title-heading">
                Login
            </h1>
        </div>
        <div class="breadcrumbs">
            <a href="{{ route('home') }}">Home</a><span class="delimiter"></span>Login
        </div>
    </div>
</div>

<div id="content" class="site-content" role="main">
    <div class="section-padding">
        <div class="section-container p-l-r">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                    <div class="login-form-container">
                        <h2 class="text-center mb-4">Welcome Back!</h2>
                        
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

                        <form id="loginForm" action="{{ route('user-login') }}" method="POST" class="login-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <span class="password-toggle" onclick="togglePassword('password')">
                                        <i class="fa fa-eye" id="password-eye"></i>
                                    </span>
                                </div>
                                <div class="invalid-feedback" id="password-error"></div>
                            </div>
                            
                            <div class="form-group d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none">Forgot Password?</a>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="button btn-primary w-100" id="loginBtn">
                                    <span class="btn-text">Login</span>
                                    <span class="btn-loading d-none">
                                        <i class="fa fa-spinner fa-spin"></i> Logging in...
                                    </span>
                                </button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-4">
                            <p>Don't have an account? <a href="{{ route('user.register.form') }}" class="text-decoration-none">Create Account</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.login-form-container {
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
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const btn = $('#loginBtn');
        const btnText = $('.btn-text');
        const btnLoading = $('.btn-loading');
        
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