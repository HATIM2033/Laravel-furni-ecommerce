@extends('layouts.furni')

@section('title', $product->name . ' - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>{{ $product->name }}</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Product Detail Section -->
<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-5 mb-5">
                <div class="product-image">
                    <img src="{{ asset( $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="col-lg-7">
                <h2 class="text-black">{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                
                <div class="price mb-4">
                    <span>{{ $product->formatted_price }}</span>
                    @if($product->compare_price)
                        <span class="compare-price text-muted">{{ $product->formatted_compare_price }}</span>
                    @endif
                </div>
                
                <div class="mb-4">
                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 220px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center quantity-amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-black increase" type="button">&plus;</button>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    @if(auth()->check())
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" class="quantity-input" value="1">
                            <button type="submit" class="btn btn-black btn-lg py-3 btn-block">
                                Add To Cart
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-black btn-lg py-3 btn-block">
                            Login to Add to Cart
                        </a>
                    @endif
                </div>
                
                <div class="mb-4">
                    <p><strong>Category:</strong> <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></p>
                    <p><strong>Stock:</strong> 
                        @if($product->isInStock())
                            <span class="text-success">In Stock ({{ $product->stock }} available)</span>
                        @else
                            <span class="text-danger">Out of Stock</span>
                        @endif
                    </p>
                </div>
                
                <div class="product-details">
                    <h4>Product Details</h4>
                    <p>{{ $product->description }}</p>
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="section-title mb-4">Related Products</h2>
            </div>
            
            @foreach($relatedProducts as $relatedProduct)
            <div class="col-12 col-md-4 col-lg-3 mb-5">
                <a class="product-item" href="{{ route('shop.show', $relatedProduct->slug) }}">
                    <img src="{{ asset( $relatedProduct->image) }}" class="img-fluid product-thumbnail">
                    <h3 class="product-title">{{ $relatedProduct->name }}</h3>
                    <strong class="product-price">{{ $relatedProduct->formatted_price }}</strong>
                    <span class="icon-cross">
                        <img src="{{ asset('images/cross.svg') }}" class="img-fluid">
                    </span>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
<!-- End Product Detail Section -->
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity increase/decrease buttons
        document.querySelectorAll('.decrease, .increase').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.quantity-container').querySelector('.quantity-amount');
                const hiddenInput = document.querySelector('.quantity-input');
                let value = parseInt(input.value) || 1;
                
                if (this.classList.contains('decrease')) {
                    value = Math.max(1, value - 1);
                } else {
                    value++;
                }
                
                input.value = value;
                hiddenInput.value = value;
            });
        });
    });
</script>
@endpush
