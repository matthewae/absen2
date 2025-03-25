<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Progress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            background-color: #1a237e;
            width: 250px;
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
            font-weight: 500;
            color: rgba(255, 255, 255, 0.8);
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .main-content {
            margin-left: 250px;
        }
        .page-header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            border-radius: 0.5rem;
        }
        .table th {
            font-weight: 600;
            color: #495057;
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
        }
        .btn-action {
            padding: 0.375rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }
        .btn-action:hover {
            transform: translateY(-1px);
        }
        .alert {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <div class="sidebar-sticky">
            <div class="px-3 mb-4">
                <h5 class="text-white fw-bold">Staff Dashboard</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}" href="{{ route('staff.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.work-progress.*') ? 'active' : '' }}" href="{{ route('staff.work-progress.index') }}">
                        <i class="fas fa-tasks"></i> Work Progress
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.attendance') ? 'active' : '' }}" href="{{ route('staff.attendance') }}">
                        <i class="fas fa-calendar-check"></i> Attendance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.profile') ? 'active' : '' }}" href="{{ route('staff.profile') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
            </ul>
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
                                            <span class="d-inline-flex align-items-center">
                                                <i class="fas fa-paperclip me-2 text-muted"></i>
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
</body>
</html>