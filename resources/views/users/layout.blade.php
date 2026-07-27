<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Staff Portal - Task Management')</title>
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-body: #f4f6f9;
            --bg-white: #ffffff;
            --primary-blue: #0d6efd;
            --primary-blue-hover: #0b5ed7;
            --border-color: #dee2e6;
            --text-dark: #212529;
            --text-muted: #6c757d;
            --success-color: #198754;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Blue Header */
        .app-header {
            background-color: var(--primary-blue);
            color: white;
            height: 60px;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: white;
            font-weight: 700;
            font-size: 1.15rem;
        }

        .brand-badge {
            background: white;
            color: var(--primary-blue);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-weight: 800;
            font-size: 0.9rem;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info-badge {
            background: rgba(255, 255, 255, 0.15);
            padding: 0.35rem 0.75rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .btn-logout-sm {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 0.35rem 0.75rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .btn-logout-sm:hover {
            background: white;
            color: var(--danger-color);
        }

        /* App Wrapper with Sidebar */
        .app-wrapper {
            display: flex;
            flex: 1;
        }

        /* Sidebar Navigation */
        .app-sidebar {
            width: 230px;
            background: var(--bg-white);
            border-right: 1px solid var(--border-color);
            padding: 1.25rem 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .sidebar-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            font-weight: 700;
            margin: 0.75rem 0.75rem 0.35rem 0.75rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.65rem 0.85rem;
            color: #495057;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.15s ease;
        }

        .nav-link:hover {
            background: #e9ecef;
            color: var(--primary-blue);
        }

        .nav-link.active {
            background: var(--primary-blue);
            color: white;
            font-weight: 600;
        }

        /* Main Content Container */
        .app-content {
            flex: 1;
            padding: 1.75rem;
            max-width: 1200px;
            width: 100%;
        }

        /* White Cards with Blue Border Accent */
        .card {
            background: var(--bg-white);
            border: 1px solid var(--border-color);
            border-top: 4px solid var(--primary-blue);
            border-radius: 6px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .card-header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
        }

        .btn-primary {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-primary:hover {
            background: var(--primary-blue-hover);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background: #5c636a;
        }

        .btn-info-sm {
            background: #0dcaf0;
            color: #000;
            border: none;
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            font-size: 0.8rem;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-info-sm:hover {
            background: #31d2f2;
        }

        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }

        .data-table th {
            background: #e7f1ff;
            color: #0c419a;
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-bottom: 2px solid #b6d4fe;
        }

        .data-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .data-table tr:hover {
            background: #f8f9fa;
        }

        /* Status Badges */
        .badge {
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }

        .badge-open {
            background: #fff3cd;
            color: #664d03;
            border: 1px solid #ffecb5;
        }

        .badge-completed {
            background: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        /* Form Styling */
        .form-control {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 0.5rem 0.75rem;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }

        .alert-success {
            background: #d1e7dd;
            border: 1px solid #badbcc;
            color: #0f5132;
            padding: 0.85rem 1rem;
            border-radius: 4px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }

        .app-footer {
            border-top: 1px solid var(--border-color);
            background: var(--bg-white);
            padding: 1rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .app-wrapper {
                flex-direction: column;
            }
            .app-sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <header class="app-header">
        <a href="{{ route('staff.dashboard') }}" class="header-brand" id="staff-brand-logo">
            <span class="brand-badge">TM</span>
            <span>Task Manager (Staff Portal)</span>
        </a>
        <div class="header-user">
            <div class="user-info-badge" id="staff-user-badge">
                👤 {{ Auth::user()->name }}
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout-sm" id="staff-logout-btn">Logout</button>
            </form>
        </div>
    </header>

    <div class="app-wrapper">
        <nav class="app-sidebar">
            <div class="sidebar-title">Menu</div>
            <a href="{{ route('staff.dashboard') }}" class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}" id="nav-staff-dashboard">
                <span>My Assigned Tasks</span>
            </a>
        </nav>

        <main class="app-content">
            @if(session('status'))
                <div class="alert-success" id="staff-alert-status">
                    ✓ {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <footer class="app-footer">
        &copy; {{ date('Y') }} Task Management System
    </footer>
    @yield('scripts')
</body>
</html>
