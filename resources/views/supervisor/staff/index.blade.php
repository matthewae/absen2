<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management - Supervisor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --pagination-hover: #fff8e1;
            --primary-yellow: #ffd700;
            --secondary-yellow: #ffeb3b;
            --dark-yellow: #ffc107;
            --text-black: #212121;
            --bg-light: #fffde7;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: var(--text-black);
            padding: 10px;
            color: var(--primary-yellow);
            z-index: 1001;
            transition: all 0.3s ease;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }
        
        .nav {
            flex: 1;
            padding-bottom: 8px;
        }
        
        .nav-link {
            margin-bottom: 2px;
            padding: 6px 10px;
            font-size: 0.875rem;
            gap: 8px;
        }
        
        .mt-auto {
            margin-top: auto;
            padding: 10px !important;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                backdrop-filter: blur(4px);
                width: 280px;
            }
            .sidebar.show {
                transform: translateX(0);
                box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            .navbar-toggler {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 45px;
                height: 45px;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1002;
                background: var(--primary-yellow);
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
        }
        .main-content {
            margin-left: 220px;
            padding: 30px;
            background-color: var(--bg-light);
            min-height: 100vh;
        }
        .nav-link {
            color: var(--primary-yellow);
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid transparent;
            font-weight: 500;
            letter-spacing: 0.3px;
            gap: 10px;
            font-size: 1rem;
        }
        .nav-link:hover, .nav-link.active {
            background-color: var(--primary-yellow);
            color: var(--text-black);
        }
        .nav-link i {
            width: 15px;
            text-align: center;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 1.25rem 1rem;
            font-size: 0.95rem;
            border-bottom: 1px solid var(--dark-yellow);
        }
        .table th {
            background-color: var(--primary-yellow);
            font-weight: 600;
            color: var(--text-black);
            border-bottom: 2px solid var(--text-black);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .btn-sm {
            margin-right: 8px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .btn-sm:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        }
        .btn-info {
            background-color: var(--primary-yellow);
            color: var(--text-black);
            border-color: var(--dark-yellow);
        }
        .btn-primary {
            background-color: var(--text-black);
            color: var(--primary-yellow);
            border-color: var(--primary-yellow);
        }
        .card {
            border: 2px solid var(--dark-yellow);
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
            transition: all 0.3s ease;
            background-color: white;
        }
        .card:hover {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
            border-color: var(--primary-yellow);
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
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
            padding: 0.75rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .pagination .page-item {
            list-style: none;
            margin: 0;
        }
        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            height: 2.5rem;
            padding: 0.5rem 1rem;
            border: 2px solid var(--dark-yellow);
            border-radius: 0.5rem;
            color: var(--text-black);
            font-weight: 500;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s ease;
            background: white;
        }
        .pagination .page-item.active .page-link {
            background: var(--primary-yellow);
            border-color: var(--dark-yellow);
            color: var(--text-black);
            font-weight: 600;
        }
        .pagination .page-link:hover {
            background-color: var(--pagination-hover);
            border-color: var(--primary-yellow);
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(255, 193, 7, 0.15);
        }
        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            color: #adb5bd;
            cursor: not-allowed;
            pointer-events: none;
            opacity: 0.7;
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
        <!-- Company Logo/Name -->
        <div class="text-center mb-4 p-4">
            <img src="{{ asset('images/logo fix2.png') }}" alt="PT. Mandajaya Rekayasa Konstruksi" class="img-fluid" style="max-width: 100px;">
        </div>

        <!-- Navigation Links -->
        <div class="nav flex-column mb-4">
            <a href="{{ route('supervisor.dashboard') }}" class="nav-link">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('supervisor.staff.index') }}" class="nav-link active">
                <i class="fas fa-users"></i> Staff Management
            </a>
            <a href="{{ route('supervisor.assignments.index') }}" class="nav-link">
                <i class="fas fa-tasks"></i> Assignments
            </a>
            <a href="{{ route('supervisor.attendance.index') }}" class="nav-link">
                <i class="fas fa-clock"></i> Attendance
            </a>
            <a href="{{ route('supervisor.work-progress.index') }}" class="nav-link">
                <i class="fas fa-chart-line"></i> Work Progress
            </a>
            <a href="{{ route('supervisor.leave-requests.index') }}" class="nav-link">
                <i class="fas fa-calendar-alt"></i> Leave Requests
            </a>
            <a href="{{ route('supervisor.profile') }}" class="nav-link">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{ route('supervisor.settings') }}" class="nav-link">
                <i class="fas fa-cog"></i> Settings
            </a>
        </div>

        <!-- Logout Button -->
        <div class="mt-auto p-3 border-top border-warning">
            <form action="{{ route('supervisor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
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
                        <div class="mb-3 text-end">
                            <small class="text-muted">Showing {{ $staff->firstItem() }} to {{ $staff->lastItem() }} of {{ $staff->total() }} entries</small>
                        </div>
                        <table class="table table-hover" id="staffTable">
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
                    <div class="pagination-container mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $staff->firstItem() }} to {{ $staff->lastItem() }} of {{ $staff->total() }} entries
                            </div>
                            <div class="pagination">
                                @if ($staff->onFirstPage())
                                    <span class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                                    </span>
                                @else
                                    <a class="page-item" href="{{ $staff->previousPageUrl() }}">
                                        <span class="page-link"><i class="fas fa-chevron-left"></i></span>
                                    </a>
                                @endif
                            
                                @foreach ($staff->getUrlRange(1, $staff->lastPage()) as $page => $url)
                                    <a class="page-item {{ $page == $staff->currentPage() ? 'active' : '' }}" href="{{ $url }}">
                                        <span class="page-link">{{ $page }}</span>
                                    </a>
                                @endforeach
                            
                                @if ($staff->hasMorePages())
                                    <a class="page-item" href="{{ $staff->nextPageUrl() }}">
                                        <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                                    </a>
                                @else
                                    <span class="page-item disabled">
                                        <span class="page-link"><i class="fas fa-chevron-right"></i></span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
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
    let hasResults = false;

    // Remove any existing "no results" message
    const existingNoResults = document.getElementById('noResultsMessage');
    if (existingNoResults) {
        existingNoResults.remove();
    }

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let found = searchTerms.length === 0;

        if (!found) {
            const rowText = Array.from(cells)
                .slice(0, -1) // Exclude the actions column
                .map(cell => cell.textContent || cell.innerText)
                .join(' ')
                .toLowerCase();

            found = searchTerms.every(term => rowText.includes(term));
        }

        if (found) {
            rows[i].style.display = '';
            hasResults = true;
            // Highlight matching terms
            Array.from(cells).forEach(cell => {
                let text = cell.textContent || cell.innerText;
                let highlightedText = text;
                searchTerms.forEach(term => {
                    if (term.length > 0) {
                        const regex = new RegExp(term, 'gi');
                        highlightedText = highlightedText.replace(regex, match => `<span class="bg-yellow-200">${match}</span>`);
                    }
                });
                if (text !== highlightedText) {
                    cell.innerHTML = highlightedText;
                }
            });
        } else {
            rows[i].style.display = 'none';
        }
    }

    // Show "no results" message if no matches found
    if (!hasResults && searchTerms.length > 0) {
        const tbody = table.getElementsByTagName('tbody')[0];
        const noResultsRow = document.createElement('tr');
        noResultsRow.id = 'noResultsMessage';
        noResultsRow.innerHTML = `
            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                <div class="flex flex-col items-center justify-center space-y-2">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <p>No staff members found matching "<span class="font-medium">${filter}</span>"</p>
                </div>
            </td>
        `;
        tbody.appendChild(noResultsRow);
    }
}

