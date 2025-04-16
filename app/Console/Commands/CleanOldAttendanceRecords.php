<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use Carbon\Carbon;

class CleanOldAttendanceRecords extends Command
{
    protected $signature = 'attendance:clean';
    protected $description = 'Clean attendance records from previous month on the 5th of each month';

    public function handle()
    {
        if (Carbon::now()->day === 5) {
            $lastMonth = Carbon::now()->subMonth();
            
            Attendance::whereYear('created_at', $lastMonth->year)
                ->whereMonth('created_at', $lastMonth->month)
                ->delete();

            $this->info('Successfully cleaned attendance records for ' . $lastMonth->format('F Y'));
        }
    }
}