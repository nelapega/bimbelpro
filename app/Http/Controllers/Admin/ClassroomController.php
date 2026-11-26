<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ClassroomController extends Controller
{
    public function index(): Response
    {
        $classrooms = Classroom::with('tutor')
            ->withCount('students')
            ->latest()
            ->get();

        $tutors = User::where('role', 'tutor')->select('id', 'name')->get();

        return Inertia::render('admin/Classrooms/Index', [
            'classrooms' => $classrooms,
            'tutors' => $tutors,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'grade_level' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'tutor_id' => 'nullable|exists:users,id',
            'room' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif,selesai',
        ]);

        Classroom::create($validated);

        return back()->with('status', 'Kelas baru berhasil dibuat.');
    }

    public function update(Request $request, Classroom $classroom): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'grade_level' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'tutor_id' => 'nullable|exists:users,id',
            'room' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif,selesai',
        ]);

        $classroom->update($validated);

        return back()->with('status', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
        $classroom->delete();

        return back()->with('status', 'Kelas berhasil dihapus.');
    }
}
