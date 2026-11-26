<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StudentController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->query('search');
        $classroomId = $request->query('classroom_id');

        $students = Student::with('classroom')
            ->when($search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
            })
            ->when($classroomId, fn ($q, $cid) => $q->where('classroom_id', $cid))
            ->latest()
            ->get();

        $classrooms = Classroom::select('id', 'name')->where('status', 'aktif')->get();

        return Inertia::render('admin/Students/Index', [
            'students' => $students,
            'classrooms' => $classrooms,
            'filters' => [
                'search' => $search,
                'classroom_id' => $classroomId,
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:students,nis',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'grade_level' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'school_origin' => 'nullable|string|max:255',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif,lulus',
        ]);

        Student::create([
            ...$validated,
            'joined_at' => now(),
        ]);

        return back()->with('status', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50|unique:students,nis,'.$student->id,
            'classroom_id' => 'nullable|exists:classrooms,id',
            'grade_level' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'school_origin' => 'nullable|string|max:255',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif,lulus',
        ]);

        $student->update($validated);

        return back()->with('status', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return back()->with('status', 'Data siswa berhasil dihapus.');
    }
}
