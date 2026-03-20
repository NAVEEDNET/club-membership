<?php

use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// 1️⃣ Root route (redirect to admin login)
Route::get('/', function() {
    return redirect()->route('admin.login');
});

// 2️⃣ Public admin login routes (no auth required)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

// 3️⃣ Protected admin routes (require admin authentication)
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Members CRUD
    Route::get('/members/create', [MemberController::class, 'create'])
        ->name('admin.members.create');
    Route::post('/members', [MemberController::class, 'store'])
        ->name('admin.members.store');

    Route::get('/members', [MemberController::class, 'index'])
        ->name('admin.members.index');

    Route::get('/members/{member}', [MemberController::class, 'show'])
        ->name('admin.members.show');

    // Edit & Update
    Route::get('/members/{member}/edit', [MemberController::class, 'edit'])
        ->name('admin.members.edit');
    Route::put('/members/{member}', [MemberController::class, 'update'])
        ->name('admin.members.update');
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])
        ->name('admin.members.destroy');
        Route::get('/admin/members/export', 
    [MemberController::class, 'exportExcel']
)->name('admin.members.export');
});