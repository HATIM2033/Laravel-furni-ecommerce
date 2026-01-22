<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<title>@yield('title', 'Login - Furni')</title>
	</head>

	<body>


<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="{{ route('home') }}">Furni<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
</div>
</nav>

<!-- Start Hero & Login Section -->
<!-- Start Hero & Login Section -->
<div class="container-fluid py-5" style="min-height: 100vh; background-image: url('{{ asset('images/log.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center" style="min-height: 80vh;">
            
            <!-- Left Side - Hero Section -->
            <div class="col-lg-6 text-white mb-5 mb-lg-0">
                <div class="pe-lg-5">
                    <h1 class="display-3 fw-bold mb-4">Welcome Back</h1>
                    <p class="lead mb-4">Sign in to your account to access your orders, profile, and more.</p>
                    
                    <div class="mt-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-white bg-opacity-25 rounded-3 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-shopping-bag fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Track Your Orders</h5>
                                <p class="mb-0 opacity-75">View your order history and track current orders</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-white bg-opacity-25 rounded-3 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Manage Profile</h5>
                                <p class="mb-0 opacity-75">Update your personal information anytime</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-25 rounded-3 p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-phone-alt fs-4"></i>
                            </div>
                        <div>
        <h5 class="mb-1 fw-bold">CONTACT US</h5>
        <p class="mb-0 opacity-75">Get in touch for any questions or support</p>
    </div>
</div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="col-lg-6">
                <div class="bg-white shadow-lg p-5" style="border-radius: 30px;">
                    <h2 class="fw-bold mb-2 text-center">Sign In</h2>
                    <p class="text-muted text-center mb-4">Enter your credentials to continue</p>
                    
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

<!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                            </label>
                            <input type="email" 
                                   id="email" 
                                   class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="email"
                                   placeholder="Enter your email"
                                   style="padding: 12px 20px; border: 2px solid #e0e0e0; transition: all 0.3s;"
                                   onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 0.2rem rgba(102, 126, 234, 0.25)'"
                                   onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                            @error('email')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-lock me-2 text-primary"></i>Password
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       id="password" 
                                       class="form-control form-control-lg rounded-3 pe-5 @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       placeholder="Enter your password"
                                       style="padding: 12px 20px; border: 2px solid #e0e0e0; transition: all 0.3s;"
                                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 0.2rem rgba(102, 126, 234, 0.25)'"
                                       onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                                <button type="button" 
                                    class="position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent"
                                    onclick="togglePassword()"
                                    style="z-index: 10; padding: 0 15px; outline: none;">
                                     <i class="fas fa-eye" id="toggleIcon" style="color: Grey; font-size: 18px; cursor: pointer;"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-2 d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <script>
                        function togglePassword() {
                            const passwordInput = document.getElementById('password');
                            const toggleIcon = document.getElementById('toggleIcon');
                            
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                toggleIcon.classList.remove('fa-eye');
                                toggleIcon.classList.add('fa-eye-slash');
                            } else {
                                passwordInput.type = 'password';
                                toggleIcon.classList.remove('fa-eye-slash');
                                toggleIcon.classList.add('fa-eye');
                            }
                        }
                        </script>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="remember_me" 
                                       name="remember">
                                <label class="form-check-label" for="remember_me">

                                    Remember me
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small text-primary">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-4">
                            <button type="submit" 
                                    id="loginBtn"
                                    class="btn btn-primary btn-lg py-3 fw-semibold" 
                                    style="background: linear-gradient(135deg, rgb(48, 48, 48) 0%, rgb(0, 85, 50) 100%); border: none;"
                                    onclick="showLoading(this)">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                <span class="btn-text">Sign In</span>
                                <span class="btn-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>
                                    Signing in...
                                </span>
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="position-relative mb-4">
                            <hr class="text-muted">
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">
                                OR
                            </span>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="mb-0 text-muted">
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color: #667eea;">
                                    Create one here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Hero & Login Section -->

<style>
/* Enhanced Form Styles */
.form-check {
    position: relative;
    padding-left: 35px;
    margin-bottom: 1rem;
}

.form-check-input {
    width: 20px;
    height: 20px;
    border: 2px solid #e0e0e0;
    border-radius: 4px;
    background-color: #fff;
    transition: all 0.3s;
}

.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.form-check-label {
    cursor: pointer;
    user-select: none;
    color: #495057;
    font-size: 0.875rem;
    line-height: 1.5;
}

.checkmark {
    position: absolute;
    top: 2px;
    left: 6px;
    width: 12px;
    height: 12px;
    border: 2px solid #667eea;
    border-radius: 2px;
    background-color: #fff;
    transition: all 0.3s;
}

.form-check-input:checked ~ .checkmark {
    background-color: #667eea;
}

.form-check-input:checked ~ .checkmark:after {
    display: block;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
    left: 4px;
    top: 4px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

/* Enhanced Button Styles */
.btn-loading {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

/* Enhanced Input Focus States */
.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
    outline: 0 !important;
}

.form-control.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

/* Enhanced Error Display */
.invalid-feedback {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.875rem;
    color: #dc3545;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    border-radius: 6px;
    padding: 12px 16px;
    margin-top: 8px;
}

.invalid-feedback i {
    font-size: 1rem;
    flex-shrink: 0;
}

/* Enhanced Link Styles */
.text-primary {
    color: #667eea !important;
    text-decoration: none !important;
    transition: color 0.3s;
}

.text-primary:hover {
    color: #0056b3 !important;
    text-decoration: underline !important;
}

/* Remove footer from login page */
body {
    overflow-x: hidden;
}

footer {
    display: none !important;
}

/* Full height layout */
.container-fluid {
    min-height: 100vh;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .container-fluid {
        padding: 0 15px;
    }
    
    .form-control {
        font-size: 16px; /* Larger on mobile */
    }
    
    .btn {
        padding: 12px 24px; /* Larger touch targets */
    }
}
</style>



                    </body>
                    </html>