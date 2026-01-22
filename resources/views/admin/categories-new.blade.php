@extends('admin.layouts.app')

@section('title', 'Categories Management - Admin Panel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Categories Management</h2>
    <div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-admin btn-admin-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
        </a>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-admin btn-admin-primary">
            <i class="fas fa-plus me-1"></i> Add Category
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h5 class="mb-0">All Categories</h5>
    </div>
    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $category->name }}</div>
                            </td>
                            <td>
                                <code class="text-muted">{{ $category->slug }}</code>
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit($category->description, 80) }}</small>
                            </td>
                            <td>
                                <span class="badge-admin badge bg-info">
                                    {{ $category->products_count }} products
                                </span>
                            </td>
                            <td>
                                <span class="badge-admin badge bg-{{ $category->is_active ? 'success' : 'secondary' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-admin btn-admin-primary" title="View Category">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-admin btn-admin-success" title="Edit Category">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($category->products_count == 0)
                                        <button type="button" 
                                                class="btn btn-admin btn-admin-danger" 
                                                title="Delete Category"
                                                onclick="deleteCategory({{ $category->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @else
                                        <button class="btn btn-admin btn-admin-danger" 
                                                title="Cannot delete category with products" 
                                                disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-4x text-muted mb-3"></i>
                <h4 class="h5 mb-3">No Categories Found</h4>
                <p class="text-muted mb-4">Start by adding your first category.</p>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-admin btn-admin-primary">
                    <i class="fas fa-plus me-1"></i> Add Category
                </a>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
function deleteCategory(categoryId) {
    console.log('Delete button clicked for category ID:', categoryId);
    
    if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
        // Create a form dynamically
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/categories/' + categoryId;
        form.style.display = 'none';
        
        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        form.appendChild(csrfInput);
        
        // Add DELETE method
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        // Submit form
        document.body.appendChild(form);
        form.submit();
    } else {
        console.log('Delete cancelled for category ID:', categoryId);
    }
}
</script>
@endpush
