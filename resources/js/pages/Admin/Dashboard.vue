<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

defineProps<{
    stats: {
        totalStudents: number;
        totalTutors: number;
        totalClassrooms: number;
        unpaidInvoices: number;
        pendingTutorApplications: number;
        reviewingTutorApplications: number;
        acceptedTutorApplications: number;
    };
    recentPayments: Array<{
        id: number;
        payment_number: string;
        amount: number;
        payment_date: string;
        payment_method: string;
        student?: { name: string };
    }>;
    todaySchedules: Array<{
        id: number;
        day: string;
        start_time: string;
        end_time: string;
        room: string;
        topic?: string;
        classroom?: { name: string };
        tutor?: { name: string };
    }>;
    recentApplications: Array<{
        id: number;
        name: string;
        email: string;
        subject_specialization: string;
        status: string;
        created_at: string;
    }>;
}>();

function formatRupiah(amount: number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(amount);
}
</script>

<template>
    <Head title="Dashboard Admin | BimbelPro" />

    <div class="space-y-8">

        <!-- WELCOME BANNER -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#3B0764] via-[#581C87] to-[#7C3AED] p-7 text-white shadow-xl sm:p-9">
            <div class="relative z-10">
                <span class="rounded-full bg-purple-400/30 px-3.5 py-1 text-[10px] font-bold tracking-[2px] text-purple-200 uppercase">
                    PUSAT KENDALI ADMINISTRATOR
                </span>

                <h1 class="mt-3 text-2xl font-extrabold sm:text-3xl">
                    Selamat Datang, {{ $page.props.auth?.user?.name ?? 'Admin BimbelPro' }}!
                </h1>

                <p class="mt-2 max-w-xl text-xs sm:text-sm text-purple-100/80 leading-relaxed">
                    Sistem BimbelPro siap memonitor perkembangan siswa, jadwal pengajar, presensi kehadiran, tagihan SPP, dan seleksi tutor hari ini.
                </p>
            </div>
        </section>

        <!-- MAIN STATS CARDS -->
        <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <!-- TOTAL SISWA -->
            <div class="rounded-2xl border border-purple-100/80 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:shadow-purple-500/10">
                <div class="flex items-center justify-between">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-purple-700 text-lg font-bold">
                        ♙
                    </div>
                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Aktif</span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500">Total Siswa Terdaftar</p>
                <h3 class="mt-1 text-3xl font-extrabold text-slate-900">{{ stats.totalStudents }}</h3>
                <Link href="/admin/siswa" class="mt-3 inline-block text-[11px] font-bold text-purple-600 hover:text-purple-800">
                    Lihat Data Siswa →
                </Link>
            </div>

            <!-- TOTAL TUTOR -->
            <div class="rounded-2xl border border-purple-100/80 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:shadow-purple-500/10">
                <div class="flex items-center justify-between">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 text-lg font-bold">
                        ♧
                    </div>
                    <span class="text-[10px] font-bold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full">Pengajar</span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500">Tutor Aktif Mengajar</p>
                <h3 class="mt-1 text-3xl font-extrabold text-slate-900">{{ stats.totalTutors }}</h3>
                <Link href="/admin/tutor" class="mt-3 inline-block text-[11px] font-bold text-purple-600 hover:text-purple-800">
                    Kelola Tutor →
                </Link>
            </div>

            <!-- KELAS AKTIF -->
            <div class="rounded-2xl border border-purple-100/80 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:shadow-purple-500/10">
                <div class="flex items-center justify-between">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-fuchsia-100 text-fuchsia-700 text-lg font-bold">
                        ▤
                    </div>
                    <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">Reguler/UTBK</span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500">Kelas Belajar Aktif</p>
                <h3 class="mt-1 text-3xl font-extrabold text-slate-900">{{ stats.totalClassrooms }}</h3>
                <Link href="/admin/kelas" class="mt-3 inline-block text-[11px] font-bold text-purple-600 hover:text-purple-800">
                    Atur Kelas & Ruang →
                </Link>
            </div>

            <!-- TAGIHAN BELUM LUNAS -->
            <div class="rounded-2xl border border-purple-100/80 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:shadow-purple-500/10">
                <div class="flex items-center justify-between">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-amber-700 text-lg font-bold">
                        Rp
                    </div>
                    <span class="text-[10px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full">Tagihan</span>
                </div>
                <p class="mt-4 text-xs font-semibold text-slate-500">Piutang SPP Belum Lunas</p>
                <h3 class="mt-1 text-xl font-extrabold text-slate-900 truncate">{{ formatRupiah(stats.unpaidInvoices) }}</h3>
                <Link href="/admin/tagihan" class="mt-3 inline-block text-[11px] font-bold text-purple-600 hover:text-purple-800">
                    Buka Riwayat Tagihan →
                </Link>
            </div>
        </section>

        <!-- SELEKSI CALON TUTOR BANNER (Highlight Fitur Pembeda) -->
        <section class="rounded-3xl border border-purple-200 bg-gradient-to-r from-purple-50 via-white to-indigo-50 p-6 shadow-sm sm:p-7">
            <div class="flex flex-col justify-between gap-5 lg:flex-row lg:items-center">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="flex h-2.5 w-2.5 rounded-full bg-purple-600"></span>
                        <p class="text-xs font-bold text-purple-800 tracking-wider uppercase">
                            STATUS SELEKSI PENERIMAAN TUTOR
                        </p>
                    </div>
                    <h2 class="mt-1 text-lg font-extrabold text-slate-900">
                        {{ stats.pendingTutorApplications }} Calon Tutor Menunggu Pemeriksaan
                    </h2>
                    <p class="mt-1 text-xs text-slate-500">
                        Ada {{ stats.reviewingTutorApplications }} sedang ditinjau/wawancara dan {{ stats.acceptedTutorApplications }} telah resmi diterima.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <Link
                        href="/admin/pendaftaran-tutor"
                        class="rounded-xl bg-purple-600 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-purple-500/20 hover:bg-purple-700 transition"
                    >
                        Tinjau Berkas Pendaftar →
                    </Link>
                </div>
            </div>
        </section>

        <!-- SCHEDULE TODAY & PAYMENTS -->
        <section class="grid gap-6 lg:grid-cols-2">

            <!-- JADWAL HARI INI -->
            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">Jadwal Belajar Hari Ini</h2>
                        <p class="text-xs text-slate-400">Sesi kelas berlangsung</p>
                    </div>
                    <Link href="/admin/jadwal" class="text-xs font-bold text-purple-600 hover:text-purple-800">
                        Semua Jadwal →
                    </Link>
                </div>

                <div v-if="todaySchedules.length > 0" class="mt-4 space-y-3">
                    <div
                        v-for="item in todaySchedules"
                        :key="item.id"
                        class="flex items-center justify-between rounded-2xl bg-purple-50/50 p-4 border border-purple-100/60"
                    >
                        <div>
                            <p class="text-xs font-extrabold text-slate-900">{{ item.classroom?.name }}</p>
                            <p class="text-[11px] text-purple-700 font-medium">Tutor: {{ item.tutor?.name }} • {{ item.room }}</p>
                        </div>
                        <span class="rounded-xl bg-white px-3 py-1.5 text-xs font-extrabold text-slate-800 shadow-sm border border-purple-100">
                            {{ item.start_time }} - {{ item.end_time }}
                        </span>
                    </div>
                </div>

                <div v-else class="mt-6 py-8 text-center text-xs text-slate-400">
                    Tidak ada jadwal kelas untuk hari ini.
                </div>
            </div>

            <!-- PEMBAYARAN TERBARU -->
            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900">Pembayaran SPP Masuk</h2>
                        <p class="text-xs text-slate-400">Transaksi siswa terkini</p>
                    </div>
                    <Link href="/admin/pembayaran" class="text-xs font-bold text-purple-600 hover:text-purple-800">
                        Riwayat →
                    </Link>
                </div>

                <div v-if="recentPayments.length > 0" class="mt-4 space-y-3">
                    <div
                        v-for="pay in recentPayments"
                        :key="pay.id"
                        class="flex items-center justify-between rounded-2xl bg-slate-50/80 p-3.5 border border-slate-100"
                    >
                        <div>
                            <p class="text-xs font-bold text-slate-900">{{ pay.student?.name }}</p>
                            <p class="text-[10px] text-slate-400">{{ pay.payment_number }} • {{ pay.payment_date }}</p>
                        </div>
                        <span class="text-xs font-extrabold text-emerald-600">
                            +{{ formatRupiah(pay.amount) }}
                        </span>
                    </div>
                </div>

                <div v-else class="mt-6 py-8 text-center text-xs text-slate-400">
                    Belum ada catatan pembayaran terbaru.
                </div>
            </div>

        </section>

    </div>
</template>
