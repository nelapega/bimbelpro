
<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

const statistics = [
    {
        title: 'Total Siswa',
        value: '—',
        description: 'Jumlah seluruh siswa',
        icon: '♙',
        color: 'bg-blue-50 text-blue-600',
    },
    {
        title: 'Total Tutor',
        value: '—',
        description: 'Pengajar terdaftar',
        icon: '♧',
        color: 'bg-indigo-50 text-indigo-600',
    },
    {
        title: 'Kelas Aktif',
        value: '—',
        description: 'Kelas berjalan',
        icon: '▤',
        color: 'bg-emerald-50 text-emerald-600',
    },
    {
        title: 'Tagihan Belum Lunas',
        value: '—',
        description: 'Tagihan menunggu pembayaran',
        icon: 'Rp',
        color: 'bg-amber-50 text-amber-600',
    },
];

const quickActions = [
    {
        title: 'Tambah Siswa',
        description: 'Daftarkan siswa baru',
        icon: '♙',
        color: 'bg-blue-50 text-blue-600',
    },
    {
        title: 'Tambah Tutor',
        description: 'Tambahkan pengajar',
        icon: '♧',
        color: 'bg-indigo-50 text-indigo-600',
    },
    {
        title: 'Buat Kelas',
        description: 'Kelola kelas belajar',
        icon: '▤',
        color: 'bg-emerald-50 text-emerald-600',
    },
    {
        title: 'Atur Jadwal',
        description: 'Susun jadwal belajar',
        icon: '◷',
        color: 'bg-amber-50 text-amber-600',
    },
];
</script>

