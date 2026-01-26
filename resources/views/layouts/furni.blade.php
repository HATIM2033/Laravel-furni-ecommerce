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
		<title>@yield('title', 'Furni - Free Bootstrap 5 Template for Furniture and Interior Design Websites by Untree.co')</title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="{{ route('home') }}">Furni<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
						<li class="nav-item {{ request()->routeIs('shop.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('shop.index') }}">Shop</a></li>
						<li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}"><a class="nav-link" href="{{ route('about') }}">About us</a></li>
						<li class="nav-item {{ request()->routeIs('services') ? 'active' : '' }}"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
						<li class="nav-item {{ request()->routeIs('blog') ? 'active' : '' }}"><a class="nav-link" href="{{ route('blog') }}">Blog</a></li>
						<li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('contact') }}">Contact us</a></li>	
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						@if(auth()->check())
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<img src="{{ asset('images/user.svg') }}">
								</a>
								<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
									<li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
									@if(auth()->user()->isAdmin())
										<li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
									@endif>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
								</ul>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
						@else
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="guestDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<img src="{{ asset('images/user.svg') }}" title="Account">
								</a>
								<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
									<li><a class="dropdown-item" href="{{ route('login') }}">
										<i class="fas fa-sign-in-alt me-2"></i>Login
									</a></li>
									<li><a class="dropdown-item" href="{{ route('register') }}">
										<i class="fas fa-user-plus me-2"></i>Register
									</a></li>
								</ul>
							</li>
						@endif
						<li><a class="nav-link" href="{{ auth()->check() ? route('cart.index') : route('login') }}"><img src="{{ asset('images/cart.svg') }}" title="{{ auth()->check() ? 'Cart' : 'Login to access cart' }}"></a></li>
					</ul>
				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->

		<!-- Flash Messages -->
		@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 80px; right: 20px; z-index: 1050; min-width: 300px;" role="alert">
				<strong>Success!</strong> {{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		@if(session('error'))
			<div class="alert alert-danger alert-dismissible fade show position-fixed" style="top: 80px; right: 20px; z-index: 1050; min-width: 300px;" role="alert">
				<strong>Error!</strong> {{ session('error') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		@if(session('warning'))
			<div class="alert alert-warning alert-dismissible fade show position-fixed" style="top: 80px; right: 20px; z-index: 1050; min-width: 300px;" role="alert">
				<strong>Warning!</strong> {{ session('warning') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		@if(session('info'))
			<div class="alert alert-info alert-dismissible fade show position-fixed" style="top: 80px; right: 20px; z-index: 1050; min-width: 300px;" role="alert">
				<strong>Info!</strong> {{ session('info') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		@yield('content')

		<!-- Start Footer Section -->
		<footer class="footer-section">
			<div class="container relative">

				<div class="sofa-img">
					<img src="{{ asset('images/sofa.png') }}" alt="Image" class="img-fluid">
				</div>

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="{{ asset('images/envelope-outline.svg') }}" alt="Image" class="img-fluid"></span><span>Subscribe to Newsletter</span></h3>

							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">Furni<span>.</span></a></div>
						<p class="mb-4">At Furni, we believe that your home should be a reflection of your personality and a sanctuary of comfort. Specializing in high-quality furniture, we offer a curated selection of premium chairs and sofas designed to blend timeless elegance with modern functionality. Whether you are looking for a cozy sofa to unwind after a long day or stylish seating to complete your dining room, our collection is crafted to meet the highest standards of durability and aesthetic appeal.</p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="{{ route('about') }}">About us</a></li>
									<li><a href="{{ route('services') }}">Services</a></li>
									<li><a href="{{ route('blog') }}">Blog</a></li>
									<li><a href="{{ route('contact') }}">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Our team</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-3">
								<ul class="list-unstyled">
									<li><a href="#">Nordic Chair</a></li>
									<li><a href="#">Kruzo Aero</a></li>
									<li><a href="#">Ergonomic Chair</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> <!-- License information: https://untree.co/license/ -->
            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('js/tiny-slider.js') }}"></script>
		<script src="{{ asset('js/custom.js') }}"></script>
		
		<!-- Flash Message Auto-Hide Script -->
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				// Auto-hide flash messages after 5 seconds
				const alerts = document.querySelectorAll('.alert');
				alerts.forEach(function(alert) {
					setTimeout(function() {
						alert.classList.remove('show');
						alert.classList.add('fade');
						setTimeout(function() {
							alert.remove();
						}, 150);
					}, 5000);
				});

				// Update cart count in navigation
				function updateCartCount() {
					fetch('{{ route("cart.index") }}', {
						headers: {
							'X-Requested-With': 'XMLHttpRequest',
						}
					})
					.then(response => response.text())
					.then(html => {
						const parser = new DOMParser();
						const doc = parser.parseFromString(html, 'text/html');
						const cartCountElement = doc.querySelector('.cart-count');
						if (cartCountElement) {
							const count = parseInt(cartCountElement.textContent.trim());
							updateCartCountDisplay(count);
						}
					})
					.catch(error => console.log('Error updating cart count:', error));
				}

				// Update cart count when page loads
				updateCartCount();
				
				// Listen for cart operations
				// Handle form submissions that modify cart
				document.addEventListener('submit', function(e) {
					const form = e.target;
					const action = form.getAttribute('action');
					
					if (action && action.includes('cart.add')) {
						// Product added to cart
						setTimeout(updateCartCount, 100);
					}
				});

				// Handle AJAX cart updates
				const originalFetch = window.fetch;
				window.fetch = function(...args) {
					const [url, options] = args;
					
					return originalFetch.apply(this, args).then(response => {
						// Update cart count after cart operations
						if (url.includes('cart.update') || url.includes('cart.remove') || url.includes('cart.clear')) {
							response.clone().json().then(data => {
								if (data.cartCount !== undefined) {
									updateCartCountDisplay(data.cartCount);
								} else {
									setTimeout(updateCartCount, 100);
								}
							}).catch(() => {
								setTimeout(updateCartCount, 100);
							});
						}
						
						return response;
					});
				};

				// Function to update cart count display
				function updateCartCountDisplay(count) {
					const existingCount = document.querySelector('.cart-count');
					if (existingCount) {
						existingCount.textContent = count;
					} else {
						// Create cart count badge if it doesn't exist
						const cartLink = document.querySelector('a[href*="cart"]');
						if (cartLink) {
							const badge = document.createElement('span');
							badge.className = 'cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger';
							badge.style.fontSize = '0.6rem';
							badge.style.padding = '2px 5px';
							badge.textContent = count;
							cartLink.style.position = 'relative';
							cartLink.appendChild(badge);
						}
					}
					
					// Hide badge if cart is empty
					if (count === 0) {
						const badge = document.querySelector('.cart-count');
						if (badge) {
							badge.style.display = 'none';
						}
					} else {
						const badge = document.querySelector('.cart-count');
						if (badge) {
							badge.style.display = 'inline-block';
						}
					}
				}

				// Handle cart update and remove buttons
				document.addEventListener('click', function(e) {
					const target = e.target;
					
					// Check if clicked element is part of cart operation
					if (target.closest('form[action*="cart.add"]')) {
						setTimeout(updateCartCount, 100);
					}
					
					// Handle AJAX cart operations
					if (target.closest('.update-cart') || target.closest('.remove-item')) {
						setTimeout(updateCartCount, 100);
					}
				});
			});
		</script>
		
		@stack('scripts')
	</body>

</html>
