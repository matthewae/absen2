<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use Carbon\Carbon;

class DeleteLastMonthAttendance extends Command
{
    protected $signature = 'attendance:delete-last-month';
    protected $description = 'Delete attendance records from last month';

    public function handle()
    {
        $lastMonth = Carbon::now()->subMonth();
        
        $deletedCount = Attendance::whereMonth('check_in', $lastMonth->month)
            ->whereYear('check_in', $lastMonth->year)
            ->delete();

        $this->info("Deleted {$deletedCount} attendance records from {$lastMonth->format('F Y')}");
    }
}