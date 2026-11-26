<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class ReportController extends Controller
{
    public function index(): Response
    {
        $totalStudents = Student::count();
        $totalTutors = User::where('role', 'tutor')->count();
        $totalClassrooms = Classroom::count();
        $totalRevenue = (float) Payment::where('status', 'berhasil')->sum('amount');
        $totalReceivables = (float) Invoice::where('status', 'belum_lunas')->sum('amount');

        $attendanceCount = Attendance::count();
        $attendanceRate = $attendanceCount > 0
            ? round((Attendance::where('status', 'hadir')->count() / $attendanceCount) * 100, 1)
            : 100;

        $classroomReports = Classroom::with('tutor')
            ->withCount('students', 'schedules', 'attendances')
            ->get();

        return Inertia::render('admin/Reports/Index', [
            'metrics' => [
                'totalStudents' => $totalStudents,
                'totalTutors' => $totalTutors,
                'totalClassrooms' => $totalClassrooms,
                'totalRevenue' => $totalRevenue,
                'totalReceivables' => $totalReceivables,
                'attendanceRate' => $attendanceRate,
            ],
            'classroomReports' => $classroomReports,
        ]);
    }
}
