<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TutorScheduleController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();

        $schedules = Schedule::with('classroom')
            ->where('tutor_id', $user->id)
            ->orderByRaw("CASE day WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END")
            ->orderBy('start_time')
            ->get();

        return Inertia::render('tutor/Schedules/Index', [
            'schedules' => $schedules,
        ]);
    }
}
