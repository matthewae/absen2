<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StaffLoginController;
use App\Http\Controllers\Auth\SupervisorLoginController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\Supervisor\DashboardController as SupervisorDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Redirect root login to staff login
Route::get('/login', function() {
    return redirect()->route('staff.login');
});

// Staff Routes
Route::prefix('staff')->name('staff.')->group(function () {
    Route::get('/login', [StaffLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [StaffLoginController::class, 'login']);
    Route::post('/logout', [StaffLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:staff')->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
        
        // Attendance routes
        Route::post('/attendance/checkin', [\App\Http\Controllers\Staff\AttendanceController::class, 'checkin'])->name('attendance.checkin');
        Route::post('/attendance/checkout', [\App\Http\Controllers\Staff\AttendanceController::class, 'checkout'])->name('attendance.checkout');
    
        // Leave request routes
        Route::get('/leave-requests/create', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'create'])->name('leave-requests.create');
        Route::post('/leave-requests', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'store'])->name('leave-requests.store');
        Route::get('/leave-requests', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'index'])->name('leave-requests.index');
        Route::get('/leave-requests/{leaveRequest}', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'show'])->name('leave-requests.show');
    });
});

// Supervisor Routes
Route::prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/login', [SupervisorLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SupervisorLoginController::class, 'login']);
    Route::post('/logout', [SupervisorLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:supervisor')->group(function () {
        Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');
        Route::get('/attendance', [\App\Http\Controllers\Supervisor\AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/staff', [\App\Http\Controllers\Supervisor\StaffController::class, 'index'])->name('staff.index');
        Route::resource('assignments', \App\Http\Controllers\Supervisor\AssignmentController::class);
    });
});
