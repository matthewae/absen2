<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management - Supervisor Dashboard</title>
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
            z-index: 1000;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 1rem;
            font-size: 0.95rem;
        }
        .table th {
            background-color: #f0f2f5;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #dee2e6;
        }
        .btn-sm {
            margin-right: 5px;
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }
        .btn-sm:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card {
            border: none;
            box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.05);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .search-box {
            position: relative;
            max-width: 300px;
        }
        .search-box .form-control {
            padding-left: 2.5rem;
            padding-right: 1rem;
            height: 2.75rem;
            border-radius: 1.375rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        .search-box .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }
        .search-box .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(59,130,246,0.05);
            cursor: pointer;
        }
        .badge {
            padding: 0.35em 0.65em;
            font-size: 0.85em;
            font-weight: 500;
            border-radius: 0.375rem;
        }
        .alert {
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .alert-success {
            background-color: #dcfce7;
            color: #166534;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .table-responsive {
                border-radius: 0.5rem;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="mb-4">
            <h4 class="mb-2">Staff Management</h4>
            <p class="text-muted small mb-0"></p>
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
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Staff List</h2>
                <div class="d-flex align-items-center gap-3">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="staffSearch" class="form-control" placeholder="Search staff..." onkeyup="searchStaff()">
                    </div>
                    <span class="text-muted">{{ now()->format('l, F j, Y') }}</span>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="staffTable">
                            <thead>
                                <tr>
                                    <th>Staff ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staff as $member)
                                <tr>
                                    <td>{{ $member->staff_id }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->phone_number }}</td>
                                    <td><span class="badge bg-primary">{{ $member->position }}</span></td>
                                    <td>
                                        <a href="{{ route('supervisor.staff.show', $member) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('supervisor.staff.edit', $member) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchStaff() {
            const input = document.getElementById('staffSearch');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('staffTable');
            const rows = table.getElementsByTagName('tr');
            const searchTerms = filter.split(' ').filter(term => term.length > 0);

            for (let i = 1; i < rows.length; i++) {
                let found = searchTerms.length === 0;
                const cells = rows[i].getElementsByTagName('td');
                
                if (!found) {
                    const rowText = Array.from(cells)
                        .slice(0, -1)
                        .map(cell => cell.textContent || cell.innerText)
                        .join(' ')
                        .toLowerCase();

                    found = searchTerms.every(term => rowText.includes(term));
                }
                
                rows[i].style.display = found ? '' : 'none';
                if (found) {
                    rows[i].classList.add('animate__animated', 'animate__fadeIn');
                }
            }
        }

        // Add event listener for real-time search
        document.getElementById('staffSearch').addEventListener('input', debounce(searchStaff, 300));

        // Debounce function to improve search performance
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
    </script>
</body>
</html>
