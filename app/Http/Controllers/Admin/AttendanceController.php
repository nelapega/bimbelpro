<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classroom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AttendanceController extends Controller
{
    public function index(Request $request): Response
    {
        $classroomId = $request->query('classroom_id');
        $date = $request->query('date', Carbon::today()->toDateString());

        $classrooms = Classroom::select('id', 'name')->get();

        $attendances = Attendance::with(['student', 'classroom', 'tutor'])
            ->when($classroomId, fn ($q) => $q->where('classroom_id', $classroomId))
            ->when($date, fn ($q) => $q->where('date', $date))
            ->latest()
            ->get();

        $summary = [
            'hadir' => $attendances->where('status', 'hadir')->count(),
            'izin' => $attendances->where('status', 'izin')->count(),
            'sakit' => $attendances->where('status', 'sakit')->count(),
            'alpa' => $attendances->where('status', 'alpa')->count(),
        ];

        return Inertia::render('admin/Attendances/Index', [
            'attendances' => $attendances,
            'classrooms' => $classrooms,
            'selectedClassroomId' => $classroomId,
            'selectedDate' => $date,
            'summary' => $summary,
        ]);
    }
}
