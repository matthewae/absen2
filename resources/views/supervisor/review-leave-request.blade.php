@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Review Leave Request</h2>
                <p class="text-sm text-gray-600 mt-1">From {{ $leaveRequest->staff->name }}</p>
            </div>
            <a href="{{ route('supervisor.dashboard') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Dashboard</a>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Leave Type</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $leaveRequest->type }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Duration</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $leaveRequest->start_date->format('d M Y') }} - {{ $leaveRequest->end_date->format('d M Y') }}</p>
                    <p class="text-sm text-gray-500">({{ $leaveRequest->getDurationInDays() }} days)</p>
                </div>
                <div class="md:col-span-2">
                    <h3 class="text-sm font-medium text-gray-500">Reason</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $leaveRequest->reason }}</p>
                </div>
                @if($leaveRequest->attachment)
                    <div class="md:col-span-2">
                        <h3 class="text-sm font-medium text-gray-500">Attachment</h3>
                        <a href="{{ Storage::url($leaveRequest->attachment) }}" target="_blank" class="mt-1 inline-flex items-center text-sm text-indigo-600 hover:text-indigo-900">
                            View Attachment
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-700">Your Response</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <form action="{{ route('supervisor.leave-requests.approve', $leaveRequest) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="approve_comment" class="block text-sm font-medium text-gray-700">Comment (Optional)</label>
                        <textarea id="approve_comment" name="supervisor_comment" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Approve Request
                    </button>
                </form>

                <form action="{{ route('supervisor.reject-leave-request', $leaveRequest) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="reject_comment" class="block text-sm font-medium text-gray-700">Reason for Rejection <span class="text-red-500">*</span></label>
                        <textarea id="reject_comment" name="supervisor_comment" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Reject Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection