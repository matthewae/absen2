<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff - Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-yellow-50">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-50 bg-yellow-600 text-black p-2 rounded-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-black text-yellow-300 w-full md:w-64 py-6 flex flex-col fixed md:relative z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
            <!-- Company Logo/Name -->
            <div class="px-6 mb-8">
                <img src="{{ asset(path: 'images/logo fix2.png') }}" alt="PT. Mandajaya Rekayasa Konstruksi" class="w-1/2 mx-auto h-auto">
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1">
                <a href="{{ route('supervisor.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <i class="fas fa-home w-5 h-5 mr-3"></i> Dashboard
                </a>
                <a href="{{ route('supervisor.staff.index') }}" class="flex items-center px-6 py-3 bg-yellow-600 text-black font-semibold">
                    <i class="fas fa-users w-5 h-5 mr-3"></i> Staff List
                </a>
                <a href="{{ route('supervisor.assignments.index') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <i class="fas fa-tasks w-5 h-5 mr-3"></i> Assignments
                </a>
                <a href="{{ route('supervisor.attendance.index') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <i class="fas fa-clock w-5 h-5 mr-3"></i> Attendance
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="px-6 py-4 border-t border-yellow-600">
                <form action="{{ route('supervisor.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm hover:bg-yellow-500 hover:text-black rounded-lg transition-colors duration-200">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 w-full">
            <!-- Top Bar -->
            <div class="bg-yellow-50 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Edit Staff Details</h2>
                        <div>
                            <a href="{{ route('supervisor.staff.show', $staff) }}" class="inline-flex items-center px-4 py-2 bg-black text-yellow-300 rounded-lg hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Staff Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-yellow-50 rounded-xl shadow-lg p-6 mb-8 border border-yellow-200 hover:shadow-md transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-yellow-400 to-black shadow-lg rounded-t-xl p-6">
                        <h2 class="text-3xl font-bold text-white">Edit Staff Details</h2>
                    </div>
                    <form action="{{ route('supervisor.staff.update', $staff) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        @if ($errors->any())
                            <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div>
                                <h4 class="text-lg font-medium text-black mb-4">Personal Information</h4>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-800">Full Name</label>
                                        <input type="text" class="mt-1 block w-full rounded-md border-yellow-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 bg-yellow-50" id="name" name="name" value="{{ old('name', $staff->name) }}" required>
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-800">Email Address</label>
                                        <input type="email" class="mt-1 block w-full rounded-md border-yellow-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 bg-yellow-50" id="email" name="email" value="{{ old('email', $staff->email) }}" required>
                                    </div>

                                    <div>
                                        <label for="phone_number" class="block text-sm font-medium text-gray-800">Phone Number</label>
                                        <input type="tel" class="mt-1 block w-full rounded-md border-yellow-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 bg-yellow-50" id="phone_number" name="phone_number" value="{{ old('phone_number', $staff->phone_number) }}">
                                    </div>

                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-800">Address</label>
                                        <textarea class="mt-1 block w-full rounded-md border-yellow-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 bg-yellow-50" id="address" name="address" rows="3">{{ old('address', $staff->address) }}</textarea>
                                    </div>

                                    <div>
                                        <label for="photo" class="block text-sm font-medium text-gray-800">Profile Photo</label>
                                        <input type="file" class="mt-1 block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-300 file:text-black hover:file:bg-yellow-400" id="photo" name="photo" accept="image/*">
                                        <p class="mt-1 text-sm text-gray-500">Leave empty to keep current photo</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Employment Details -->
                            <div>
                                <h4 class="text-lg font-medium text-black mb-4">Employment Details</h4>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="staff_id" class="block text-sm font-medium text-gray-800">Staff ID</label>
                                        <input type="text" class="mt-1 block w-full rounded-md border-yellow-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 bg-yellow-50" id="staff_id" name="staff_id" value="{{ old('staff_id', $staff->staff_id) }}" required>
                                    </div>

                                    <div>
                                        <label for="position" class="block text-sm font-medium text-gray-800">Position</label>
                                        <input type="text" class="mt-1 block w-full rounded-md border-yellow-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 bg-yellow-50" id="position" name="position" value="{{ old('position', $staff->position) }}" required>
                                    </div>

                                    <div>
                                        <label for="department" class="block text-sm font-medium text-gray-800">Department</label>
                                        <input type="text" class="mt-1 block w-full rounded-md border-yellow-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 bg-yellow-50" id="department" name="department" value="{{ old('department', $staff->department) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-black text-yellow-300 rounded-lg hover:bg-yellow-600 hover:text-black transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
</body>
</html>