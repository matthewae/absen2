<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Details - Supervisor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            background-color: #1a237e;
            padding: 1rem;
            overflow-y: auto;
            z-index: 100;
            transition: transform 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                padding: 1rem !important;
            }
            .detail-container {
                padding: 15px !important;
            }
            .status-badge, .priority-badge {
                display: inline-block;
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }
            .priority-badge {
                margin-left: 0 !important;
            }
        }
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #fff;
            border-radius: 0.5rem;
            transition: all 0.3s;
            margin-bottom: 0.5rem;
            text-decoration: none;
        }
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .nav-link i {
            margin-right: 0.75rem;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
        .header {
            background-color: #fff;
            padding: 15px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .detail-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 25px;
            margin: 20px 0;
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-weight: 500;
        }
        .priority-badge {
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-white mb-4">PT. Mandajaya</h4>
        <nav>
            <a class="nav-link" href="{{ route('supervisor.dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a class="nav-link active" href="{{ route('supervisor.assignments.index') }}">
                <i class="fas fa-tasks"></i> Assignments
            </a>
            <a class="nav-link" href="{{ route('supervisor.staff-list') }}">
                <i class="fas fa-users"></i> Staff
            </a>
        </nav>
        <div class="mt-auto pt-3 border-top">
            <div class="text-white mb-2">{{ Auth::user() ? Auth::user()->name : 'Unknown User' }}</div>
            <form action="{{ route('supervisor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Assignment Details</h4>
            <div class="d-flex align-items-center">
                <span class="me-3">{{ Auth::user() ? Auth::user()->name : 'Unknown User' }}</span>
            </div>
        </div>

        <!-- Assignment Details Container -->
        <div class="detail-container">
            <div class="row mb-4">
                <div class="col-md-8">
                    <h2 class="mb-3">{{ $assignment->title }}</h2>
                    <p class="text-muted">Assigned to: {{ $assignment->staff->name }}</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="status-badge {{ $assignment->status == 'completed' ? 'bg-success' : ($assignment->status == 'in_progress' ? 'bg-warning' : 'bg-secondary') }} text-white">
                        {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                    </span>
                    <span class="priority-badge ms-2 {{ $assignment->priority == 'high' ? 'bg-danger' : ($assignment->priority == 'medium' ? 'bg-warning' : 'bg-info') }} text-white">
                        {{ ucfirst($assignment->priority) }} Priority
                    </span>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Description</h5>
                    <p>{{ $assignment->description }}</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Start Date & Time</h5>
                            <p>{{ $assignment->start_datetime->format('M d, Y h:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>End Date & Time</h5>
                            <p>{{ $assignment->end_datetime->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($assignment->attachment)
            <div class="mb-4">
                <h5>Attachment</h5>
                <a href="{{ Storage::url($assignment->attachment) }}" class="btn btn-outline-primary" target="_blank">
                    <i class="fas fa-download me-2"></i>Download Attachment
                </a>
            </div>
            @endif

            <div class="d-flex justify-content-between">
                <a href="{{ route('supervisor.assignments.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
                <div>
                    <!-- <a href="{{ route('supervisor.assignments.edit', $assignment->id) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit me-2"></i>Edit Assignment
                    </a> -->
                    <form action="{{ route('supervisor.assignments.destroy', $assignment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this assignment?')">
                            <i class="fas fa-trash me-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'btn btn-primary d-md-none position-fixed';
            toggleBtn.style.cssText = 'top: 10px; left: 10px; z-index: 1000;';
            toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
            document.body.appendChild(toggleBtn);
        
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
        
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        
            // Close sidebar when clicking outside
            mainContent.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                }
            });
        
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>