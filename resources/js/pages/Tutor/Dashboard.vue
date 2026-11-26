<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import TutorLayout from '@/layouts/TutorLayout.vue';

defineOptions({
    layout: TutorLayout,
});

defineProps<{
    myClassrooms: Array<{
        id: number;
        name: string;
        subject: string;
        grade_level: string;
        room?: string | null;
        students_count: number;
    }>;
    totalStudents: number;
    todaySchedules: Array<{
        id: number;
        day: string;
        start_time: string;
        end_time: string;
        room?: string | null;
        topic?: string | null;
        classroom: { name: string };
    }>;
    recentAttendances: Array<{
        id: number;
        date: string;
        status: string;
        student: { name: string };
        classroom: { name: string };
    }>;
    announcements: Array<{
        id: number;
        title: string;
        content: string;
        created_at: string;
    }>;
}>();
</script>

<template>
    <Head title="Dashboard Tutor | BimbelPro" />

    <div class="space-y-8">

        <!-- WELCOME BANNER -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#3B0764] via-[#581C87] to-[#7C3AED] p-7 text-white shadow-xl sm:p-9">
            <div class="relative z-10">
                <span class="rounded-full bg-purple-400/30 px-3.5 py-1 text-[10px] font-bold tracking-[2px] text-purple-200 uppercase">
                    AREA PENGAJAR PROFESIONAL
                </span>

                <h1 class="mt-3 text-2xl font-extrabold sm:text-3xl">
                    Selamat Mengajar, {{ $page.props.auth?.user?.name ?? 'Tutor' }}!
                </h1>

                <p class="mt-2 max-w-xl text-xs sm:text-sm text-purple-100/80 leading-relaxed">
                    Semangat membimbing siswa hari ini. Pantau jadwal mengajar, kelas aktif, dan catat presensi kehadiran siswa dengan mudah.
                </p>
            </div>
        </section>

        <!-- STATS TILES -->
        <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-purple-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-700 font-bold text-lg">▤</span>
                    <span class="text-[10px] font-bold text-purple-600 bg-purple-50 px-2.5 py-0.5 rounded-full">Aktif</span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500">Kelas Saya</p>
                <h3 class="mt-1 text-3xl font-extrabold text-slate-900">{{ myClassrooms.length }}</h3>
                <Link href="/tutor/kelas-saya" class="mt-3 inline-block text-[11px] font-bold text-purple-600 hover:text-purple-800">
                    Buka Kelas →
                </Link>
            </div>

            <div class="rounded-2xl border border-purple-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 font-bold text-lg">♙</span>
                    <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2.5 py-0.5 rounded-full">Bimbingan</span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500">Total Siswa Saya</p>
                <h3 class="mt-1 text-3xl font-extrabold text-slate-900">{{ totalStudents }}</h3>
                <Link href="/tutor/siswa" class="mt-3 inline-block text-[11px] font-bold text-purple-600 hover:text-purple-800">
                    Daftar Siswa →
                </Link>
            </div>

            <div class="rounded-2xl border border-purple-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 font-bold text-lg">◷</span>
                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full">Hari Ini</span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500">Jadwal Sesi Hari Ini</p>
                <h3 class="mt-1 text-3xl font-extrabold text-slate-900">{{ todaySchedules.length }}</h3>
                <Link href="/tutor/jadwal" class="mt-3 inline-block text-[11px] font-bold text-purple-600 hover:text-purple-800">
                    Semua Jadwal →
                </Link>
            </div>

            <div class="rounded-2xl border border-purple-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-700 font-bold text-lg">✓</span>
                    <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2.5 py-0.5 rounded-full">Presensi</span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500">Input Kehadiran</p>
                <h3 class="mt-1 text-base font-extrabold text-slate-900">Digital</h3>
                <Link href="/tutor/absensi" class="mt-3 inline-block text-[11px] font-bold text-purple-600 hover:text-purple-800">
                    Input Absensi Sekarang →
                </Link>
            </div>
        </section>

        <!-- JADWAL HARI INI & PENGUMUMAN -->
        <section class="grid gap-6 lg:grid-cols-2">

            <!-- JADWAL HARI INI -->
            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">Jadwal Mengajar Hari Ini</h2>
                        <p class="text-xs text-slate-400">Sesi bimbingan aktif</p>
                    </div>
                    <Link href="/tutor/absensi" class="text-xs font-bold text-purple-600 hover:text-purple-800">
                        Input Absensi →
                    </Link>
                </div>

                <div v-if="todaySchedules.length > 0" class="mt-4 space-y-3">
                    <div
                        v-for="s in todaySchedules"
                        :key="s.id"
                        class="flex items-center justify-between rounded-2xl bg-purple-50/60 p-4 border border-purple-100"
                    >
                        <div>
                            <p class="text-xs font-extrabold text-slate-900">{{ s.classroom.name }}</p>
                            <p class="text-[11px] text-purple-700 font-medium">{{ s.room }} • {{ s.topic ?? 'Materi Reguler' }}</p>
                        </div>
                        <span class="rounded-xl bg-white px-3 py-1.5 text-xs font-extrabold text-slate-800 shadow-sm border border-purple-100">
                            {{ s.start_time }} - {{ s.end_time }}
                        </span>
                    </div>
                </div>

                <div v-else class="mt-6 py-8 text-center text-xs text-slate-400">
                    Tidak ada jadwal mengajar untuk hari ini. Waktu istirahat atau persiapan materi!
                </div>
            </div>

            <!-- PENGUMUMAN DARI ADMIN -->
            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">Pengumuman Akademik</h2>
                        <p class="text-xs text-slate-400">Pemberitahuan dari pengelola</p>
                    </div>
                    <Link href="/tutor/pengumuman" class="text-xs font-bold text-purple-600 hover:text-purple-800">
                        Lihat Semua →
                    </Link>
                </div>

                <div v-if="announcements.length > 0" class="mt-4 space-y-3">
                    <div
                        v-for="ann in announcements"
                        :key="ann.id"
                        class="rounded-2xl border border-purple-100/80 bg-slate-50/70 p-4"
                    >
                        <h3 class="text-xs font-bold text-slate-900">{{ ann.title }}</h3>
                        <p class="mt-1 text-[11px] text-slate-600 leading-relaxed">{{ ann.content }}</p>
                    </div>
                </div>

                <div v-else class="mt-6 py-8 text-center text-xs text-slate-400">
                    Belum ada pengumuman baru dari Administrator.
                </div>
            </div>

        </section>

    </div>
</template>
