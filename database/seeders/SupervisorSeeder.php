<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Hash;

class SupervisorSeeder extends Seeder
{
    public function run(): void
    {
        Supervisor::create([
            'supervisor_id' => 'SUP001',
            'name' => 'Michael Johnson',
            'email' => 'michael.johnson@mandajaya.com',
            'password' => 'password123',
            'department' => 'IT',
            'position' => 'IT Manager'
        ]);

        Supervisor::create([
            'supervisor_id' => 'SUP002',
            'name' => 'Sarah Williams',
            'email' => 'sarah.williams@mandajaya.com',
            'password' => 'password123',
            'department' => 'HR',
            'position' => 'HR Director'
        ]);
    }
}