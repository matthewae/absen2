<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Staff Profile</title>
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
                <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
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
                <a href="{{ route('staff.profile') }}" class="flex items-center px-6 py-3 bg-indigo-900">
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
        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-6">Profile Information</h2>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Profile Photo Section -->
                    <div class="text-center">
                        <div class="mb-4">
                            <img src="{{ $staff->photo_url ?? 'https://via.placeholder.com/200x300' }}" alt="Profile Photo" class="w-full max-w-md mx-auto h-96 object-cover border-2 border-indigo-200 rounded-lg shadow-md">
                        </div>
                        <h3 class="text-xl font-semibold mb-1">{{ $staff->name }}</h3>
                        <p class="text-gray-600 mb-1">{{ $staff->position }}</p>
                        <p class="text-gray-500 mb-4">{{ $staff->department }}</p>
                        <form action="{{ route('staff.update-photo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex items-center justify-center">
                                <label class="bg-indigo-600 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-indigo-700 transition-colors duration-200">
                                    <span>Change Photo</span>
                                    <input type="file" name="photo" class="hidden" onchange="this.form.submit()">
                                </label>
                            </div>
                        </form>
                    </div>

                    <!-- Personal Information -->
                    <div class="bg-gray-50 rounded-lg p-8 space-y-8">
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">FULL NAME</h4>
                            <p class="mt-2 text-xl font-medium text-gray-900">{{ $staff->name }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">EMAIL</h4>
                            <p class="mt-2 text-xl font-medium text-gray-900">{{ $staff->email }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">DEPARTMENT</h4>
                            <p class="mt-2 text-xl font-medium text-gray-900">{{ $staff->department }}</p>
                        </div>
                        <div class="border-b border-gray-200 pb-6">
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">POSITION</h4>
                            <p class="mt-2 text-xl font-medium text-gray-900">{{ $staff->position }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">BIRTH DATE</h4>
                            <p class="mt-2 text-xl font-medium text-gray-900">{{ $staff->birth_date ? $staff->birth_date->format('d F Y') : 'Not set' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leave Information -->
            <!-- <div class="bg-gray-50 rounded-lg p-6 space-y-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">ANNUAL LEAVE QUOTA</h4>
                    <p class="mt-2 text-lg font-medium text-gray-900">{{ $staff->annual_leave_quota }} days</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">REMAINING LEAVE</h4>
                    <p class="mt-2 text-lg font-medium text-gray-900">{{ $staff->remaining_leave }} days</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">USED LEAVE</h4>
                    <p class="mt-2 text-lg font-medium text-gray-900">{{ $staff->used_leave }} days</p>
                </div>
            </div> -->
        </div>
    </div>
</body>
</html>