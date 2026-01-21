@extends('admin.layouts.app')

@section('title', 'Order Details - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Order Details</h2>
    <div>
        <a href="{{ route('admin.orders') }}" class="btn btn-admin btn-admin-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Orders
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">Order #{{ $order->order_number }}</h5>
    </div>
    <div class="card-body">
        <!-- Order Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-3">Order Information</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Order ID:</strong></td>
                        <td>#{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Order Number:</strong></td>
                        <td>{{ $order->order_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date:</strong></td>
                        <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Amount:</strong></td>
                        <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-3">Status Information</h6>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Order Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-admin btn-admin-success">
                        <i class="fas fa-save me-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-3">Customer Information</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $order->user->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $order->user->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Payment Status:</strong></td>
                        <td>
                            <span class="badge-admin badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Order Items -->
        <div class="row">
            <div class="col-12">
                <h6 class="text-muted mb-3">Order Items</h6>
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($item->product->image)
                                            <img src="{{ asset( $item->product->image) }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="me-2" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $item->product->name }}</div>
                                            <small class="text-muted">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->product->category->name }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td><strong>${{ number_format($item->price * $item->quantity, 2) }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total:</th>
                                <th><strong>${{ number_format($order->total_amount, 2) }}</strong></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Delete Order Button -->
        <div class="row mt-4">
            <div class="col-12">
                <form action="{{ route('admin.orders.delete', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-admin btn-admin-danger">
                        <i class="fas fa-trash me-1"></i> Delete Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
