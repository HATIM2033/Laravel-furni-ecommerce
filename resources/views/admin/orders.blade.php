@extends('layouts.furni')

@section('title', 'Orders Management - Admin')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Orders Management</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Orders Section -->
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

        <div class="bg-white p-5 rounded shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="h4">All Orders</h3>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-black btn-sm">← Dashboard</a>
            </div>
            
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table">
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
                                <td><strong>{{ $order->order_number }}</strong></td>
                                <td>
                                    <div>
                                        <strong>{{ $order->user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $order->user->email }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $order->orderItems->count() }} items</span>
                                </td>
                                <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                <td>
                                    <div class="d-flex flex-column">
                                        @if($order->status === 'completed')
                                            <span class="badge bg-success mb-1">
                                                <i class="fas fa-check-circle me-1"></i>Paid (COD)
                                            </span>
                                            <small class="text-muted">
                                                <i class="fas fa-money-bill-wave me-1"></i>Delivered & Paid
                                            </small>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge bg-danger mb-1">
                                                <i class="fas fa-times-circle me-1"></i>Cancelled
                                            </span>
                                            <small class="text-muted">
                                                <i class="fas fa-ban me-1"></i>No Payment Required
                                            </small>
                                        @else
                                            <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }} mb-1">
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
                                <td>
                                    @if($order->status === 'completed')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Completed
                                        </span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>Cancelled
                                        </span>
                                    @else
                                        <span class="badge {{ $order->status === 'pending' ? 'bg-warning' : 'bg-info' }}">
                                            <i class="fas fa-{{ $order->status === 'pending' ? 'clock' : 'truck' }} me-1"></i>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-outline-black">View</a>
                                        <a href="#" class="btn btn-outline-primary">Edit</a>
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
                    <i class="fa fa-shopping-cart fa-4x text-muted mb-3"></i>
                    <h4 class="h5 mb-3">No Orders Found</h4>
                    <p class="text-muted">No orders have been placed yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- End Orders Section -->
@endsection
