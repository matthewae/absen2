<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Assignment - Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fefce8;
        }
        #sidebar {
            background-color: black;
            color: #facc15;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 40;
            transition: transform 0.3s ease;
        }
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-250px);
            }
            #sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
                padding: 1rem !important;
            }
        }
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #facc15;
            border-radius: 0.5rem;
            transition: all 0.3s;
            margin-bottom: 0.5rem;
            text-decoration: none;
        }
        .nav-link:hover, .nav-link.active {
            background-color: #facc15;
            color: black;
        }
        .nav-link i {
            margin-right: 0.75rem;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }
        .header {
            background-color: #facc15;
            color: black;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-container {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin: 1rem 0;
        }
    </style>
</head>
<body class="bg-yellow-50">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="md:hidden fixed top-4 left-4 z-50 bg-yellow-400 text-black p-2 rounded-lg">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="py-6 flex flex-col">
        <div class="px-6 mb-8">
            <img src="{{ asset('images/logo fix2.png') }}" alt="PT. Mandajaya" class="w-1/2 mx-auto h-auto">
        </div>
        <nav class="flex-1">
            <a href="{{ route('supervisor.dashboard') }}" class="nav-link">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('supervisor.assignments.index') }}" class="nav-link active">
                <i class="fas fa-tasks"></i> Assignments
            </a>
            <a href="{{ route('supervisor.staff-list') }}" class="nav-link">
                <i class="fas fa-users"></i> Staff
            </a>
        </nav>
        <div class="px-6 py-4 border-t border-yellow-600">
            <div class="text-yellow-400 mb-2">{{ Auth::user() ? Auth::user()->name : 'Unknown User' }}</div>
            <form action="{{ route('supervisor.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-4 py-2 text-sm bg-yellow-400 text-black rounded-lg hover:bg-yellow-500 transition-colors duration-200">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header flex justify-between items-center">
            <h4 class="text-xl font-semibold">Create New Assignment</h4>
            <div class="flex items-center">
                <span>{{ Auth::user() ? Auth::user()->name : 'Unknown User' }}</span>
            </div>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <form method="POST" action="{{ route('supervisor.assignments.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" class="w-full px-4 py-2 rounded-lg border @error('title') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-yellow-400" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="staff_id" class="block text-sm font-medium text-gray-700 mb-2">Assign To Staff</label>
                        <select class="w-full px-4 py-2 rounded-lg border @error('staff_id') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-yellow-400" id="staff_id" name="staff_id" required>
                            <option value="">Select Staff</option>
                            @foreach($staff as $member)
                                <option value="{{ $member->id }}" {{ old('staff_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ $member->staff_id }})
                                </option>
                            @endforeach
                        </select>
                        @error('staff_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea class="w-full px-4 py-2 rounded-lg border @error('description') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-yellow-400" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="start_datetime" class="block text-sm font-medium text-gray-700 mb-2">Start Date & Time</label>
                        <input type="datetime-local" class="w-full px-4 py-2 rounded-lg border @error('start_datetime') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-yellow-400" id="start_datetime" name="start_datetime" value="{{ old('start_datetime') }}" required>
                        @error('start_datetime')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_datetime" class="block text-sm font-medium text-gray-700 mb-2">End Date & Time</label>
                        <input type="datetime-local" class="w-full px-4 py-2 rounded-lg border @error('end_datetime') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-yellow-400" id="end_datetime" name="end_datetime" value="{{ old('end_datetime') }}" required>
                        @error('end_datetime')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                        <select class="w-full px-4 py-2 rounded-lg border @error('priority') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-yellow-400" id="priority" name="priority" required>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-4 py-2 rounded-lg border @error('status') border-red-500 @else border-gray-300 @enderror focus:outline-none focus:ring-2 focus:ring-yellow-400" id="status" name="status" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- <div class="mb-4">
                    <label for="attachment" class="form-label">Attachment (Optional)</label>
                    <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="attachment" name="attachment">
                    @error('attachment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> -->

                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('supervisor.assignments.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Back to List
                    </a>
                    <button type="submit" class="px-6 py-2 bg-yellow-400 text-black rounded-lg hover:bg-yellow-500 transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>Create Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');

            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                if (sidebar.classList.contains('show')) {
                    mainContent.style.marginLeft = '0';
                } else {
                    mainContent.style.marginLeft = '0';
                }
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                        sidebar.classList.remove('show');
                        mainContent.style.marginLeft = '0';
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    mainContent.style.marginLeft = '250px';
                } else {
                    mainContent.style.marginLeft = '0';
                }
            });
        });
    </script>
    </script>
</body>
</html>