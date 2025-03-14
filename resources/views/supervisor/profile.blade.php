<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #1a237e;
            padding-top: 1rem;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar-link {
            color: #ffffff;
            text-decoration: none;
            padding: 0.8rem 1rem;
            display: block;
            transition: all 0.3s;
            border-radius: 0.5rem;
            margin: 0.2rem 0.5rem;
        }
        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateX(5px);
        }
        .sidebar-link i {
            margin-right: 0.5rem;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
        .profile-header {
            background-color: #ffffff;
            border-radius: 0.5rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .profile-avatar {
            width: 200px;
            height: 150px;
            border-radius: 8px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .profile-avatar i {
            font-size: 3rem;
            color: #6c757d;
        }
        .info-card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .info-label {
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        .info-value {
            font-size: 1rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="px-3 mb-4">
            <h5 class="text-white">Supervisor Dashboard</h5>
        </div>
        <a href="{{ route('supervisor.dashboard') }}" class="sidebar-link">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('supervisor.profile') }}" class="sidebar-link active">
            <i class="bi bi-person"></i> Profile
        </a>
        <a href="{{ route('supervisor.settings') }}" class="sidebar-link">
            <i class="bi bi-gear"></i> Settings
        </a>
        <a href="{{ route('supervisor.work-progress.index') }}" class="sidebar-link">
            <i class="bi bi-list-task"></i> Work Progress
        </a>
        <form action="{{ route('supervisor.logout') }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    <div class="main-content">
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="profile-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="col">
                    <h2 class="mb-1">{{ $supervisor->name }}</h2>
                    <p class="text-muted mb-0">{{ $supervisor->department }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="info-card">
                    <h5 class="mb-4">Contact Information</h5>
                    <div class="mb-3">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $supervisor->email }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value">{{ $supervisor->phone_number ?? 'Not set' }}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-card">
                    <h5 class="mb-4">Department Information</h5>
                    <div class="mb-3">
                        <div class="info-label">Department</div>
                        <div class="info-value">{{ $supervisor->department }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="info-label">Supervisor ID</div>
                        <div class="info-value">{{ $supervisor->supervisor_id }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>