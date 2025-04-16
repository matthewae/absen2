<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments | Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-yellow-50">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-button" class="md:hidden fixed top-4 right-4 z-20 bg-yellow-600 text-black p-2 rounded-lg">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div id="sidebar" class="bg-black text-yellow-300 w-64 py-6 flex flex-col fixed h-full z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out overflow-y-auto">
            <div class="px-6 mb-8">
            <img src="{{ asset(path: 'images/logo fix2.png') }}" alt="PT. Mandajaya Rekayasa Konstruksi" class="w-1/2 mx-auto h-auto">            </div>

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
                <a href="{{ route('supervisor.assignments.index') }}" class="flex items-center px-6 py-3 bg-yellow-600 text-black font-semibold">
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
        <div class="flex-1 md:ml-64 w-full">
            <!-- Header -->
            <div class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Assignments</h2>
                        <div class="flex items-center space-x-4">
                            <button onclick="window.location.href='{{ route('supervisor.assignments.create') }}'" class="bg-yellow-600 text-black px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>New Assignment</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                    <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                        <div class="flex-1">
                            <input type="text" placeholder="Search assignments..." class="w-full px-4 py-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        </div>
                        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                            <select class="px-4 py-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                            <select class="px-4 py-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="">All Staff</option>
                                @foreach($staff as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Assignments List -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($assignments as $assignment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $assignment->title }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($assignment->description, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" data-staff-id="{{ $assignment->staff->id }}">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full overflow-hidden bg-gray-100">
                                                <img src="{{ $assignment->staff->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($assignment->staff->name).'&background=6366f1&color=fff' }}" 
                                                    alt="{{ $assignment->staff->name }}" 
                                                    class="h-full w-full object-cover">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $assignment->staff->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $assignment->staff->position }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $assignment->end_datetime ? $assignment->end_datetime->format('M d, Y') : 'No due date' }}</div>
                                        <div class="text-sm text-gray-500">{{ $assignment->end_datetime ? $assignment->end_datetime->diffForHumans() : '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $assignment->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $assignment->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $assignment->status === 'revision' ? 'bg-orange-100 text-orange-800' : '' }}
                                            {{ $assignment->status === 'pending' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ ucfirst($assignment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('supervisor.assignments.show', $assignment) }}" class="text-yellow-600 hover:text-yellow-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- <a href="{{ route('supervisor.assignments.edit', $assignment) }}" class="text-yellow-600 hover:text-yellow-900">
                                                <i class="fas fa-edit"></i>
                                            </a> -->
                                            <form method="POST" action="{{ route('supervisor.assignments.destroy', $assignment) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this assignment?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No assignments found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $assignments->links() }}
                </div>
            </div>
        </div>
    </div>

<!-- New Assignment Modal -->
<div id="assignmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Create New Assignment</h3>
            <form action="{{ route('supervisor.assignments.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <div class="mb-4">
                    <label for="staff_id" class="block text-sm font-medium text-gray-700">Assign To</label>
                    <select name="staff_id" id="staff_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Staff Member</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                    <input type="date" name="due_date" id="due_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors">Cancel</button>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">Create Assignment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('assignmentModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('assignmentModal').classList.add('hidden');
}

// Add event listeners for search and filters
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[placeholder="Search assignments..."]');
    const statusSelect = document.querySelector('select:first-of-type');
    const staffSelect = document.querySelector('select:last-of-type');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.flex-1');

    function updateTable() {
        const searchQuery = searchInput.value.toLowerCase();
        const statusFilter = statusSelect.value.toLowerCase();
        const staffFilter = staffSelect.value;

        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const title = row.querySelector('td:first-child').textContent.toLowerCase();
            const status = row.querySelector('td:nth-child(4) span').textContent.trim().toLowerCase();
            const staffId = row.querySelector('td:nth-child(2)').getAttribute('data-staff-id');

            const matchesSearch = searchQuery === '' || title.includes(searchQuery);
            const matchesStatus = statusFilter === '' || status.includes(statusFilter);
            const matchesStaff = staffFilter === '' || staffId === staffFilter;

            row.style.display = (matchesSearch && matchesStatus && matchesStaff) ? '' : 'none';
        });
    }

    // Mobile menu toggle
    function toggleMobileMenu(event) {
        event.stopPropagation();
        sidebar.classList.toggle('-translate-x-full');
        document.body.classList.toggle('overflow-hidden');
    }

    function closeMobileMenu() {
        if (window.innerWidth < 768) {
            sidebar.classList.add('-translate-x-full');
            document.body.classList.remove('overflow-hidden');
        }
    }

    mobileMenuButton.addEventListener('click', toggleMobileMenu);
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
            closeMobileMenu();
        }
    });

    searchInput.addEventListener('input', updateTable);
    statusSelect.addEventListener('change', updateTable);
    staffSelect.addEventListener('change', updateTable);
});

            !sidebar.contains(event.target) && 
            !mobileMenuButton.contains(event.target)) {
            sidebar.classList.add('-translate-x-full');
        }
    }

    mobileMenuButton.addEventListener('click', toggleMobileMenu);
    document.addEventListener('click', closeMobileMenu);

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('-translate-x-full');
        } else {
            sidebar.classList.add('-translate-x-full');
        }
    });
});
</script>
</body>
</html>

