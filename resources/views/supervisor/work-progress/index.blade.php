<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Progress | Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                <a href="{{ route('supervisor.work-progress.index') }}" class="flex items-center px-6 py-3 bg-yellow-600 text-black">
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

            <!-- Logout Button -->
            <div class="px-6 py-4 border-t border-yellow-700">
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
                        <h2 class="text-xl font-semibold text-gray-800">Staff Work Progress</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border-2 border-yellow-100">
                    <div class="flex flex-col md:flex-row md:items-center md:space-x-6">
                        <div class="flex-1 mb-4 md:mb-0">
                            <div class="relative group">
                                <input type="text" id="searchInput" placeholder="Search staff by name or position..." 
                                    class="w-full px-5 py-3 pr-12 bg-yellow-50 border-2 border-yellow-200 rounded-xl 
                                    focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-200 
                                    transition-all duration-200 text-gray-700 placeholder-gray-400">
                                <span class="absolute right-4 top-3.5 text-yellow-500 group-hover:text-yellow-600 transition-colors duration-200">
                                    <i class="fas fa-search fa-lg"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row md:items-center space-y-3 md:space-y-0 md:space-x-4">
                            <select id="statusFilter" 
                                class="px-5 py-3 bg-yellow-50 border-2 border-yellow-200 rounded-xl 
                                focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-200 
                                transition-all duration-200 text-gray-700 cursor-pointer hover:border-yellow-300">
                                <option value="">All Status</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                            </select>
                            <select id="sortBy" 
                                class="px-5 py-3 bg-yellow-50 border-2 border-yellow-200 rounded-xl 
                                focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-200 
                                transition-all duration-200 text-gray-700 cursor-pointer hover:border-yellow-300">
                                <option value="latest">Latest Update</option>
                                <option value="name">Name A-Z</option>
                                <option value="position">Position</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Staff Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="staffGrid">
                    @forelse($staffMembers as $staff)
                        <div class="staff-card bg-white rounded-xl shadow-lg border-2 border-yellow-100 overflow-hidden hover:border-yellow-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1" 
                             data-name="{{ strtolower($staff->name) }}" 
                             data-position="{{ strtolower($staff->position) }}" 
                             data-status="{{ $staff->workProgress->first() ? strtolower($staff->workProgress->first()->status) : 'no_status' }}">
                            <div class="p-6">
                                <div class="flex items-center space-x-5 mb-6">
                                    <div class="w-16 h-16 rounded-full overflow-hidden bg-yellow-100 flex-shrink-0 ring-2 ring-yellow-200">
                                        <img src="{{ $staff->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($staff->name).'&background=eab308&color=000' }}" 
                                             alt="{{ $staff->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-xl font-bold text-gray-900 truncate hover:text-yellow-600 transition-colors duration-200">{{ $staff->name }}</h3>
                                        <p class="text-sm font-medium text-gray-600">{{ $staff->position }}</p>
                                    </div>
                                </div>

                                <div class="space-y-4 bg-yellow-50 rounded-lg p-4 mb-6">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-700 font-medium">Latest Update:</span>
                                        <span class="text-gray-900 font-semibold">{{ $staff->workProgress->first() ? $staff->workProgress->first()->created_at->diffForHumans() : 'No updates yet' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-700 font-medium">Status:</span>
                                        @if($staff->workProgress->first())
                                            @php $status = $staff->workProgress->first()->status @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full
                                                {{ $status === 'completed' ? 'bg-green-200 text-green-800' : '' }}
                                                {{ $status === 'in_progress' ? 'bg-blue-200 text-blue-800' : '' }}
                                                {{ $status === 'revision' ? 'bg-orange-200 text-orange-800' : '' }}
                                                {{ $status === 'pending' ? 'bg-gray-200 text-gray-800' : '' }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        @else
                                            <span class="text-gray-500 font-medium">-</span>
                                        @endif
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-700 font-medium">Tasks Completed:</span>
                                        <span class="text-gray-900 font-semibold">{{ $staff->workProgress->where('status', 'completed')->count() }}</span>
                                    </div>
                                </div>

                                <div>
                                    <a href="{{ route('supervisor.work-progress.show', $staff) }}" 
                                       class="w-full inline-flex justify-center items-center px-4 py-3 bg-yellow-500 rounded-lg shadow-md text-sm font-bold text-black hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-[1.02]">
                                        <i class="fas fa-chart-line mr-2"></i>
                                        View Progress History
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <div class="text-gray-400">
                                <i class="fas fa-search fa-3x mb-4"></i>
                                <p class="text-lg font-medium">No staff members found</p>
                                <p class="text-sm">Try adjusting your search or filter criteria</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="mt-6">
                    @if ($staffMembers->hasPages())
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
                            <div class="flex space-x-3">
                                {{-- Previous Page Link --}}
                                @if ($staffMembers->onFirstPage())
                                    <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                        <i class="fas fa-chevron-left mr-1"></i>
                                        Previous
                                    </span>
                                @else
                                    <a href="{{ $staffMembers->previousPageUrl() }}" 
                                       class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-400 transition-colors duration-200 flex items-center">
                                        <i class="fas fa-chevron-left mr-1"></i>
                                        Previous
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($staffMembers->getUrlRange(1, $staffMembers->lastPage()) as $page => $url)
                                    @if ($page == $staffMembers->currentPage())
                                        <span class="px-4 py-2 bg-yellow-500 text-black rounded-lg font-bold">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" 
                                           class="px-4 py-2 bg-white border-2 border-yellow-200 text-gray-700 rounded-lg hover:bg-yellow-100 hover:border-yellow-300 transition-all duration-200">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($staffMembers->hasMorePages())
                                    <a href="{{ $staffMembers->nextPageUrl() }}" 
                                       class="px-4 py-2 bg-yellow-500 text-black rounded-lg hover:bg-yellow-400 transition-colors duration-200 flex items-center">
                                        Next
                                        <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                @else
                                    <span class="px-4 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                        Next
                                        <i class="fas fa-chevron-right ml-1"></i>
                                    </span>
                                @endif
                            </div>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const sortBy = document.getElementById('sortBy');
        const staffCards = document.querySelectorAll('.staff-card');

        function filterCards() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value.toLowerCase();

            staffCards.forEach(card => {
                const name = card.getAttribute('data-name');
                const position = card.getAttribute('data-position');
                const status = card.getAttribute('data-status');

                const matchesSearch = name.includes(searchTerm) || position.includes(searchTerm);
                const matchesStatus = !statusValue || status === statusValue;

                card.style.display = matchesSearch && matchesStatus ? '' : 'none';
            });
        }

        // Add event listeners
        searchInput.addEventListener('input', filterCards);
        statusFilter.addEventListener('change', filterCards);
        sortBy.addEventListener('change', function() {
            window.location.href = window.location.pathname + '?sort=' + this.value;
        });
    });
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');

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
    </script>
</body>
</html>