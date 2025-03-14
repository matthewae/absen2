<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function profile()
    {
        $supervisor = auth()->user();
        return view('supervisor.profile', [
            'supervisor' => $supervisor,
            'title' => 'Profile'
        ]);
    }
}