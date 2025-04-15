<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $staff ? $staff->name . '\'s' : '' }}Attendance | Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary-yellow: #ffd700;
            --secondary-yellow: #ffeb3b;
            --dark-yellow: #ffc107;
            --text-black: #212121;
            --bg-light: #fffde7;
        }
    </style>
<body class="bg-[var(--bg-light)]">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[var(--text-black)] text-[var(--primary-yellow)] fixed h-full">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-8">Staff Management</h1>
                <nav class="space-y-4">
                    <a href="{{ route('supervisor.dashboard') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-home w-6"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('supervisor.staff-list') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-users w-6"></i>
                        <span>Staff List</span>
                    </a>
                    <a href="{{ route('supervisor.assignments.index') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-tasks w-6"></i>
                        <span>Assignments</span>
                    </a>
                    <a href="{{ route('supervisor.attendance.index') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-clock w-6"></i>
                        <span>Attendance</span>
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
                <div class="bg-white shadow-lg rounded-lg p-6 border border-[var(--dark-yellow)]">
                    <!-- Staff Info Header -->
                    <div class="flex justify-between items-center mb-6">
                        @if($staff)
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                                <img src="{{ $staff->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($staff->name).'&background=6366f1&color=fff' }}" 
                                        alt="{{ $staff->name }}" 
                                        class="w-full h-full object-cover">
                            </div>
                            <!-- <div>
                                <h2 class="text-2xl font-semibold text-gray-800">{{ $staff->name }}'s Attendance</h2>
                                <p class="text-sm text-gray-600 mt-1">{{ $staff->position }} - {{ $staff->department }}</p>
                            </div> -->
                        </div>
                        @else
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Staff Attendance Overview</h2>
                        </div>
                        @endif
                        <a href="{{ route('supervisor.staff-list') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Staff List
                        </a>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-6">
                        <div class="max-w-md">
                            <div class="relative flex items-center">
                                <input type="text" id="staffSearch" class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500" placeholder="Search staff by name...">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Staff List and Attendance Records -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-[var(--dark-yellow)] text-[var(--text-black)]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff Member</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Days Present</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($staffMembers as $staff)
                                <tr class="hover:bg-[var(--bg-light)] transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full" src="{{ $staff->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($staff->name).'&background=6366f1&color=fff' }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $staff->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $staff->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $staff->department }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @php
                                            $todayAttendance = $staff->attendances->where('created_at', '>=', now()->startOfDay())
                                                                                ->where('created_at', '<=', now()->endOfDay())
                                                                                ->first();
                                        @endphp
                                        @if($todayAttendance)
                                            {{ \Carbon\Carbon::parse($todayAttendance->check_in)->format('H:i:s') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($todayAttendance && $todayAttendance->check_out)
                                            {{ \Carbon\Carbon::parse($todayAttendance->check_out)->format('H:i:s') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($todayAttendance && $todayAttendance->check_in && $todayAttendance->check_out)
                                            {{ \Carbon\Carbon::parse($todayAttendance->check_out)->diffForHumans(\Carbon\Carbon::parse($todayAttendance->check_in), ['parts' => 2]) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $today = now()->format('Y-m-d');
                                            $todayAttendance = $staff->attendances->where('created_at', '>=', $today.' 00:00:00')
                                                                                ->where('created_at', '<=', $today.' 23:59:59')
                                                                                ->first();
                                        @endphp
                                        @if($todayAttendance)
                                            @if($todayAttendance->check_out)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Completed</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">On Duty</span>
                                            @endif
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Absent</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $staff->attendances->where('status', 'present')->count() + $staff->attendances->where('status', 'late')->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('supervisor.staff.attendance.export', $staff->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-download mr-2"></i>Download Records (.xlsx)
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        @if(!$staff)
                            <div class="flex justify-center">
                                {{ $staffMembers->links() }}
                            </div>
                            <style>
                                nav[role="navigation"] {
                                    @apply mt-4;
                                }
                                nav[role="navigation"] > div {
                                    @apply flex justify-between items-center;
                                }
                                nav[role="navigation"] span.relative {
                                    @apply relative inline-flex items-center px-4 py-2 text-sm font-medium border;
                                }
                                nav[role="navigation"] span.relative:not(.text-gray-500) {
                                    @apply bg-[var(--dark-yellow)] text-[var(--text-black)] border-[var(--dark-yellow)];
                                }
                                nav[role="navigation"] span.relative.text-gray-500 {
                                    @apply bg-white border-gray-300 hover:bg-[var(--dark-yellow)] hover:text-[var(--text-black)];
                                }
                                nav[role="navigation"] span[aria-disabled="true"] {
                                    @apply bg-gray-100 text-gray-400 cursor-not-allowed;
                                }
                            </style>
                        @endif
                    </div>

                    <script>
                        document.getElementById('staffSearch').addEventListener('input', function(e) {
                            const searchTerm = e.target.value.toLowerCase();
                            const rows = document.querySelectorAll('tbody tr');
                            
                            rows.forEach(row => {
                                const nameCell = row.querySelector('td:first-child .text-gray-900');
                                const name = nameCell.textContent.toLowerCase();
                                
                                if (name.includes(searchTerm)) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        });
                    </script>
                    <!-- Export Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <form action="{{ route('supervisor.staff.attendance.export-all') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-[var(--dark-yellow)] text-[var(--text-black)] rounded-lg hover:bg-[var(--primary-yellow)] transition-colors flex items-center font-semibold">
                                <i class="fas fa-download mr-2"></i> Export All Staff Records
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>