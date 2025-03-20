<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $staff = Auth::user();
        $assignments = Assignment::where('staff_id', $staff->id)
            ->orderBy('start_datetime')
            ->get()
            ->map(function($assignment) {
                return [
                    'id' => $assignment->id,
                    'title' => $assignment->title,
                    'start' => $assignment->start_datetime,
                    'end' => $assignment->end_datetime,
                    'description' => $assignment->description,
                    'status' => $assignment->status,
                    'priority' => $assignment->priority
                ];
            });

        $upcomingAssignments = Assignment::where('staff_id', $staff->id)
            ->where('start_datetime', '>', now())
            ->orderBy('start_datetime')
            ->get();

        return view('staff.schedule', [
            'staff' => $staff,
            'assignments' => $assignments,
            'upcomingAssignments' => $upcomingAssignments,
            'calendarEvents' => $assignments
        ]);
    }
}