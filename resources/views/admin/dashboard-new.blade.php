@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-lg-3 col-md-6">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-value">{{ $totalProducts }}</div>
            <div class="stat-label">Total Products</div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-value">{{ $totalCategories }}</div>
            <div class="stat-label">Categories</div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card info">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Orders</h5>
                <a href="{{ route('admin.orders') }}" class="btn btn-admin btn-admin-primary btn-sm">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body">
                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="table admin-table">
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
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $order->user->name }}</div>
                                                <small class="text-muted">{{ $order->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                    <td>
                                        <span class="badge-admin badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
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
                        <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No orders yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-lg-4">
        <!-- Latest Users -->
        <div class="admin-card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Latest Users</h5>
            </div>
            <div class="card-body">
                @if($latestUsers->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($latestUsers as $user)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3" style="width: 35px; height: 35px; font-size: 0.9rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>
                            <span class="badge-admin badge bg-{{ $user->isAdmin() ? 'danger' : 'primary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No users yet</p>
                @endif
            </div>
        </div>

        <!-- Latest Products -->
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">Latest Products</h5>
            </div>
            <div class="card-body">
                @if($latestProducts->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($latestProducts as $product)
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <div class="fw-bold">{{ $product->name }}</div>
                                <small class="text-muted">{{ $product->category->name ?? 'No Category' }}</small>
                            </div>
                            <span class="badge-admin badge bg-success">
                                ${{ number_format($product->price, 2) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No products yet</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-admin btn-admin-primary w-100">
                            <i class="fas fa-plus me-2"></i>Add Product
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-admin btn-admin-success w-100">
                            <i class="fas fa-plus me-2"></i>Add Category
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-admin btn-admin-info w-100">
                            <i class="fas fa-users me-2"></i>Manage Users
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.orders') }}" class="btn btn-admin btn-admin-warning w-100">
                            <i class="fas fa-shopping-cart me-2"></i>View Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
