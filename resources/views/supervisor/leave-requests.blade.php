<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests | Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-8">Supervisor Panel</h1>
                <nav class="space-y-4">
                    <a href="{{ route('supervisor.dashboard') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-home w-6"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('supervisor.staff.index') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-users w-6"></i>
                        <span>Staff Management</span>
                    </a>
                    <a href="{{ route('supervisor.assignments.index') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-tasks w-6"></i>
                        <span>Assignments</span>
                    </a>
                    <a href="{{ route('supervisor.work-progress.index') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-chart-line w-6"></i>
                        <span>Work Progress</span>
                    </a>
                    <a href="{{ route('supervisor.leave-requests') }}" class="flex items-center space-x-2 text-white bg-indigo-900 rounded-lg p-2">
                        <i class="fas fa-calendar-check w-6"></i>
                        <span>Leave Requests</span>
                    </a>
                    <a href="{{ route('supervisor.profile') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-user w-6"></i>
                        <span>Profile</span>
                    </a>
                    <a href="{{ route('supervisor.settings') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-cog w-6"></i>
                        <span>Settings</span>
                    </a>
                </nav>
            </div>
            <div class="absolute bottom-0 w-full p-6">
                <form method="POST" action="{{ route('supervisor.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 text-indigo-100 hover:text-white w-full">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Header -->
            <div class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Leave Requests</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Filters -->
                <div class="mb-6 flex justify-between items-center">
                    <div class="flex space-x-4">
                        <select class="rounded-lg border-gray-300 text-gray-700 text-sm" onchange="window.location.href=this.value">
                            <option value="{{ route('supervisor.leave-requests', ['status' => 'all']) }}" {{ request('status') == 'all' ? 'selected' : '' }}>All Requests</option>
                            <option value="{{ route('supervisor.leave-requests', ['status' => 'pending']) }}" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="{{ route('supervisor.leave-requests', ['status' => 'approved']) }}" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="{{ route('supervisor.leave-requests', ['status' => 'rejected']) }}" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                </div>

                <!-- Leave Requests Table -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Range</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($leaveRequests as $request)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                                                <img src="{{ $request->staff->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($request->staff->name).'&background=6366f1&color=fff' }}" 
                                                     alt="{{ $request->staff->name }}" 
                                                     class="h-full w-full object-cover">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $request->staff->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $request->staff->department }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $request->type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $request->start_date->format('M d, Y') }} - {{ $request->end_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $request->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $request->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($request->status === 'pending')
                                            <form action="{{ route('supervisor.leave-requests.update', $request->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Approve</button>
                                            </form>
                                            <form action="{{ route('supervisor.leave-requests.update', $request->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400">Processed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No leave requests found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $leaveRequests->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>