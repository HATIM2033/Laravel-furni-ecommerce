@extends('layouts.furni')

@section('title', 'Admin Dashboard - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Admin Dashboard</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Dashboard Section -->
<div class="untree_co-section">
    <div class="container">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Summary Cards -->
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $totalProducts }}</h4>
                                <p class="card-text">Total Products</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fa fa-box fa-2x"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.products') }}" class="btn btn-sm btn-light mt-2">View All</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $totalCategories }}</h4>
                                <p class="card-text">Total Categories</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fa fa-tags fa-2x"></i>
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-light mt-2">Manage</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $totalUsers }}</h4>
                                <p class="card-text">Total Users</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fa fa-users fa-2x"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.users') }}" class="btn btn-sm btn-light mt-2">View All</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title">{{ $totalOrders }}</h4>
                                <p class="card-text">Total Orders</p>
                            </div>
                            <div class="align-self-center">
                                <i class="fa fa-shopping-cart fa-2x"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-light mt-2">View All</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Orders -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="bg-white p-5 rounded shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="h4">Recent Orders</h3>
                        <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-outline-black">View All</a>
                    </div>
                    
                    @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td><strong>{{ $order->order_number }}</strong></td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $order->status === 'completed' ? 'bg-success' : ($order->status === 'pending' ? 'bg-warning' : 'bg-info') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">No orders yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="col-lg-4">
                <!-- Latest Users -->
                <div class="bg-white p-5 rounded shadow-sm mb-4">
                    <h3 class="h4 mb-4">Latest Users</h3>
                    @if($latestUsers->count() > 0)
                        <div class="list-group">
                            @foreach($latestUsers as $user)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                                <span class="badge {{ $user->isAdmin() ? 'bg-danger' : 'bg-primary' }} rounded-pill">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No users yet</p>
                    @endif
                </div>

                <!-- Latest Products -->
                <div class="bg-white p-5 rounded shadow-sm">
                    <h3 class="h4 mb-4">Latest Products</h3>
                    @if($latestProducts->count() > 0)
                        <div class="list-group">
                            @foreach($latestProducts as $product)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $product->name }}</h6>
                                    <small class="text-muted">{{ $product->category->name ?? 'No Category' }}</small>
                                </div>
                                <span class="badge bg-success rounded-pill">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No products yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Dashboard Section -->
@endsection
