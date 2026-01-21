@extends('layouts.furni')

@section('title', 'Products Management - Admin')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Products Management</h1>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Products Section -->
<div class="untree_co-section">
    <div class="container">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="bg-white p-5 rounded shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="h4">All Products</h3>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-black btn-sm me-2">← Dashboard</a>
                    <a href="#" class="btn btn-black btn-sm">Add Product</a>
                </div>
            </div>
            
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
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
                                    <img src="{{ asset('images/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         style="width: 50px; height: 50px; object-fit: cover;" 
                                         class="rounded">
                                </td>
                                <td>
                                    <strong>{{ $product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                </td>
                                <td>{{ $product->category->name ?? 'No Category' }}</td>
                                <td><strong>${{ number_format($product->price, 2) }}</strong></td>
                                <td>
                                    <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <span class="badge {{ $product->active ? 'bg-success' : 'bg-secondary' }} me-1">
                                            {{ $product->active ? 'Active' : 'Inactive' }}
                                        </span>
                                        @if($product->featured)
                                            <span class="badge bg-warning">Featured</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-outline-black">Edit</a>
                                        <a href="#" class="btn btn-outline-danger">Delete</a>
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
                    <i class="fa fa-box fa-4x text-muted mb-3"></i>
                    <h4 class="h5 mb-3">No Products Found</h4>
                    <p class="text-muted mb-4">Start by adding your first product.</p>
                    <a href="#" class="btn btn-black">Add Product</a>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- End Products Section -->
@endsection
