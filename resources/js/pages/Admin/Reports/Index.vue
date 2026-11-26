<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

defineProps<{
    metrics: {
        totalStudents: number;
        totalTutors: number;
        totalClassrooms: number;
        totalRevenue: number;
        totalReceivables: number;
        attendanceRate: number;
    };
    classroomReports: Array<{
        id: number;
        name: string;
        subject: string;
        grade_level: string;
        capacity: number;
        students_count: number;
        schedules_count: number;
        attendances_count: number;
        tutor?: { name: string };
    }>;
}>();

function formatRupiah(amount: number) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(amount);
}
</script>

<template>
    <Head title="Laporan Rekapitulasi Bimbel | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Laporan Rekapitulasi Sistem</h1>
                <p class="mt-1 text-xs text-slate-500">Ringkasan performa akademik, kapasitas kelas, absensi, dan keuangan bimbel.</p>
            </div>
        </div>

        <!-- METRICS TILES -->
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm">
                <span class="text-xs font-semibold text-slate-500">Penerimaan Biaya Belajar (Lunas)</span>
                <p class="mt-2 text-2xl font-extrabold text-emerald-600">{{ formatRupiah(metrics.totalRevenue) }}</p>
                <p class="mt-1 text-[11px] text-slate-400">Total akumulasi pembayaran terverifikasi</p>
            </div>

            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm">
                <span class="text-xs font-semibold text-slate-500">Sisa Piutang Belum Lunas</span>
                <p class="mt-2 text-2xl font-extrabold text-amber-600">{{ formatRupiah(metrics.totalReceivables) }}</p>
                <p class="mt-1 text-[11px] text-slate-400">Tagihan berjalan dalam proses pelunasan</p>
            </div>

            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm">
                <span class="text-xs font-semibold text-slate-500">Tingkat Kehadiran Siswa</span>
                <p class="mt-2 text-2xl font-extrabold text-purple-700">{{ metrics.attendanceRate }}%</p>
                <p class="mt-1 text-[11px] text-slate-400">Rasio siswa hadir dari seluruh sesi presensi</p>
            </div>
        </div>

        <!-- CLASSROOM RECAP TABLE -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="border-b border-purple-100 bg-purple-50/40 p-5">
                <h2 class="text-sm font-extrabold text-purple-950">Rekapitulasi Per Rombongan Belajar / Kelas</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/20 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Nama Kelas</th>
                            <th class="px-6 py-4">Mata Pelajaran</th>
                            <th class="px-6 py-4">Tutor Pengampu</th>
                            <th class="px-6 py-4">Siswa Terdaftar</th>
                            <th class="px-6 py-4">Jadwal Sesi</th>
                            <th class="px-6 py-4">Total Record Absensi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="cr in classroomReports" :key="cr.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4 font-extrabold text-slate-900">{{ cr.name }}</td>
                            <td class="px-6 py-4 font-bold text-purple-700">{{ cr.subject }} ({{ cr.grade_level }})</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ cr.tutor?.name ?? '—' }}</td>
                            <td class="px-6 py-4 font-bold text-slate-900">{{ cr.students_count }} / {{ cr.capacity }}</td>
                            <td class="px-6 py-4 text-slate-700">{{ cr.schedules_count }} Sesi / Minggu</td>
                            <td class="px-6 py-4 text-emerald-600 font-bold">{{ cr.attendances_count }} Tercatat</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>
