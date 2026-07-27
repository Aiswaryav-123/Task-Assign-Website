<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Staff\TaskController as StaffTaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root redirect
Route::get('/', function () {
    return redirect()->route('login');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Routes (Admin Only)
    Route::middleware('role:admin')->prefix('admin')->as('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        
        // Staff Management
        Route::resource('staff', AdminStaffController::class);

        // Task Management
        Route::resource('tasks', AdminTaskController::class);
    });

    // Staff Routes
    Route::middleware('role:staff')->prefix('staff')->as('staff.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staffDashboard'])->name('dashboard');
        
        // Staff Task Actions
        Route::get('/tasks/{task}', [StaffTaskController::class, 'show'])->name('tasks.show');
        Route::patch('/tasks/{task}/status', [StaffTaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    });
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return "Cache Cleared!";
});
