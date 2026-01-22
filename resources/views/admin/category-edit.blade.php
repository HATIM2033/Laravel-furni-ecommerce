@extends('admin.layouts.app')

@section('title', 'Edit Category - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Category</h2>
    <a href="{{ route('admin.categories') }}" class="btn btn-admin btn-admin-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Categories
    </a>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">Edit Category: {{ $category->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" readonly>
                        <small class="text-muted">URL-friendly version of the name</small>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                        <small class="text-muted">Inactive categories won't be shown in the shop</small>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @if($category->products()->count() > 0)
                                <small class="text-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    This category has {{ $category->products()->count() }} product(s)
                                </small>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('admin.categories') }}" class="btn btn-admin btn-admin-secondary me-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-admin btn-admin-primary">
                                <i class="fas fa-save me-1"></i> Update Category
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@if($category->products()->count() > 0)
<div class="admin-card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Products in this Category</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    nameInput.addEventListener('input', function() {
        // Generate slug from name
        const slug = this.value.toLowerCase()
            .replace(/[^\w\s-]/g, '') // Remove special characters
            .replace(/[\s_-]+/g, '-') // Replace spaces and underscores with hyphen
            .replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens
        
        slugInput.value = slug;
    });
});
</script>
@endsection
