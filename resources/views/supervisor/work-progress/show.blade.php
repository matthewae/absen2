<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $staff->name }}'s Work Progress | Supervisor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        $(document).ready(function() {
            function refreshWorkProgress() {
                $.get(window.location.href, function(data) {
                    const newContent = $(data).find('.space-y-6').html();
                    $('.space-y-6').html(newContent);
                });
            }
            
            setInterval(refreshWorkProgress, 30000); // Refresh every 30 seconds
        });
    </script>
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
            <div class="p-6">
                <img src="{{ asset('images/logo fix2.png') }}" alt="PT. Mandajaya Rekayasa Konstruksi" class="w-1/2 mx-auto h-auto mb-8">
                <nav class="space-y-4">
                    <a href="{{ route('supervisor.dashboard') }}" class="flex items-center space-x-2 text-yellow-300 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                        <i class="fas fa-home w-6"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('supervisor.staff-list') }}" class="flex items-center space-x-2 text-yellow-300 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                        <i class="fas fa-users w-6"></i>
                        <span>Staff Management</span>
                    </a>
                    <a href="{{ route('supervisor.work-progress.index') }}" class="flex items-center space-x-2 text-black bg-yellow-500 rounded-lg p-2">
                        <i class="fas fa-tasks w-6"></i>
                        <span>Work Progress</span>
                    </a>
                </nav>
            </div>
            <div class="absolute bottom-0 w-full p-6">
                <form method="POST" action="{{ route('supervisor.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 text-yellow-300 hover:bg-yellow-500 hover:text-black transition-colors duration-200 w-full">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64 w-full">
            <!-- Header -->
            <div class="bg-gradient-to-r from-yellow-400 to-black shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('supervisor.work-progress.index') }}" class="text-yellow-300 hover:text-yellow-500">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h2 class="text-xl font-semibold text-white">{{ $staff->name }}'s Work Progress</h2>
                        </div>
                        <span class="text-sm text-yellow-300">{{ now()->format('l, F j, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Staff Info Card -->
                <div class="bg-yellow-50 rounded-lg shadow-lg border border-yellow-200 p-6 mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                            <img src="{{ $staff->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($staff->name).'&background=6366f1&color=fff' }}" 
                                alt="{{ $staff->name }}" 
                                class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ $staff->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $staff->position }} - {{ $staff->department }}</p>
                        </div>
                    </div>
                </div>

                <!-- Progress Timeline -->
                <div class="space-y-6">
                    @forelse($workProgress as $progress)
                        <div class="bg-yellow-50 rounded-lg shadow-lg border border-yellow-200 overflow-hidden">
                            <div class="p-6 border-b border-yellow-200">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full
                                            {{ $progress->status === 'pending' ? 'bg-gray-100 text-gray-800 border border-gray-300' : '' }}
                                            {{ $progress->status === 'OnProgress' ? 'bg-blue-100 text-blue-800 border border-blue-300' : '' }}
                                            {{ $progress->status === 'revision' ? 'bg-orange-100 text-orange-800 border border-orange-300' : '' }}
                                            {{ $progress->status === 'completed' ? 'bg-green-100 text-green-800 border border-green-300' : '' }}">
                                            {{ ucfirst($progress->status) }}
                                        </span>
                                        <span class="text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-clock mr-2"></i>
                                            {{ $progress->created_at->format('M d, Y H:i') }}
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="px-6 py-4 bg-yellow-50">
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Work Description:</h4>
                                    <p class="text-gray-600 whitespace-pre-line text-justify">{{ $progress->work_description }}</p>
                                </div>
                                @if($progress->files->count() > 0)
                                    <div class="border-t border-gray-200 pt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-3">Attachments:</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            @foreach($progress->files as $file)
                                                <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200 hover:border-indigo-300 transition-colors">
                                                    <div class="flex items-center space-x-3 overflow-hidden">
                                                        <i class="fas fa-file text-indigo-600"></i>
                                                        <span class="text-sm text-gray-600 truncate">{{ $file->original_name }}</span>
                                                    </div>
                                                    <a href="{{ route('supervisor.work-progress.download', $file) }}" 
                                                        class="px-3 py-1 bg-black text-yellow-300 rounded-md hover:bg-yellow-500 hover:text-black text-sm flex items-center space-x-1 flex-shrink-0">
                                                        <i class="fas fa-download"></i>
                                                        <span>Download</span>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if($progress->status === 'rejected' && $progress->rejection_reason)
                                    <div class="mt-4 p-4 bg-red-50 rounded-lg border border-red-200">
                                        <h5 class="text-sm font-medium text-red-800 mb-1 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            Rejection Reason:
                                        </h5>
                                        <p class="text-sm text-red-600">{{ $progress->rejection_reason }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-gray-200">
                            <i class="fas fa-clipboard-list text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600">No work progress records found</p>
                        </div>
                    @endforelse

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $workProgress->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');

            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
            });
        });
    </script>
</body>
</html>
            <div class="p-6">
                <img src="{{ asset('images/logo fix2.png') }}" alt="PT. Mandajaya Rekayasa Konstruksi" class="w-1/2 mx-auto h-auto mb-8">
                <nav class="space-y-4">