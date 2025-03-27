<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details - Supervisor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: #1a237e;
            padding: 20px;
            color: white;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .profile-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .profile-info h3 {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }
        .profile-info .text-muted {
            font-size: 1.1rem;
            color: #6c757d;
        }
        .table th {
            width: 30%;
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }
        .table td {
            color: #4a5568;
        }
        .badge {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        .btn-primary {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="mb-4">
            <h4 class="mb-2">Supervisor Portal</h4>
            <p class="text-muted small mb-0">Staff Management</p>
        </div>
        <div class="mb-4">
            <a href="{{ route('supervisor.dashboard') }}" class="nav-link">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('supervisor.staff.index') }}" class="nav-link active">
                <i class="fas fa-users"></i> Staff List
            </a>
            <a href="{{ route('supervisor.assignments.index') }}" class="nav-link">
                <i class="fas fa-tasks"></i> Assignments
            </a>
            <a href="{{ route('supervisor.attendance.index') }}" class="nav-link">
                <i class="fas fa-clock"></i> Attendance
            </a>
        </div>
        <div class="mt-auto">
            <form action="{{ route('supervisor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Staff Details</h2>
                <div>
                    <a href="{{ route('supervisor.staff.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to Staff List
                    </a>
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-header">
                    <img src="{{ $staff->photo_url ?? 'https://via.placeholder.com/120' }}" alt="{{ $staff->name }}" class="profile-image">
                    <div class="profile-info">
                        <h3>{{ $staff->name }}</h3>
                        <!-- <p class="text-muted mb-1">{{ $staff->position }}</p> -->
                        <p class="text-muted mb-0">Staff ID: {{ $staff->staff_id }}</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Personal Information</h4>
                                <table class="table table-hover">
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $staff->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $staff->phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $staff->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Employment Details</h4>
                                <table class="table table-hover">
                                    <tr>
                                        <th>Department</th>
                                        <td>{{ $staff->department }}</td>
                                    </tr>
                                    <tr>
                                        <th>Position</th>
                                        <td>{{ $staff->position }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge bg-success rounded-pill">Active</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('supervisor.staff.edit', $staff) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Staff Details
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>