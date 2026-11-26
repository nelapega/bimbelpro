<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TutorController extends Controller
{
    public function index(): Response
    {
        $tutors = User::where('role', 'tutor')
            ->with(['classrooms', 'tutorApplication'])
            ->withCount(['classrooms', 'schedules'])
            ->latest()
            ->get();

        return Inertia::render('admin/Tutors/Index', [
            'tutors' => $tutors,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if ($user->role !== 'tutor') {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->update($validated);

        return back()->with('status', 'Data profil tutor berhasil diperbarui.');
    }
}
