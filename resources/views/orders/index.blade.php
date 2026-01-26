@extends('layouts.furni')

@section('title', 'My Orders - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>My Orders</h1>
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
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="bg-white p-5 rounded shadow-sm">
                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <strong>{{ $order->order_number }}</strong>
                                        </td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                                        <td>
                                            @if($order->status === 'completed')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Completed
                                                </span>
                                                <br>
                                                <small class="text-muted">Delivered & Paid</small>
                                            @elseif($order->status === 'cancelled')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle me-1"></i>Cancelled
                                                </span>
                                                <br>
                                                <small class="text-muted">No Payment Required</small>
                                            @else
                                                <span class="badge {{ $order->status === 'pending' ? 'bg-warning' : 'bg-info' }}">
                                                    <i class="fas fa-{{ $order->status === 'pending' ? 'clock' : 'truck' }} me-1"></i>
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status === 'completed')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-money-bill-wave me-1"></i>Paid (COD)
                                                </span>
                                            @elseif($order->status === 'cancelled')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-ban me-1"></i>Cancelled
                                                </span>
                                            @else
                                                <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                                    <i class="fas fa-{{ $order->payment_status === 'paid' ? 'check-circle' : 'clock' }} me-1"></i>
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->order_number) }}" class="btn btn-sm btn-outline-black">
                                                View Details
                                            </a>
                                            @if(in_array($order->status, ['pending', 'processing']))
                                                <form action="{{ route('orders.cancel', $order->order_number) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger ms-1" 
                                                            onclick="return confirm('Are you sure you want to cancel this order? This action cannot be undone.')">
                                                        Cancel Order
                                                    </button>
                                                </form>
                                            @endif
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
                            <div class="mb-4">
                                <i class="fa fa-shopping-bag fa-4x text-muted"></i>
                            </div>
                            <h3 class="h4 mb-3">No Orders Yet</h3>
                            <p class="text-muted mb-4">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                            <a href="{{ route('shop.index') }}" class="btn btn-black">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Orders Section -->
@endsection
