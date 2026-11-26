<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

const props = defineProps<{
    attendances: Array<{
        id: number;
        date: string;
        status: string;
        notes?: string | null;
        student: { id: number; name: string; nis: string };
        classroom: { id: number; name: string };
        tutor: { id: number; name: string };
    }>;
    classrooms: Array<{ id: number; name: string }>;
    selectedClassroomId?: string | null;
    selectedDate: string;
    summary: {
        hadir: number;
        izin: number;
        sakit: number;
        alpa: number;
    };
}>();

const classroomId = ref(props.selectedClassroomId || '');
const date = ref(props.selectedDate);

function filterAttendance() {
    router.get('/admin/absensi', {
        classroom_id: classroomId.value || undefined,
        date: date.value,
    }, { preserveState: true });
}

function getStatusBadge(status: string) {
    switch (status) {
        case 'hadir':
            return 'bg-emerald-100 text-emerald-800 border-emerald-200';
        case 'izin':
            return 'bg-blue-100 text-blue-800 border-blue-200';
        case 'sakit':
            return 'bg-amber-100 text-amber-800 border-amber-200';
        case 'alpa':
            return 'bg-rose-100 text-rose-800 border-rose-200';
        default:
            return 'bg-slate-100 text-slate-800 border-slate-200';
    }
}
</script>

<template>
    <Head title="Rekap Absensi Siswa | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Rekapitulasi Absensi Siswa</h1>
                <p class="mt-1 text-xs text-slate-500">Pantau kehadiran siswa di setiap kelas dan pertemuan belajar.</p>
            </div>
        </div>

        <!-- FILTER -->
        <div class="flex flex-col gap-3 rounded-2xl border border-purple-100 bg-white p-4 shadow-sm sm:flex-row sm:items-center">
            <select
                v-model="classroomId"
                @change="filterAttendance"
                class="h-10 rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs font-medium focus:outline-none"
            >
                <option value="">Semua Kelas</option>
                <option v-for="c in classrooms" :key="c.id" :value="c.id">{{ c.name }}</option>
            </select>

            <input
                v-model="date"
                @change="filterAttendance"
                type="date"
                class="h-10 rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs font-medium focus:outline-none"
            />

            <button
                @click="filterAttendance"
                class="h-10 rounded-xl bg-purple-600 px-4 text-xs font-bold text-white hover:bg-purple-700"
            >
                Tampilkan Rekap
            </button>
        </div>

        <!-- STATS BADGES -->
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
            <div class="rounded-2xl border border-emerald-100 bg-emerald-50/60 p-4 text-center">
                <span class="text-xs font-bold text-emerald-700">Hadir</span>
                <p class="mt-1 text-2xl font-extrabold text-emerald-900">{{ summary.hadir }}</p>
            </div>
            <div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4 text-center">
                <span class="text-xs font-bold text-blue-700">Izin</span>
                <p class="mt-1 text-2xl font-extrabold text-blue-900">{{ summary.izin }}</p>
            </div>
            <div class="rounded-2xl border border-amber-100 bg-amber-50/60 p-4 text-center">
                <span class="text-xs font-bold text-amber-700">Sakit</span>
                <p class="mt-1 text-2xl font-extrabold text-amber-900">{{ summary.sakit }}</p>
            </div>
            <div class="rounded-2xl border border-rose-100 bg-rose-50/60 p-4 text-center">
                <span class="text-xs font-bold text-rose-700">Alpa / Tanpa Keterangan</span>
                <p class="mt-1 text-2xl font-extrabold text-rose-900">{{ summary.alpa }}</p>
            </div>
        </div>

        <!-- ATTENDANCE TABLE -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Nama Siswa & NIS</th>
                            <th class="px-6 py-4">Kelas</th>
                            <th class="px-6 py-4">Tutor Pengajar</th>
                            <th class="px-6 py-4">Status Kehadiran</th>
                            <th class="px-6 py-4">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="a in attendances" :key="a.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ a.date }}</td>
                            <td class="px-6 py-4">
                                <p class="font-extrabold text-slate-900">{{ a.student.name }}</p>
                                <p class="text-[10px] text-purple-600 font-mono">{{ a.student.nis }}</p>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-700">{{ a.classroom.name }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ a.tutor.name }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full border px-3 py-1 text-[10px] font-extrabold uppercase" :class="getStatusBadge(a.status)">
                                    {{ a.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ a.notes ?? '—' }}</td>
                        </tr>

                        <tr v-if="attendances.length === 0">
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                Tidak ada data absensi untuk filter tanggal / kelas ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>
