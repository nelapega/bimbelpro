<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\TutorApplication;
use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class AdminDashboardController extends Controller
{
    public function index(): Response
    {
        $totalStudents = Student::where('status', 'aktif')->count();
        $totalTutors = User::where('role', 'tutor')->count();
        $totalClassrooms = Classroom::where('status', 'aktif')->count();
        $unpaidInvoices = Invoice::where('status', 'belum_lunas')->sum('amount');

        $pendingTutorApplications = TutorApplication::where('status', 'menunggu')->count();
        $reviewingTutorApplications = TutorApplication::where('status', 'sedang_ditinjau')->count();
        $acceptedTutorApplications = TutorApplication::where('status', 'diterima')->count();

        $recentPayments = Payment::with('student', 'invoice')
            ->latest()
            ->take(5)
            ->get();

        $todayDay = Carbon::now()->locale('id')->isoFormat('dddd');
        $todaySchedules = Schedule::with('classroom', 'tutor')
            ->where('day', $todayDay)
            ->take(5)
            ->get();

        $recentApplications = TutorApplication::latest()->take(5)->get();

        return Inertia::render('admin/Dashboard', [
            'stats' => [
                'totalStudents' => $totalStudents,
                'totalTutors' => $totalTutors,
                'totalClassrooms' => $totalClassrooms,
                'unpaidInvoices' => (float) $unpaidInvoices,
                'pendingTutorApplications' => $pendingTutorApplications,
                'reviewingTutorApplications' => $reviewingTutorApplications,
                'acceptedTutorApplications' => $acceptedTutorApplications,
            ],
            'recentPayments' => $recentPayments,
            'todaySchedules' => $todaySchedules,
            'recentApplications' => $recentApplications,
        ]);
    }
}
