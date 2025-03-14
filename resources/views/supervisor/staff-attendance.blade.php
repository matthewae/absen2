<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $staff->name }}'s Attendance | Supervisor Dashboard</title>
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
                    <a href="{{ route('supervisor.staff-list') }}" class="flex items-center space-x-2 text-white bg-indigo-900 rounded-lg p-2">
                        <i class="fas fa-users w-6"></i>
                        <span>Staff Management</span>
                    </a>
                    <a href="#" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-calendar-alt w-6"></i>
                        <span>Schedule</span>
                    </a>
                    <a href="#" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-chart-bar w-6"></i>
                        <span>Reports</span>
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
                        <h2 class="text-xl font-semibold text-gray-800">Staff Attendance Details</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <!-- Staff Info Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                                <img src="{{ $staff->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($staff->name).'&background=6366f1&color=fff' }}" 
                                     alt="{{ $staff->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h2 class="text-2xl font-semibold text-gray-800">{{ $staff->name }}'s Attendance</h2>
                                <p class="text-sm text-gray-600 mt-1">{{ $staff->position }} - {{ $staff->department }}</p>
                            </div>
                        </div>
                        <a href="{{ route('supervisor.staff-list') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Staff List
                        </a>
                    </div>

                    <!-- Monthly Calendar Overview -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-4">Monthly Overview</h3>
                        <div class="grid grid-cols-7 gap-2">
                            @php
                                $currentMonth = now()->month;
                                $currentYear = now()->year;
                                $daysInMonth = now()->daysInMonth;
                                $firstDayOfMonth = now()->startOfMonth()->dayOfWeek;
                            @endphp

                            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                                <div class="text-center text-sm font-medium text-gray-500">{{ $day }}</div>
                            @endforeach

                            @for($i = 0; $i < $firstDayOfMonth; $i++)
                                <div class="h-12"></div>
                            @endfor

                            @for($day = 1; $day <= $daysInMonth; $day++)
                                @php
                                    $date = sprintf('%d-%02d-%02d', $currentYear, $currentMonth, $day);
                                    $attendance = $monthlyAttendance[$date] ?? null;
                                @endphp
                                <div class="h-12 flex items-center justify-center rounded-lg {{ $attendance ? 'bg-green-100 hover:bg-green-200' : 'bg-white border border-gray-200 hover:border-gray-300' }} transition-colors duration-200 cursor-pointer">
                                    <div class="text-sm {{ $attendance ? 'text-green-800' : 'text-gray-700' }}">
                                        {{ $day }}
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Attendance Details Table -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-700">Attendance Details</h3>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center">
                                    <i class="fas fa-download mr-2"></i> Export Records
                                </button>
                            </div>
                        </div>

                        @if($monthlyAttendance->count() > 0)
                            <div class="overflow-x-auto bg-white rounded-lg shadow">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($monthlyAttendance as $date => $records)
                                            @foreach($records as $record)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $record->check_in->format('H:i') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $record->check_out ? $record->check_out->format('H:i') : '-' }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        @if($record->check_out)
                                                            {{ $record->check_in->diffInHours($record->check_out) }} hours
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $record->check_out ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                            {{ $record->check_out ? 'Completed' : 'On Duty' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8 bg-gray-50 rounded-lg">
                                <i class="fas fa-calendar-times text-4xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600">No attendance records found for this month</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>