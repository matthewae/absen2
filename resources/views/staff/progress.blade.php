<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Work Progress</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <style>
        .filepond--drop-label {
            color: #4f46e5;
        }
        .filepond--panel-root {
            background-color: #f3f4f6;
            border: 2px dashed #e5e7eb;
        }
        .filepond--item-panel {
            background-color: #4f46e5;
        }
    </style>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-gradient-to-b from-indigo-800 to-indigo-900 text-white w-64 py-6 flex flex-col shadow-xl">
            <!-- Company Logo/Name -->
            <div class="px-6 mb-8">
                <h1 class="text-2xl font-bold tracking-tight">PT. Mandajaya</h1>
                <p class="text-indigo-200 text-sm mt-1">Work Management System</p>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 space-y-1 px-3">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700/50 hover:backdrop-blur-sm transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('staff.attendance') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700/50 hover:backdrop-blur-sm transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Attendance
                </a>
                <a href="{{ route('staff.schedule') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700/50 hover:backdrop-blur-sm transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Schedule
                </a>
                <a href="{{ route('staff.progress.index') }}" class="flex items-center px-6 py-3 bg-indigo-700/50 backdrop-blur-sm">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Work Progress
                </a>
                <a href="{{ route('staff.profile') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700/50 hover:backdrop-blur-sm transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="{{ route('staff.settings') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700/50 hover:backdrop-blur-sm transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="px-6 py-4 border-t border-indigo-700/50 mt-auto">
                <form action="{{ route('staff.logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm hover:bg-indigo-700/50 hover:backdrop-blur-sm rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm sticky top-0 z-10 backdrop-blur-sm bg-white/90">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Work Progress</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $staff->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
                <!-- Add New Work Progress Form -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 mb-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-gray-900">Add New Work Progress</h3>
                        <span class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium">New Entry</span>
                    </div>
                    <form action="{{ route('staff.progress.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Project Topic -->
                            <div class="space-y-2">
                                <label for="project_topic" class="block text-sm font-semibold text-gray-900">Project Topic</label>
                                <div class="relative">
                                    <select id="project_topic" name="project_topic" required class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 pr-10 focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-colors duration-200">
                                        <option value="" disabled selected>Select a topic</option>
                                        <option value="Perencanaan">Perencanaan</option>
                                        <option value="Pengawasan">Pengawasan</option>
                                        <option value="Kajian">Kajian</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Company Name -->
                            <div class="space-y-2">
                                <label for="company_name" class="block text-sm font-semibold text-gray-900">Company Name</label>
                                <input type="text" id="company_name" name="company_name" required class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-colors duration-200" placeholder="Enter company name">
                            </div>
                        </div>

                        <!-- Work Description -->
                        <div class="space-y-2">
                            <label for="work_description" class="block text-sm font-semibold text-gray-900">Work Description</label>
                            <div class="relative">
                                <textarea id="work_description" name="work_description" rows="4" required class="block w-full rounded-lg border-gray-300 bg-gray-50 py-3 px-4 focus:border-indigo-500 focus:ring-indigo-500 text-sm transition-colors duration-200" placeholder="Describe your work progress in detail (minimum 20 words)"></textarea>
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500" id="word-counter">0 words</div>
                            </div>
                            <p class="text-sm text-gray-500">Please provide a detailed description with at least 20 words</p>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-semibold text-gray-900">Project Status</label>
                            <div class="grid grid-cols-3 gap-4">
                                <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 focus:outline-none">
                                    <input type="radio" name="status" value="On progress" class="sr-only" checked>
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">On Progress</span>
                                        </span>
                                    </span>
                                    <span class="ring-2 ring-indigo-500 ring-offset-2 pointer-events-none absolute -inset-px rounded-lg" aria-hidden="true"></span>
                                </label>
                                <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 focus:outline-none">
                                    <input type="radio" name="status" value="complete" class="sr-only">
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Complete</span>
                                        </span>
                                    </span>
                                </label>
                                <label class="relative flex cursor-pointer rounded-lg border border-gray-300 bg-white p-4 focus:outline-none">
                                    <input type="radio" name="status" value="revision" class="sr-only">
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-medium text-gray-900">Revision</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-900">Upload Files</label>
                            <input type="file" class="filepond" name="files[]" multiple data-allow-reorder="true">
                            <p class="text-sm text-gray-500">Drag and drop your files here, or click to browse. Maximum 150MB per file.</p>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700/50 hover:backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Progress
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Work Progress List -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-bold text-gray-900">Your Work Progress</h3>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-2 h-2 mr-1 rounded-full bg-green-400"></span>
                                    Complete
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <span class="w-2 h-2 mr-1 rounded-full bg-yellow-400"></span>
                                    In Progress
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach($workProgress as $progress)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-3">
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $progress->company_name }}</h4>
                                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $progress->status === 'complete' ? 'bg-green-100 text-green-800' : ($progress->status === 'revision' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($progress->status) }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">{{ $progress->project_topic }}</p>
                                    <p class="mt-2 text-sm text-gray-700">{{ $progress->work_description }}</p>
                                    
                                    @if($progress->files->count() > 0)
                                    <div class="mt-4">
                                        <h5 class="text-sm font-medium text-gray-700 mb-2">Attached Files:</h5>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($progress->files as $file)
                                            <a href="{{ route('staff.progress.download', $file->id) }}" class="inline-flex items-center px-3 py-1 rounded-md bg-gray-100 hover:bg-gray-200 text-sm text-gray-700 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                </svg>
                                                {{ $file->original_name }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="ml-4 flex-shrink-0 text-right">
                                    <div class="text-sm text-gray-500">{{ $progress->created_at->format('M j, Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $progress->created_at->format('g:i A') }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize FilePond
        FilePond.create(document.querySelector('.filepond'));

        // Word counter for work description
        const workDescription = document.getElementById('work_description');
        const wordCounter = document.getElementById('word-counter');

        workDescription.addEventListener('input', function() {
            const words = this.value.trim().split(/\s+/).filter(word => word.length > 0);
            wordCounter.textContent = `${words.length} words`;
        });
    </script>
</body>
</html>
            </div>
        </div>
    </div>
</body>
</html>