@extends('admin.layouts.app')

@section('title', 'Product Details - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Product Details</h2>
    <div>
        <a href="{{ route('admin.products') }}" class="btn btn-admin btn-admin-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Products
        </a>
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-admin btn-admin-primary">
            <i class="fas fa-edit me-1"></i> Edit Product
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">{{ $product->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <h6 class="text-muted mb-3">Product Image</h6>
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="img-fluid rounded"
                             style="max-width: 100%; max-height: 300px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x300/e9ecef/6c757d?text=No+Image" 
                             alt="No image" 
                             class="img-fluid rounded">
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <h6 class="text-muted mb-3">Product Information</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Product ID:</strong></td>
                        <td>#{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>SKU:</strong></td>
                        <td>{{ $product->sku ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Category:</strong></td>
                        <td>
                            @if($product->category)
                                <span class="badge-admin badge bg-info">
                                    {{ $product->category->name }}
                                </span>
                            @else
                                <span class="text-muted">No Category</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Price:</strong></td>
                        <td><strong class="text-success">${{ number_format($product->price, 2) }}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Stock:</strong></td>
                        <td>
                            <span class="badge-admin badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                {{ $product->stock }} in stock
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <div class="d-flex gap-1">
                                @if($product->is_active)
                                    <span class="badge-admin badge bg-success">Active</span>
                                @else
                                    <span class="badge-admin badge bg-secondary">Inactive</span>
                                @endif
                                @if($product->is_featured)
                                    <span class="badge-admin badge bg-warning">Featured</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $product->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Last Updated:</strong></td>
                        <td>{{ $product->updated_at->format('M d, Y h:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($product->description)
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="text-muted mb-3">Description</h6>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Shop Preview -->
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="text-muted mb-3">Shop Preview</h6>
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            This is how the product will appear to customers on the shop page when it's active.
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card product-card">
                                    <div class="card-body">
                                        <div class="product-item">
                                            <div class="product-image">
                                                @if($product->image)
                                                    <img src="{{ asset($product->image) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="img-fluid">
                                                @else
                                                    <img src="https://via.placeholder.com/300x300/e9ecef/6c757d?text=No+Image" 
                                                         alt="No image" 
                                                         class="img-fluid">
                                                @endif
                                            </div>
                                            <div class="product-info">
                                                <h3>{{ $product->name }}</h3>
                                                <p>{{ Str::limit($product->description, 100) }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="price">${{ number_format($product->price, 2) }}</span>
                                                    @if($product->stock > 0)
                                                        <span class="badge bg-success">In Stock</span>
                                                    @else
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @endif
                                                </div>
                                                @if($product->is_active)
                                                    <button class="btn btn-primary w-100 mt-2">
                                                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary w-100 mt-2" disabled>
                                                        <i class="fas fa-times me-2"></i>Unavailable
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-3">
                                    <h6>Product Status Summary</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Visibility</span>
                                            <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                                                {{ $product->is_active ? 'Visible' : 'Hidden' }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Availability</span>
                                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                                {{ $product->stock > 0 ? 'Available' : 'Out of Stock' }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Featured Status</span>
                                            <span class="badge bg-{{ $product->is_featured ? 'warning' : 'light' }}">
                                                {{ $product->is_featured ? 'Featured' : 'Regular' }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
