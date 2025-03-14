<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $staff->name }}'s Work Progress | Supervisor Dashboard</title>
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
                    <a href="{{ route('supervisor.staff-list') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-users w-6"></i>
                        <span>Staff Management</span>
                    </a>
                    <a href="{{ route('supervisor.work-progress.index') }}" class="flex items-center space-x-2 text-white bg-indigo-900 rounded-lg p-2">
                        <i class="fas fa-tasks w-6"></i>
                        <span>Work Progress</span>
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
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('supervisor.work-progress.index') }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h2 class="text-xl font-semibold text-gray-800">{{ $staff->name }}'s Work Progress</h2>
                        </div>
                        <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Staff Info Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
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
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $progress->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $progress->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $progress->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($progress->status) }}
                                        </span>
                                        <span class="text-sm text-gray-500">{{ $progress->created_at->format('M d, Y H:i') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($progress->status === 'pending')
                                            <form action="{{ route('supervisor.work-progress.approve', $progress) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                                                    Approve
                                                </button>
                                            </form>
                                            <button onclick="showRejectModal('{{ $progress->id }}')" class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                                                Reject
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div class="prose max-w-none text-gray-700">
                                    <h4 class="text-lg font-medium mb-2">{{ $progress->title }}</h4>
                                    <p class="text-gray-600">{{ $progress->description }}</p>
                                </div>

                                @if($progress->files->count() > 0)
                                    <div class="mt-4">
                                        <h5 class="text-sm font-medium text-gray-700 mb-2">Attachments:</h5>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            @foreach($progress->files as $file)
                                                <a href="{{ Storage::url($file->file_path) }}" target="_blank" 
                                                   class="flex items-center p-2 border rounded-lg hover:bg-gray-50">
                                                    <i class="fas fa-file-alt text-indigo-600 mr-2"></i>
                                                    <span class="text-sm text-gray-600 truncate">{{ $file->original_name }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($progress->status === 'rejected' && $progress->rejection_reason)
                                    <div class="mt-4 p-4 bg-red-50 rounded-lg">
                                        <h5 class="text-sm font-medium text-red-800 mb-1">Rejection Reason:</h5>
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

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Work Progress</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection</label>
                        <textarea name="rejection_reason" id="rejection_reason" rows="4" 
                                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                  required></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideRejectModal()" 
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">Cancel</button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRejectModal(progressId) {
            const modal = document.getElementById('rejectModal');
            const form = document.getElementById('rejectForm');
            form.action = `/supervisor/work-progress/${progressId}/reject`;
            modal.classList.remove('hidden');
        }

        function hideRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>