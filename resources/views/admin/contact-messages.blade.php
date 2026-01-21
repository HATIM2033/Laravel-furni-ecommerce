@extends('admin.layouts.app')

@section('title', 'Contact Messages - Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h3 mb-2">
                        <i class="fas fa-envelope me-2 text-primary"></i>Contact Messages
                    </h2>
                    <p class="text-muted mb-0">View all incoming customer inquiries</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="text-end">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary">{{ $messages->count() }}</span>
                            <small class="text-muted">Total</small>
                        </div>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span class="badge bg-success">{{ $messages->where('is_replied', false)->count() }}</span>
                            <small class="text-muted">New</small>
                        </div>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span class="badge bg-secondary">{{ $messages->where('is_replied', true)->count() }}</span>
                            <small class="text-muted">Read</small>
                        </div>
                    </div>
                </div>
            </div>

            @if($messages->count() > 0)
                <!-- Messages List -->
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="18%">Sender</th>
                                        <th width="23%">Email</th>
                                        <th width="18%">Subject</th>
                                        <th width="23%">Message</th>
                                        <th width="10%">Date</th>
                                        <th width="8%">Status</th>
                                        <th width="6%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr data-message-id="{{ $message->id }}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                        {{ substr($message->full_name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $message->full_name }}</div>
                                                        <small class="text-muted">Customer</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $message->email }}" class="text-decoration-none" title="Click to email this customer">
                                                    {{ $message->email }}
                                                    <i class="fas fa-external-link-alt ms-1 text-muted small"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if($message->subject)
                                                    <span class="text-primary fw-semibold">{{ Str::limit($message->subject, 30) }}</span>
                                                @else
                                                    <span class="text-muted">No subject</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="message-preview">
                                                    {{ Str::limit($message->message, 80) }}
                                                    @if(Str::length($message->message) > 80)
                                                        <button class="btn btn-link btn-sm p-0 ms-1" 
                                                                onclick="this.parentElement.innerHTML='{{ $message->message }}'"
                                                                title="Click to see full message">
                                                            <small>see more</small>
                                                        </button>
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
                                                    <span class="badge bg-secondary">Read</span>
                                                @else
                                                    <span class="badge bg-success">New</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary view-message-btn" 
                                                        data-message-id="{{ $message->id }}"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#viewMessageModal"
                                                        title="View Message">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-inbox fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">No Contact Messages</h4>
                    <p class="text-muted mb-4">When users submit contact forms, their messages will appear here.</p>
                    <a href="{{ route('home') }}#contact" class="btn btn-primary" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>View Contact Page
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- View Message Modal -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="viewMessageModalLabel">
                    <i class="fas fa-envelope me-2"></i>Contact Message Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="messageContent">
                    <!-- Message content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Close
                </button>
                <a href="#" id="emailReplyLink" class="btn btn-primary" target="_blank">
                    <i class="fas fa-reply me-1"></i>Reply via Email
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle View Message modal
    const viewMessageModal = document.getElementById('viewMessageModal');
    const messageContent = document.getElementById('messageContent');
    const emailReplyLink = document.getElementById('emailReplyLink');
    
    if (viewMessageModal) {
        viewMessageModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const messageId = button.getAttribute('data-message-id');
            
            // Fetch message details
            fetch(`/admin/contact-messages/${messageId}/details`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display message content
                    messageContent.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-3">Sender Information</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Name:</label>
                                    <div>${data.message.full_name}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email:</label>
                                    <div>
                                        <a href="mailto:${data.message.email}" class="text-decoration-none">
                                            ${data.message.email}
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Date:</label>
                                    <div>${data.message.created_at}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-3">Message Content</h6>
                                ${data.message.subject ? `
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Subject:</label>
                                    <div class="text-primary">${data.message.subject}</div>
                                </div>
                                ` : ''}
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Message:</label>
                                    <div class="alert alert-light">${data.message.message}</div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    // Set email reply link
                    emailReplyLink.href = `mailto:${data.message.email}`;
                    
                    // Mark as read if it's a new message
                    if (!data.message.is_replied) {
                        markMessageAsRead(messageId);
                    }
                } else {
                    messageContent.innerHTML = '<div class="alert alert-danger">Failed to load message details.</div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageContent.innerHTML = '<div class="alert alert-danger">Error loading message details.</div>';
            });
        });
    }
    
    // Function to mark message as read
    function markMessageAsRead(messageId) {
        fetch(`/admin/contact-messages/${messageId}/mark-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the status badge in the table
                const row = document.querySelector(`tr[data-message-id="${messageId}"]`);
                if (row) {
                    const statusBadge = row.querySelector('.badge');
                    statusBadge.className = 'badge bg-secondary';
                    statusBadge.textContent = 'Read';
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Auto-mark messages as read when email links are clicked
    const emailLinks = document.querySelectorAll('a[href^="mailto:"]');
    emailLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const row = this.closest('tr');
            const statusBadge = row.querySelector('.badge');
            if (statusBadge && statusBadge.textContent.trim() === 'New') {
                const messageId = row.dataset.messageId;
                if (messageId) {
                    markMessageAsRead(messageId);
                }
            }
        });
    });
});
</script>

<style>
.message-preview {
    line-height: 1.4;
}

.message-preview .btn-link {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.75rem;
}

.message-preview .btn-link:hover {
    color: #495057;
    text-decoration: underline;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.avatar-sm {
    font-size: 0.875rem;
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
}

.card {
    border: none;
    border-radius: 0.5rem;
}

.table th {
    border-top: none;
    font-weight: 600;
    color: #495057;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table td {
    vertical-align: middle;
    border-color: #f8f9fa;
}

a[href^="mailto:"] {
    color: #6c757d;
    transition: color 0.2s;
}

a[href^="mailto:"]:hover {
    color: #495057;
}
</style>
@endpush
