<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Staff Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-indigo-800 text-white w-64 py-6 flex flex-col">
            <!-- Company Logo/Name -->
            <div class="px-6 mb-8">
                <h1 class="text-2xl font-bold">PT. Mandajaya Rekayasa Konstruksi</h1>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 bg-indigo-900">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('staff.attendance') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Attendance
                </a>
                <a href="{{ route('staff.schedule') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Schedule
                </a>
                <a href="{{ route('staff.progress.index') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Work Progress
                </a>
                <a href="{{ route('staff.profile') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="{{ route('staff.settings') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="px-6 py-4 border-t border-indigo-700">
                <form action="{{ route('staff.logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm hover:bg-indigo-700 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Staff Dashboard</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $staff->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Staff Info -->
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 shadow-lg rounded-xl p-6 mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2">Welcome back, {{ $staff->name }}</h2>
                    <p class="text-indigo-100 text-sm">{{ now()->format('l, F j, Y') }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Today's Attendance Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Today's Attendance</h3>
                            <span class="text-xs font-medium px-2.5 py-0.5 rounded-full {{ $latestAttendance && $latestAttendance->check_in->isToday() ? ($latestAttendance->check_out ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') : 'bg-gray-100 text-gray-800' }}">
                                {{ $latestAttendance && $latestAttendance->check_in->isToday() ? ($latestAttendance->check_out ? 'Completed' : 'On Duty') : 'Not Started' }}
                            </span>
                        </div>
                        @if($latestAttendance && $latestAttendance->check_in->isToday())
                            <div class="space-y-3">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-sm">Check-in: {{ $latestAttendance->check_in->format('H:i') }}</span>
                                </div>
                                @if($latestAttendance->check_out)
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span class="text-sm">Check-out: {{ $latestAttendance->check_out->format('H:i') }}</span>
                                    </div>
                                @else
                                    <form action="{{ route('staff.attendance.checkout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">Check Out</button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <form action="{{ route('staff.attendance.checkin') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">Check In</button>
                            </form>
                        @endif
                    </div>

                    <!-- Monthly Attendance Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Monthly Attendance</h3>
                                <p class="text-sm text-gray-500">This month's record</p>
                            </div>
                        </div>
                        <div class="flex items-baseline space-x-2">
                            <p class="text-3xl font-bold text-gray-900">{{ $monthlyAttendance->count() }}</p>
                            <p class="text-sm text-gray-500">days present</p>
                        </div>
                    </div>

                    <!-- Leave Requests Card -->
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Leave Requests</h3>
                                <p class="text-sm text-gray-500">Pending approvals</p>
                            </div>
                        </div>
                        <div class="flex items-baseline space-x-2">
                            <p class="text-3xl font-bold text-gray-900">{{ $pendingLeaveRequests->count() }}</p>
                            <p class="text-sm text-gray-500">pending requests</p>
                        </div>
                    </div>
                </div>
            <!-- </div>
        </div>
    </div> -->

                <!-- Assignments and Leave Requests Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Upcoming Assignments -->
                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-gray-900">Upcoming Assignments</h2>
                                <span class="text-sm text-gray-500">{{ $upcomingAssignments->count() }} tasks</span>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-100 max-h-[400px] overflow-y-auto">
                            @if($upcomingAssignments->count() > 0)
                                @foreach($upcomingAssignments as $assignment)
                                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-medium text-gray-900">{{ $assignment->title }}</h3>
                                                <p class="mt-1 text-sm text-gray-500">{{ $assignment->description }}</p>
                                                <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        <span>{{ $assignment->start_datetime->format('d M Y') }}</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <span>{{ $assignment->start_datetime->format('H:i') }} - {{ $assignment->end_datetime->format('H:i') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-6 text-center text-gray-500">No upcoming assignments</div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Leave Requests -->
                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-gray-900">Recent Leave Requests</h2>
                                <a href="{{ route('staff.leave-requests.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">New Request</a>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-100 max-h-[400px] overflow-y-auto">
                            @if($leaveRequests->count() > 0)
                                @foreach($leaveRequests as $request)
                                    @if($request->end_date >= now())
                                    <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                                        <div class="flex items-start space-x-4">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center space-x-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                                    @if($request->status === 'approved')
                                                        <span class="ml-2 inline-flex items-center text-sm text-green-600">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                            Request Approved
                                                        </span>
                                                    @endif
                                                    <span class="text-sm font-medium text-gray-900">{{ $request->type }}</span>
                                                </div>
                                                <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        <span>{{ $request->start_date->format('d M Y') }} - {{ $request->end_date->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                                @if($request->status !== 'pending')
                                                <div class="mt-2 text-sm">
                                                    <!-- <p class="text-gray-600"><strong>Reviewed by:</strong> {{ optional($request->approvedBy)->name ?: 'Unknown' }}</p>
                                                    <p class="text-gray-600"><strong>Reviewed at:</strong> {{ $request->approved_at ? $request->approved_at->format('d M Y H:i') : 'N/A' }}</p> -->
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="p-6 text-center text-gray-500">No recent leave requests</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>