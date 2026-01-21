@extends('layouts.furni')

@section('title', 'Order Details - ' . $order->order_number . ' - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Order Details</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Order Details Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white p-5 rounded shadow-sm">
                    <!-- Order Header -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h2 class="h3 mb-3">Order #{{ $order->order_number }}</h2>
                            <p class="text-muted">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="mb-2">
                                <span class="badge {{ $order->status === 'completed' ? 'bg-success' : ($order->status === 'pending' ? 'bg-warning' : 'bg-info') }} me-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-black btn-sm">
                                ← Back to Orders
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Order Items -->
                        <div class="col-lg-8 mb-5 mb-lg-0">
                            <h3 class="h5 mb-4">Order Items</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
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
                                                    <img src="{{ asset('images/' . $item->product_image) }}" 
                                                         alt="{{ $item->product_name }}" 
                                                         style="width: 60px; height: 60px; object-fit: cover;" 
                                                         class="me-3 rounded">
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->product_name }}</h6>
                                                        @if($item->product)
                                                            <small class="text-muted">{{ $item->product->category->name ?? '' }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><strong>${{ number_format($item->total, 2) }}</strong></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="col-lg-4">
                            <div class="bg-light p-4 rounded">
                                <h3 class="h5 mb-4">Order Summary</h3>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span>${{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Shipping:</span>
                                        <span>${{ number_format($order->shipping_amount, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tax:</span>
                                        <span>${{ number_format($order->tax_amount, 2) }}</span>
                                    </div>
                                    @if($order->discount_amount > 0)
                                    <div class="d-flex justify-content-between mb-2 text-success">
                                        <span>Discount:</span>
                                        <span>-${{ number_format($order->discount_amount, 2) }}</span>
                                    </div>
                                    @endif
                                </div>
                                
                                <hr>
                                
                                <div class="d-flex justify-content-between mb-4">
                                    <strong>Total:</strong>
                                    <strong class="h5 text-black">${{ number_format($order->total_amount, 2) }}</strong>
                                </div>

                                <div class="mb-3">
                                    <p class="mb-1"><strong>Payment Method:</strong></p>
                                    <p>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <h3 class="h5 mb-3">Shipping Information</h3>
                            <div class="bg-light p-4 rounded">
                                <p class="mb-1">
                                    {{ $order->shipping_address['street'] ?? '' }}<br>
                                    {{ $order->shipping_address['city'] ?? '' }}, 
                                    {{ $order->shipping_address['state'] ?? '' }} 
                                    {{ $order->shipping_address['zip'] ?? '' }}
                                </p>
                            </div>
                        </div>
                        
                        @if($order->billing_address && $order->billing_address !== $order->shipping_address)
                        <div class="col-md-6">
                            <h3 class="h5 mb-3">Billing Information</h3>
                            <div class="bg-light p-4 rounded">
                                <p class="mb-1">
                                    {{ $order->billing_address['street'] ?? '' }}<br>
                                    {{ $order->billing_address['city'] ?? '' }}, 
                                    {{ $order->billing_address['state'] ?? '' }} 
                                    {{ $order->billing_address['zip'] ?? '' }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="d-flex gap-2">
                                <a href="{{ route('shop.index') }}" class="btn btn-black">
                                    Continue Shopping
                                </a>
                                <a href="{{ route('profile.index') }}" class="btn btn-outline-black">
                                    Back to Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Order Details Section -->
@endsection
