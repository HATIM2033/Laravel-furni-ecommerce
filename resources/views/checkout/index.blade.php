@extends('layouts.furni')

@section('title', 'Checkout - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Checkout</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Checkout Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <!-- Billing Form -->
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Billing Details</h2>
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="p-3 p-lg-5 border bg-white">
                        <!-- Shipping Address -->
                        <h3 class="h6 mb-3">Shipping Address</h3>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="street" class="text-black">Street Address <span class="text-danger">*</span></label>
                                <input type="text" id="street" name="shipping_address[street]" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="city" class="text-black">City <span class="text-danger">*</span></label>
                                <input type="text" id="city" name="shipping_address[city]" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="text-black">State <span class="text-danger">*</span></label>
                                <input type="text" id="state" name="shipping_address[state]" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="zip" class="text-black">Zip Code <span class="text-danger">*</span></label>
                                <input type="text" id="zip" name="shipping_address[zip]" class="form-control" required>
                            </div>
                        </div>

                        <!-- Billing Address (Same as Shipping) -->
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="same_as_shipping" checked>
                                <label class="form-check-label" for="same_as_shipping">
                                    Billing address same as shipping
                                </label>
                            </div>
                        </div>

                        <!-- Billing Address (Hidden by default) -->
                        <div id="billing-address" style="display: none;">
                            <h3 class="h6 mb-3 mt-4">Billing Address</h3>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="billing_street" class="text-black">Street Address</label>
                                    <input type="text" id="billing_street" name="billing_address[street]" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="billing_city" class="text-black">City</label>
                                    <input type="text" id="billing_city" name="billing_address[city]" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="billing_state" class="text-black">State</label>
                                    <input type="text" id="billing_state" name="billing_address[state]" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="billing_zip" class="text-black">Zip Code</label>
                                    <input type="text" id="billing_zip" name="billing_address[zip]" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <h3 class="h6 mb-3 mt-4">Payment Method</h3>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="cash_on_delivery" name="payment_method" value="cash_on_delivery" checked required>
                                <label class="form-check-label" for="cash_on_delivery">
                                    <strong>Cash on Delivery (COD)</strong>
                                    <br>
                                    <small class="text-muted">Pay when you receive your order. No additional fees.</small>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Place Order</button>
                    </div>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Your Order</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <table class="table site-block-order-table mb-5">
                                <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                    <tr>
                                        <td>{{ $item['product']->name }} <strong class="mx-2">×</strong> {{ $item['quantity'] }}</td>
                                        <td>${{ number_format($item['subtotal'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                        <td class="text-black font-weight-bold"><strong>${{ number_format($cartTotal, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Checkout Section -->
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sameAsShippingCheckbox = document.getElementById('same_as_shipping');
        const billingAddressDiv = document.getElementById('billing-address');
        
        sameAsShippingCheckbox.addEventListener('change', function() {
            if (this.checked) {
                billingAddressDiv.style.display = 'none';
                // Clear billing address fields
                billingAddressDiv.querySelectorAll('input').forEach(input => input.value = '');
            } else {
                billingAddressDiv.style.display = 'block';
            }
        });
    });
</script>
@endpush
