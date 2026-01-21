@extends('admin.layouts.app')

@section('title', 'Contact Message - Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-envelope me-2"></i>Contact Message Details
                        </h5>
                        <div>
                            <a href="{{ route('admin.contact-messages') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i>Back to Messages
                            </a>
                            @if(!$contactMessage->is_replied)
                                <span class="badge bg-warning">Pending Reply</span>
                            @else
                                <span class="badge bg-success">Replied</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Message Details -->
                        <div class="col-lg-6">
                            <h6 class="text-primary mb-3">Message Information</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold">From:</label>
                                <div>
                                    <strong>{{ $contactMessage->full_name }}</strong><br>
                                    <a href="mailto:{{ $contactMessage->email }}" class="text-decoration-none">
                                        {{ $contactMessage->email }}
                                    </a>
                                </div>
                            </div>
                            
                            @if($contactMessage->subject)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Subject:</label>
                                    <div>{{ $contactMessage->subject }}</div>
                                </div>
                            @endif
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date:</label>
                                <div>{{ $contactMessage->created_at->format('F j, Y, g:i a') }}</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Message:</label>
                                <div class="alert alert-light">
                                    {{ $contactMessage->message }}
                                </div>
                            </div>
                            
                            @if($contactMessage->is_replied)
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Replied On:</label>
                                    <div>{{ $contactMessage->replied_at->format('F j, Y, g:i a') }}</div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Reply Section -->
                        <div class="col-lg-6">
                            <h6 class="text-primary mb-3">
                                @if($contactMessage->is_replied)
                                    <i class="fas fa-reply me-1"></i>Sent Reply
                                @else
                                    <i class="fas fa-paper-plane me-1"></i>Send Reply
                                @endif
                            </h6>
                            
                            @if($contactMessage->is_replied)
                                <div class="alert alert-success">
                                    <h6 class="alert-heading">Reply Sent Successfully</h6>
                                    <p class="mb-0">{{ $contactMessage->admin_reply }}</p>
                                    <hr>
                                    <small class="text-muted">
                                        Sent on {{ $contactMessage->replied_at->format('F j, Y, g:i a') }}
                                    </small>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.contact-messages.reply', $contactMessage) }}" method="POST">
                                        @csrf
                                        <button type="submit" name="send_again" value="1" class="btn btn-primary">
                                            <i class="fas fa-redo me-1"></i>Send Another Reply
                                        </button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('admin.contact-messages.reply', $contactMessage) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="reply" class="form-label fw-bold">Your Reply:</label>
                                        <textarea name="reply" id="reply" class="form-control" rows="8" required
                                                  placeholder="Type your reply here...">{{ old('reply') }}</textarea>
                                        @error('reply')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="send_copy" name="send_copy" value="1">
                                            <label class="form-check-label" for="send_copy">
                                                Send a copy to my email
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-1"></i>Send Reply
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                            <i class="fas fa-times me-1"></i>Cancel
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="border-top pt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">
                                            Message ID: #{{ str_pad($contactMessage->id, 6, '0', STR_PAD_LEFT) }}
                                        </small>
                                    </div>
                                    <div>
                                        <form action="{{ route('admin.contact-messages.delete', $contactMessage) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this message? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash me-1"></i>Delete Message
                                            </button>
                                        </form>
                                    </div>
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

@push('scripts')
<script>
    // Auto-resize textarea
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('reply');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        }
    });
</script>

<style>
    .btn-admin {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border: 1px solid transparent;
        border-radius: 0.375rem;
        transition: all 0.15s ease-in-out;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }
    
    .card {
        border: none;
        border-radius: 0.5rem;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .form-control:focus {
        border-color: #6c757d;
        box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
    }
    
    .btn-primary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-primary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    
    .alert {
        border: none;
        border-radius: 0.5rem;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
    
    .alert-light {
        background-color: #f8f9fa;
        color: #495057;
    }
</style>
@endpush
