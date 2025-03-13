<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">My Leave Requests</h1>
                    <p class="mt-1 text-sm text-gray-600">View and manage your leave requests</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('staff.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
                        Back to Dashboard
                    </a>
                    <a href="{{ route('staff.leave-requests.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        New Request
                    </a>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                @if($leaveRequests->count() > 0)
                    <ul class="divide-y divide-gray-200">
                        @foreach($leaveRequests as $request)
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center">
                                                <p class="text-sm font-medium text-indigo-600 truncate capitalize">{{ $request->type }} Leave</p>
                                                <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' : ($request->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </div>
                                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $request->start_date->format('d M Y') }} - {{ $request->end_date->format('d M Y') }}
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            @if($request->attachment)
                                                <a href="{{ Storage::url($request->attachment) }}" target="_blank" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700">
                                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                    </svg>
                                                    Attachment
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600">{{ $request->reason }}</p>
                                    </div>
                                    @if($request->supervisor_comment)
                                        <div class="mt-2 text-sm">
                                            <span class="font-medium text-gray-500">Supervisor Comment:</span>
                                            <span class="text-gray-600">{{ $request->supervisor_comment }}</span>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="px-4 py-6 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="mt-2">No leave requests found</p>
                        <a href="{{ route('staff.leave-requests.create') }}" class="mt-3 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                            Create your first leave request
                            <svg class="ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

            @if($leaveRequests->hasPages())
                <div class="mt-4">
                    {{ $leaveRequests->links() }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>