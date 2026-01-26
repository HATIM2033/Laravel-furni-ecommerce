@extends('admin.layouts.app')

@section('title', 'User Details - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>User Details</h2>
    <div>
        <a href="{{ route('admin.users') }}" class="btn btn-admin btn-admin-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-admin btn-admin-primary">
            <i class="fas fa-edit me-1"></i> Edit User
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">{{ $user->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-muted mb-3">User Information</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>User ID:</strong></td>
                        <td>#{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Role:</strong></td>
                        <td>
                            <span class="badge-admin badge bg-{{ $user->isAdmin() ? 'danger' : 'primary' }}">
                                <i class="fas fa-{{ $user->isAdmin() ? 'user-shield' : 'user' }} me-1"></i>
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Joined:</strong></td>
                        <td>{{ $user->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-3">Order Statistics</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Total Orders:</strong></td>
                        <td>{{ $user->orders->count() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Spent:</strong></td>
                        <td>${{ number_format($user->orders->sum('total_amount'), 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Last Order:</strong></td>
                        <td>
                            @if($user->orders->count() > 0)
                                {{ $user->orders->first()->created_at->format('M d, Y') }}
                            @else
                                No orders yet
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Recent Orders -->
        @if($user->orders->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="text-muted mb-3">Recent Orders</h6>
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->orders->take(5) as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-decoration-none">
                                        {{ $order->order_number }}
                                    </a>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>{{ $order->orderItems->count() }} items</td>
                                <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                <td>
                                    @if($order->status === 'completed')
                                        <span class="badge-admin badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Completed
                                        </span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="badge-admin badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>Cancelled
                                        </span>
                                    @else
                                        <span class="badge-admin badge bg-{{ $order->status === 'pending' ? 'warning' : 'info' }}">
                                            <i class="fas fa-{{ $order->status === 'pending' ? 'clock' : 'truck' }} me-1"></i>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        @if($order->status === 'completed')
                                            <span class="badge-admin badge bg-success mb-1">
                                                <i class="fas fa-check-circle me-1"></i>Paid (COD)
                                            </span>
                                            <small class="text-muted">
                                                <i class="fas fa-money-bill-wave me-1"></i>Delivered & Paid
                                            </small>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge-admin badge bg-danger mb-1">
                                                <i class="fas fa-times-circle me-1"></i>Cancelled
                                            </span>
                                            <small class="text-muted">
                                                <i class="fas fa-ban me-1"></i>No Payment Required
                                            </small>
                                        @else
                                            <span class="badge-admin badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }} mb-1">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                            <small class="text-muted">
                                                @if($order->payment_method === 'cash_on_delivery')
                                                    <i class="fas fa-money-bill-wave me-1"></i>COD
                                                @else
                                                    {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                                                @endif
                                            </small>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
