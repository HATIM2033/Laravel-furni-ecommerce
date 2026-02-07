@extends('layouts.furni')

@section('title', 'Cart - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-lg-7"></div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                @csrf
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cart as $id => $item)
                            <tr data-product-id="{{ $id }}">
                                <td class="product-thumbnail">
                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="img-fluid">
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black">{{ $item['name'] }}</h2>
                                </td>
                                <td class="product-price-value" data-price="{{ $item['price'] }}">
                                    ${{ number_format($item['price'], 2) }}
                                </td>
                                <td>
                                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-black decrease" type="button" data-id="{{ $id }}">&minus;</button>
                                        </div>
                                        <input type="number" 
                                               class="form-control text-center quantity-amount" 
                                               value="{{ $item['quantity'] }}" 
                                               data-id="{{ $id }}"
                                               min="1"
                                               max="99">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-black increase" type="button" data-id="{{ $id }}">&plus;</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-total-price">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </td>
                                <td>
                                    <a href="#" class="btn btn-black btn-sm remove-item" data-id="{{ $id }}">X</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <h4>Your cart is empty</h4>
                                    <p>Add some products to get started!</p>
                                    <a href="{{ route('shop.index') }}" class="btn btn-black">Continue Shopping</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        @if($cart)
        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button type="button" class="btn btn-black btn-sm btn-block update-cart">Update Cart</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('shop.index') }}" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="text-black h4" for="coupon">Coupon</label>
                        <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                        <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-black">Apply Coupon</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row justify-content-end">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black cart-subtotal">${{ number_format($cartTotal, 2) }}</strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black cart-total">${{ number_format($cartTotal, 2) }}</strong>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='{{ route('checkout.index') }}'">
                                    Proceed To Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to update row total
        function updateRowTotal(row) {
            const price = parseFloat(row.querySelector('.product-price-value').dataset.price);
            const quantity = parseInt(row.querySelector('.quantity-amount').value);
            const total = price * quantity;
            row.querySelector('.product-total-price').textContent = '$' + total.toFixed(2);
            updateCartTotal();
        }

        // Function to update cart total
        function updateCartTotal() {
            let subtotal = 0;
            document.querySelectorAll('tbody tr[data-product-id]').forEach(row => {
                const price = parseFloat(row.querySelector('.product-price-value').dataset.price);
                const quantity = parseInt(row.querySelector('.quantity-amount').value);
                subtotal += price * quantity;
            });
            
            document.querySelector('.cart-subtotal').textContent = '$' + subtotal.toFixed(2);
            document.querySelector('.cart-total').textContent = '$' + subtotal.toFixed(2);
        }

        // Quantity decrease button
        document.querySelectorAll('.decrease').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const id = this.dataset.id;
                const input = document.querySelector(`.quantity-amount[data-id="${id}"]`);
                let value = parseInt(input.value) || 1;
                
                value = Math.max(1, value - 1);
                input.value = value;
                
                // Update the row total
                const row = this.closest('tr');
                updateRowTotal(row);
            });
        });

        // Quantity increase button
        document.querySelectorAll('.increase').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const id = this.dataset.id;
                const input = document.querySelector(`.quantity-amount[data-id="${id}"]`);
                let value = parseInt(input.value) || 1;
                
                value++;
                input.value = value;
                
                // Update the row total
                const row = this.closest('tr');
                updateRowTotal(row);
            });
        });

        // Manual input change
        document.querySelectorAll('.quantity-amount').forEach(input => {
            input.addEventListener('change', function() {
                let value = parseInt(this.value) || 1;
                value = Math.max(1, value);
                this.value = value;
                
                const row = this.closest('tr');
                updateRowTotal(row);
            });
        });

        // Remove item from cart
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                
                if (confirm('Are you sure you want to remove this item?')) {
                    fetch('{{ route('cart.remove') }}', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id: id })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to remove item');
                    });
                }
            });
        });

        // Update cart
        const updateCartBtn = document.querySelector('.update-cart');
        if (updateCartBtn) {
            updateCartBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const quantities = {};
                document.querySelectorAll('.quantity-amount').forEach(input => {
                    quantities[input.dataset.id] = parseInt(input.value);
                });

                fetch('{{ route('cart.update') }}', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(quantities)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update cart');
                });
            });
        }
    });
</script>
@endpush