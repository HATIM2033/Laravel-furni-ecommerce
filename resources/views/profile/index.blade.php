@extends('layouts.furni')

@section('title', 'My Profile - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>My Profile</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Profile Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <!-- Profile Information -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="bg-white p-5 rounded shadow-sm">
                    <h2 class="section-title mb-4">Profile Information</h2>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-black">Full Name</label>
                            <p class="form-control-plaintext">{{ auth()->user()->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-black">Email Address</label>
                            <p class="form-control-plaintext">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-black">Role</label>
                            <p class="form-control-plaintext">
                                <span class="badge {{ auth()->user()->isAdmin() ? 'bg-danger' : 'bg-primary' }}">
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-black">Member Since</label>
                            <p class="form-control-plaintext">{{ auth()->user()->created_at->format('M d, Y') }}</p>
                        </div>
                        @if(auth()->user()->phone)
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-black">Phone Number</label>
                            <p class="form-control-plaintext">{{ auth()->user()->phone }}</p>
                        </div>
                        @endif
                        @if(auth()->user()->address)
                        <div class="col-md-12 mb-3">
                            <label class="form-label text-black">Address</label>
                            <p class="form-control-plaintext">
                                @if(is_array(auth()->user()->address))
                                    {{ auth()->user()->address['street'] ?? '' }}, 
                                    {{ auth()->user()->address['city'] ?? '' }}, 
                                    {{ auth()->user()->address['state'] ?? '' }} 
                                    {{ auth()->user()->address['zip'] ?? '' }}
                                @else
                                    {{ auth()->user()->address }}
                                @endif
                            </p>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-black">Edit Profile</a>
                    </div>
                </div>
            </div>
            
            <!-- Account Actions -->
            <div class="col-lg-4">
                <div class="bg-white p-5 rounded shadow-sm">
                    <h3 class="mb-4">Account Actions</h3>
                    
                    <!-- User Orders -->
                    <div class="mb-4">
                        <h4 class="h6 mb-3">My Orders</h4>
                        <p class="text-muted small mb-3">View your order history and track current orders</p>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-black btn-sm">View Orders</a>
                    </div>
                    
                    <!-- Logout -->
                    <div class="mb-4">
                        <h4 class="h6 mb-3">Account Security</h4>
                        <p class="text-muted small mb-3">Sign out of your account</p>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-black btn-sm">Logout</button>
                        </form>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="bg-light p-5 rounded mt-4">
                    <h3 class="mb-4">Quick Stats</h3>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Orders:</span>
                        <strong>{{ auth()->user()->orders()->count() }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Account Status:</span>
                        <strong class="text-success">Active</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Profile Section -->
@endsection
