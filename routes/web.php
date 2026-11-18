
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// LANDING PAGE
Route::inertia('/', 'Welcome')->name('home');


Route::get('/cek-header-inertia', function (Request $request) {
    return response()->json([
        'header_inertia' => $request->header('X-Inertia'),
        'header_ajax' => $request->header('X-Requested-With'),
        'accept' => $request->header('Accept'),
        'middleware' => $request->route()->gatherMiddleware(),
    ]);
});


// ROUTE PENGECEKAN SESSION SEMENTARA
Route::get('/cek-sesi', function (Request $request) {
    return response()->json([
        'authenticated' => auth()->check(),
        'user_id' => auth()->id(),
        'has_session_cookie' => $request->cookies->has(
            config('session.cookie')
        ),
        'session_driver' => config('session.driver'),
    ]);
});



// HALAMAN PENGGUNA YANG SUDAH LOGIN
Route::middleware(['auth', 'verified'])->group(function () {

    // PENGARAH DASHBOARD BERDASARKAN ROLE
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


    // =====================================
    // HALAMAN KHUSUS ADMIN
    // =====================================

    Route::middleware('role:admin')->group(function () {

        Route::inertia('/admin/dashboard', 'admin/Dashboard')
            ->name('admin.dashboard');

    });


    // =====================================
    // HALAMAN KHUSUS TUTOR
    // =====================================

    Route::middleware('role:tutor')->group(function () {

        Route::inertia('/tutor/dashboard', 'tutor/Dashboard')
            ->name('tutor.dashboard');

    });

});


// PENGATURAN AKUN
require __DIR__.'/settings.php';
