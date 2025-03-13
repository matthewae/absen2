<?php

use App\Http\Controllers\Staff\ProgressController;
use App\Http\Controllers\WorkProgressController;
use App\Http\Controllers\WorkProgressFileController;
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

        // Progress routes
        Route::get('/progress', function() {
            return redirect()->route('staff.progress.index');
        })->name('progress');

        Route::prefix('progress')->name('progress.')->group(function () {
            Route::get('/', [ProgressController::class, 'index'])->name('index');
            Route::get('/create', [ProgressController::class, 'create'])->name('create');
            Route::post('/', [ProgressController::class, 'store'])->name('store');
            Route::get('/{workProgress}', [ProgressController::class, 'show'])->name('show');
            Route::get('/{file}/download', [ProgressController::class, 'download'])->name('download-file');
        });
        
        // Work Progress routes
        Route::get('/work-progress', function() {
            return redirect()->route('staff.work-progress.index');
        })->name('work-progress');

        Route::prefix('work-progress')->name('work-progress.')->group(function () {
            Route::get('/', [ProgressController::class, 'index'])->name('index');
            Route::get('/create', [ProgressController::class, 'create'])->name('create');
            Route::post('/', [ProgressController::class, 'store'])->name('store');
            Route::get('/{workProgress}', [ProgressController::class, 'show'])->name('show');
            Route::get('/{file}/download', [ProgressController::class, 'download'])->name('download-file');
        });
        
        // Attendance routes
        Route::get('/attendance', [\App\Http\Controllers\Staff\AttendanceController::class, 'index'])->name('attendance');
        Route::post('/attendance/checkin', [\App\Http\Controllers\Staff\AttendanceController::class, 'checkin'])->name('attendance.checkin');
        Route::post('/attendance/checkout', [\App\Http\Controllers\Staff\AttendanceController::class, 'checkout'])->name('attendance.checkout');

        // Schedule routes
        Route::get('/schedule', [\App\Http\Controllers\Staff\ScheduleController::class, 'index'])->name('schedule');

        // Profile routes
        Route::get('/profile', [\App\Http\Controllers\Staff\ProfileController::class, 'index'])->name('profile');
        Route::post('/update-photo', [\App\Http\Controllers\Staff\ProfileController::class, 'updatePhoto'])->name('update-photo');

        // Settings routes
        Route::get('/settings', [\App\Http\Controllers\Staff\SettingsController::class, 'index'])->name('settings');
        Route::post('/update-password', [\App\Http\Controllers\Staff\SettingsController::class, 'updatePassword'])->name('update-password');
    
        // Leave request routes
        Route::prefix('leave')->name('leave.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'store'])->name('store');
            Route::get('/{leaveRequest}', [\App\Http\Controllers\Staff\LeaveRequestController::class, 'show'])->name('show');
        });
    });
});

// Supervisor Routes
Route::prefix('supervisor')->name('supervisor.')->group(function () {
    Route::get('/login', [SupervisorLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SupervisorLoginController::class, 'login']);
    Route::post('/logout', [SupervisorLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:supervisor')->group(function () {
        Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])->name('dashboard');
    });
});
