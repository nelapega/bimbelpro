<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\ClassroomController as AdminClassroomController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\TutorApplicationController as AdminTutorApplicationController;
use App\Http\Controllers\Admin\TutorController as AdminTutorController;
use App\Http\Controllers\Public\TutorRegistrationController;
use App\Http\Controllers\Tutor\TutorAnnouncementController;
use App\Http\Controllers\Tutor\TutorAttendanceController;
use App\Http\Controllers\Tutor\TutorClassroomController;
use App\Http\Controllers\Tutor\TutorDashboardController;
use App\Http\Controllers\Tutor\TutorProfileController;
use App\Http\Controllers\Tutor\TutorScheduleController;
use App\Http\Controllers\Tutor\TutorStudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. HALAMAN UMUM (SEBELUM LOGIN)
// ==========================================
Route::inertia('/', 'Welcome')->name('home');

// Pendaftaran Calon Tutor (Publik)
Route::get('/daftar-tutor', [TutorRegistrationController::class, 'create'])->name('tutor.register');
Route::post('/daftar-tutor', [TutorRegistrationController::class, 'store'])->name('tutor.register.store');
Route::get('/informasi-pendaftaran', [TutorRegistrationController::class, 'info'])->name('tutor.register.info');
Route::get('/informasi-pendaftaran/cek', [TutorRegistrationController::class, 'checkStatus'])->name('tutor.register.status');

// ==========================================
// 2. HALAMAN PENGGUNA TERAUTENTIKASI
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // REDIRECT DASHBOARD BERDASARKAN ROLE
    Route::get('/dashboard', function (Request $request) {
        $user = $request->user();

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        if ($user->isTutor()) {
            return redirect()->intended(route('tutor.dashboard', absolute: false));
        }

        abort(403, 'Role pengguna tidak dikenali.');
    })->name('dashboard');

    // ==========================================
    // 3. FITUR ADMIN (PENGELOLA UTAMA)
    // ==========================================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // 1. Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // 2. Pendaftaran Tutor
        Route::get('/pendaftaran-tutor', [AdminTutorApplicationController::class, 'index'])->name('tutor-applications.index');
        Route::post('/pendaftaran-tutor/{application}/status', [AdminTutorApplicationController::class, 'updateStatus'])->name('tutor-applications.update-status');

        // 3. Data Siswa
        Route::get('/siswa', [AdminStudentController::class, 'index'])->name('students.index');
        Route::post('/siswa', [AdminStudentController::class, 'store'])->name('students.store');
        Route::put('/siswa/{student}', [AdminStudentController::class, 'update'])->name('students.update');
        Route::delete('/siswa/{student}', [AdminStudentController::class, 'destroy'])->name('students.destroy');

        // 4. Data Tutor
        Route::get('/tutor', [AdminTutorController::class, 'index'])->name('tutors.index');
        Route::put('/tutor/{user}', [AdminTutorController::class, 'update'])->name('tutors.update');

        // 5. Data Kelas
        Route::get('/kelas', [AdminClassroomController::class, 'index'])->name('classrooms.index');
        Route::post('/kelas', [AdminClassroomController::class, 'store'])->name('classrooms.store');
        Route::put('/kelas/{classroom}', [AdminClassroomController::class, 'update'])->name('classrooms.update');
        Route::delete('/kelas/{classroom}', [AdminClassroomController::class, 'destroy'])->name('classrooms.destroy');

        // 6. Jadwal
        Route::get('/jadwal', [AdminScheduleController::class, 'index'])->name('schedules.index');
        Route::post('/jadwal', [AdminScheduleController::class, 'store'])->name('schedules.store');
        Route::delete('/jadwal/{schedule}', [AdminScheduleController::class, 'destroy'])->name('schedules.destroy');

        // 7. Absensi
        Route::get('/absensi', [AdminAttendanceController::class, 'index'])->name('attendances.index');

        // 8. Tagihan
        Route::get('/tagihan', [AdminInvoiceController::class, 'index'])->name('invoices.index');
        Route::post('/tagihan', [AdminInvoiceController::class, 'store'])->name('invoices.store');

        // 9. Pembayaran
        Route::get('/pembayaran', [AdminPaymentController::class, 'index'])->name('payments.index');
        Route::post('/pembayaran', [AdminPaymentController::class, 'store'])->name('payments.store');

        // 10. Laporan
        Route::get('/laporan', [AdminReportController::class, 'index'])->name('reports.index');
    });

    // ==========================================
    // 4. FITUR TUTOR (TENAGA PENGAJAR)
    // ==========================================
    Route::middleware('role:tutor')->prefix('tutor')->name('tutor.')->group(function () {
        // 1. Dashboard
        Route::get('/dashboard', [TutorDashboardController::class, 'index'])->name('dashboard');

        // 2. Jadwal Mengajar
        Route::get('/jadwal', [TutorScheduleController::class, 'index'])->name('schedules.index');

        // 3. Kelas Saya
        Route::get('/kelas-saya', [TutorClassroomController::class, 'index'])->name('classrooms.index');

        // 4. Daftar Siswa
        Route::get('/siswa', [TutorStudentController::class, 'index'])->name('students.index');

        // 5. Absensi
        Route::get('/absensi', [TutorAttendanceController::class, 'index'])->name('attendances.index');
        Route::post('/absensi', [TutorAttendanceController::class, 'store'])->name('attendances.store');

        // 6. Pengumuman
        Route::get('/pengumuman', [TutorAnnouncementController::class, 'index'])->name('announcements.index');

        // 7. Profil Saya
        Route::get('/profil', [TutorProfileController::class, 'index'])->name('profile.index');
        Route::put('/profil', [TutorProfileController::class, 'update'])->name('profile.update');
    });

});

// PENGATURAN AKUN
require __DIR__.'/settings.php';
