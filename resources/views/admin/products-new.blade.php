@extends('admin.layouts.app')

@section('title', 'Products Management - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products Management</h2>
    <div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-admin btn-admin-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
        </a>
        <a href="{{ route('admin.products.create') }}" class="btn btn-admin btn-admin-primary">
            <i class="fas fa-plus me-1"></i> Add Product
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">All Products</h5>
    </div>
    <div class="card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         style="width: 50px; height: 50px; object-fit: cover;" 
                                         class="rounded">
                                @else
                                    <img src="https://via.placeholder.com/50x50/e9ecef/6c757d?text=No+Image" 
                                         alt="No image" 
                                         style="width: 50px; height: 50px; object-fit: cover;" 
                                         class="rounded">
                                @endif
                            </td>
                            <td>
                                <div>
                                    <div class="fw-bold">{{ $product->name }}</div>
                                    <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge-admin badge bg-info">
                                    {{ $product->category->name ?? 'No Category' }}
                                </span>
                            </td>
                            <td><strong>${{ number_format($product->price, 2) }}</strong></td>
                            <td>
                                <span class="badge-admin badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                    {{ $product->stock }} in stock
                                </span>
                            </td>
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
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-admin btn-admin-primary" title="View Product">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-admin btn-admin-success" title="Edit Product">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.delete', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-admin btn-admin-danger" title="Delete Product">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box fa-4x text-muted mb-3"></i>
                <h4 class="h5 mb-3">No Products Found</h4>
                <p class="text-muted mb-4">Start by adding your first product.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-admin btn-admin-primary">
                    <i class="fas fa-plus me-1"></i> Add Product
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
