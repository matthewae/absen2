@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $staff->name }}'s Attendance</h2>
                <p class="text-sm text-gray-600 mt-1">{{ $staff->position }} - {{ $staff->department }}</p>
            </div>
            <a href="{{ route('supervisor.staff-list') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Staff List</a>
        </div>

        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-medium text-gray-700 mb-2">Monthly Overview</h3>
            <div class="grid grid-cols-7 gap-2">
                @php
                    $currentMonth = now()->month;
                    $currentYear = now()->year;
                    $daysInMonth = now()->daysInMonth;
                    $firstDayOfMonth = now()->startOfMonth()->dayOfWeek;
                @endphp

                <!-- Week days header -->
                @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                    <div class="text-center text-sm font-medium text-gray-500">{{ $day }}</div>
                @endforeach

                <!-- Empty cells for days before the first day of month -->
                @for($i = 0; $i < $firstDayOfMonth; $i++)
                    <div class="h-10"></div>
                @endfor

                <!-- Calendar days -->
                @for($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $date = sprintf('%d-%02d-%02d', $currentYear, $currentMonth, $day);
                        $attendance = $monthlyAttendance[$date] ?? null;
                    @endphp
                    <div class="h-10 flex items-center justify-center rounded-lg {{ $attendance ? 'bg-green-100' : 'bg-white border border-gray-200' }}">
                        <div class="text-sm {{ $attendance ? 'text-green-800' : 'text-gray-700' }}">
                            {{ $day }}
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-700">Attendance Details</h3>
            @if($monthlyAttendance->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check In</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check Out</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($monthlyAttendance as $date => $records)
                                @foreach($records as $record)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $record->check_in->format('H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $record->check_out ? $record->check_out->format('H:i') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($record->check_out)
                                                {{ $record->check_in->diffInHours($record->check_out) }} hours
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600">No attendance records found for this month</p>
            @endif
        </div>
    </div>
</div>
@endsection