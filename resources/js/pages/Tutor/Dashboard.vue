
<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard Tutor - BimbelPro" />

    <div class="min-h-screen bg-slate-50 p-8">
        <div class="mx-auto max-w-7xl">

            <p class="text-sm font-bold tracking-widest text-blue-700">
                BIMBELPRO
            </p>

            <h1 class="mt-3 text-3xl font-bold text-slate-800">
                Dashboard Tutor
            </h1>

            <p class="mt-2 text-slate-500">
                Selamat datang di panel pengajar BimbelPro.
            </p>

            <div class="mt-8 rounded-xl border bg-white p-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    Aktivitas Mengajar
                </h2>

                <p class="mt-2 text-sm text-slate-500">
                    Jadwal mengajar, kelas yang ditangani,
                    daftar siswa, dan absensi akan ditampilkan di sini.
                </p>
            </div>

        </div>
    </div>
</template>