<template>
    <Head title="Dashboard Admin | BimbelPro" />

    <div class="space-y-7">

        <!-- PAGE TITLE -->
        <section class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <div class="mb-2 flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <p class="text-[10px] font-bold tracking-[1.5px] text-emerald-600">
                        ADMINISTRATOR PANEL
                    </p>
                </div>

                <h1 class="text-2xl font-extrabold tracking-tight text-[#142B55] sm:text-3xl">
                    Dashboard
                </h1>

                <p class="mt-2 text-xs leading-6 text-slate-500 sm:text-sm">
                    Selamat datang di BimbelPro. Pantau aktivitas bimbingan belajar Anda di sini.
                </p>
            </div>

            <div class="flex items-center gap-2 self-start rounded-xl border border-slate-200 bg-white px-4 py-3 sm:self-auto">
                <span class="text-lg text-blue-600">◷</span>
                <div>
                    <p class="text-[10px] font-bold text-slate-700">
                        Ringkasan Sistem
                    </p>
                    <p class="text-[9px] text-slate-400">
                        Data terbaru
                    </p>
                </div>
            </div>
        </section>

        <!-- STATISTICS -->
        <section>
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-sm font-extrabold text-[#172554]">
                    Ringkasan Aktivitas
                </h2>

                <span class="text-[10px] font-medium text-slate-400">
                    Statistik sistem
                </span>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div
                    v-for="item in statistics"
                    :key="item.title"
                    class="group rounded-2xl border border-slate-100 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-100/50"
                >
                    <div class="flex items-center justify-between">
                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl text-lg font-bold"
                            :class="item.color"
                        >
                            {{ item.icon }}
                        </div>

                        <span class="text-[9px] font-semibold text-slate-300">
                            BIMBELPRO
                        </span>
                    </div>

                    <p class="mt-5 text-xs font-semibold text-slate-500">
                        {{ item.title }}
                    </p>

                    <h3 class="mt-1 text-3xl font-extrabold tracking-tight text-[#142B55]">
                        {{ item.value }}
                    </h3>

                    <p class="mt-2 text-[10px] text-slate-400">
                        {{ item.description }}
                    </p>
                </div>
            </div>
        </section>

        <!-- QUICK ACTIONS -->
        <section>
            <div class="mb-4">
                <h2 class="text-sm font-extrabold text-[#172554]">
                    Akses Cepat
                </h2>
                <p class="mt-1 text-[10px] text-slate-400">
                    Pintasan untuk aktivitas administrasi.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
                <div
                    v-for="action in quickActions"
                    :key="action.title"
                    class="flex items-center gap-3 rounded-xl border border-slate-100 bg-white p-4 shadow-sm transition hover:border-blue-200 hover:shadow-md"
                >
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-lg font-bold"
                        :class="action.color"
                    >
                        {{ action.icon }}
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-xs font-bold text-[#172554]">
                            {{ action.title }}
                        </p>
                        <p class="mt-1 text-[9px] text-slate-400">
                            {{ action.description }}
                        </p>
                    </div>
                </div>
            </div>

            <p class="mt-3 text-[10px] text-slate-400">
                Pintasan ini merupakan rancangan tampilan. Fungsinya akan kita hubungkan saat modul masing-masing selesai dibuat.
            </p>
        </section>

        <!-- CHART AND SCHEDULE -->
        <section class="grid gap-5 xl:grid-cols-3">

            <!-- PAYMENT CHART -->
            <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm xl:col-span-2">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-sm font-extrabold text-[#172554]">
                            Statistik Pembayaran
                        </h2>
                        <p class="mt-1 text-[10px] text-slate-400">
                            Ringkasan pemasukan bimbingan belajar.
                        </p>
                    </div>

                    <span class="rounded-lg bg-blue-50 px-3 py-2 text-[10px] font-bold text-blue-600">
                        Per Bulan
                    </span>
                </div>

                <div class="mt-7 flex h-[220px] flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/70 px-4 text-center">
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-xl text-blue-600">
                        ↗
                    </div>

                    <p class="text-xs font-bold text-slate-600">
                        Belum Ada Data Pembayaran
                    </p>

                    <p class="mt-2 max-w-xs text-[10px] leading-5 text-slate-400">
                        Grafik pemasukan akan ditampilkan setelah data tagihan dan transaksi pembayaran tersedia.
                    </p>
                </div>
            </div>

            <!-- TODAY SCHEDULE -->
            <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                <div>
                    <h2 class="text-sm font-extrabold text-[#172554]">
                        Jadwal Hari Ini
                    </h2>
                    <p class="mt-1 text-[10px] text-slate-400">
                        Aktivitas pembelajaran.
                    </p>
                </div>

                <div class="mt-6 flex min-h-[190px] flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/70 px-4 text-center">
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-600">
                        ◷
                    </div>

                    <p class="text-xs font-bold text-slate-600">
                        Belum Ada Jadwal
                    </p>

                    <p class="mt-2 text-[10px] leading-5 text-slate-400">
                        Jadwal belajar yang tersimpan akan muncul di sini.
                    </p>
                </div>
            </div>
        </section>

        <!-- BOTTOM SECTION -->
        <section class="grid gap-5 lg:grid-cols-2">

            <!-- RECENT ACTIVITIES -->
            <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                <div class="mb-5 flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-extrabold text-[#172554]">
                            Aktivitas Terbaru
                        </h2>
                        <p class="mt-1 text-[10px] text-slate-400">
                            Riwayat aktivitas sistem.
                        </p>
                    </div>
                </div>

                <div class="flex min-h-[115px] flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/70 px-4 text-center">
                    <p class="text-xs font-semibold text-slate-500">
                        Belum Ada Aktivitas
                    </p>
                    <p class="mt-2 text-[10px] text-slate-400">
                        Aktivitas terbaru akan ditampilkan di sini.
                    </p>
                </div>
            </div>

            <!-- UNPAID INVOICES -->
            <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                <div class="mb-5">
                    <h2 class="text-sm font-extrabold text-[#172554]">
                        Pengingat Tagihan
                    </h2>
                    <p class="mt-1 text-[10px] text-slate-400">
                        Daftar pembayaran yang belum lunas.
                    </p>
                </div>

                <div class="flex min-h-[115px] flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50/70 px-4 text-center">
                    <p class="text-xs font-semibold text-slate-500">
                        Belum Ada Tagihan
                    </p>
                    <p class="mt-2 text-[10px] text-slate-400">
                        Tagihan siswa akan muncul setelah dibuat oleh Admin.
                    </p>
                </div>
            </div>
        </section>

        <!-- FOOTER NOTE -->
        <div class="rounded-xl border border-blue-100 bg-blue-50/70 px-5 py-4">
            <div class="flex items-start gap-3">
                <span class="text-lg text-blue-600">ⓘ</span>
                <div>
                    <p class="text-xs font-bold text-blue-900">
                        Informasi Dashboard
                    </p>
                    <p class="mt-1 text-[10px] leading-5 text-blue-700">
                        Statistik akan diperbarui secara otomatis berdasarkan data yang tersimpan di database BimbelPro.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
