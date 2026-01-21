@extends('layouts.furni')

@section('title', 'Order Success - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Order Success</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Order Success Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="bg-white p-5 rounded shadow-sm">
                    <div class="mb-4">
                        <div class="text-success">
                            <i class="fa fa-check-circle fa-4x"></i>
                        </div>
                    </div>
                    
                    <h2 class="mb-3">Thank You For Your Order!</h2>
                    <p class="mb-4">Your order has been placed successfully. We'll send you an email confirmation shortly.</p>
                    
                    <div class="order-summary mb-4">
                        <h4 class="h5 mb-3">Order Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                                <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                                <p><strong>Status:</strong> <span class="badge bg-warning">{{ ucfirst($order->status) }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                                <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                                <p><strong>Payment Status:</strong> <span class="badge bg-info">{{ ucfirst($order->payment_status) }}</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="order-items mb-4">
                        <h4 class="h5 mb-3">Order Items</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('images/' . $item->product_image) }}" alt="{{ $item->product_name }}" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
                                                {{ $item->product_name }}
                                            </div>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>${{ number_format($item->total, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="shipping-info mb-4">
                        <h4 class="h5 mb-3">Shipping Information</h4>
                        <p>
                            {{ $order->shipping_address['street'] }}<br>
                            {{ $order->shipping_address['city'] }}, {{ $order->shipping_address['state'] }} {{ $order->shipping_address['zip'] }}
                        </p>
                    </div>
                    
                    <div class="actions">
                        <a href="{{ route('shop.index') }}" class="btn btn-black me-2">Continue Shopping</a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-black">View My Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Order Success Section -->
@endsection
