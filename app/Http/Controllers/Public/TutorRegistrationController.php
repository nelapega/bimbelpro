<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\TutorApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TutorRegistrationController extends Controller
{
    /**
     * Tampilkan formulir pendaftaran calon tutor.
     */
    public function create(): Response
    {
        return Inertia::render('Public/TutorRegister');
    }

    /**
     * Tampilkan halaman alur dan informasi penerimaan tutor.
     */
    public function info(): Response
    {
        return Inertia::render('Public/TutorRegisterInfo');
    }

    /**
     * Simpan pengajuan pendaftaran calon tutor baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tutor_applications,email',
            'phone' => 'required|string|max:20',
            'education' => 'required|string|max:255',
            'subject_specialization' => 'required|string|max:255',
            'experience_years' => 'required|string|max:50',
            'motivation' => 'required|string|min:20',
            'portfolio_url' => 'nullable|url|max:255',
        ], [
            'email.unique' => 'Email ini sudah pernah digunakan untuk pendaftaran tutor.',
            'motivation.min' => 'Motivasi minimal terdiri dari 20 karakter.',
        ]);

        TutorApplication::create([
            ...$validated,
            'status' => 'menunggu',
        ]);

        return redirect()->route('tutor.register.info')->with('status', 'Pendaftaran Anda berhasil dikirim! Tim BimbelPro akan meninjau berkas Anda.');
    }

    /**
     * Cek status pendaftaran calon tutor berdasarkan email.
     */
    public function checkStatus(Request $request): Response
    {
        $application = null;

        if ($request->filled('email')) {
            $application = TutorApplication::where('email', $request->query('email'))->first();
        }

        return Inertia::render('Public/TutorRegisterInfo', [
            'searchedEmail' => $request->query('email'),
            'application' => $application,
        ]);
    }
}
