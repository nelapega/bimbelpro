<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Inertia\Inertia;
use Inertia\Response;

class TutorAnnouncementController extends Controller
{
    public function index(): Response
    {
        $announcements = Announcement::with('author')
            ->whereIn('target_role', ['all', 'tutor'])
            ->orderByDesc('is_pinned')
            ->latest()
            ->get();

        return Inertia::render('tutor/Announcements/Index', [
            'announcements' => $announcements,
        ]);
    }
}
