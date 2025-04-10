<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Progress Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
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
            <div class="px-6 mb-8">
                <h1 class="text-2xl font-bold text-white">Staff Dashboard</h1>
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
    <div class="flex-1 ml-64">
        <!-- Top Bar -->
        <div class="bg-white shadow-sm sticky top-0 z-10 backdrop-blur-sm bg-white/90">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Work Progress Details</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow p-6">
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
</body>

</html>