@extends('layouts.furni')

@section('title', 'Explore Our Collection - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="hero-section text-center">
                    <h1>Explore Our Collection</h1>
                    <p class="mb-4">Discover our carefully curated selection of premium furniture pieces. From modern sofas to elegant chairs, find everything you need to transform your space.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Categories Section -->
<div class="product-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h2 class="section-title">Browse Categories</h2>
                <p>Find exactly what you're looking for in our organized collections</p>
            </div>
        </div>
        
        <div class="row">
            @forelse($categories as $category)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="product-item">
                        <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="category-card">
                            <div class="category-image">
                               @php
    $categorySlug = strtolower($category->name);
    $imagePath = 'images/categories/' . $categorySlug . '.jpg';
@endphp

@if($category->image)
    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="img-fluid">
@elseif(file_exists(public_path($imagePath)))
    <img src="{{ asset($imagePath) }}" alt="{{ $category->name }}" class="img-fluid">
@else
    <img src="https://via.placeholder.com/300x200/e9ecef/6c757d?text={{ $category->name }}" alt="{{ $category->name }}" class="img-fluid">
@endif
                            </div>
                            <div class="category-info">
                                <h3>{{ $category->name }}</h3>
                                <p>{{ Str::limit($category->description, 80) }}</p>
                                <span class="explore-btn">Explore Category →</span>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No categories available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- End Categories Section -->

<!-- Start Featured Products Section -->
<div class="product-section bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h2 class="section-title">Featured Products</h2>
                <p>Handpicked favorites from our collection</p>
            </div>
        </div>
        
        <div class="row">
            @forelse($featuredProducts as $product)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="product-item">
                        <a href="{{ route('shop.show', $product->slug) }}" class="product-card">
                            <div class="product-image">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                @else
                                    <img src="public\images\sofa.png" alt="No image" class="img-fluid">
                                @endif
                            </div>
                            <div class="product-info">
                                <h3>{{ $product->name }}</h3>
                                <p class="product-price">{{ $product->formatted_price }}</p>
                                @if($product->compare_price)
                                    <p class="compare-price">{{ $product->formatted_compare_price }}</p>
                                @endif
                                <span class="featured-badge">Featured</span>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No featured products available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('shop.index') }}" class="btn btn-primary">View All Products</a>
            </div>
        </div>
    </div>
</div>
<!-- End Featured Products Section -->

<!-- Start Latest Products Section -->
<div class="product-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h2 class="section-title">Latest Arrivals</h2>
                <p>Fresh additions to our collection</p>
            </div>
        </div>
        
        <div class="row">
            @forelse($latestProducts as $product)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="product-item">
                        <a href="{{ route('shop.show', $product->slug) }}" class="product-card">
                            <div class="product-image">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                @else
                                    <img src="https://via.placeholder.com/300x300/e9ecef/6c757d?text=No+Image" alt="No image" class="img-fluid">
                                @endif
                            </div>
                            <div class="product-info">
                                <h3>{{ $product->name }}</h3>
                                <p class="product-price">{{ $product->formatted_price }}</p>
                                @if($product->compare_price)
                                    <p class="compare-price">{{ $product->formatted_compare_price }}</p>
                                @endif
                                <span class="new-badge">New</span>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No latest products available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
<!-- End Latest Products Section -->

<!-- Start CTA Section -->
<div class="cta-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title">Ready to Transform Your Space?</h2>
                <p class="mb-4">Browse our complete collection and find the perfect pieces for your home.</p>
                <div class="cta-buttons">
                    <a href="{{ route('shop.index') }}" class="btn btn-primary me-2">Shop All Products</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End CTA Section -->
@endsection

@push('scripts')
<style>
    .category-card {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: transform 0.3s ease;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        text-decoration: none;
        color: inherit;
    }
    
    .category-image {
        height: 200px;
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    
    .category-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .category-card:hover .category-image img {
        transform: scale(1.05);
    }
    
    .category-info {
        text-align: center;
    }
    
    .category-info h3 {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: #000;
    }
    
    .category-info p {
        color: #6c757d;
        margin-bottom: 15px;
    }
    
    .explore-btn {
        color: #6c757d;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .category-card:hover .explore-btn {
        color: #000;
    }
    
    .product-card {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: transform 0.3s ease;
        position: relative;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        text-decoration: none;
        color: inherit;
    }
    
    .product-image {
        height: 250px;
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .product-image img {
        transform: scale(1.05);
    }
    
    .product-info {
        text-align: center;
    }
    
    .product-info h3 {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: #000;
        font-weight: 500;
    }
    
    .product-price {
        font-size: 1.2rem;
        font-weight: 600;
        color: #000;
        margin-bottom: 5px;
    }
    
    .compare-price {
        text-decoration: line-through;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }
    
    .featured-badge, .new-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #6c757d;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .new-badge {
        background-color: #28a745;
    }
    
    .cta-section {
        background-color: #f8f9fa;
        padding: 80px 0;
        margin: 80px 0;
    }
    
    .cta-buttons {
        margin-top: 30px;
    }
    
    .hero {
        background: linear-gradient(135deg, #125801ff 0%);
        color: white;
        padding: 100px 0;
        margin-bottom: 80px;
    }
    
    .hero h1 {
        color: white;
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    
    .hero p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.2rem;
    }
</style>
@endpush
