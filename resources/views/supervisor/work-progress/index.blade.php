<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Progress | Supervisor Dashboard</title>
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
                    <a href="#" class="flex items-center space-x-2 text-white bg-indigo-900 rounded-lg p-2">
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
                        <h2 class="text-xl font-semibold text-gray-800">Staff Work Progress</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($staffMembers as $staff)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <div class="p-6">
                                <div class="flex items-center space-x-4 mb-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200">
                                        <img src="{{ $staff->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($staff->name).'&background=6366f1&color=fff' }}" 
                                             alt="{{ $staff->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $staff->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $staff->position }}</p>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Latest Update:</span>
                                        <span class="text-gray-900">{{ $staff->workProgress->first() ? $staff->workProgress->first()->created_at->diffForHumans() : 'No updates yet' }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Status:</span>
                                        @if($staff->workProgress->first())
                                            @php $status = $staff->workProgress->first()->status @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($status) }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <a href="{{ route('supervisor.work-progress.show', $staff) }}" 
                                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-indigo-600 rounded-md shadow-sm text-sm font-medium text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-eye mr-2"></i>
                                        View Progress History
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>