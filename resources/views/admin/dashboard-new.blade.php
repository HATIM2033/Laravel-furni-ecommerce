@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin Panel')

@section('content')
<div class="row">
    <!-- Original Stats Cards -->
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

<!-- Financial Stats Cards -->
<div class="financial-section">
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-chart-line text-success"></i>
                Financial Overview
            </h4>
        </div>
        
        <!-- Total Revenue Card -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card success revenue-pulse">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-value money-value">{{ number_format($totalRevenue, 2) }}</div>
                <div class="stat-label">Total Revenue</div>
                <div class="stat-change">
                    <small class="text-muted">All completed orders</small>
                </div>
            </div>
        </div>
        
        <!-- Today's Revenue Card -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card info">
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div class="stat-value money-value">{{ number_format($todayRevenue, 2) }}</div>
                <div class="stat-label">Today's Revenue</div>
                <div class="stat-change">
                    @if($todayRevenue > 0)
                        <span class="trend-up">
                            <i class="fas fa-arrow-up"></i> Live
                        </span>
                    @else
                        <span class="text-muted">
                            <i class="fas fa-minus"></i> No sales yet
                        </span>
                    @endif
                    <small class="text-muted">Completed today</small>
                </div>
            </div>
        </div>
        
        <!-- Monthly Revenue Card -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card primary">
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-value money-value">{{ number_format($monthlyRevenue, 2) }}</div>
                <div class="stat-label">Monthly Revenue</div>
                <div class="stat-change">
                    <small class="text-muted">{{ now()->format('F') }} {{ now()->year }}</small>
                </div>
            </div>
        </div>
        
        <!-- Average Order Value Card -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card warning">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-value money-value">{{ number_format($averageOrderValue, 2) }}</div>
                <div class="stat-label">Avg Order Value</div>
                <div class="stat-change">
                    <small class="text-muted">Per completed order</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Revenue Cards -->
<div class="financial-section">
    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-hourglass-half text-warning"></i>
                Pending Revenue
            </h4>
        </div>
        
        <!-- Pending Revenue Card -->
        <div class="col-lg-6 col-md-6">
            <div class="stat-card warning">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-value money-value">{{ number_format($pendingRevenue, 2) }}</div>
                <div class="stat-label">Pending Orders</div>
                <div class="stat-change">
                    @if($pendingRevenue > 0)
                        <span class="trend-up">
                            <i class="fas fa-exclamation-triangle"></i> Action needed
                        </span>
                    @else
                        <span class="text-muted">
                            <i class="fas fa-check-circle"></i> All clear
                        </span>
                    @endif
                    <small class="text-muted">Awaiting confirmation</small>
                </div>
            </div>
        </div>
        
        <!-- Processing Revenue Card -->
        <div class="col-lg-6 col-md-6">
            <div class="stat-card info">
                <div class="stat-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <div class="stat-value money-value">{{ number_format($processingRevenue, 2) }}</div>
                <div class="stat-label">Processing Orders</div>
                <div class="stat-change">
                    @if($processingRevenue > 0)
                        <span class="text-info">
                            <i class="fas fa-spinner fa-spin"></i> In progress
                        </span>
                    @else
                        <span class="text-muted">
                            <i class="fas fa-check-circle"></i> No active orders
                        </span>
                    @endif
                    <small class="text-muted">Currently being processed</small>
                </div>
            </div>
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
                                        @if($order->status === 'completed')
                                            <span class="badge-admin badge bg-success">
                                                <i class="fas fa-check me-1"></i>Completed
                                            </span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge-admin badge bg-danger">
                                                <i class="fas fa-times me-1"></i>Cancelled
                                            </span>
                                        @else
                                            <span class="badge-admin badge bg-{{ $order->status === 'pending' ? 'warning' : 'info' }}">
                                                <i class="fas fa-{{ $order->status === 'pending' ? 'clock' : 'truck' }} me-1"></i>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @endif
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
                        <a href="{{ route('admin.products') }}" class="btn btn-admin btn-admin-primary w-100">
                            <i class="fas fa-eye"></i> View Product
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.categories') }}" class="btn btn-admin btn-admin-success w-100">
                            <i class="fas fa-tags"></i> View Category
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.users') }}" class="btn btn-admin btn-admin-success w-100" style="background-color: #ff0000ff;">
                            <i class="fas fa-users me-2"></i>Manage Users
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('admin.orders') }}" class="btn btn-admin btn-admin-success w-100" style="background-color: #ffe600ff;">
                            <i class="fas fa-shopping-cart me-2"></i>View Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
