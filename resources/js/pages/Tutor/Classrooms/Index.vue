<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import TutorLayout from '@/layouts/TutorLayout.vue';

defineOptions({
    layout: TutorLayout,
});

defineProps<{
    classrooms: Array<{
        id: number;
        name: string;
        subject: string;
        grade_level: string;
        capacity: number;
        room?: string | null;
        students_count: number;
        students: Array<{ id: number; name: string; nis: string }>;
        schedules: Array<{ id: number; day: string; start_time: string; end_time: string }>;
    }>;
}>();
</script>

<template>
    <Head title="Kelas Saya | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Kelas Bimbingan Saya</h1>
                <p class="mt-1 text-xs text-slate-500">Rombongan belajar dan siswa yang ditugaskan oleh Administrator kepada Anda.</p>
            </div>
        </div>

        <!-- CLASSROOMS CARDS -->
        <div class="grid gap-6 sm:grid-cols-2">
            <div
                v-for="c in classrooms"
                :key="c.id"
                class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm transition hover:shadow-lg hover:shadow-purple-500/5"
            >
                <div class="flex items-center justify-between">
                    <span class="rounded-full bg-purple-100 px-3 py-1 text-[10px] font-bold text-purple-700">
                        {{ c.grade_level }}
                    </span>
                    <span class="text-xs font-bold text-slate-500">{{ c.students_count }} / {{ c.capacity }} Siswa</span>
                </div>

                <h3 class="mt-4 text-lg font-extrabold text-slate-900">{{ c.name }}</h3>
                <p class="mt-1 text-xs font-semibold text-purple-700">{{ c.subject }} • {{ c.room ?? 'Ruang Belajar' }}</p>

                <!-- SCHEDULE PILLS -->
                <div class="mt-5 border-t border-slate-100 pt-4">
                    <p class="text-[11px] font-bold text-slate-400 mb-2 uppercase">Jadwal Sesi</p>
                    <div class="flex flex-wrap gap-2">
                        <span
                            v-for="sc in c.schedules"
                            :key="sc.id"
                            class="rounded-xl bg-purple-50 px-2.5 py-1 text-xs font-bold text-purple-800"
                        >
                            {{ sc.day }} ({{ sc.start_time }}-{{ sc.end_time }})
                        </span>
                        <span v-if="c.schedules.length === 0" class="text-xs text-slate-400 italic">
                            Belum ada jadwal
                        </span>
                    </div>
                </div>

                <!-- STUDENT PREVIEWS -->
                <div class="mt-5 border-t border-slate-100 pt-4">
                    <p class="text-[11px] font-bold text-slate-400 mb-2 uppercase">Siswa Terdaftar ({{ c.students.length }})</p>
                    <div class="max-h-36 overflow-y-auto space-y-1.5 scrollbar-thin">
                        <div
                            v-for="st in c.students"
                            :key="st.id"
                            class="flex items-center justify-between rounded-xl bg-slate-50/70 px-3 py-1.5 text-xs"
                        >
                            <span class="font-bold text-slate-800">{{ st.name }}</span>
                            <span class="text-[10px] font-mono text-purple-600">{{ st.nis }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end">
                    <Link
                        href="/tutor/absensi"
                        class="rounded-xl bg-purple-600 px-4 py-2 text-xs font-bold text-white hover:bg-purple-700"
                    >
                        Isi Absensi Kelas Ini →
                    </Link>
                </div>
            </div>
        </div>

        <div v-if="classrooms.length === 0" class="rounded-3xl border border-dashed border-slate-200 bg-white p-12 text-center text-slate-400 text-xs">
            Belum ada kelas yang ditugaskan kepada Anda oleh Administrator.
        </div>

    </div>
</template>
