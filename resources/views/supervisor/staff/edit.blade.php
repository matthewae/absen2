<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff - Supervisor Dashboard</title>
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
        .form-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
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
                <h2 class="mb-0">Edit Staff Details</h2>
                <div>
                    <a href="{{ route('supervisor.staff.show', $staff) }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to Staff Details
                    </a>
                </div>
            </div>

            <div class="form-section">
                <form action="{{ route('supervisor.staff.update', $staff) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4 class="mb-3">Personal Information</h4>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $staff->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $staff->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $staff->phone_number) }}">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $staff->address) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                <small class="text-muted">Leave empty to keep current photo</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4 class="mb-3">Employment Details</h4>
                            
                            <div class="mb-3">
                                <label for="staff_id" class="form-label">Staff ID</label>
                                <input type="text" class="form-control" id="staff_id" name="staff_id" value="{{ old('staff_id', $staff->staff_id) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $staff->position) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department" value="{{ old('department', $staff->department) }}" required>
                            </div>

                            <!-- <div class="mb-3">
                                <label for="join_date" class="form-label">Join Date</label>
                                <input type="date" class="form-control" id="join_date" name="join_date" value="{{ old('join_date', $staff->join_date?->format('Y-m-d')) }}" required>
                            </div> -->
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>