<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TutorStudentController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();

        $myClassrooms = Classroom::where('tutor_id', $user->id)->get();
        $classroomIds = $myClassrooms->pluck('id');

        $students = Student::with('classroom')
            ->whereIn('classroom_id', $classroomIds)
            ->latest()
            ->get();

        return Inertia::render('tutor/Students/Index', [
            'students' => $students,
            'myClassrooms' => $myClassrooms,
        ]);
    }
}
