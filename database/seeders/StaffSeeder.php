<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        // Get the supervisor ID from the database
        $supervisor = \App\Models\Supervisor::first();
        
        if ($supervisor) {
            Staff::create([
                'staff_id' => 'STF001',
                'name' => 'John Doe',
                'email' => 'john.doe@mandajaya.com',
                'password' => 'password123',
                'department' => 'IT',
                'position' => 'Software Developer',
                'birth_date' => '1990-01-15',
                'annual_leave_quota' => 12,
                'remaining_leave' => 12,
                'used_leave' => 0,
                'supervisor_id' => $supervisor->id
            ]);

            Staff::create([
                'staff_id' => 'STF002',
                'name' => 'Jane Smith',
                'email' => 'jane.smith@mandajaya.com',
                'password' => 'password123',
                'department' => 'HR',
                'position' => 'HR Manager',
                'birth_date' => '1988-05-20',
                'annual_leave_quota' => 12,
                'remaining_leave' => 10,
                'used_leave' => 2,
                'supervisor_id' => $supervisor->id
            ]);

            Staff::create([
                'staff_id' => 'STF003',
                'name' => 'Mike Johnson',
                'email' => 'mike.johnson@mandajaya.com',
                'password' => 'password123',
                'department' => 'IT',
                'position' => 'System Administrator',
                'birth_date' => '1992-08-10',
                'annual_leave_quota' => 12,
                'remaining_leave' => 12,
                'used_leave' => 0,
                'supervisor_id' => $supervisor->id
            ]);
        }
    }
}