<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TutorAttendanceController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $myClassrooms = Classroom::where('tutor_id', $user->id)->get();

        $selectedClassroomId = $request->query('classroom_id', $myClassrooms->first()?->id);
        $selectedDate = $request->query('date', Carbon::today()->toDateString());

        $students = collect();
        $existingAttendances = collect();

        if ($selectedClassroomId) {
            // Pastikan kelas ini milik tutor
            $classroom = $myClassrooms->firstWhere('id', (int) $selectedClassroomId);
            if ($classroom) {
                $students = Student::where('classroom_id', $classroom->id)->get();

                $existingAttendances = Attendance::where('classroom_id', $classroom->id)
                    ->where('date', $selectedDate)
                    ->get()
                    ->keyBy('student_id');
            }
        }

        return Inertia::render('tutor/Attendances/Index', [
            'myClassrooms' => $myClassrooms,
            'selectedClassroomId' => (int) $selectedClassroomId,
            'selectedDate' => $selectedDate,
            'students' => $students,
            'existingAttendances' => $existingAttendances,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.student_id' => 'required|exists:students,id',
            'attendances.*.status' => 'required|in:hadir,izin,sakit,alpa',
            'attendances.*.notes' => 'nullable|string|max:255',
        ]);

        // Verifikasi kepemilikan kelas oleh tutor
        $classroom = Classroom::where('id', $validated['classroom_id'])
            ->where('tutor_id', $user->id)
            ->firstOrFail();

        foreach ($validated['attendances'] as $item) {
            Attendance::updateOrCreate(
                [
                    'classroom_id' => $classroom->id,
                    'student_id' => $item['student_id'],
                    'date' => $validated['date'],
                ],
                [
                    'tutor_id' => $user->id,
                    'status' => $item['status'],
                    'notes' => $item['notes'] ?? null,
                ]
            );
        }

        return back()->with('status', 'Presensi kehadiran siswa berhasil disimpan!');
    }
}
