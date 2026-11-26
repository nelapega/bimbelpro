<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TutorClassroomController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();

        $classrooms = Classroom::where('tutor_id', $user->id)
            ->with(['students', 'schedules'])
            ->withCount('students')
            ->get();

        return Inertia::render('tutor/Classrooms/Index', [
            'classrooms' => $classrooms,
        ]);
    }
}
