<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import TutorLayout from '@/layouts/TutorLayout.vue';

defineOptions({
    layout: TutorLayout,
});

defineProps<{
    students: Array<{
        id: number;
        nis: string;
        name: string;
        grade_level: string;
        school_origin?: string | null;
        classroom?: { id: number; name: string };
    }>;
    myClassrooms: Array<{ id: number; name: string }>;
}>();
</script>

<template>
    <Head title="Daftar Siswa Saya | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Daftar Siswa Bimbingan Saya</h1>
                <p class="mt-1 text-xs text-slate-500">Siswa yang tergabung dalam kelas yang Anda ajar.</p>
            </div>
        </div>

        <!-- TABLE OF STUDENTS -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Nomor Induk (NIS)</th>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4">Rombel / Kelas</th>
                            <th class="px-6 py-4">Jenjang</th>
                            <th class="px-6 py-4">Asal Sekolah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="s in students" :key="s.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4 font-mono font-bold text-purple-700">{{ s.nis }}</td>
                            <td class="px-6 py-4 font-extrabold text-slate-900">{{ s.name }}</td>
                            <td class="px-6 py-4 font-bold text-slate-700">{{ s.classroom?.name ?? '—' }}</td>
                            <td class="px-6 py-4 text-purple-700 font-semibold">{{ s.grade_level }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ s.school_origin ?? '—' }}</td>
                        </tr>

                        <tr v-if="students.length === 0">
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                Belum ada siswa di kelas yang Anda ampu.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>
