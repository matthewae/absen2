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
        
        // Settings route
        Route::get('/settings', [\App\Http\Controllers\Staff\SettingsController::class, 'index'])->name('settings');
        Route::post('/settings/update-password', [\App\Http\Controllers\Staff\SettingsController::class, 'updatePassword'])->name('update-password');
        
        // Profile routes
        Route::get('/profile', [\App\Http\Controllers\Staff\ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update-photo', [\App\Http\Controllers\Staff\ProfileController::class, 'updatePhoto'])->name('update-photo');
        
        // Schedule route
        Route::get('/schedule', [\App\Http\Controllers\Staff\ScheduleController::class, 'index'])->name('schedule');
        
        // Attendance routes
        Route::get('/attendance', [\App\Http\Controllers\Staff\AttendanceController::class, 'index'])->name('attendance');
        Route::post('/attendance/checkin', [\App\Http\Controllers\Staff\AttendanceController::class, 'checkin'])->name('attendance.checkin');
        Route::post('/attendance/checkout', [\App\Http\Controllers\Staff\AttendanceController::class, 'checkout'])->name('attendance.checkout');
    
        // Leave request routes
        Route::get('/leave-requests/create', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'create'])->name('leave-requests.create');
        Route::post('/leave-requests', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'store'])->name('leave-requests.store');
        Route::get('/leave-requests', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'index'])->name('leave-requests.index');
        Route::get('/leave-requests/{leaveRequest}', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'show'])->name('leave-requests.show');

        // Work Progress routes
        Route::get('/progress', [\App\Http\Controllers\Staff\WorkProgressController::class, 'index'])->name('progress.index');
        Route::get('/progress/create', [\App\Http\Controllers\Staff\WorkProgressController::class, 'create'])->name('progress.create');
        Route::post('/progress', [\App\Http\Controllers\Staff\WorkProgressController::class, 'store'])->name('progress.store');
        Route::get('/progress/{workProgress}', [\App\Http\Controllers\Staff\WorkProgressController::class, 'show'])->name('progress.show');
        Route::get('/progress/{workProgress}/edit', [\App\Http\Controllers\Staff\WorkProgressController::class, 'edit'])->name('progress.edit');
        Route::put('/progress/{workProgress}', [\App\Http\Controllers\Staff\WorkProgressController::class, 'update'])->name('progress.update');
        Route::delete('/progress/{workProgress}', [\App\Http\Controllers\Staff\WorkProgressController::class, 'destroy'])->name('progress.destroy');
    });
});

// Supervisor Routes
Route::prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/login', [SupervisorLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SupervisorLoginController::class, 'login']);
    Route::post('/logout', [SupervisorLoginController::class, 'logout'])->name('logout');

    Route::middleware(['auth:supervisor'])->group(function () {
        Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [\App\Http\Controllers\SupervisorController::class, 'profile'])->name('profile');
        Route::post('/profile/update-photo', [\App\Http\Controllers\SupervisorController::class, 'updatePhoto'])->name('update-photo');
        Route::get('/staff', [SupervisorDashboardController::class, 'viewStaffList'])->name('staff-list');
        Route::get('/staff/{staff}/attendance', [SupervisorDashboardController::class, 'viewStaffAttendance'])->name('staff.attendance');
        Route::get('/leave-requests', [SupervisorDashboardController::class, 'viewLeaveRequests'])->name('leave-requests');
        Route::get('/leave-requests/{leaveRequest}', [SupervisorDashboardController::class, 'reviewLeaveRequest'])->name('review-leave-request');
        Route::get('/leave-requests/{leaveRequest}/review', [SupervisorDashboardController::class, 'reviewLeaveRequest'])->name('leave-requests.review');
        Route::post('/leave-requests/{leaveRequest}/approve', [SupervisorDashboardController::class, 'approveLeaveRequest'])->name('leave-requests.approve');
        Route::post('/leave-requests/{leaveRequest}/reject', [SupervisorDashboardController::class, 'rejectLeaveRequest'])->name('leave-requests.reject');
        Route::put('/leave-requests/{leaveRequest}', [SupervisorDashboardController::class, 'updateLeaveRequest'])->name('leave-requests.update');

        // Assignment routes
        Route::get('/assignments/create', [\App\Http\Controllers\Supervisor\AssignmentController::class, 'create'])->name('assignments.create');
        Route::post('/assignments', [\App\Http\Controllers\Supervisor\AssignmentController::class, 'store'])->name('assignments.store');
        Route::get('/assignments', [\App\Http\Controllers\Supervisor\AssignmentController::class, 'index'])->name('assignments.index');
        Route::get('/assignments/{assignment}', [\App\Http\Controllers\Supervisor\AssignmentController::class, 'show'])->name('assignments.show');
        Route::get('/assignments/{assignment}/edit', [\App\Http\Controllers\Supervisor\AssignmentController::class, 'edit'])->name('assignments.edit');
        Route::put('/assignments/{assignment}', [\App\Http\Controllers\Supervisor\AssignmentController::class, 'update'])->name('assignments.update');
        Route::delete('/assignments/{assignment}', [\App\Http\Controllers\Supervisor\AssignmentController::class, 'destroy'])->name('assignments.destroy');
        // Work Progress routes
        Route::get('/work-progress', [\App\Http\Controllers\Supervisor\WorkProgressController::class, 'index'])->name('work-progress.index');
        Route::get('/work-progress/{staff}', [\App\Http\Controllers\Supervisor\WorkProgressController::class, 'show'])->name('work-progress.show');
        Route::post('/work-progress/{progress}/approve', [\App\Http\Controllers\Supervisor\WorkProgressController::class, 'approve'])->name('work-progress.approve');

        Route::get('/settings', [\App\Http\Controllers\Supervisor\SettingsController::class, 'showSettings'])->name('settings');
        Route::put('/settings/update-password', [\App\Http\Controllers\Supervisor\SettingsController::class, 'updatePassword'])->name('update-password');
    });
});
