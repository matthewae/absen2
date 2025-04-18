<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Staff Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-yellow-50">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden fixed top-4 right-4 z-50 bg-yellow-600 text-black p-2 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <!-- Sidebar -->
        <div id="sidebar" class="bg-black text-yellow-300 w-full md:w-64 py-6 flex flex-col fixed md:relative z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
            <!-- Company Logo/Name -->
            <div class="px-6 mb-8">
                <img src="{{ asset('images/logo fix2.png') }}" alt="PT. Mandajaya Rekayasa Konstruksi" class="w-1/2 mx-auto h-auto">
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('staff.attendance') }}" class="flex items-center px-6 py-3 bg-yellow-600 text-black font-semibold">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Attendance
                </a>
                <a href="{{ route('staff.schedule') }}" class="flex items-center px-6 py-3 hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Schedule
                </a>
                <a href="{{ route('staff.progress.index') }}" class="flex items-center px-6 py-3 hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Work Progress
                </a>
                <a href="{{ route('staff.profile') }}" class="flex items-center px-6 py-3 hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="{{ route('staff.settings') }}" class="flex items-center px-6 py-3 hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="px-6 py-4 border-t border-yellow-600">
                <form action="{{ route('staff.logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm hover:bg-yellow-600 hover:text-black rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 w-full">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Attendance Management</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->setTimezone('Asia/Jakarta')->format('l, F j, Y') }}</span>
                            <span id="current-time" class="text-sm font-medium text-gray-900"></span>
                            <span class="text-sm font-medium text-gray-900">{{ $staff->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-8 space-y-6">
                <!-- Attendance Actions -->
                <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-100 mb-4 md:mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 sm:gap-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Today's Attendance</h3>
                        <span class="text-xs font-medium px-2.5 py-0.5 rounded-full self-start sm:self-center {{ $latestAttendance && $latestAttendance->check_in->isToday() ? ($latestAttendance->check_out ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') : 'bg-gray-100 text-gray-800' }}">
                            {{ $latestAttendance && $latestAttendance->check_in->isToday() ? ($latestAttendance->check_out ? 'Completed' : 'On Duty') : 'Not Started' }}
                        </span>
                    </div>

                    @if($latestAttendance && $latestAttendance->check_in->isToday())
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Check-in Time</span>
                                </div>
                                <p class="mt-2 text-2xl font-bold text-gray-900">{{ $latestAttendance->check_in->setTimezone('Asia/Jakarta')->format('H:i') }}</p>
                            </div>

                            <div class="p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Check-out Time</span>
                                </div>
                                @if($latestAttendance->check_out)
                                    <p class="mt-2 text-2xl font-bold text-gray-900">{{ $latestAttendance->check_out->format('H:i') }}</p>
                                @else
                                    <form action="{{ route('staff.attendance.checkout') }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="w-full bg-black text-yellow-300 px-4 py-3 md:py-2 rounded-lg text-sm font-medium hover:bg-yellow-600 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">Check Out</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @else
                        <form action="{{ route('staff.attendance.checkin') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-black text-yellow-300 px-4 py-3 md:py-2 rounded-lg text-sm font-medium hover:bg-yellow-600 hover:text-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">Check In</button>
                        </form>
                    @endif
                </div>

                <!-- Attendance History -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 md:p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Attendance History</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <div class="block sm:hidden">
                            @foreach($attendanceHistory as $attendance)
                            <div class="p-4 border-b border-gray-200">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="text-sm font-medium text-gray-900">{{ $attendance->check_in->format('d-M-Y') }}</div>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $attendance->check_out ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $attendance->check_out ? 'Completed' : 'On Duty' }}
                                    </span>
                                </div>
                                <div class="space-y-1">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Check In:</span>
                                        <span class="text-sm text-gray-900">{{ $attendance->check_in->setTimezone('Asia/Jakarta')->format('H:i') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Check Out:</span>
                                        <span class="text-sm text-gray-900">{{ $attendance->check_out ? $attendance->check_out->setTimezone('Asia/Jakarta')->format('H:i') : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <table class="hidden sm:table min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($attendanceHistory as $attendance)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $attendance->check_in->format('d-M-Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $attendance->check_in->setTimezone('Asia/Jakarta')->format('H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $attendance->check_out ? $attendance->check_out->setTimezone('Asia/Jakarta')->format('H:i') : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $attendance->check_out ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $attendance->check_out ? 'Completed' : 'On Duty' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $attendanceHistory->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');

        mobileMenuButton.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
        });
    });

    // Update current time
    function updateTime() {
        const timeElement = document.getElementById('current-time');
        const now = new Date();
        timeElement.textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
    }
    
    setInterval(updateTime, 1000);
    updateTime();
</script>
</html>