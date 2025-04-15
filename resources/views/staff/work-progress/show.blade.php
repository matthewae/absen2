<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Progress Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgb(250, 233, 135);
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
            padding: 48px 0 0;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            background-color: var(--secondary-color);
            width: 250px;
            transition: left 0.3s ease-in-out;
        }
        .sidebar.show {
            left: 0;
        }
        @media (min-width: 768px) {
            .sidebar {
                left: 0;
            }
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
            color: var(--primary-color);
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .sidebar .nav-link:hover {
            color: var(--text-light);
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: var(--text-light);
            background-color: rgba(255, 255, 255, 0.1);
        }
        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s ease-in-out;
            padding: 1rem;
        }
        @media (min-width: 768px) {
            .main-content {
                margin-left: 250px;
                padding: 2rem;
            }
        }
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        @media (max-width: 767px) {
            .table th, .table td {
                min-width: 120px;
            }
            .table td:last-child {
                min-width: 100px;
            }
        }
        .menu-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            padding: 0.5rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        @media (min-width: 768px) {
            .menu-toggle {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-sticky">
            <div class="px-6 mb-8">
                <img src="{{ asset(path: 'images/logo fix2.png') }}" alt="Company Logo" class="img-fluid" style="max-width: 100px; height: auto;">
            </div>
            <nav class="space-y-2">
                <a href="{{ route('staff.dashboard') }}" class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ route('staff.work-progress.index') }}" class="nav-link {{ request()->routeIs('staff.work-progress.*') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i> Work Progress
                </a>
                <a href="{{ route('staff.attendance') }}" class="nav-link {{ request()->routeIs('staff.attendance') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Attendance
                </a>
                <a href="{{ route('staff.profile') }}" class="nav-link {{ request()->routeIs('staff.profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> Profile
                </a>
            </nav>
        </div>
    </nav>


    </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="bg-white shadow-sm sticky top-0 z-10 backdrop-blur-sm bg-white/90 mb-6 rounded-lg page-header">
            <div class="px-4 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold" style="color: var(--secondary-color)">Work Progress Details</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow p-6 card">
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $workProgress->project_topic }}</h3>
                        <span class="px-3 py-1 rounded-full text-sm <?php echo e(($workProgress->status === 'completed') ? 'bg-green-100 text-green-800' : 
                                (($workProgress->status === 'pending') ? 'bg-gray-100 text-black-800' : 
                                ($workProgress->status === 'revision' ? 'bg-orange-100 text-orange-800' : 
                                ($workProgress->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')))); ?>">
                            <?php echo e(ucfirst(str_replace('_', ' ', $workProgress->status))); ?>
                        </span>
                    </div>
                    <p class="text-sm text-gray-500">Submitted on {{ $workProgress->created_at->format('Y-m-d H:i') }}</p>
                </div>

                <div class="mb-6">
                    <h4 class="text-md font-semibold text-gray-700 mb-2">Description</h4>
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-700">
                        {{ $workProgress->work_description }}
                    </div>
                </div>

                <div>
                    <h4 class="text-md font-semibold text-gray-700 mb-2">Attached Files</h4>
                    <div class="bg-gray-50 rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">File Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Size</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($workProgress->files as $file)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $file->original_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $file->mime_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($file->file_size / 1024, 2) }} KB</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('staff.work-progress.download-file', $file) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-download mr-1"></i> Download
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No files attached</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('staff.work-progress.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
    </script>
</body>

</html>