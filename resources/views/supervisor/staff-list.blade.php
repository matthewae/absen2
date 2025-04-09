<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List - Supervisor Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            background-color: #1a237e;
            padding: 1.5rem;
            overflow-y: auto;
            z-index: 100;
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
            width: 1.5rem;
            margin-right: 0.75rem;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
        .header {
            position: sticky;
            top: 0;
            background-color: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 50;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-8">Supervisor Panel</h1>
            <nav class="space-y-4">
                <a href="{{ route('supervisor.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('supervisor.staff-list') }}" class="nav-link active">
                    <i class="fas fa-users"></i>
                    <span>Staff List</span>
                </a>
                <a href="{{ route('supervisor.work-progress.index') }}" class="nav-link">
                    <i class="fas fa-tasks"></i>
                    <span>Work Progress</span>
                </a>
            </nav>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Staff Management</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">{{ now()->format('l, F j, Y') }}</span>
                <form method="POST" action="{{ route('supervisor.logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Staff List Section -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Staff Overview</h3>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        <i class="fas fa-download mr-2"></i> Export List
                    </button>
                </div>
            </div>

            @if($staff->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Today's Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($staff as $member)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $member->staff_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full" src="{{ $member->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($member->name) }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $member->position }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($member->attendances->count() > 0)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $member->attendances->first()->check_out ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $member->attendances->first()->check_out ? 'Completed' : 'On Duty' }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Not Checked In
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('supervisor.staff.attendance', $member) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <i class="fas fa-calendar-alt mr-1"></i> Attendance
                                        </a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-2">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <p class="text-gray-600">No staff members found</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>