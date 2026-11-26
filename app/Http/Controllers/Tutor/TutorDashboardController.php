<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TutorDashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();

        $myClassrooms = Classroom::where('tutor_id', $user->id)
            ->withCount('students')
            ->get();

        $classroomIds = $myClassrooms->pluck('id');

        $totalStudents = Student::whereIn('classroom_id', $classroomIds)->count();

        $todayDay = Carbon::now()->locale('id')->isoFormat('dddd');
        $todaySchedules = Schedule::with('classroom')
            ->where('tutor_id', $user->id)
            ->where('day', $todayDay)
            ->get();

        $recentAttendances = Attendance::with(['student', 'classroom'])
            ->where('tutor_id', $user->id)
            ->latest()
            ->take(6)
            ->get();

        $announcements = Announcement::whereIn('target_role', ['all', 'tutor'])
            ->latest()
            ->take(3)
            ->get();

        return Inertia::render('tutor/Dashboard', [
            'myClassrooms' => $myClassrooms,
            'totalStudents' => $totalStudents,
            'todaySchedules' => $todaySchedules,
            'recentAttendances' => $recentAttendances,
            'announcements' => $announcements,
        ]);
    }
}
