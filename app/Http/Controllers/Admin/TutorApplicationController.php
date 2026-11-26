<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TutorApplication;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class TutorApplicationController extends Controller
{
    public function index(Request $request): Response
    {
        $status = $request->query('status');

        $applications = TutorApplication::query()
            ->when($status, fn ($q) => $q->where('status', $status))
            ->latest()
            ->get();

        return Inertia::render('admin/TutorApplications/Index', [
            'applications' => $applications,
            'currentFilter' => $status ?? 'all',
            'counts' => [
                'all' => TutorApplication::count(),
                'menunggu' => TutorApplication::where('status', 'menunggu')->count(),
                'sedang_ditinjau' => TutorApplication::where('status', 'sedang_ditinjau')->count(),
                'diterima' => TutorApplication::where('status', 'diterima')->count(),
                'ditolak' => TutorApplication::where('status', 'ditolak')->count(),
            ],
        ]);
    }

    public function updateStatus(Request $request, TutorApplication $application): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,sedang_ditinjau,diterima,ditolak',
            'admin_notes' => 'nullable|string',
            'custom_password' => 'nullable|string|min:6',
        ]);

        $newStatus = $validated['status'];
        $createdAccountMessage = '';

        // JIKA DITERIMA: Otomatis buat / aktifkan akun User dengan role 'tutor'
        if ($newStatus === 'diterima' && ! $application->user_id) {
            $existingUser = User::where('email', $application->email)->first();

            if (! $existingUser) {
                $password = $validated['custom_password'] ?: 'tutor123';
                $newUser = User::create([
                    'name' => $application->name,
                    'email' => $application->email,
                    'password' => Hash::make($password),
                    'role' => 'tutor',
                    'email_verified_at' => now(),
                ]);

                $application->user_id = $newUser->id;
                $createdAccountMessage = " Akun login tutor telah dibuat (Password awal: {$password}).";
            } else {
                $existingUser->update(['role' => 'tutor']);
                $application->user_id = $existingUser->id;
                $createdAccountMessage = ' Akun pengguna yang sudah ada diubah menjadi role Tutor.';
            }
        }

        $application->update([
            'status' => $newStatus,
            'admin_notes' => $validated['admin_notes'] ?? $application->admin_notes,
            'reviewed_at' => now(),
        ]);

        return back()->with('status', "Status pendaftaran calon tutor berhasil diperbarui menjadi {$newStatus}.{$createdAccountMessage}");
    }
}
