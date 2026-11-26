<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Classroom;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\TutorApplication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BimbelProSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pastikan Admin Utama Ada
        $admin = User::firstOrCreate(
            ['email' => 'admin@bimbelpro.com'],
            [
                'name' => 'Admin BimbelPro',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Pastikan Tutor Utama Ada
        $tutor1 = User::firstOrCreate(
            ['email' => 'tutor@bimbelpro.com'],
            [
                'name' => 'Tutor BimbelPro (Rian Hidayat, S.Pd.)',
                'password' => Hash::make('tutor123'),
                'role' => 'tutor',
                'email_verified_at' => now(),
            ]
        );

        $tutor2 = User::firstOrCreate(
            ['email' => 'sarah@bimbelpro.com'],
            [
                'name' => 'Sarah Azzahra, M.Si.',
                'password' => Hash::make('tutor123'),
                'role' => 'tutor',
                'email_verified_at' => now(),
            ]
        );

        $tutor3 = User::firstOrCreate(
            ['email' => 'dimas@bimbelpro.com'],
            [
                'name' => 'Dimas Pratama, S.Si.',
                'password' => Hash::make('tutor123'),
                'role' => 'tutor',
                'email_verified_at' => now(),
            ]
        );

        // 3. Calon Tutor (Pendaftaran Tutor)
        TutorApplication::updateOrCreate(
            ['email' => 'tutor@bimbelpro.com'],
            [
                'user_id' => $tutor1->id,
                'name' => 'Rian Hidayat, S.Pd.',
                'phone' => '081234567890',
                'education' => 'S1 Pendidikan Matematika - Universitas Indonesia',
                'subject_specialization' => 'Matematika & Penalaran Kuantitatif',
                'experience_years' => '4 tahun',
                'motivation' => 'Ingin mendedikasikan ilmu matematika agar mudah dipahami siswa SMA.',
                'portfolio_url' => 'https://linkedin.com/in/rianhidayat',
                'status' => 'diterima',
                'admin_notes' => 'Lulus wawancara & microteaching dengan nilai A. Akun diaktifkan.',
                'reviewed_at' => now()->subDays(10),
            ]
        );

        TutorApplication::updateOrCreate(
            ['email' => 'sarah@bimbelpro.com'],
            [
                'user_id' => $tutor2->id,
                'name' => 'Sarah Azzahra, M.Si.',
                'phone' => '081298765432',
                'education' => 'S2 Fisika Terapan - Institut Teknologi Bandung',
                'subject_specialization' => 'Fisika SMA & Persiapan Olimpiade',
                'experience_years' => '5 tahun',
                'motivation' => 'Berpengalaman melatih siswa tembus medali OSN Fisika.',
                'portfolio_url' => 'https://linkedin.com/in/sarah-azzahra',
                'status' => 'diterima',
                'admin_notes' => 'Kualifikasi sangat baik. Akun diaktifkan.',
                'reviewed_at' => now()->subDays(8),
            ]
        );

        TutorApplication::firstOrCreate(
            ['email' => 'anisa.fitri@gmail.com'],
            [
                'name' => 'Anisa Fitriani, S.Pd.',
                'phone' => '085712345678',
                'education' => 'S1 Pendidikan Bahasa Inggris - Universitas Negeri Jakarta',
                'subject_specialization' => 'Bahasa Inggris & TOEFL Preparation',
                'experience_years' => '2 tahun',
                'motivation' => 'Metode pembelajaran komunikatif dan interaktif untuk siswa SMP-SMA.',
                'portfolio_url' => 'https://instagram.com/anisateaches',
                'status' => 'sedang_ditinjau',
                'admin_notes' => 'Jadwal wawancara tanggal 28 November 2026 pukul 14:00.',
                'reviewed_at' => now()->subDay(),
            ]
        );

        TutorApplication::firstOrCreate(
            ['email' => 'fajar.nugroho@gmail.com'],
            [
                'name' => 'Fajar Nugroho, S.Si.',
                'phone' => '087811223344',
                'education' => 'S1 Kimia - Universitas Gadjah Mada',
                'subject_specialization' => 'Kimia SMA & UTBK',
                'experience_years' => '3 tahun',
                'motivation' => 'Membuat kimia menjadi pelajaran yang menyenangkan lewat eksperimen konseptual.',
                'portfolio_url' => 'https://drive.google.com/cv-fajar',
                'status' => 'menunggu',
                'admin_notes' => null,
                'reviewed_at' => null,
            ]
        );

        TutorApplication::firstOrCreate(
            ['email' => 'hendra.kusuma@gmail.com'],
            [
                'name' => 'Hendra Kusuma',
                'phone' => '081399887766',
                'education' => 'D3 Teknik Informatika',
                'subject_specialization' => 'Biologi',
                'experience_years' => '1 tahun',
                'motivation' => 'Ingin mencoba mengajar.',
                'portfolio_url' => null,
                'status' => 'ditolak',
                'admin_notes' => 'Kualifikasi pendidikan dan mata pelajaran yang diajukan tidak selaras.',
                'reviewed_at' => now()->subDays(5),
            ]
        );

        // 4. Kelas Belajar
        $kelas1 = Classroom::firstOrCreate(
            ['name' => '12 IPA - UTBK SNBT Unggulan'],
            [
                'tutor_id' => $tutor1->id,
                'subject' => 'Matematika & TPS',
                'grade_level' => 'SMA',
                'capacity' => 20,
                'room' => 'Ruang Galileo (Lantai 2)',
                'status' => 'aktif',
            ]
        );

        $kelas2 = Classroom::firstOrCreate(
            ['name' => '11 IPA - Fisika Master'],
            [
                'tutor_id' => $tutor2->id,
                'subject' => 'Fisika',
                'grade_level' => 'SMA',
                'capacity' => 15,
                'room' => 'Ruang Newton (Lantai 1)',
                'status' => 'aktif',
            ]
        );

        $kelas3 = Classroom::firstOrCreate(
            ['name' => '9 SMP - Matematika Juara'],
            [
                'tutor_id' => $tutor1->id,
                'subject' => 'Matematika',
                'grade_level' => 'SMP',
                'capacity' => 18,
                'room' => 'Ruang Pythagoras (Lantai 1)',
                'status' => 'aktif',
            ]
        );

        $kelas4 = Classroom::firstOrCreate(
            ['name' => '10 SMA - Kimia & Sains'],
            [
                'tutor_id' => $tutor3->id,
                'subject' => 'Kimia',
                'grade_level' => 'SMA',
                'capacity' => 16,
                'room' => 'Ruang Curie (Lantai 2)',
                'status' => 'aktif',
            ]
        );

        // 5. Data Siswa
        $studentsData = [
            ['nis' => 'BP-2026-001', 'name' => 'Ahmad Fauzan', 'classroom_id' => $kelas1->id, 'grade_level' => 'SMA', 'email' => 'fauzan@student.com', 'phone' => '081234001', 'school_origin' => 'SMAN 1 Jakarta', 'parent_name' => 'Ir. Gunawan', 'parent_phone' => '081200001', 'address' => 'Jl. Tebet Barat No. 12'],
            ['nis' => 'BP-2026-002', 'name' => 'Bintang Pratama', 'classroom_id' => $kelas1->id, 'grade_level' => 'SMA', 'email' => 'bintang@student.com', 'phone' => '081234002', 'school_origin' => 'SMAN 8 Jakarta', 'parent_name' => 'Bambang S.', 'parent_phone' => '081200002', 'address' => 'Jl. Rasuna Sahid No. 45'],
            ['nis' => 'BP-2026-003', 'name' => 'Clarissa Putri', 'classroom_id' => $kelas1->id, 'grade_level' => 'SMA', 'email' => 'clarissa@student.com', 'phone' => '081234003', 'school_origin' => 'SMAN 70 Jakarta', 'parent_name' => 'Hj. Ratna', 'parent_phone' => '081200003', 'address' => 'Jl. Gandaria No. 7'],
            ['nis' => 'BP-2026-004', 'name' => 'Dava Ramadhan', 'classroom_id' => $kelas1->id, 'grade_level' => 'SMA', 'email' => 'dava@student.com', 'phone' => '081234004', 'school_origin' => 'SMAN 28 Jakarta', 'parent_name' => 'H. Suryo', 'parent_phone' => '081200004', 'address' => 'Jl. Pasar Minggu No. 88'],
            ['nis' => 'BP-2026-005', 'name' => 'Elisa Marwah', 'classroom_id' => $kelas2->id, 'grade_level' => 'SMA', 'email' => 'elisa@student.com', 'phone' => '081234005', 'school_origin' => 'SMAN 34 Jakarta', 'parent_name' => 'Budi Utomo', 'parent_phone' => '081200005', 'address' => 'Jl. Fatmawati No. 21'],
            ['nis' => 'BP-2026-006', 'name' => 'Fathan Alghifari', 'classroom_id' => $kelas2->id, 'grade_level' => 'SMA', 'email' => 'fathan@student.com', 'phone' => '081234006', 'school_origin' => 'SMAN 68 Jakarta', 'parent_name' => 'Farhan A.', 'parent_phone' => '081200006', 'address' => 'Jl. Salemba No. 19'],
            ['nis' => 'BP-2026-007', 'name' => 'Gita Kirana', 'classroom_id' => $kelas3->id, 'grade_level' => 'SMP', 'email' => 'gita@student.com', 'phone' => '081234007', 'school_origin' => 'SMPN 115 Jakarta', 'parent_name' => 'Kurniawan', 'parent_phone' => '081200007', 'address' => 'Jl. Casablangka No. 9'],
            ['nis' => 'BP-2026-008', 'name' => 'Habibi Rahman', 'classroom_id' => $kelas3->id, 'grade_level' => 'SMP', 'email' => 'habibi@student.com', 'phone' => '081234008', 'school_origin' => 'SMP Labschool Kebayoran', 'parent_name' => 'Rahmat H.', 'parent_phone' => '081200008', 'address' => 'Jl. Wolter Monginsidi No. 3'],
            ['nis' => 'BP-2026-009', 'name' => 'Intan Permata', 'classroom_id' => $kelas4->id, 'grade_level' => 'SMA', 'email' => 'intan@student.com', 'phone' => '081234009', 'school_origin' => 'SMAN 8 Jakarta', 'parent_name' => 'dr. Hendra', 'parent_phone' => '081200009', 'address' => 'Jl. Cikini Raya No. 14'],
            ['nis' => 'BP-2026-010', 'name' => 'Jovi Julian', 'classroom_id' => $kelas4->id, 'grade_level' => 'SMA', 'email' => 'jovi@student.com', 'phone' => '081234010', 'school_origin' => 'SMAN 28 Jakarta', 'parent_name' => 'Julian P.', 'parent_phone' => '081200010', 'address' => 'Jl. Ampera No. 25'],
        ];

        foreach ($studentsData as $data) {
            Student::firstOrCreate(['nis' => $data['nis']], [
                ...$data,
                'status' => 'aktif',
                'joined_at' => now()->subMonths(2),
            ]);
        }

        // 6. Jadwal Belajar
        Schedule::firstOrCreate(
            ['classroom_id' => $kelas1->id, 'day' => 'Senin'],
            [
                'tutor_id' => $tutor1->id,
                'start_time' => '15:30',
                'end_time' => '17:00',
                'room' => 'Ruang Galileo',
                'topic' => 'Kalkulus & Matriks Tingkat Lanjut',
            ]
        );

        Schedule::firstOrCreate(
            ['classroom_id' => $kelas1->id, 'day' => 'Rabu'],
            [
                'tutor_id' => $tutor1->id,
                'start_time' => '15:30',
                'end_time' => '17:00',
                'room' => 'Ruang Galileo',
                'topic' => 'Bedah Soal Penalaran Kuantitatif SNBT',
            ]
        );

        Schedule::firstOrCreate(
            ['classroom_id' => $kelas2->id, 'day' => 'Selasa'],
            [
                'tutor_id' => $tutor2->id,
                'start_time' => '16:00',
                'end_time' => '17:30',
                'room' => 'Ruang Newton',
                'topic' => 'Dinamika Rotasi & Kesetimbangan Benda Tegar',
            ]
        );

        Schedule::firstOrCreate(
            ['classroom_id' => $kelas3->id, 'day' => 'Kamis'],
            [
                'tutor_id' => $tutor1->id,
                'start_time' => '14:00',
                'end_time' => '15:30',
                'room' => 'Ruang Pythagoras',
                'topic' => 'Persamaan Garis Lurus & Aljabar Dasar',
            ]
        );

        Schedule::firstOrCreate(
            ['classroom_id' => $kelas4->id, 'day' => 'Jumat'],
            [
                'tutor_id' => $tutor3->id,
                'start_time' => '15:45',
                'end_time' => '17:15',
                'room' => 'Ruang Curie',
                'topic' => 'Konfigurasi Elektron & Tabel Periodik',
            ]
        );

        // 7. Data Absensi (untuk kelas 1 oleh tutor 1)
        $studentsK1 = Student::where('classroom_id', $kelas1->id)->get();
        $today = Carbon::today();
        foreach ($studentsK1 as $idx => $st) {
            $status = match ($idx % 4) {
                0 => 'hadir',
                1 => 'hadir',
                2 => 'izin',
                3 => 'hadir',
            };
            Attendance::updateOrCreate(
                ['classroom_id' => $kelas1->id, 'student_id' => $st->id, 'date' => $today->toDateString()],
                [
                    'tutor_id' => $tutor1->id,
                    'status' => $status,
                    'notes' => $status === 'izin' ? 'Ada acara keluarga' : 'Mengikuti sesi tepat waktu',
                ]
            );
        }

        // 8. Tagihan & Pembayaran Siswa
        foreach (Student::take(6)->get() as $idx => $st) {
            $invNum = 'INV-202611-'.str_pad($st->id, 3, '0', STR_PAD_LEFT);
            $isPaid = $idx % 2 === 0;

            $inv = Invoice::firstOrCreate(
                ['invoice_number' => $invNum],
                [
                    'student_id' => $st->id,
                    'title' => 'Biaya Bimbingan Belajar November 2026',
                    'amount' => 750000,
                    'due_date' => Carbon::now()->addDays(5)->toDateString(),
                    'status' => $isPaid ? 'lunas' : 'belum_lunas',
                    'notes' => 'Paket Reguler 12 Sesi + 2x Tryout Eksklusif',
                ]
            );

            if ($isPaid) {
                Payment::firstOrCreate(
                    ['payment_number' => 'PAY-202611-'.str_pad($st->id, 3, '0', STR_PAD_LEFT)],
                    [
                        'invoice_id' => $inv->id,
                        'student_id' => $st->id,
                        'amount' => 750000,
                        'payment_date' => Carbon::now()->subDays(2)->toDateString(),
                        'payment_method' => 'transfer_bank',
                        'status' => 'berhasil',
                        'notes' => 'Transfer via BCA Virtual Account',
                    ]
                );
            }
        }

        // 9. Pengumuman Sistem
        Announcement::firstOrCreate(
            ['title' => 'Jadwal Simulasi Tryout Akbar SNBT 2027'],
            [
                'author_id' => $admin->id,
                'content' => 'Simulasi Tryout Akbar akan dilaksanakan serentak pada hari Sabtu, 5 Desember 2026. Seluruh tutor diharapkan mendampingi dan memeriksa kehadiran siswa.',
                'target_role' => 'all',
                'is_pinned' => true,
            ]
        );

        Announcement::firstOrCreate(
            ['title' => 'Panduan Pengisian Absensi Digital BimbelPro'],
            [
                'author_id' => $admin->id,
                'content' => 'Bagi seluruh Tutor, mohon mengisi presensi kelas maksimal 30 menit setelah sesi pembelajaran selesai melalui portal Tutor masing-masing.',
                'target_role' => 'tutor',
                'is_pinned' => false,
            ]
        );
    }
}
