<?php

use App\Models\Classroom;
use App\Models\Student;
use App\Models\TutorApplication;
use App\Models\User;

test('landing page can be rendered with modern purple theme', function () {
    $response = $this->get(route('home'));
    $response->assertOk();
});

test('public tutor registration form can be rendered and submitted', function () {
    $response = $this->get(route('tutor.register'));
    $response->assertOk();

    $postResponse = $this->post(route('tutor.register.store'), [
        'name' => 'Calon Tutor Hebat',
        'email' => 'calon.tutor@example.com',
        'phone' => '081234567890',
        'education' => 'S1 Pendidikan Fisika UNJ',
        'subject_specialization' => 'Fisika SMA',
        'experience_years' => '2 tahun',
        'motivation' => 'Saya bertekad mendidik siswa agar mencintai sains fisika dengan metode kontekstual.',
        'portfolio_url' => 'https://linkedin.com/in/calontutor',
    ]);

    $postResponse->assertRedirect(route('tutor.register.info'));
    $this->assertDatabaseHas('tutor_applications', [
        'email' => 'calon.tutor@example.com',
        'status' => 'menunggu',
    ]);
});

test('applicant can check registration status', function () {
    TutorApplication::factory()->create([
        'email' => 'status.cek@example.com',
        'status' => 'sedang_ditinjau',
    ]);

    $response = $this->get(route('tutor.register.status', ['email' => 'status.cek@example.com']));
    $response->assertOk();
});

test('admin can view and approve tutor application with auto user creation', function () {
    $admin = User::factory()->admin()->create();

    $app = TutorApplication::factory()->create([
        'name' => 'Dewi Sartika, S.Pd.',
        'email' => 'dewi.sartika@example.com',
        'status' => 'menunggu',
    ]);

    $response = $this->actingAs($admin)->post(route('admin.tutor-applications.update-status', $app->id), [
        'status' => 'diterima',
        'custom_password' => 'dewi12345',
        'admin_notes' => 'Lulus seleksi microteaching dengan nilai memuaskan.',
    ]);

    $response->assertSessionHasNoErrors();
    $this->assertDatabaseHas('tutor_applications', [
        'id' => $app->id,
        'status' => 'diterima',
    ]);

    // Verifikasi akun User dengan role 'tutor' otomatis dibuat
    $this->assertDatabaseHas('users', [
        'email' => 'dewi.sartika@example.com',
        'role' => 'tutor',
    ]);
});

test('admin can access all 10 management menus', function () {
    $admin = User::factory()->admin()->create();
    $this->actingAs($admin);

    $menus = [
        route('admin.dashboard'),
        route('admin.tutor-applications.index'),
        route('admin.students.index'),
        route('admin.tutors.index'),
        route('admin.classrooms.index'),
        route('admin.schedules.index'),
        route('admin.attendances.index'),
        route('admin.invoices.index'),
        route('admin.payments.index'),
        route('admin.reports.index'),
    ];

    foreach ($menus as $url) {
        $this->get($url)->assertOk();
    }
});

test('tutor can access all 7 tutor menus and record attendance', function () {
    $tutor = User::factory()->tutor()->create();
    $this->actingAs($tutor);

    $classroom = Classroom::create([
        'tutor_id' => $tutor->id,
        'name' => '12 IPA Fisika Khusus',
        'subject' => 'Fisika',
        'grade_level' => 'SMA',
        'capacity' => 15,
        'status' => 'aktif',
    ]);

    $student = Student::create([
        'classroom_id' => $classroom->id,
        'nis' => 'TEST-001',
        'name' => 'Siswa Rajin',
        'grade_level' => 'SMA',
        'status' => 'aktif',
    ]);

    $menus = [
        route('tutor.dashboard'),
        route('tutor.schedules.index'),
        route('tutor.classrooms.index'),
        route('tutor.students.index'),
        route('tutor.attendances.index'),
        route('tutor.announcements.index'),
        route('tutor.profile.index'),
    ];

    foreach ($menus as $url) {
        $this->get($url)->assertOk();
    }

    // Test input presensi kehadiran
    $attendanceResponse = $this->post(route('tutor.attendances.store'), [
        'classroom_id' => $classroom->id,
        'date' => now()->toDateString(),
        'attendances' => [
            [
                'student_id' => $student->id,
                'status' => 'hadir',
                'notes' => 'Hadir tepat waktu dan aktif berdiskusi.',
            ],
        ],
    ]);

    $attendanceResponse->assertSessionHasNoErrors();
    $this->assertDatabaseHas('attendances', [
        'classroom_id' => $classroom->id,
        'student_id' => $student->id,
        'status' => 'hadir',
    ]);
});
