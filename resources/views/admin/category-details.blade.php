@extends('admin.layouts.app')

@section('title', 'Category Details - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Category Details</h2>
    <div>
        <a href="{{ route('admin.categories') }}" class="btn btn-admin btn-admin-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Categories
        </a>
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-admin btn-admin-primary">
            <i class="fas fa-edit me-1"></i> Edit Category
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">{{ $category->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-muted mb-3">Category Information</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Category ID:</strong></td>
                        <td>#{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Slug:</strong></td>
                        <td><code class="text-muted">{{ $category->slug }}</code></td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge-admin badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $category->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-3">Statistics</h6>
                <table class="table table-sm">
                    <tr>
                        <td><strong>Total Products:</strong></td>
                        <td>{{ $category->products->count() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Active Products:</strong></td>
                        <td>{{ $category->products->where('is_active', true)->count() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Last Updated:</strong></td>
                        <td>{{ $category->updated_at->format('M d, Y h:i A') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($category->description)
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="text-muted mb-3">Description</h6>
                <p class="card-text">{{ $category->description }}</p>
            </div>
        </div>
        @endif

        <!-- Products in this Category -->
        @if($category->products->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="text-muted mb-3">Products in this Category</h6>
                <div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->products->take(10) as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="me-2" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $product->name }}</div>
                                            <small class="text-muted">SKU: {{ $product->sku ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>${{ number_format($product->price, 2) }}</strong></td>
                                <td>
                                    <span class="badge-admin badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                        {{ $product->stock }} in stock
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-admin badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.products') }}#product-{{ $product->id }}" class="btn btn-admin btn-admin-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($category->products->count() > 10)
                <div class="text-center mt-3">
                    <small class="text-muted">Showing 10 of {{ $category->products->count() }} products</small>
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="row mt-4">
            <div class="col-12">
                <div class="text-center py-4">
                    <i class="fas fa-box fa-3x text-muted mb-3"></i>
                    <h6 class="text-muted">No Products in this Category</h6>
                    <p class="text-muted">This category doesn't have any products yet.</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
