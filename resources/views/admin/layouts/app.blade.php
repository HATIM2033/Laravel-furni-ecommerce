<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Laravel E-commerce')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Admin Custom CSS -->
    <style>
        :root {
            --sidebar-bg: #2c3e50;
            --sidebar-hover: #34495e;
            --sidebar-active: #3498db;
            --header-bg: #ecf0f1;
            --card-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            background: transparent;
        }

        .sidebar-menu .nav-link:hover {
            background: var(--sidebar-hover);
            color: white;
        }

        .sidebar-menu .nav-link.active {
            background: var(--sidebar-active);
            color: white;
        }

        .sidebar-menu .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            background: #f8f9fa;
            min-height: 100vh;
        }

        /* Header */
        .admin-header {
            background: var(--header-bg);
            padding: 15px 30px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .admin-header h1 {
            margin: 0;
            font-size: 1.75rem;
            color: #2c3e50;
            font-weight: 600;
        }

        .admin-header .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .admin-header .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #3498db;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        /* Cards */
        .admin-card {
            background: white;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            border: none;
            margin-bottom: 25px;
        }

        .admin-card .card-header {
            background: transparent;
            border-bottom: 1px solid #dee2e6;
            padding: 20px 25px;
            font-weight: 600;
            color: #2c3e50;
        }

        .admin-card .card-body {
            padding: 25px;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            border-left: 4px solid #3498db;
            margin-bottom: 25px;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-card.primary { border-left-color: #3498db; }
        .stat-card.success { border-left-color: #27ae60; }
        .stat-card.warning { border-left-color: #f39c12; }
        .stat-card.danger { border-left-color: #e74c3c; }
        .stat-card.info { border-left-color: #17a2b8; }

        .stat-card .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .stat-card.primary .stat-icon { color: #3498db; }
        .stat-card.success .stat-icon { color: #27ae60; }
        .stat-card.warning .stat-icon { color: #f39c12; }
        .stat-card.danger .stat-icon { color: #e74c3c; }
        .stat-card.info .stat-icon { color: #17a2b8; }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tables */
        .admin-table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .admin-table .table {
            margin: 0;
        }

        .admin-table .table th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #2c3e50;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .admin-table .table td {
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
        }

        /* Buttons */
        .btn-admin {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-admin-primary {
            background: #3498db;
            color: white;
        }

        .btn-admin-primary:hover {
            background: #2980b9;
            color: white;
        }

        .btn-admin-success {
            background: #27ae60;
            color: white;
        }

        .btn-admin-success:hover {
            background: #229954;
            color: white;
        }

        .btn-admin-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-admin-danger:hover {
            background: #c0392b;
            color: white;
        }

        .btn-admin-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-admin-secondary:hover {
            background: #5a6268;
            color: white;
        }

        /* Badges */
        .badge-admin {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .content-area {
                padding: 20px 15px;
            }

            .admin-header {
                padding: 15px 20px;
            }
        }

        /* Flash Messages */
        .alert-admin {
            border-radius: 8px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-admin-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #27ae60;
        }

        .alert-admin-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #e74c3c;
        }

        .alert-admin-warning {
            background: #fff3cd;
            color: #856404;
            border-left: 4px solid #f39c12;
        }

        .alert-admin-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-cog me-2"></i>Admin Panel</h3>
            </div>
            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.products') }}" class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    Products
                </a>
                <a href="{{ route('admin.categories') }}" class="nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i>
                    Categories
                </a>
                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    Users
                </a>
                <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    Orders
                </a>
                <a href="{{ route('admin.contact-messages') }}" class="nav-link {{ request()->routeIs('admin.contact-messages*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    Contact Messages
                </a>
                <hr style="border-color: rgba(255,255,255,0.1); margin: 20px;">
                <a href="{{ route('home') }}" class="nav-link" target="_blank">
                    <i class="fas fa-store"></i>
                    View Website
                </a>
                <a href="{{ route('profile.index') }}" class="nav-link">
                    <i class="fas fa-user"></i>
                    My Profile
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link" style="background: none; border: none; color: rgba(255,255,255,0.8); width: 100%; text-align: left;">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="admin-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h1>@yield('title', 'Admin Dashboard')</h1>
                    <div class="d-flex align-items-center">
                        <!-- Notifications Bell -->
                        <div class="notification-dropdown me-3">
                            <button class="btn btn-link position-relative p-2 text-decoration-none" 
                                    type="button" 
                                    id="notificationDropdown" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <i class="fas fa-bell fa-lg"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
                                      id="notificationCount">
                                    0
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end notification-menu" 
                                aria-labelledby="notificationDropdown" 
                                style="width: 350px; max-height: 400px; overflow-y: auto;">
                                <li class="dropdown-header d-flex justify-content-between align-items-center">
                                    <span>Notifications</span>
                                    <button class="btn btn-sm btn-link text-decoration-none p-0" 
                                            onclick="markAllNotificationsAsRead()">
                                        Mark all as read
                                    </button>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <div id="notificationsList">
                                    <!-- Notifications will be loaded here -->
                                </div>
                            </ul>
                        </div>
                        
                        <div class="user-info">
                            <span class="text-muted me-3">Welcome, {{ auth()->user()->name }}</span>
                            <div class="user-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="content-area">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-admin-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-admin-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-admin-warning alert-dismissible fade show" role="alert">
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-admin-info alert-dismissible fade show" role="alert">
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Notifications JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        loadNotifications();
        
        // Refresh notifications every 30 seconds
        setInterval(loadNotifications, 30000);
        
        // Load notifications when dropdown is shown
        const notificationDropdown = document.getElementById('notificationDropdown');
        if (notificationDropdown) {
            notificationDropdown.addEventListener('click', function() {
                loadNotifications();
            });
        }
    });
    
    function loadNotifications() {
        fetch('/admin/notifications', {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            updateNotificationCount(data.unread_count);
            updateNotificationsList(data.notifications);
        })
        .catch(error => console.error('Error loading notifications:', error));
    }
    
    function updateNotificationCount(count) {
        const countElement = document.getElementById('notificationCount');
        if (countElement) {
            countElement.textContent = count;
            countElement.style.display = count > 0 ? 'block' : 'none';
        }
    }
    
    function updateNotificationsList(notifications) {
        const listElement = document.getElementById('notificationsList');
        if (!listElement) return;
        
        if (notifications.length === 0) {
            listElement.innerHTML = `
                <li class="dropdown-item text-center text-muted py-3">
                    No notifications
                </li>
            `;
            return;
        }
        
        listElement.innerHTML = notifications.map(notification => `
            <li class="dropdown-item notification-item ${!notification.is_read ? 'unread' : ''}" 
                data-notification-id="${notification.id}">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="fw-bold ${!notification.is_read ? 'text-primary' : ''}">
                            ${notification.title}
                        </div>
                        <div class="small text-muted">${notification.message}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">
                            ${formatTime(notification.created_at)}
                        </div>
                    </div>
                    ${!notification.is_read ? `
                        <div class="ms-2">
                            <span class="badge bg-primary rounded-pill">New</span>
                        </div>
                    ` : ''}
                </div>
                ${notification.url ? `
                    <div class="mt-2">
                        <a href="${notification.url}" class="btn btn-sm btn-outline-primary" 
                           onclick="markNotificationAsRead(${notification.id})">
                            View
                        </a>
                    </div>
                ` : ''}
            </li>
            ${notifications.indexOf(notification) < notifications.length - 1 ? '<li><hr class="dropdown-divider"></li>' : ''}
        `).join('');
    }
    
    function formatTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diff = Math.floor((now - date) / 1000); // seconds
        
        if (diff < 60) return 'Just now';
        if (diff < 3600) return Math.floor(diff / 60) + ' minutes ago';
        if (diff < 86400) return Math.floor(diff / 3600) + ' hours ago';
        if (diff < 604800) return Math.floor(diff / 86400) + ' days ago';
        
        return date.toLocaleDateString();
    }
    
    function markNotificationAsRead(notificationId) {
        fetch(`/admin/notifications/${notificationId}/mark-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications(); // Refresh the list
            }
        })
        .catch(error => console.error('Error marking notification as read:', error));
    }
    
    function markAllNotificationsAsRead() {
        fetch('/admin/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications(); // Refresh the list
            }
        })
        .catch(error => console.error('Error marking all notifications as read:', error));
    }
    </script>
    
    <style>
    /* Notification Bell Styles */
    .notification-dropdown .btn-link {
        color: #6c757d;
        position: relative;
        transition: color 0.2s;
    }
    
    .notification-dropdown .btn-link:hover {
        color: #495057;
    }
    
    .notification-dropdown .badge {
        font-size: 0.65rem;
        min-width: 18px;
        height: 18px;
        padding: 0 4px;
        line-height: 18px;
    }
    
    .notification-menu {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
    }
    
    .notification-item {
        padding: 12px 16px;
        border-left: 3px solid transparent;
        transition: all 0.2s;
    }
    
    .notification-item.unread {
        background-color: #f8f9fa;
        border-left-color: #007bff;
    }
    
    .notification-item:hover {
        background-color: #e9ecef;
    }
    
    .notification-item .badge {
        font-size: 0.7rem;
    }
    
    .notification-item .btn-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    .dropdown-header {
        font-weight: 600;
        color: #495057;
        padding: 8px 16px;
        font-size: 0.875rem;
    }
    
    .dropdown-header .btn-link {
        font-size: 0.75rem;
        color: #6c757d;
    }
    
    .dropdown-header .btn-link:hover {
        color: #495057;
    }
    
    @keyframes bellRing {
        0%, 100% { transform: rotate(0deg); }
        10%, 30% { transform: rotate(-10deg); }
        20%, 40% { transform: rotate(10deg); }
    }
    
    .notification-dropdown .btn-link:hover i {
        animation: bellRing 0.5s ease-in-out;
    }
    </style>
    
    @stack('scripts')
</body>
</html>