// Add event listener for real-time search with debounce
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

<style>
.pagination-container {
    background: white;
    padding: 1rem;
    border-radius: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.pagination {
    margin: 0;
    gap: 0.5rem;
}

.page-item .page-link {
    border: 2px solid var(--dark-yellow);
    color: var(--text-black);
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: 500;
    min-width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.page-item.active .page-link {
    background-color: var(--primary-yellow);
    border-color: var(--dark-yellow);
    color: var(--text-black);
    font-weight: 600;
}

.page-item .page-link:hover {
    background-color: var(--pagination-hover);
    border-color: var(--primary-yellow);
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(255, 193, 7, 0.15);
}

.page-item.disabled .page-link {
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #adb5bd;
    pointer-events: none;
    opacity: 0.7;
}
</style>

<!-- Add this button before the main content div -->
<button class="navbar-toggler d-md-none" type="button" onclick="toggleSidebar()" aria-label="Toggle navigation">
    <i class="fas fa-bars" style="font-size: 1.25rem; color: var(--text-black);"></i>
</button>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const toggler = document.querySelector('.navbar-toggler');
    sidebar.classList.toggle('show');
    
    // Close sidebar when clicking outside
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !toggler.contains(event.target) && sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        }
    });
}
</script>
</body>
</html>

<style>
.pagination-container {
    background: white;
    padding: 1rem;
    border-radius: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.pagination {
    margin: 0;
    gap: 0.5rem;
}

.page-item .page-link {
    border: 2px solid var(--dark-yellow);
    color: var(--text-black);
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: 500;
    min-width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.page-item.active .page-link {
    background: var(--primary-yellow);
    color: var(--text-black);
    transform: translateX(3px);
    border-color: var(--dark-yellow);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.page-item .page-link:hover {
    background-color: var(--pagination-hover);
    border-color: var(--primary-yellow);
    transform: translateY(-2px);
    box-shadow: 0 3px 8px rgba(255, 193, 7, 0.15);
}

.page-item.disabled .page-link {
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #adb5bd;
    pointer-events: none;
    opacity: 0.7;
}
</style>