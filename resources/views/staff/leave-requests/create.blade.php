<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Leave Request</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');

            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
            });
        });
    </script>
</head>
<body class="bg-yellow-50">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden fixed top-4 right-4 z-20 bg-yellow-600 text-black p-2 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <!-- Sidebar -->
        <div id="sidebar" class="bg-black text-yellow-300 w-full md:w-64 py-6 flex flex-col fixed md:relative z-10 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
            <div class="px-6 mb-8">
                <h1 class="text-2xl font-bold">PT. Mandajaya Rekayasa Konstruksi</h1>
            </div>
            <nav class="flex-1">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-yellow-500 hover:text-black transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="flex-1 w-full p-6 md:p-8">
            <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="max-w-md mx-auto">
                    <div class="p-6 border-b border-yellow-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900">Create Leave Request</h2>
                            <p class="text-sm text-gray-500">Please fill in all required fields</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('staff.leave-requests.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="bg-red-50 text-red-500 p-4 rounded-lg">
                                    <ul class="list-disc pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="space-y-4">
                                <div class="flex flex-col">
                                    <label class="text-sm font-medium text-gray-700 mb-1">Leave Type<span class="text-red-500">*</span></label>
                                    <select name="type" class="px-4 py-2 border focus:ring-yellow-500 focus:border-yellow-500 w-full text-sm border-gray-300 rounded-lg focus:outline-none text-gray-600" required>
                                    <option value="">Select Leave Type</option>
                                    <option value="annual" {{ old('type') == 'annual' ? 'selected' : '' }}>Annual Leave</option>
                                    <option value="sick" {{ old('type') == 'sick' ? 'selected' : '' }}>Sick Leave</option>
                                    <option value="emergency" {{ old('type') == 'emergency' ? 'selected' : '' }}>Emergency Leave</option>
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm font-medium text-gray-700 mb-1">Start Date<span class="text-red-500">*</span></label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}" class="px-4 py-2 border focus:ring-yellow-500 focus:border-yellow-500 w-full text-sm border-gray-300 rounded-lg focus:outline-none text-gray-600" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm font-medium text-gray-700 mb-1">End Date<span class="text-red-500">*</span></label>
                                <input type="date" name="end_date" value="{{ old('end_date') }}" class="px-4 py-2 border focus:ring-yellow-500 focus:border-yellow-500 w-full text-sm border-gray-300 rounded-lg focus:outline-none text-gray-600" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm font-medium text-gray-700 mb-1">Reason<span class="text-red-500">*</span></label>
                                <textarea name="reason" rows="3" class="px-4 py-2 border focus:ring-yellow-500 focus:border-yellow-500 w-full text-sm border-gray-300 rounded-lg focus:outline-none text-gray-600" required>{{ old('reason') }}</textarea>
                            </div>
                            <div class="flex flex-col">
                                <label class="text-sm font-medium text-gray-700 mb-1">Supporting Document<span class="text-red-500">*</span></label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-yellow-200 border-dashed rounded-lg hover:border-yellow-300 transition-colors duration-200">
                                    <div class="space-y-2 text-center">
                                        <svg class="mx-auto h-12 w-12 text-yellow-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="attachment" class="relative cursor-pointer bg-white rounded-md font-medium text-yellow-600 hover:text-yellow-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-yellow-500">
                                                <span>Upload a file</span>
                                                <input id="attachment" name="attachment" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png" required>
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF, PNG, JPG up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-6 flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('staff.dashboard') }}" class="flex justify-center items-center w-full text-gray-900 px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
                            </a>
                            <button type="submit" class="bg-yellow-600 flex justify-center items-center w-full text-black px-4 py-2 rounded-lg focus:outline-none hover:bg-yellow-700 transition-colors duration-200">
                                Create Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>