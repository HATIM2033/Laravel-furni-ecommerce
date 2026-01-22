@extends('layouts.furni')

@section('title', 'Message Details - Furni')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Message Details</h1>
                    <p>View your message and our reply</p>
                </div>
            </div>
            <div class="col-lg-7">
                
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Message Section -->
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <!-- Message Details -->
            <div class="col-lg-12">
                <div class="bg-white p-5 rounded shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="section-title mb-0">Message Details</h2>
                        <div>
                            <a href="{{ route('profile.messages') }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-arrow-left me-2"></i>Back to Messages
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Send New Message
                            </a>
                        </div>
                    </div>
                    
                    <!-- Original Message -->
                    <div class="mb-5">
                        <div class="alert alert-light">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-envelope me-2"></i>Your Message
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Date:</strong> {{ $message->created_at->format('F j, Y, g:i a') }}</p>
                                    <p><strong>Email:</strong> {{ $message->email }}</p>
                                </div>
                                <div class="col-md-6">
                                    @if($message->subject)
                                        <p><strong>Subject:</strong> {{ $message->subject }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                <p><strong>Message:</strong></p>
                                <div class="bg-white p-3 rounded border">
                                    <p class="mb-0">{{ $message->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Admin Reply -->
                    @if($message->is_replied && $message->admin_reply)
                        <div class="mb-5">
                            <div class="alert alert-success">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-reply me-2"></i>Our Reply
                                </h5>
                                @if($message->replied_at)
                                    <p class="mb-3">
                                        <strong>Replied on:</strong> {{ $message->replied_at->format('F j, Y, g:i a') }}
                                    </p>
                                @endif
                                <div class="bg-white p-3 rounded border">
                                    <p class="mb-0">{{ $message->admin_reply }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mb-5">
                            <div class="alert alert-warning">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-clock me-2"></i>Reply Status
                                </h5>
                                <p class="mb-0">We haven't replied to your message yet. Our team typically responds within 24-48 hours. You'll also receive an email notification when we reply.</p>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Action Buttons -->
                    <div class="text-center">
                        @if(!$message->is_replied)
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Tip:</strong> You can send us another message if you have additional questions.
                            </div>
                        @endif
                        
                        <div class="mt-4">
                            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Send Another Message
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Message Section -->
@endsection

@push('styles')
<style>
.alert {
    border: none;
    border-radius: 0.5rem;
    padding: 1.5rem;
}

.alert-light {
    background-color: #f8f9fa;
    border-left: 4px solid #6c757d;
}

.alert-success {
    background-color: #d4edda;
    border-left: 4px solid #28a745;
}

.alert-warning {
    background-color: #fff3cd;
    border-left: 4px solid #ffc107;
}

.alert-info {
    background-color: #d1ecf1;
    border-left: 4px solid #17a2b8;
}

.alert h5 {
    color: inherit;
}

.alert h5 i {
    opacity: 0.8;
}

.bg-white.p-3.rounded.border {
    background-color: #fff !important;
    border: 1px solid #dee2e6;
}
</style>
@endpush
