@extends('admin.layouts.app')

@section('title', 'Orders Management - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Orders Management</h2>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-admin btn-admin-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
    </a>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">All Orders</h5>
    </div>
    <div class="card-body">
        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $order->order_number }}</div>
                                <small class="text-muted">ID: #{{ $order->id }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                        {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $order->user->name }}</div>
                                        <small class="text-muted">{{ $order->user->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-admin badge bg-info">
                                    {{ $order->orderItems->count() }} items
                                </span>
                            </td>
                            <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                            <td>
                                <span class="badge-admin badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                                    <i class="fas fa-{{ $order->payment_status === 'paid' ? 'check-circle' : 'clock' }} me-1"></i>
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-admin badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                                    <i class="fas fa-{{ $order->status === 'completed' ? 'check' : ($order->status === 'pending' ? 'clock' : 'truck') }} me-1"></i>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <div>{{ $order->created_at->format('M d, Y') }}</div>
                                <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-admin btn-admin-primary" title="View Order">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-admin btn-admin-success" title="Update Status">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                <h4 class="h5 mb-3">No Orders Found</h4>
                <p class="text-muted">No orders have been placed yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
