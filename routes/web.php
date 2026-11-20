<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// LANDING PAGE
Route::inertia('/', 'Welcome')->name('home');

// HALAMAN PENGGUNA YANG SUDAH LOGIN
Route::middleware(['auth', 'verified'])->group(function () {

    // REDIRECT DASHBOARD BERDASARKAN ROLE
    Route::get('/dashboard', function (Request $request) {

        $user = $request->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isTutor()) {
            return redirect()->route('tutor.dashboard');
        }

        abort(403, 'Role pengguna tidak dikenali.');

    })->name('dashboard');

    // DASHBOARD ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::inertia('/admin/dashboard', 'Admin/Dashboard')
            ->name('admin.dashboard');
    });

    // DASHBOARD TUTOR
    Route::middleware('role:tutor')->group(function () {
        Route::inertia('/tutor/dashboard', 'Tutor/Dashboard')
            ->name('tutor.dashboard');
    });

});

// PENGATURAN AKUN
require __DIR__.'/settings.php';
