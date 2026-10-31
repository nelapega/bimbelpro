<?php

use Illuminate\Support\Facades\Route;

// Halaman utama langsung menuju login
Route::redirect('/', '/login')->name('home');

// ===============================
// ROUTE KHUSUS ADMIN
// ===============================

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::inertia('/dashboard', 'Admin/Dashboard')
            ->name('dashboard');

    });

// ===============================
// ROUTE KHUSUS TUTOR
// ===============================

Route::middleware(['auth', 'role:tutor'])
    ->prefix('tutor')
    ->name('tutor.')
    ->group(function () {

        Route::inertia('/dashboard', 'Tutor/Dashboard')
            ->name('dashboard');

    });

// Route pengaturan bawaan Laravel
require __DIR__.'/settings.php';
