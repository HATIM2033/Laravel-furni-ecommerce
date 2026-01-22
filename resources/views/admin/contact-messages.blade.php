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
                                        <th width="8%">Actions</th>
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
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button class="btn btn-sm btn-outline-primary view-message-btn" 
                                                            data-message-id="{{ $message->id }}"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#viewMessageModal"
                                                            title="View Message">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-success reply-message-btn" 
                                                            data-message-id="{{ $message->id }}"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#replyMessageModal"
                                                            title="Reply to Message">
                                                        <i class="fas fa-reply"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger delete-message-btn" 
                                                            data-message-id="{{ $message->id }}"
                                                            title="Delete Message">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
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

<!-- Reply Message Modal -->
<div class="modal fade" id="replyMessageModal" tabindex="-1" aria-labelledby="replyMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="replyMessageModalLabel">
                    <i class="fas fa-reply me-2"></i>Reply to Contact Message
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="replyForm">
                <div class="modal-body">
                    <div id="replyMessageContent">
                        <!-- Message details will be loaded here -->
                    </div>
                    
                    <div class="mt-4">
                        <label for="replyMessage" class="form-label fw-bold">
                            <i class="fas fa-pen me-1"></i>Your Reply
                        </label>
                        <textarea class="form-control" id="replyMessage" name="reply" rows="6" 
                                  placeholder="Type your reply here..." required></textarea>
                        <div class="form-text">
                            Minimum 10 characters, maximum 2000 characters. This reply will be sent to the user's email address.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-success" id="sendReplyBtn">
                        <i class="fas fa-paper-plane me-1"></i>Send Reply
                    </button>
                </div>
            </form>
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
    
    // Handle Reply Message modal
    const replyMessageModal = document.getElementById('replyMessageModal');
    const replyMessageContent = document.getElementById('replyMessageContent');
    const replyForm = document.getElementById('replyForm');
    const sendReplyBtn = document.getElementById('sendReplyBtn');
    const replyMessageTextarea = document.getElementById('replyMessage');
    let currentMessageId = null;
    
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
    
    // Handle Reply Message modal
    if (replyMessageModal) {
        replyMessageModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const messageId = button.getAttribute('data-message-id');
            currentMessageId = messageId;
            
            // Fetch message details for reply
            fetch(`/admin/contact-messages/${messageId}/details`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Display message details in reply modal
                    replyMessageContent.innerHTML = `
                        <div class="alert alert-light">
                            <h6 class="fw-bold mb-2">Original Message:</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>From:</strong> ${data.message.full_name}</p>
                                    <p><strong>Email:</strong> ${data.message.email}</p>
                                    <p><strong>Date:</strong> ${data.message.created_at}</p>
                                </div>
                                <div class="col-md-6">
                                    ${data.message.subject ? `<p><strong>Subject:</strong> ${data.message.subject}</p>` : ''}
                                </div>
                            </div>
                            <div class="mt-2">
                                <p><strong>Message:</strong></p>
                                <p class="mb-0">${data.message.message}</p>
                            </div>
                        </div>
                    `;
                    
                    // Clear previous reply
                    replyMessageTextarea.value = '';
                    
                    // Mark as read if it's a new message
                    if (!data.message.is_replied) {
                        markMessageAsRead(messageId);
                    }
                } else {
                    replyMessageContent.innerHTML = '<div class="alert alert-danger">Failed to load message details.</div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                replyMessageContent.innerHTML = '<div class="alert alert-danger">Error loading message details.</div>';
            });
        });
    }
    
    // Handle reply form submission
    if (replyForm) {
        replyForm.addEventListener('submit', function (e) {
            e.preventDefault();
            
            const replyText = replyMessageTextarea.value.trim();
            
            if (!replyText || replyText.length < 10) {
                alert('Please enter at least 10 characters for your reply.');
                return;
            }
            
            // Disable send button
            sendReplyBtn.disabled = true;
            sendReplyBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Sending...';
            
            // Send reply
            fetch(`/admin/contact-messages/${currentMessageId}/reply`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    reply: replyText
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(replyMessageModal);
                    modal.hide();
                    
                    // Show success message
                    showAlert('success', data.message);
                    
                    // Update status badge in table
                    const row = document.querySelector(`tr[data-message-id="${currentMessageId}"]`);
                    if (row) {
                        const statusBadge = row.querySelector('.badge');
                        statusBadge.className = 'badge bg-secondary';
                        statusBadge.textContent = 'Read';
                    }
                } else {
                    showAlert('error', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Failed to send reply. Please try again.');
            })
            .finally(() => {
                // Re-enable send button
                sendReplyBtn.disabled = false;
                sendReplyBtn.innerHTML = '<i class="fas fa-paper-plane me-1"></i>Send Reply';
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
    
    // Function to show alerts
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alertDiv);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.parentNode.removeChild(alertDiv);
            }
        }, 5000);
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
    
    // Handle delete message buttons
    const deleteButtons = document.querySelectorAll('.delete-message-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const messageId = this.getAttribute('data-message-id');
            const row = this.closest('tr');
            const senderName = row.querySelector('.fw-bold').textContent;
            
            if (confirm(`Are you sure you want to delete the message from ${senderName}? This action cannot be undone.`)) {
                // Disable button and show loading
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                
                // Delete the message
                fetch(`/admin/contact-messages/${messageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the row with animation
                        row.style.transition = 'opacity 0.3s, transform 0.3s';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(-20px)';
                        
                        setTimeout(() => {
                            row.remove();
                            
                            // Update message counts
                            updateMessageCounts();
                            
                            // Show success message
                            showAlert('success', data.message);
                            
                            // Check if table is empty
                            checkEmptyState();
                        }, 300);
                    } else {
                        showAlert('error', data.message);
                        // Restore button
                        this.disabled = false;
                        this.innerHTML = '<i class="fas fa-trash"></i>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'Failed to delete message. Please try again.');
                    // Restore button
                    this.disabled = false;
                    this.innerHTML = '<i class="fas fa-trash"></i>';
                });
            }
        });
    });
    
    // Function to update message counts
    function updateMessageCounts() {
        const totalMessages = document.querySelectorAll('tbody tr').length;
        const newMessages = document.querySelectorAll('tbody tr .badge.bg-success').length;
        const readMessages = document.querySelectorAll('tbody tr .badge.bg-secondary').length;
        
        // Update header counts
        const totalCountElement = document.querySelector('.text-end .badge-primary');
        const newCountElement = document.querySelector('.text-end .badge-success');
        const readCountElement = document.querySelector('.text-end .badge-secondary');
        
        if (totalCountElement) totalCountElement.textContent = totalMessages;
        if (newCountElement) newCountElement.textContent = newMessages;
        if (readCountElement) readCountElement.textContent = readMessages;
    }
    
    // Function to check if table is empty and show empty state
    function checkEmptyState() {
        const tbody = document.querySelector('tbody');
        const tableContainer = document.querySelector('.table-responsive');
        
        if (tbody && tbody.children.length === 0) {
            const emptyState = `
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
            `;
            tableContainer.parentElement.innerHTML = emptyState;
        }
    }
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
