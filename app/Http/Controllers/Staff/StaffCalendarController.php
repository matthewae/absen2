<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffCalendarController extends Controller
{
    public function index()
    {
        return view('staff.calendar');
    }

    public function events()
    {
        $staff = Auth::user();
        $assignments = Assignment::where('staff_id', $staff->id)
            ->get()
            ->map(function ($assignment) {
                return [
                    'id' => $assignment->id,
                    'title' => $assignment->title,
                    'start' => $assignment->start_datetime,
                    'end' => $assignment->end_datetime,
                    'backgroundColor' => $this->getStatusColor($assignment->status),
                    'borderColor' => $this->getStatusColor($assignment->status),
                    'textColor' => '#ffffff',
                    'url' => route('staff.assignments.show', $assignment->id)
                ];
            });

        return response()->json($assignments);
    }

    private function getStatusColor($status)
    {
        return match($status) {
            'pending' => '#FFA500',     // Orange
            'in_progress' => '#3498DB', // Blue
            'completed' => '#2ECC71',   // Green
            default => '#95A5A6'        // Gray
        };
    }
}