<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<title>Register - Furni</title>
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

<!-- Start Hero & Register Section -->
<div class="container-fluid py-5" style="min-height: 100vh; background-image: url('{{ asset('images/reg1.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center" style="min-height: 80vh;">
            
            <!-- Left Side - Hero Section -->
            <div class="col-lg-6 text-white px-4 px-lg-5 d-none d-lg-block">
                <h1 class="display-4 fw-bold mb-3">Create Account</h1>
                <p class="fs-5 mb-5">Join us today and enjoy exclusive offers, faster checkout, and personalized recommendations.</p>
                
                <div class="mt-5">
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-white bg-opacity-25 rounded-3 p-3 me-3">
                            <i class="fas fa-gift fs-5"></i>
                        </div>
                        <div>
                            <h5 class="mb-2">Exclusive Offers</h5>
                            <p class="mb-0 opacity-75 small">Get access to special discounts and promotions</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-4">
                        <div class="bg-white bg-opacity-25 rounded-3 p-3 me-3">
                            <i class="fas fa-bolt fs-5"></i>
                        </div>
                        <div>
                            <h5 class="mb-2">Faster Checkout</h5>
                            <p class="mb-0 opacity-75 small">Save your information for quick purchases</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start">
                        <div class="bg-white bg-opacity-25 rounded-3 p-3 me-3">
                            <i class="fas fa-star fs-5"></i>
                        </div>
                        <div>
                            <h5 class="mb-2">Personalized Experience</h5>
                            <p class="mb-0 opacity-75 small">Get recommendations tailored just for you</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="col-lg-6 px-4 px-lg-5">
                    <div class="bg-white shadow-lg p-5" style="border-radius: 30px;">
                    <h2 class="fw-bold mb-2 text-center">Create Your Account</h2>
                    <p class="text-muted text-center mb-4 small">Fill in your details to get started</p>

                    <form method="POST" action="{{ route('register') }}" onsubmit="console.log('Form submitting...'); return true;">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-user me-2 text-primary"></i>Full Name
                            </label>
                            <input type="text" 
                                   id="name" 
                                   class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus 
                                   autocomplete="name"
                                   placeholder="Enter your full name"
                                   style="padding: 12px 20px; border: 2px solid #e0e0e0; transition: all 0.3s;"
                                   onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 0.2rem rgba(102, 126, 234, 0.25)'"
                                   onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                            @error('name')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                            </label>
                            <input type="email" 
                                   id="email" 
                                   class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email"
                                   placeholder="your@email.com"
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
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-lock me-2 text-primary"></i>Password
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       id="password" 
                                        class="form-control form-control-lg rounded-3 pe-5 @error('password') is-invalid @enderror password-no-reveal"
                                       name="password" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Create a strong password"
                                       style="padding: 12px 20px; border: 2px solid #e0e0e0; transition: all 0.3s;"
                                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 0.2rem rgba(102, 126, 234, 0.25)'"
                                       onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                                <button type="button" 
                                        class="position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent"
                                        onclick="togglePassword('password', 'toggleIcon1')"
                                        style="z-index: 10; padding: 0 15px; outline: none;">
                                    <i class="fas fa-eye" id="toggleIcon1" style="color: grey; font-size: 18px; cursor: pointer;"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-2 d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-lock me-2 text-primary"></i>Confirm Password
                            </label>
                            <div class="position-relative">
                                <input type="password" 
                                       id="password_confirmation" 
                                        class="form-control form-control-lg rounded-3 pe-5 @error('password_confirmation') is-invalid @enderror password-no-reveal" 
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Confirm your password"
                                       style="padding: 12px 20px; border: 2px solid #e0e0e0; transition: all 0.3s;"
                                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 0.2rem rgba(102, 126, 234, 0.25)'"
                                       onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='none'">
                                <button type="button" 
                                        class="position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent"
                                        onclick="togglePassword('password_confirmation', 'toggleIcon2')"
                                        style="z-index: 10; padding: 0 15px; outline: none;">
                                    <i class="fas fa-eye" id="toggleIcon2" style="color: grey; font-size: 18px; cursor: pointer;"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger small mt-2 d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Role (Hidden - defaults to user) -->
                        <input type="hidden" name="role" value="user">

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" 
                                    id="registerBtn"
                                    class="btn btn-lg py-2 text-white fw-semibold" 
                                    style="background: linear-gradient(135deg, rgb(48, 48, 48) 0%, rgb(0, 85, 50) 100%); border: none;"
                                    onclick="showLoading(this)">
                                <i class="fas fa-user-plus me-2"></i>
                                <span class="btn-text">Create Account</span>
                                <span class="btn-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>
                                    Creating account...
                                </span>
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="text-center my-3">
                            <span class="text-muted small">OR</span>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="mb-0 small text-muted">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: #667eea;">
                                    Sign in here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);
    
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

function showLoading(button) {
    const btnText = button.querySelector('.btn-text');
    const btnLoading = button.querySelector('.btn-loading');
    
    // Show loading state
    btnText.style.display = 'none';
    btnLoading.style.display = 'inline-block';
    
    // Let the form submit naturally, don't disable the button immediately
    // The form will submit and redirect, so no need for timeout reset
}

// Password strength checker
function checkPasswordStrength(password) {
    const strength = document.getElementById('passwordStrength');
    if (!strength || !password) return;
    
    let score = 0;
    let feedback = '';
    
    if (password.length >= 8) score += 1;
    if (password.match(/[a-z]/)) score += 1;
    if (password.match(/[A-Z]/)) score += 1;
    if (password.match(/[0-9]/)) score += 1;
    if (password.match(/[^a-zA-Z0-9]/)) score += 1;
    
    if (score < 2) {
        feedback = 'Weak';
        strength.className = 'text-danger';
    } else if (score < 4) {
        feedback = 'Fair';
        strength.className = 'text-warning';
    } else {
        feedback = 'Strong';
        strength.className = 'text-success';
    }
    
    strength.textContent = feedback;
}
</script>

<style>
/* Enhanced Form Styles */
.form-check {
    position: relative;
    padding-left: 35px;
    margin-bottom: 1rem;
}

/* Hide browser's default password reveal button */
input[type="password"]::-ms-reveal,
input[type="password"]::-ms-clear {
    display: none;
}

input[type="password"]::-webkit-contacts-auto-fill-button,
input[type="password"]::-webkit-credentials-auto-fill-button {
    visibility: hidden;
    display: none !important;
    pointer-events: none;
    height: 0;
    width: 0;
    margin: 0;
}

.password-no-reveal::-ms-reveal {
    display: none !important;
}

.password-no-reveal::-webkit-credentials-auto-fill-button,
.password-no-reveal::-webkit-textfield-decoration-container > div {
    display: none !important;
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
<!-- End Hero & Register Section -->
 </body>
</html>
