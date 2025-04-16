<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Progress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color:rgb(250, 233, 135);
            --secondary-color: #000000;
            --text-light: #ffffff;
            --text-dark: #000000;
        }
        body {
            background-color: var(--primary-color);
            min-height: 100vh;
            position: relative;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: -250px;
            z-index: 1000;
            padding: 20px 0;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            background-color: var(--secondary-color);
            width: 250px;
            transition: left 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }
        .sidebar.show {
            left: 0;
        }
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            color: var(--primary-color);
            padding: 12px 20px;
            margin: 4px 12px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
        }
        .sidebar .nav-link:hover {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease-in-out;
            padding: 1rem;
        }
        @media (min-width: 992px) {
            .sidebar {
                left: 0 !important;
            }
            .main-content {
                margin-left: 250px;
                padding-top: 20px;
            }
        }
        .toggle-sidebar {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        @media (min-width: 992px) {
            .toggle-sidebar {
                display: none;
            }
        }
        .page-header {
            background: var(--secondary-color);
            color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }
        .card {
            border: 2px solid var(--secondary-color);
            background-color: var(--text-light);
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.2);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            font-weight: 600;
            color: var(--text-dark);
            background-color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            white-space: nowrap;
            padding: 1rem;
        }
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }
        .table tr:hover {
            background-color: rgba(255, 215, 0, 0.05);
        }
        .badge {
            padding: 0.5em 1.2em;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: capitalize;
        }
        .badge.bg-success {
            background-color: #28a745 !important;
        }
        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #000;
        }
        .badge.bg-info {
            background-color: #17a2b8 !important;
        }
        .file-attachment {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.75rem;
            background-color: rgba(255, 215, 0, 0.1);
            border-radius: 0.5rem;
            color: var(--text-dark);
        }
        .file-attachment i {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }
        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            background-color: var(--primary-color);
            color: var(--secondary-color);
            border: 2px solid var(--secondary-color);
            font-weight: 600;
        }
        .btn-action:hover {
            transform: translateY(-1px);
            background-color: var(--secondary-color);
            color: var(--primary-color);
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }
        @media (max-width: 768px) {
            .table {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table td {
                min-width: 120px;
            }
            .table td:first-child {
                min-width: 150px;
            }
        }
        .alert {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <button class="toggle-sidebar" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <nav class="sidebar">
        <div class="sidebar-sticky">
            <div class="px-3 mb-4 text-center">
                <img src="{{ asset(path: 'images/logo fix2.png') }}" alt="Company Logo" style="max-width: 120px; margin: 0 auto 20px;">
            </div>
            <nav class="nav flex-column">
                <a href="{{ route('staff.dashboard') }}" class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('staff.attendance') }}" class="nav-link {{ request()->routeIs('staff.attendance') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Attendance
                </a>
                <a href="{{ route('staff.schedule') }}" class="nav-link {{ request()->routeIs('staff.schedule') ? 'active' : '' }}">
                    <i class="fas fa-clipboard"></i> Schedule
                </a>
                <a href="{{ route('staff.work-progress.index') }}" class="nav-link {{ request()->routeIs('staff.work-progress.*') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i> Work Progress
                </a>
                <a href="{{ route('staff.profile') }}" class="nav-link {{ request()->routeIs('staff.profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="{{ route('staff.settings') }}" class="nav-link {{ request()->routeIs('staff.settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </nav>
            <div class="mt-auto px-3 py-3 border-t border-yellow-300">
                <form action="{{ route('staff.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link w-100 text-center">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="page-header">
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Work Progress</h1>
                    <a href="{{ route('staff.work-progress.create') }}" class="btn btn-primary btn-action">
                        <i class="fas fa-plus me-2"></i>New Work Progress
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid px-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="px-4">Date</th>
                                    <th>Project Topic</th>
                                    <th>Company Name</th>
                                    <th>Status</th>
                                    <th>Files</th>
                                    <th class="text-end px-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($workProgresses as $progress)
                                    <tr>
                                        <td class="px-4">{{ $progress->created_at->format('Y-m-d H:i') }}</td>
                                        <td>{{ $progress->project_topic }}</td>
                                        <td>{{ $progress->company_name }}</td>
                                        <td>
                                            <span class="badge rounded-pill bg-{{ $progress->status === 'completed' ? 'success' : ($progress->status === 'revision' ? 'warning' : 'info') }}">
                                                {{ ucfirst($progress->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="file-attachment">
                                                <i class="fas fa-paperclip"></i>
                                                {{ $progress->files->count() }}
                                            </span>
                                        </td>
                                        <td class="text-end px-4">
                                            <a href="{{ route('staff.work-progress.show', $progress) }}" class="btn btn-sm btn-outline-primary btn-action">
                                                <i class="fas fa-eye me-1"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-folder-open mb-3 h3"></i>
                                                <p class="mb-0">No work progress entries found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.querySelector('.toggle-sidebar');
            if (window.innerWidth < 992 && 
                !sidebar.contains(event.target) && 
                !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>
</html>