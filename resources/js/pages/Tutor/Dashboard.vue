<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import TutorLayout from '@/layouts/TutorLayout.vue';

defineOptions({
    layout: TutorLayout,
});

const statistics = [
    {
        title: 'Kelas Saya',
        value: '—',
        description: 'Kelas yang diampu',
        icon: '▤',
        color: 'bg-blue-50 text-blue-600',
    },
    {
        title: 'Total Siswa',
        value: '—',
        description: 'Siswa dalam kelas saya',
        icon: '♙',
        color: 'bg-indigo-50 text-indigo-600',
    },
    {
        title: 'Jadwal Hari Ini',
        value: '—',
        description: 'Sesi pembelajaran',
        icon: '◷',
        color: 'bg-emerald-50 text-emerald-600',
    },
    {
        title: 'Absensi',
        value: '—',
        description: 'Menunggu pencatatan',
        icon: '✓',
        color: 'bg-amber-50 text-amber-600',
    },
];
</script>

<template>
    <Head title="Dashboard Tutor | BimbelPro" />

    <div class="space-y-7">

        <section class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#142B55] to-blue-700 p-6 text-white shadow-lg sm:p-8">
            <div class="relative z-10">
                <span class="text-[10px] font-bold tracking-[2px] text-blue-200">
                    TUTOR DASHBOARD
                </span>

                <h1 class="mt-3 text-2xl font-extrabold sm:text-3xl">
                    Selamat Datang,
                    {{ $page.props.auth?.user?.name ?? 'Tutor' }}!
                </h1>

                <p class="mt-3 max-w-xl text-sm leading-7 text-blue-100/80">
                    Semangat mengajar hari ini! Pantau jadwal dan aktivitas
                    kelas Anda melalui BimbelPro.
                </p>
            </div>
        </section>

        <section>
            <h2 class="mb-4 text-sm font-extrabold text-[#172554]">
                Ringkasan Aktivitas
            </h2>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div
                    v-for="item in statistics"
                    :key="item.title"
                    class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg"
                >
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl text-lg font-bold"
                        :class="item.color"
                    >
                        {{ item.icon }}
                    </div>

                    <p class="mt-5 text-xs font-semibold text-slate-500">
                        {{ item.title }}
                    </p>

                    <h3 class="mt-1 text-3xl font-extrabold text-[#142B55]">
                        {{ item.value }}
                    </h3>

                    <p class="mt-2 text-[10px] text-slate-400">
                        {{ item.description }}
                    </p>
                </div>
            </div>
        </section>

        <section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
            <h2 class="text-sm font-extrabold text-[#172554]">
                Jadwal Mengajar Hari Ini
            </h2>

            <p class="mt-1 text-[10px] text-slate-400">
                Agenda pembelajaran Anda.
            </p>

            <div class="mt-6 flex min-h-[160px] flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50">
                <span class="mb-3 text-3xl text-blue-600">◷</span>

                <p class="text-xs font-bold text-slate-600">
                    Belum Ada Jadwal Mengajar
                </p>

                <p class="mt-2 text-center text-[10px] text-slate-400">
                    Jadwal kelas yang ditugaskan Admin akan muncul di sini.
                </p>
            </div>
        </section>

        <section class="grid gap-5 lg:grid-cols-2">
            <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                <h2 class="text-sm font-extrabold text-[#172554]">
                    Kelas Saya
                </h2>

                <div class="mt-5 flex min-h-[130px] flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50">
                    <p class="text-xs font-bold text-slate-600">
                        Belum Ada Kelas
                    </p>

                    <p class="mt-2 text-[10px] text-slate-400">
                        Admin belum menugaskan kelas kepada Anda.
                    </p>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                <h2 class="text-sm font-extrabold text-[#172554]">
                    Pencatatan Absensi
                </h2>

                <div class="mt-5 flex min-h-[130px] flex-col items-center justify-center rounded-xl border border-dashed border-slate-200 bg-slate-50">
                    <p class="text-xs font-bold text-slate-600">
                        Belum Ada Absensi
                    </p>

                    <p class="mt-2 text-center text-[10px] text-slate-400">
                        Data absensi akan muncul berdasarkan sesi pembelajaran.
                    </p>
                </div>
            </div>
        </section>

        <section class="rounded-xl border border-indigo-100 bg-indigo-50/70 p-5">
            <h3 class="text-xs font-bold text-indigo-900">
                Informasi Tutor
            </h3>

            <p class="mt-2 text-[10px] leading-6 text-indigo-700">
                Anda hanya dapat mengakses kelas, jadwal, siswa, dan absensi
                yang menjadi tanggung jawab Anda. Informasi keuangan
                dikelola oleh Admin.
            </p>
        </section>

    </div>
</template>
