<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details - Supervisor Dashboard</title>
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
                <a href="{{ route('supervisor.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('supervisor.staff.index') }}" class="flex items-center px-6 py-3 bg-yellow-600 text-black font-semibold">
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
                        <h2 class="text-xl font-semibold text-gray-800">Staff Details</h2>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('supervisor.staff.index') }}" class="flex items-center px-4 py-2 bg-black text-yellow-300 rounded-lg hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Staff List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Staff Profile -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-gradient-to-r from-yellow-400 to-black rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex items-center space-x-6">
                        <img src="{{ $staff->photo_url ?? 'https://via.placeholder.com/120' }}" alt="{{ $staff->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-yellow-300">
                        <div>
                            <h3 class="text-2xl font-bold text-white">{{ $staff->name }}</h3>
                            <p class="text-yellow-300">Staff ID: {{ $staff->staff_id }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Personal Information -->
                    <div class="bg-yellow-50 rounded-xl shadow-lg p-6 border border-yellow-200">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Personal Information</h4>
                        <div class="space-y-4">
                            <div class="flex border-b border-yellow-200 pb-3">
                                <span class="w-1/3 font-medium text-gray-600">Email</span>
                                <span class="w-2/3 text-gray-800">{{ $staff->email }}</span>
                            </div>
                            <div class="flex border-b border-yellow-200 pb-3">
                                <span class="w-1/3 font-medium text-gray-600">Phone</span>
                                <span class="w-2/3 text-gray-800">{{ $staff->phone_number }}</span>
                            </div>
                            <div class="flex border-b border-yellow-200 pb-3">
                                <span class="w-1/3 font-medium text-gray-600">Address</span>
                                <span class="w-2/3 text-gray-800">{{ $staff->address }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Details -->
                    <div class="bg-yellow-50 rounded-xl shadow-lg p-6 border border-yellow-200">
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Employment Details</h4>
                        <div class="space-y-4">
                            <div class="flex border-b border-yellow-200 pb-3">
                                <span class="w-1/3 font-medium text-gray-600">Department</span>
                                <span class="w-2/3 text-gray-800">{{ $staff->department }}</span>
                            </div>
                            <div class="flex border-b border-yellow-200 pb-3">
                                <span class="w-1/3 font-medium text-gray-600">Position</span>
                                <span class="w-2/3 text-gray-800">{{ $staff->position }}</span>
                            </div>
                            <div class="flex border-b border-yellow-200 pb-3">
                                <span class="w-1/3 font-medium text-gray-600">Status</span>
                                <span class="w-2/3">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Active</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('supervisor.staff.edit', $staff) }}" class="flex items-center px-6 py-3 bg-black text-yellow-300 rounded-lg hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Staff Details
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        });
    </script>
</body>
</html>