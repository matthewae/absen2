<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-50 bg-yellow-600 text-black p-2 rounded-lg shadow-lg hover:bg-yellow-700 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="bg-black text-yellow-300 w-64 py-6 flex flex-col fixed h-full z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out overflow-y-auto">
            <!-- Company Logo/Name -->
            <div class="px-6 mb-8">
            <img src="{{ asset(path: 'images/logo fix2.png') }}" alt="PT. Mandajaya Rekayasa Konstruksi" class="w-1/2 mx-auto h-auto">            </div>

            <!-- Navigation Links -->
            <nav class="flex-1">
                <a href="{{ route('supervisor.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
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
                <a href="{{ route('supervisor.profile') }}" class="flex items-center px-6 py-3 bg-yellow-600 text-black font-semibold">
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

        <div class="flex-1 md:ml-64 p-8 bg-yellow-50 w-full">
            <div class="bg-white rounded-xl shadow-xl p-8 mb-8 transform hover:scale-[1.02] transition-transform duration-300">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-8">
                    <div class="flex flex-col items-center space-y-6">
                        <div class="w-64 h-64 rounded-xl overflow-hidden shadow-xl ring-4 ring-yellow-100">
                            @if($supervisor->profile_picture && Storage::disk('public')->exists($supervisor->profile_picture))
                                <img src="{{ Storage::disk('public')->url($supervisor->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-yellow-50 to-yellow-100 flex items-center justify-center">
                                    <svg class="w-32 h-32 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <form id="updatePhotoForm" action="{{ route('supervisor.update-photo') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-sm">
                            @csrf
                            <div class="flex flex-col space-y-3">
                                <div class="relative">
                                    <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-yellow-100 file:text-black hover:file:bg-yellow-200 transition-colors duration-200" name="profile_picture" accept="image/*" required>
                                </div>
                                <button type="submit" class="w-full py-3 px-6 bg-black text-yellow-300 text-sm font-bold rounded-xl hover:bg-yellow-600 hover:text-black transition-all duration-200 transform hover:scale-105 shadow-lg">Update Photo</button>
                            </div>
                            <div id="updatePhotoMessage" class="mt-3 text-sm font-medium hidden"></div>
                            @error('profile_picture')
                                <p class="mt-3 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </form>
                        
                        <script>
                        document.getElementById('updatePhotoForm').addEventListener('submit', function(e) {
                            e.preventDefault();
                            
                            const formData = new FormData(this);
                            const messageDiv = document.getElementById('updatePhotoMessage');
                            
                            fetch(this.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                messageDiv.classList.remove('hidden');
                                if (data.success) {
                                    messageDiv.className = 'mt-3 text-sm text-green-600 font-medium';
                                    messageDiv.textContent = data.message;
                                    // Reload the page to show the updated image
                                    setTimeout(() => window.location.reload(), 1000);
                                } else {
                                    messageDiv.className = 'mt-3 text-sm text-red-600 font-medium';
                                    messageDiv.textContent = data.message;
                                }
                            })
                            .catch(error => {
                                messageDiv.classList.remove('hidden');
                                messageDiv.className = 'mt-3 text-sm text-red-600 font-medium';
                                messageDiv.textContent = 'An error occurred while updating the photo.';
                            });
                        });
                        </script>
                    </div>
                    <div class="flex-1 md:ml-8">
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-3">{{ $supervisor->name }}</h2>
                        <p class="text-xl text-gray-600 mb-4 uppercase tracking-wider font-semibold">{{ $supervisor->position }}</p>
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-yellow-100 text-black transform hover:scale-105 transition-transform duration-200">{{ $supervisor->department }}</span>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl shadow-xl p-8 transform hover:scale-[1.02] transition-transform duration-300">
                    <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Contact Information
                    </h3>
                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wide">Email</span>
                            <span class="mt-2 text-lg text-gray-900">{{ $supervisor->email }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wide">Phone Number</span>
                            <span class="mt-2 text-lg text-gray-900">{{ $supervisor->phone_number ?? 'Not set' }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wide">Address</span>
                            <span class="mt-2 text-lg text-gray-900">{{ $supervisor->address ?? 'Not set' }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-xl p-8 transform hover:scale-[1.02] transition-transform duration-300">
                    <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Department Information
                    </h3>
                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wide">Department</span>
                            <span class="mt-2 text-lg text-gray-900">{{ $supervisor->department }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wide">Supervisor ID</span>
                            <span class="mt-2 text-lg text-gray-900">{{ $supervisor->supervisor_id }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.flex-1');

        // Mobile menu toggle
        mobileMenuButton.addEventListener('click', function(event) {
            event.stopPropagation();
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    });
    </script>
</body>
</html>