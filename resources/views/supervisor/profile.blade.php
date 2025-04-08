<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a237e;
            --hover-color: rgba(255, 255, 255, 0.15);
            --text-light: #ffffff;
            --text-dark: #2c3e50;
            --bg-light: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: var(--primary-color);
            padding-top: 1.5rem;
            box-shadow: var(--card-shadow);
            z-index: 1000;
        }

        .sidebar-link {
            color: var(--text-light);
            text-decoration: none;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-radius: 0.75rem;
            margin: 0.3rem 0.75rem;
            font-weight: 500;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background-color: var(--hover-color);
            color: var(--text-light);
            transform: translateX(5px);
        }

        .sidebar-link i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .main-content {
            margin-left: 250px;
            padding: 2.5rem;
            min-height: 100vh;
        }

        .profile-header {
            background-color: var(--text-light);
            border-radius: 1rem;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .profile-header:hover {
            transform: translateY(-5px);
        }

        .profile-avatar {
            width: 200px;
            height: 250px;
            border-radius: 1rem;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: relative;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .profile-avatar img:hover {
            transform: scale(1.05);
        }

        .profile-avatar i {
            font-size: 4rem;
            color: #6c757d;
        }

        .info-card {
            background-color: var(--text-light);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-5px);
        }

        .info-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .photo-upload-btn {
            background-color: var(--primary-color);
            color: var(--text-light);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .photo-upload-btn:hover {
            background-color: #283593;
            transform: translateY(-2px);
        }

        .upload-feedback {
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
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
                        @if($supervisor->profile_picture)
                            <img src="{{ asset('storage/' . $supervisor->profile_picture) }}" alt="Profile Picture" class="img-fluid" style="width: 200px; height: 250px; object-fit: cover; border-radius: 8px;">
                        @else
                            <i class="bi bi-person"></i>
                        @endif
                    </div>
                    <form action="{{ route('supervisor.update-photo') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                        @csrf
                        <div class="input-group">
                            <input type="file" class="form-control form-control-sm" name="profile_picture" accept="image/*" required>
                            <button type="submit" class="btn btn-primary btn-sm">Update Photo</button>
                        </div>
                        @error('profile_picture')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
                <div class="col">
                    <div class="ps-4">
                        <h2 class="mb-3 fw-bold display-4">{{ $supervisor->name }}</h2>
                        <p class="text-muted mb-2 fs-3 text-uppercase letter-spacing-2">{{ $supervisor->position }}</p>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary fs-6 text-uppercase">{{ $supervisor->department }}</span>
                        </div>
                    </div>
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
                    <div class="mb-3">
                        <div class="info-label">Address</div>
                        <div class="info-value">{{ $supervisor->address ?? 'Not set' }}</div>
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