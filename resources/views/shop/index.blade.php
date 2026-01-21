@extends('layouts.furni')

@section('title', 'Shop - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <!-- Category Filter -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="section-title">All Products</h2>
                    <div class="category-filter">
                        <a href="{{ route('shop.index') }}" class="{{ !request('category') ? 'active' : '' }}">All</a>
                        @foreach($categories as $category)
                            <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="{{ request('category') == $category->slug ? 'active' : '' }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($products as $product)
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="{{ route('shop.show', $product->slug) }}">
                        <img src="{{ asset($product->image) }}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">{{ $product->name }}</h3>
                        <strong class="product-price">{{ $product->formatted_price }}</strong>
                        @if($product->compare_price)
                            <span class="compare-price text-muted small">{{ $product->formatted_compare_price }}</span>
                        @endif

                        <span class="icon-cross">
                            <img src="{{ asset('images/cross.svg') }}" class="img-fluid">
                        </span>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <h3>No products found</h3>
                        <p>Check back later for new products or browse our categories.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation" class="d-flex justify-content-center align-items-center">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<style>
    .category-filter {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .category-filter a {
        text-decoration: none;
        color: #6c757d;
        padding: 5px 10px;
        border-radius: 4px;
        transition: all 0.3s ease;
    }
    
    .category-filter a:hover,
    .category-filter a.active {
        color: #000;
        background-color: #f8f9fa;
    }
    
    .compare-price {
        text-decoration: line-through;
        margin-left: 10px;
    }
    
    /* Custom Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin: 20px 0;
    }
    
    .pagination .page-link {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        background-color: #fff;
        color: #6c757d;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .pagination .page-link:hover {
        background-color: #f8f9fa;
        color: #000;
        border-color: #adb5bd;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #6c757d;
        color: #fff;
        border-color: #6c757d;
    }
    
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #e9ecef;
        border-color: #dee2e6;
        cursor: not-allowed;
    }
</style>
@endpush
