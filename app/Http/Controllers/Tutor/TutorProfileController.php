<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\TutorApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TutorProfileController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $application = TutorApplication::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->first();

        return Inertia::render('tutor/Profile/Index', [
            'tutor' => $user,
            'application' => $application,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'subject_specialization' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
        ]);

        $user->update(['name' => $validated['name']]);

        $application = TutorApplication::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->first();

        if ($application) {
            $application->update([
                'name' => $validated['name'],
                'phone' => $validated['phone'] ?? $application->phone,
                'subject_specialization' => $validated['subject_specialization'] ?? $application->subject_specialization,
                'education' => $validated['education'] ?? $application->education,
            ]);
        }

        return back()->with('status', 'Informasi profil tutor berhasil diperbarui.');
    }
}
