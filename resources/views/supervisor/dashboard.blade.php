<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden fixed top-4 right-4 z-20 bg-yellow-600 text-black p-2 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <!-- Sidebar -->
        <div id="sidebar" class="bg-black text-yellow-300 w-full md:w-64 py-6 flex flex-col fixed md:relative z-10 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
            <!-- Company Logo/Name -->
            <div class="px-6 mb-8">
            <img src="{{ asset(path: 'images/logo fix2.png') }}" alt="PT. Mandajaya Rekayasa Konstruksi" class="w-1/2 mx-auto h-auto">
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1">
                <a href="{{ route('supervisor.dashboard') }}" class="flex items-center px-6 py-3 bg-yellow-600 text-black font-semibold">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('supervisor.staff.index') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Staff Management
                </a>
                <a href="{{ route('supervisor.assignments.index') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Assignments
                </a>
                <a href="{{ route('supervisor.work-progress.index') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Work Progress
                </a>
                <a href="{{ route('supervisor.leave-requests') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Leave Requests
                </a>
                <a href="{{ route('supervisor.profile') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="{{ route('supervisor.settings') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="px-6 py-4 border-t border-yellow-600">
                <form action="{{ route('supervisor.logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm hover:bg-yellow-500 hover:text-black rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-0 mt-16 md:mt-0">
            <!-- Top Bar -->
            <div class="bg-yellow-100 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Supervisor Dashboard</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $supervisor->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Supervisor Info -->
                <div class="bg-gradient-to-r from-yellow-400 to-black shadow-lg rounded-xl p-6 mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2">Welcome, {{ $supervisor->name }}</h2>
                    <p class="text-indigo-100 text-sm">{{ now()->format('l, F j, Y') }}</p>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-8">
                    <div class="bg-yellow-50 p-6 rounded-xl shadow-sm border border-yellow-200 hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-700">Department Staff</h3>
                        <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $staffCount }}</p>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-xl shadow-sm border border-yellow-200 hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-700">Staff on Leave Today</h3>
                        <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $staffOnLeave }}</p>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-xl shadow-sm border border-yellow-200 hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-lg font-medium text-gray-700">Pending Leave Requests</h3>
                        <p class="text-2xl font-semibold text-gray-900 mt-2">{{ is_object($pendingLeaveRequests) ? $pendingLeaveRequests->count() : 0 }}</p>
                    </div>
                </div>

                <!-- Staff Attendance Today -->
                <div class="bg-yellow-50 shadow rounded-xl p-6 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Today's Staff Attendance</h2>
                        <a href="{{ route('supervisor.staff.index') }}" class="text-yellow-600 hover:text-black font-semibold">View All Staff</a>
                    </div>
                    <div class="overflow-x-auto -mx-4 sm:mx-0">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-yellow-100">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff Name</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Check In</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Check Out</th>
                                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-yellow-50 divide-y divide-yellow-200">
                                @foreach($staffAttendanceToday as $staff)
                                    <tr>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $staff->name }}
                                            <div class="sm:hidden text-xs text-gray-500 mt-1">
                                                @php
                                                    $todayAttendance = $staff->attendances->where('created_at', '>=', now()->startOfDay())
                                                                                        ->where('created_at', '<=', now()->endOfDay())
                                                                                        ->first();
                                                @endphp
                                                In: {{ $todayAttendance?->check_in?->format('H:i') ?? '-' }} | Out: {{ $todayAttendance?->check_out?->format('H:i') ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">
                                            {{ $todayAttendance?->check_in?->format('H:i') ?? '-' }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">
                                            {{ $todayAttendance?->check_out?->format('H:i') ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($staff->attendance_status === 'present')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $staff->attendances->first()?->check_out ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $staff->attendances->first()?->check_out ? 'Completed' : 'On Duty' }}
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Not Checked In
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 px-4 sm:px-6 py-3 flex items-center justify-between border-t border-gray-200">
                            <div class="flex-1 flex justify-between sm:hidden space-x-3">
                                @if ($staffAttendanceToday->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $staffAttendanceToday->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Previous
                                    </a>
                                @endif
                                @if ($staffAttendanceToday->hasMorePages())
                                    <a href="{{ $staffAttendanceToday->nextPageUrl() }}" class="relative ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Next
                                    </a>
                                @else
                                    <span class="relative ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                                        Next
                                    </span>
                                @endif
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing
                                        <span class="font-medium">{{ $staffAttendanceToday->firstItem() ?? 0 }}</span>
                                        to
                                        <span class="font-medium">{{ $staffAttendanceToday->lastItem() ?? 0 }}</span>
                                        of
                                        <span class="font-medium">{{ $staffAttendanceToday->total() }}</span>
                                        results
                                    </p>
                                </div>
                                <div>
                                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($staffAttendanceToday->onFirstPage())
                                            <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-400 cursor-default">
                                                <span class="sr-only">Previous</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @else
                                            <a href="{{ $staffAttendanceToday->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                <span class="sr-only">Previous</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @endif
                                    
                                        {{-- Pagination Elements --}}
                                        @foreach ($staffAttendanceToday->getUrlRange(1, $staffAttendanceToday->lastPage()) as $page => $url)
                                            @if ($page == $staffAttendanceToday->currentPage())
                                                <span class="relative inline-flex items-center px-4 py-2 border border-indigo-500 bg-indigo-50 text-sm font-medium text-indigo-600 cursor-default" aria-current="page">
                                                    {{ $page }}
                                                </span>
                                            @else
                                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                    {{ $page }}
                                                </a>
                                            @endif
                                        @endforeach
                                    
                                        {{-- Next Page Link --}}
                                        @if ($staffAttendanceToday->hasMorePages())
                                            <a href="{{ $staffAttendanceToday->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                <span class="sr-only">Next</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @else
                                            <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-400 cursor-default">
                                                <span class="sr-only">Next</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        @endif
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Assignments -->
                <div class="bg-yellow-50 shadow rounded-xl p-6 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Recent Assignments</h2>
                        <a href="{{ route('supervisor.assignments.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">New Assignment</a>
                    </div>
                    @if($recentAssignments->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentAssignments as $assignment)
                                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                                    <h3 class="font-medium text-gray-900">{{ $assignment->title }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $assignment->staff->name }}</p>
                                    <p class="text-sm text-gray-500 mt-1">{{ $assignment->description }}</p>
                                    <div class="mt-2 text-xs text-gray-500">Due: {{ $assignment->end_datetime ? $assignment->end_datetime->format('M d, Y') : 'No due date' }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No recent assignments</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        
        if (!sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
            if (!sidebar.classList.contains('-translate-x-full') && window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
</script>
</body>
</html>
