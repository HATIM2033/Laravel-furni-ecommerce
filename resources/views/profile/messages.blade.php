@extends('layouts.furni')

@section('title', 'My Messages - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>My Messages</h1>
                    <p>View your contact messages and replies from our team</p>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Messages Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <!-- Messages List -->
            <div class="col-lg-12">
                <div class="bg-white p-5 rounded shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="section-title mb-0">My Contact Messages</h2>
                        <a href="{{ route('profile.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Profile
                        </a>
                    </div>
                    
                    @if($messages->count() > 0)
                        <!-- Messages List -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="25%">Subject</th>
                                        <th width="40%">Message</th>
                                        <th width="15%">Date</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr>
                                            <td>
                                                @if($message->subject)
                                                    <span class="fw-semibold text-primary">{{ Str::limit($message->subject, 30) }}</span>
                                                @else
                                                    <span class="text-muted">No subject</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="message-preview">
                                                    {{ Str::limit($message->message, 60) }}
                                                    @if(Str::length($message->message) > 60)
                                                        <small class="text-muted">...</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted small">
                                                    <div>{{ $message->created_at->format('M j, Y') }}</div>
                                                    <div>{{ $message->created_at->format('g:i a') }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($message->is_replied)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Replied
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning">
                                                        <i class="fas fa-clock me-1"></i>Pending
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('profile.messages.show', $message) }}" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="View Message">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Summary Stats -->
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="alert alert-info mb-0">
                                    <h6 class="mb-2">
                                        <i class="fas fa-envelope me-2"></i>Total Messages
                                    </h6>
                                    <h4 class="mb-0">{{ $messages->count() }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alert alert-success mb-0">
                                    <h6 class="mb-2">
                                        <i class="fas fa-check me-2"></i>Replied
                                    </h6>
                                    <h4 class="mb-0">{{ $messages->where('is_replied', true)->count() }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alert alert-warning mb-0">
                                    <h6 class="mb-2">
                                        <i class="fas fa-clock me-2"></i>Pending
                                    </h6>
                                    <h4 class="mb-0">{{ $messages->where('is_replied', false)->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-inbox fa-4x text-muted"></i>
                            </div>
                            <h4 class="text-muted mb-3">No Messages Yet</h4>
                            <p class="text-muted mb-4">You haven't sent any contact messages yet. When you contact us, your messages will appear here.</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Contact Us
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Messages Section -->
@endsection

@push('styles')
<style>
.message-preview {
    line-height: 1.4;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.badge {
    font-size: 0.75rem;
}

.alert {
    border: none;
    border-radius: 0.5rem;
}

.alert h6 {
    font-size: 0.875rem;
    font-weight: 600;
}

.alert h4 {
    font-size: 1.5rem;
    font-weight: 700;
}
</style>
@endpush
