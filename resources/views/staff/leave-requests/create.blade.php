<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Leave Request</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-5 mb-6">
                        <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                            <h2 class="leading-relaxed">Create Leave Request</h2>
                            <p class="text-sm text-gray-500 font-normal">Please fill in all required fields</p>
                        </div>
                    </div>
                    <form action="{{ route('staff.leave-requests.store') }}" method="POST" class="divide-y divide-gray-200" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="flex flex-col">
                                <label class="leading-loose font-medium text-gray-700">Leave Type<span class="text-red-500">*</span></label>
                                <select name="type" class="px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>
                                    <option value="">Select Leave Type</option>
                                    <option value="annual" {{ old('type') == 'annual' ? 'selected' : '' }}>Annual Leave</option>
                                    <option value="sick" {{ old('type') == 'sick' ? 'selected' : '' }}>Sick Leave</option>
                                    <option value="emergency" {{ old('type') == 'emergency' ? 'selected' : '' }}>Emergency Leave</option>
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose font-medium text-gray-700">Start Date<span class="text-red-500">*</span></label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}" class="px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose font-medium text-gray-700">End Date<span class="text-red-500">*</span></label>
                                <input type="date" name="end_date" value="{{ old('end_date') }}" class="px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose font-medium text-gray-700">Reason<span class="text-red-500">*</span></label>
                                <textarea name="reason" rows="3" class="px-4 py-2 border focus:ring-indigo-500 focus:border-indigo-500 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" required>{{ old('reason') }}</textarea>
                            </div>
                            <div class="flex flex-col">
                                <label class="leading-loose font-medium text-gray-700">Supporting Document<span class="text-red-500">*</span></label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="attachment" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
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
                        <div class="pt-4 flex items-center space-x-4">
                            <a href="{{ route('staff.dashboard') }}" class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none hover:bg-gray-100">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
                            </a>
                            <button type="submit" class="bg-indigo-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none hover:bg-indigo-600">
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