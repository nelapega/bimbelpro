<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import TutorLayout from '@/layouts/TutorLayout.vue';

defineOptions({
    layout: TutorLayout,
});

defineProps<{
    schedules: Array<{
        id: number;
        day: string;
        start_time: string;
        end_time: string;
        room?: string | null;
        topic?: string | null;
        classroom: { id: number; name: string; subject: string; grade_level: string };
    }>;
}>();
</script>

<template>
    <Head title="Jadwal Mengajar Saya | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Jadwal Mengajar Saya</h1>
                <p class="mt-1 text-xs text-slate-500">Daftar hari dan jam mengajar kelas yang ditugaskan kepada Anda.</p>
            </div>
            <Link
                href="/tutor/absensi"
                class="inline-flex items-center gap-2 rounded-2xl bg-purple-600 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-purple-500/20 hover:bg-purple-700"
            >
                <span>Input Presensi Sesi →</span>
            </Link>
        </div>

        <!-- SCHEDULES TABLE -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Hari & Jam</th>
                            <th class="px-6 py-4">Kelas & Mata Pelajaran</th>
                            <th class="px-6 py-4">Ruangan</th>
                            <th class="px-6 py-4">Topik Pembahasan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="s in schedules" :key="s.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4">
                                <span class="font-extrabold text-purple-800 text-sm block">{{ s.day }}</span>
                                <span class="text-[11px] font-semibold text-slate-500">{{ s.start_time }} - {{ s.end_time }} WIB</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-extrabold text-slate-900">{{ s.classroom.name }}</p>
                                <p class="text-[11px] text-purple-600 font-semibold">{{ s.classroom.subject }} ({{ s.classroom.grade_level }})</p>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-700">{{ s.room ?? 'Ruang Belajar Utama' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ s.topic ?? 'Materi Reguler' }}</td>
                            <td class="px-6 py-4 text-right">
                                <Link
                                    href="/tutor/absensi"
                                    class="rounded-xl bg-purple-50 px-3.5 py-1.5 font-bold text-purple-700 hover:bg-purple-100"
                                >
                                    Absensi Kelas
                                </Link>
                            </td>
                        </tr>

                        <tr v-if="schedules.length === 0">
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                Belum ada penugasan jadwal mengajar untuk akun Anda.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>
