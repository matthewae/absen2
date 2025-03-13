@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Supervisor Info -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Welcome, {{ $supervisor->name }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-700">Department Staff</h3>
                <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $staffCount }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-700">Staff on Leave Today</h3>
                <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $staffOnLeave }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-700">Pending Leave Requests</h3>
                <p class="text-2xl font-semibold text-gray-900 mt-2">{{ $pendingLeaveRequests->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Staff Attendance Today -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Today's Staff Attendance</h2>
            <a href="{{ route('supervisor.staff-list') }}" class="text-indigo-600 hover:text-indigo-900">View All Staff</a>
        </div>
        @if($staffAttendanceToday->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($staffAttendanceToday as $staff)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $staff->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $staff->attendances->first()->check_in->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $staff->attendances->first()->check_out ? $staff->attendances->first()->check_out->format('H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $staff->attendances->first()->check_out ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $staff->attendances->first()->check_out ? 'Completed' : 'On Duty' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600">No attendance records for today</p>
        @endif
    </div>

    <!-- Recent Assignments -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Recent Assignments</h2>
            <a href="{{ route('supervisor.assignments.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">New Assignment</a>
        </div>
        @if($recentAssignments->count() > 0)
            <div class="space-y-4">
                @foreach($recentAssignments as $assignment)
                    <div class="border-l-4 border-indigo-500 pl-4 py-2">
                        <h3 class="text-lg font-medium text-gray-900">{{ $assignment->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $assignment->description }}</p>
                        <div class="mt-2 text-sm text-gray-500">
                            <span>Assigned to: {{ $assignment->staff->name }}</span>
                            <span class="mx-2">|</span>
                            <span>Start: {{ $assignment->start_datetime->format('d M Y H:i') }}</span>
                            <span class="mx-2">|</span>
                            <span>End: {{ $assignment->end_datetime->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No recent assignments</p>
        @endif
    </div>

    <!-- Pending Leave Requests -->
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Pending Leave Requests</h2>
        @if($pendingLeaveRequests->count() > 0)
            <div class="space-y-4">
                @foreach($pendingLeaveRequests as $request)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $request->staff->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $request->type }}</p>
                                <p class="text-sm text-gray-500">{{ $request->start_date->format('d M Y') }} - {{ $request->end_date->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600 mt-2">{{ $request->reason }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('supervisor.review-leave-request', $request) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">Review</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">No pending leave requests</p>
        @endif
    </div>
</div>
@endsection