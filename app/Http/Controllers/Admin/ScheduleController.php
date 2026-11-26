<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ScheduleController extends Controller
{
    public function index(): Response
    {
        $schedules = Schedule::with(['classroom', 'tutor'])
            ->orderByRaw("CASE day WHEN 'Senin' THEN 1 WHEN 'Selasa' THEN 2 WHEN 'Rabu' THEN 3 WHEN 'Kamis' THEN 4 WHEN 'Jumat' THEN 5 WHEN 'Sabtu' THEN 6 WHEN 'Minggu' THEN 7 ELSE 8 END")
            ->orderBy('start_time')
            ->get();

        $classrooms = Classroom::where('status', 'aktif')->select('id', 'name', 'tutor_id')->get();
        $tutors = User::where('role', 'tutor')->select('id', 'name')->get();

        return Inertia::render('admin/Schedules/Index', [
            'schedules' => $schedules,
            'classrooms' => $classrooms,
            'tutors' => $tutors,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'tutor_id' => 'required|exists:users,id',
            'day' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'room' => 'nullable|string|max:255',
            'topic' => 'nullable|string|max:255',
        ]);

        Schedule::create($validated);

        return back()->with('status', 'Jadwal belajar berhasil ditambahkan.');
    }

    public function destroy(Schedule $schedule): RedirectResponse
    {
        $schedule->delete();

        return back()->with('status', 'Jadwal berhasil dihapus.');
    }
}
