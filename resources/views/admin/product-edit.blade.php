@extends('admin.layouts.app')

@section('title', 'Edit Product - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Product</h2>
    <a href="{{ route('admin.products') }}" class="btn btn-admin btn-admin-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Products
    </a>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">Edit Product: {{ $product->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sku" class="form-label">SKU (optional)</label>
                                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" placeholder="Auto-generated if empty">
                                @error('sku')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                                @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
                                @error('stock')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">JPEG, PNG, JPG, GIF (Max 2MB)</small>
                                @if($product->image)
                                    <div class="mt-2">
                                        <small class="text-muted">Current: {{ basename($product->image) }}</small>
                                    </div>
                                @endif
                                @error('image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Product Status</label>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        <strong>Active</strong>
                                        <br><small class="text-muted">Product will be visible in shop</small>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        <strong>Featured</strong>
                                        <br><small class="text-muted">Show on homepage</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6 class="card-title mb-3">Current Product Image</h6>
                                <div id="imagePreview" class="mb-3">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid rounded"
                                             style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/200x200/e9ecef/6c757d?text=No+Image" 
                                             alt="No image" 
                                             class="img-fluid rounded"
                                             style="max-width: 200px; max-height: 200px;">
                                    @endif
                                </div>
                                <div id="namePreview" class="fw-bold">{{ $product->name }}</div>
                                <div id="pricePreview" class="text-success">${{ number_format($product->price, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Product ID: #{{ $product->id }} | 
                                Created: {{ $product->created_at->format('M d, Y') }} | 
                                Last Updated: {{ $product->updated_at->format('M d, Y') }}
                            </small>
                        </div>
                        <div>
                            <a href="{{ route('admin.products') }}" class="btn btn-admin btn-admin-secondary me-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-admin btn-admin-primary">
                                <i class="fas fa-save me-1"></i> Update Product
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const priceInput = document.getElementById('price');
    const imageInput = document.getElementById('image');
    const namePreview = document.getElementById('namePreview');
    const pricePreview = document.getElementById('pricePreview');
    const imagePreview = document.getElementById('imagePreview').querySelector('img');
    
    // Update preview as user types
    nameInput.addEventListener('input', function() {
        namePreview.textContent = this.value || 'Product Name';
    });
    
    priceInput.addEventListener('input', function() {
        pricePreview.textContent = '$' + (parseFloat(this.value) || 0).toFixed(2);
    });
    
    // Preview image on file selection
    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection
