
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login } from '@/routes';
</script>

<template>
    <Head title="BimbelPro - Sistem Manajemen Bimbingan Belajar">
        <meta
            name="description"
            content="BimbelPro membantu pengelola bimbingan belajar mengelola siswa, tutor, kelas, jadwal, absensi, dan pembayaran dalam satu sistem."
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link
            rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin="anonymous"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
    </Head>

    <div
        class="min-h-screen scroll-smooth bg-[#F7F9FD] font-['Plus_Jakarta_Sans'] text-[#172554]"
    >
        <!-- NAVBAR -->
        <header
            class="sticky top-0 z-50 border-b border-slate-100 bg-white/90 backdrop-blur-xl"
        >
            <div
                class="mx-auto flex h-[76px] max-w-7xl items-center justify-between px-5 lg:px-8"
            >
                <!-- LOGO -->
                <a href="#beranda" class="flex items-center gap-2.5">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-lg shadow-blue-200"
                    >
                        <svg
                            class="h-6 w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="m2 10 10-6 10 6-10 6-10-6Z" />
                            <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5" />
                            <path d="M22 10v6" />
                        </svg>
                    </div>

                    <div class="leading-tight">
                        <span class="text-xl font-extrabold tracking-tight text-[#172554]">
                            Bimbel<span class="text-blue-600">Pro</span>
                        </span>
                        <span class="block text-[9px] font-semibold tracking-[2px] text-slate-400">
                            LEARNING MANAGEMENT
                        </span>
                    </div>
                </a>

                <!-- NAVIGATION -->
                <nav
                    class="hidden items-center gap-9 text-[13px] font-semibold text-slate-500 md:flex"
                >
                    <a
                        href="#beranda"
                        class="transition hover:text-blue-600"
                    >
                        Beranda
                    </a>
                    <a
                        href="#fitur"
                        class="transition hover:text-blue-600"
                    >
                        Fitur
                    </a>
                    <a
                        href="#cara-kerja"
                        class="transition hover:text-blue-600"
                    >
                        Cara Kerja
                    </a>
                    <a
                        href="#tentang"
                        class="transition hover:text-blue-600"
                    >
                        Tentang Sistem
                    </a>
                </nav>

                <!-- LOGIN BUTTON -->
                <div>
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-xs font-bold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-blue-700"
                    >
                        Dashboard
                        <span>→</span>
                    </Link>

                    <Link
                        v-else
                        :href="login()"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-xs font-bold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-blue-700"
                    >
                        Masuk
                        <span>→</span>
                    </Link>
                </div>
            </div>
        </header>

        <main>
            <!-- HERO SECTION -->
            <section
                id="beranda"
                class="relative overflow-hidden bg-gradient-to-br from-[#F0F5FF] via-white to-[#F5F8FF]"
            >
                <div
                    class="absolute -right-40 -top-40 h-[500px] w-[500px] rounded-full bg-blue-200/20 blur-3xl"
                ></div>
                <div
                    class="absolute -bottom-48 -left-32 h-[400px] w-[400px] rounded-full bg-indigo-200/20 blur-3xl"
                ></div>

                <div
                    class="relative mx-auto grid max-w-7xl items-center gap-14 px-5 py-20 lg:grid-cols-2 lg:gap-12 lg:px-8 lg:py-28"
                >
                    <!-- HERO TEXT -->
                    <div class="relative z-10">
                        <div
                            class="mb-7 inline-flex items-center gap-2 rounded-full border border-blue-100 bg-white px-4 py-2 text-[11px] font-bold tracking-wide text-blue-700 shadow-sm"
                        >
                            <span
                                class="h-2 w-2 rounded-full bg-blue-500"
                            ></span>
                            SISTEM MANAJEMEN BIMBINGAN BELAJAR
                        </div>

                        <h1
                            class="max-w-xl text-4xl leading-[1.2] font-extrabold tracking-tight text-[#14264B] sm:text-5xl lg:text-[57px]"
                        >
                            Kelola Bimbingan Belajar
                            <span
                                class="bg-gradient-to-r from-blue-600 to-indigo-500 bg-clip-text text-transparent"
                            >
                                Lebih Mudah.
                            </span>
                        </h1>

                        <p
                            class="mt-6 max-w-lg text-sm leading-7 text-slate-500 sm:text-base"
                        >
                            Satu sistem untuk mengelola seluruh aktivitas
                            bimbingan belajar. Mulai dari data siswa, tutor,
                            kelas, jadwal, absensi, hingga pembayaran dan
                            laporan.
                        </p>

                        <div class="mt-9 flex flex-wrap items-center gap-4">
                            <Link
                                :href="login()"
                                v-if="!$page.props.auth.user"
                                class="inline-flex items-center gap-3 rounded-xl bg-blue-600 px-7 py-3.5 text-sm font-bold text-white shadow-xl shadow-blue-200 transition hover:-translate-y-1 hover:bg-blue-700"
                            >
                                Masuk ke Sistem
                                <span class="text-lg">→</span>
                            </Link>

                            <Link
                                :href="dashboard()"
                                v-else
                                class="inline-flex items-center gap-3 rounded-xl bg-blue-600 px-7 py-3.5 text-sm font-bold text-white shadow-xl shadow-blue-200 transition hover:-translate-y-1 hover:bg-blue-700"
                            >
                                Buka Dashboard
                                <span class="text-lg">→</span>
                            </Link>

                            <a
                                href="#fitur"
                                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-sm font-bold text-slate-600 transition hover:border-blue-300 hover:text-blue-600"
                            >
                                Pelajari Fitur
                            </a>
                        </div>

                        <div
                            class="mt-10 flex flex-wrap items-center gap-x-7 gap-y-3 text-xs font-semibold text-slate-500"
                        >
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-100 text-blue-600"
                                >
                                    ✓
                                </span>
                                Data terpusat
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-100 text-blue-600"
                                >
                                    ✓
                                </span>
                                Hak akses pengguna
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="flex h-5 w-5 items-center justify-center rounded-full bg-blue-100 text-blue-600"
                                >
                                    ✓
                                </span>
                                Mudah digunakan
                            </div>
                        </div>
                    </div>

                    <!-- DASHBOARD PREVIEW -->
                    <div class="relative mx-auto w-full max-w-[570px]">
                        <div
                            class="absolute -right-7 -top-7 h-32 w-32 rounded-full bg-blue-300/20 blur-2xl"
                        ></div>
                        <div
                            class="absolute -bottom-8 -left-8 h-40 w-40 rounded-full bg-indigo-300/20 blur-2xl"
                        ></div>

                        <div
                            class="relative overflow-hidden rounded-[24px] border border-slate-200/80 bg-white p-3 shadow-[0_25px_80px_-25px_rgba(37,99,235,0.25)] sm:p-5"
                        >
                            <!-- PREVIEW TOP BAR -->
                            <div
                                class="mb-4 flex items-center justify-between border-b border-slate-100 pb-4"
                            >
                                <div class="flex items-center gap-2">
                                    <span
                                        class="h-2.5 w-2.5 rounded-full bg-red-400"
                                    ></span>
                                    <span
                                        class="h-2.5 w-2.5 rounded-full bg-amber-400"
                                    ></span>
                                    <span
                                        class="h-2.5 w-2.5 rounded-full bg-green-400"
                                    ></span>
                                </div>
                                <div
                                    class="rounded-md bg-slate-50 px-4 py-1.5 text-[9px] font-medium text-slate-400"
                                >
                                    BimbelPro Management
                                </div>
                                <span
                                    class="text-xs font-bold text-blue-600"
                                >
                                    ●
                                </span>
                            </div>

                            <div class="flex gap-3">
                                <!-- PREVIEW SIDEBAR -->
                                <div
                                    class="hidden w-[120px] shrink-0 rounded-xl bg-[#142B55] p-3 sm:block"
                                >
                                    <div
                                        class="mb-7 flex items-center gap-1.5 text-white"
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                d="m2 10 10-6 10 6-10 6-10-6Z"
                                            />
                                            <path
                                                d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5"
                                            />
                                        </svg>
                                        <span class="text-[10px] font-bold">
                                            BimbelPro
                                        </span>
                                    </div>

                                    <div
                                        class="space-y-3 text-[9px] font-medium text-blue-100"
                                    >
                                        <div
                                            class="rounded-md bg-blue-500 px-2 py-2 text-white"
                                        >
                                            ▦ Dashboard
                                        </div>
                                        <div>♙ Data Siswa</div>
                                        <div>♧ Data Tutor</div>
                                        <div>▤ Kelas</div>
                                        <div>▦ Jadwal</div>
                                        <div>☷ Absensi</div>
                                        <div>▣ Pembayaran</div>
                                    </div>
                                </div>

                                <!-- PREVIEW CONTENT -->
                                <div class="min-w-0 flex-1">
                                    <div
                                        class="mb-4 flex items-center justify-between"
                                    >
                                        <div>
                                            <p
                                                class="text-[12px] font-extrabold text-slate-800 sm:text-sm"
                                            >
                                                Ringkasan Aktivitas
                                            </p>
                                            <p
                                                class="mt-1 text-[9px] text-slate-400"
                                            >
                                                Selamat datang di BimbelPro
                                            </p>
                                        </div>
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 text-xs text-blue-600"
                                        >
                                            ♙
                                        </div>
                                    </div>

                                    <!-- MINI STATISTICS -->
                                    <div class="grid grid-cols-2 gap-2">
                                        <div
                                            class="rounded-xl border border-blue-100 bg-blue-50/70 p-3"
                                        >
                                            <p
                                                class="text-[9px] font-semibold text-slate-500"
                                            >
                                                Total Siswa
                                            </p>
                                            <p
                                                class="mt-2 text-xl font-extrabold text-blue-700"
                                            >
                                                —
                                            </p>
                                            <p
                                                class="mt-1 text-[8px] text-slate-400"
                                            >
                                                Data siswa terdaftar
                                            </p>
                                        </div>
                                        <div
                                            class="rounded-xl border border-indigo-100 bg-indigo-50/70 p-3"
                                        >
                                            <p
                                                class="text-[9px] font-semibold text-slate-500"
                                            >
                                                Total Tutor
                                            </p>
                                            <p
                                                class="mt-2 text-xl font-extrabold text-indigo-700"
                                            >
                                                —
                                            </p>
                                            <p
                                                class="mt-1 text-[8px] text-slate-400"
                                            >
                                                Pengajar terdaftar
                                            </p>
                                        </div>
                                        <div
                                            class="rounded-xl border border-emerald-100 bg-emerald-50/70 p-3"
                                        >
                                            <p
                                                class="text-[9px] font-semibold text-slate-500"
                                            >
                                                Kelas Aktif
                                            </p>
                                            <p
                                                class="mt-2 text-xl font-extrabold text-emerald-700"
                                            >
                                                —
                                            </p>
                                            <p
                                                class="mt-1 text-[8px] text-slate-400"
                                            >
                                                Kelas pembelajaran
                                            </p>
                                        </div>
                                        <div
                                            class="rounded-xl border border-amber-100 bg-amber-50/70 p-3"
                                        >
                                            <p
                                                class="text-[9px] font-semibold text-slate-500"
                                            >
                                                Tagihan
                                            </p>
                                            <p
                                                class="mt-2 text-xl font-extrabold text-amber-700"
                                            >
                                                —
                                            </p>
                                            <p
                                                class="mt-1 text-[8px] text-slate-400"
                                            >
                                                Ringkasan pembayaran
                                            </p>
                                        </div>
                                    </div>

                                    <!-- MINI SCHEDULE -->
                                    <div
                                        class="mt-3 rounded-xl border border-slate-100 p-3"
                                    >
                                        <div
                                            class="mb-3 flex items-center justify-between"
                                        >
                                            <p
                                                class="text-[10px] font-extrabold text-slate-700"
                                            >
                                                Jadwal Pembelajaran
                                            </p>
                                            <span
                                                class="text-[8px] font-bold text-blue-600"
                                            >
                                                Lihat Jadwal →
                                            </span>
                                        </div>

                                        <div class="space-y-3">
                                            <div
                                                class="flex items-center gap-2"
                                            >
                                                <div
                                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-xs text-blue-700"
                                                >
                                                    M
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p
                                                        class="text-[9px] font-bold text-slate-700"
                                                    >
                                                        Matematika
                                                    </p>
                                                    <p
                                                        class="text-[8px] text-slate-400"
                                                    >
                                                        Jadwal kelas
                                                    </p>
                                                </div>
                                                <span
                                                    class="rounded-full bg-blue-50 px-2 py-1 text-[8px] font-bold text-blue-600"
                                                >
                                                    Terjadwal
                                                </span>
                                            </div>
                                            <div
                                                class="flex items-center gap-2"
                                            >
                                                <div
                                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100 text-xs text-purple-700"
                                                >
                                                    B
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p
                                                        class="text-[9px] font-bold text-slate-700"
                                                    >
                                                        Bahasa Inggris
                                                    </p>
                                                    <p
                                                        class="text-[8px] text-slate-400"
                                                    >
                                                        Jadwal kelas
                                                    </p>
                                                </div>
                                                <span
                                                    class="rounded-full bg-purple-50 px-2 py-1 text-[8px] font-bold text-purple-600"
                                                >
                                                    Terjadwal
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="absolute -bottom-5 -left-4 hidden rounded-xl border border-slate-100 bg-white px-4 py-3 shadow-xl sm:block"
                        >
                            <div class="flex items-center gap-2">
                                <div
                                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 text-lg text-blue-600"
                                >
                                    ✓
                                </div>
                                <div>
                                    <p
                                        class="text-[10px] font-extrabold text-slate-800"
                                    >
                                        Data Terintegrasi
                                    </p>
                                    <p class="text-[9px] text-slate-400">
                                        Dalam satu sistem
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p
                        class="relative mt-9 text-center text-[10px] text-slate-400 lg:hidden"
                    >
                        Ilustrasi tampilan aplikasi BimbelPro
                    </p>
                </div>
            </section>

            <!-- FEATURE SECTION -->
            <section id="fitur" class="bg-white py-24">
                <div class="mx-auto max-w-7xl px-5 lg:px-8">
                    <div class="mx-auto mb-14 max-w-2xl text-center">
                        <span
                            class="text-[11px] font-extrabold tracking-[3px] text-blue-600"
                        >
                            FITUR UNGGULAN
                        </span>
                        <h2
                            class="mt-4 text-3xl font-extrabold tracking-tight text-[#14264B] sm:text-4xl"
                        >
                            Semua Kebutuhan Bimbel,
                            <span class="text-blue-600">Satu Sistem.</span>
                        </h2>
                        <p
                            class="mt-4 text-sm leading-7 text-slate-500"
                        >
                            Kelola kegiatan operasional bimbingan belajar
                            dengan fitur yang saling terintegrasi dan mudah
                            digunakan.
                        </p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <!-- FEATURE 1 -->
                        <div
                            class="group rounded-2xl border border-slate-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60"
                        >
                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                    <circle cx="10" cy="7" r="4" />
                                    <path d="M20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-extrabold text-[#172554]">
                                Data Siswa
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Kelola identitas, jenjang pendidikan, dan
                                status setiap siswa.
                            </p>
                        </div>

                        <!-- FEATURE 2 -->
                        <div
                            class="group rounded-2xl border border-slate-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60"
                        >
                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition group-hover:bg-indigo-600 group-hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 21a8 8 0 0 1 16 0" />
                                    <path d="m16 11 2 2 4-4" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-extrabold text-[#172554]">
                                Data Tutor
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Kelola profil pengajar, bidang keahlian, dan
                                akun tutor.
                            </p>
                        </div>

                        <!-- FEATURE 3 -->
                        <div
                            class="group rounded-2xl border border-slate-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60"
                        >
                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z" />
                                    <path d="M8 7h8M8 11h8" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-extrabold text-[#172554]">
                                Manajemen Kelas
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Atur mata pelajaran, tutor pengajar, dan
                                anggota setiap kelas.
                            </p>
                        </div>

                        <!-- FEATURE 4 -->
                        <div
                            class="group rounded-2xl border border-slate-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60"
                        >
                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition group-hover:bg-amber-500 group-hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect x="3" y="4" width="18" height="17" rx="2" />
                                    <path d="M16 2v4M8 2v4M3 10h18M8 14h2M8 17h2M14 14h2" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-extrabold text-[#172554]">
                                Jadwal Belajar
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Atur hari, waktu, ruang belajar, dan jadwal
                                mengajar tutor.
                            </p>
                        </div>

                        <!-- FEATURE 5 -->
                        <div
                            class="group rounded-2xl border border-slate-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60"
                        >
                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition group-hover:bg-purple-600 group-hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect x="5" y="3" width="14" height="18" rx="2" />
                                    <path d="M9 3v2h6V3M8 12l2 2 5-5M8 17h8" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-extrabold text-[#172554]">
                                Absensi Siswa
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Catat kehadiran siswa berdasarkan sesi
                                pembelajaran.
                            </p>
                        </div>

                        <!-- FEATURE 6 -->
                        <div
                            class="group rounded-2xl border border-slate-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60"
                        >
                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-600 transition group-hover:bg-rose-600 group-hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect x="2" y="5" width="20" height="15" rx="2" />
                                    <path d="M2 10h20M6 15h4" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-extrabold text-[#172554]">
                                Pembayaran
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Kelola tagihan, transaksi pembayaran, dan sisa
                                tagihan siswa.
                            </p>
                        </div>

                        <!-- FEATURE 7 -->
                        <div
                            class="group rounded-2xl border border-slate-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60"
                        >
                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600 transition group-hover:bg-cyan-600 group-hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M3 3v18h18" />
                                    <path d="m7 14 4-4 4 3 6-7" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-extrabold text-[#172554]">
                                Laporan
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Pantau rekap siswa, kelas, absensi, dan
                                pembayaran.
                            </p>
                        </div>

                        <!-- FEATURE 8 -->
                        <div
                            class="group rounded-2xl border border-slate-100 bg-white p-6 transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl hover:shadow-blue-100/60"
                        >
                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition group-hover:bg-slate-700 group-hover:text-white"
                            >
                                <svg
                                    class="h-6 w-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-extrabold text-[#172554]">
                                Hak Akses Pengguna
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Pisahkan wewenang Admin dan Tutor sesuai
                                tanggung jawabnya.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- HOW IT WORKS -->
            <section
                id="cara-kerja"
                class="bg-[#F3F6FC] py-24"
            >
                <div class="mx-auto max-w-7xl px-5 lg:px-8">
                    <div class="mx-auto mb-14 max-w-2xl text-center">
                        <span
                            class="text-[11px] font-extrabold tracking-[3px] text-blue-600"
                        >
                            CARA KERJA
                        </span>
                        <h2
                            class="mt-4 text-3xl font-extrabold tracking-tight text-[#14264B] sm:text-4xl"
                        >
                            Pengelolaan Lebih
                            <span class="text-blue-600">Terstruktur.</span>
                        </h2>
                        <p
                            class="mt-4 text-sm leading-7 text-slate-500"
                        >
                            Seluruh aktivitas bimbingan belajar dikelola
                            melalui alur kerja yang saling terhubung.
                        </p>
                    </div>

                    <div class="grid gap-6 md:grid-cols-3">
                        <!-- STEP 1 -->
                        <div
                            class="relative rounded-2xl border border-slate-100 bg-white p-7 shadow-sm"
                        >
                            <span
                                class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-lg font-extrabold text-white shadow-lg shadow-blue-200"
                            >
                                01
                            </span>
                            <h3 class="text-base font-extrabold text-[#172554]">
                                Admin Mengelola Data
                            </h3>
                            <p
                                class="mt-3 text-xs leading-7 text-slate-500"
                            >
                                Admin mengatur data siswa, tutor, kelas, jadwal
                                belajar, serta administrasi bimbingan belajar.
                            </p>
                        </div>

                        <!-- STEP 2 -->
                        <div
                            class="relative rounded-2xl border border-slate-100 bg-white p-7 shadow-sm"
                        >
                            <span
                                class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-600 text-lg font-extrabold text-white shadow-lg shadow-indigo-200"
                            >
                                02
                            </span>
                            <h3 class="text-base font-extrabold text-[#172554]">
                                Tutor Melaksanakan Pembelajaran
                            </h3>
                            <p
                                class="mt-3 text-xs leading-7 text-slate-500"
                            >
                                Tutor melihat jadwal dan kelas yang menjadi
                                tanggung jawabnya, kemudian mencatat absensi
                                siswa.
                            </p>
                        </div>

                        <!-- STEP 3 -->
                        <div
                            class="relative rounded-2xl border border-slate-100 bg-white p-7 shadow-sm"
                        >
                            <span
                                class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-600 text-lg font-extrabold text-white shadow-lg shadow-emerald-200"
                            >
                                03
                            </span>
                            <h3 class="text-base font-extrabold text-[#172554]">
                                Admin Memantau Laporan
                            </h3>
                            <p
                                class="mt-3 text-xs leading-7 text-slate-500"
                            >
                                Admin memantau kehadiran, tagihan, pembayaran,
                                dan laporan aktivitas bimbingan belajar.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ABOUT SECTION -->
            <section id="tentang" class="bg-white py-24">
                <div
                    class="mx-auto grid max-w-7xl items-center gap-12 px-5 lg:grid-cols-2 lg:px-8"
                >
                    <div>
                        <span
                            class="text-[11px] font-extrabold tracking-[3px] text-blue-600"
                        >
                            TENTANG BIMBELPRO
                        </span>
                        <h2
                            class="mt-4 text-3xl leading-tight font-extrabold tracking-tight text-[#14264B] sm:text-4xl"
                        >
                            Administrasi Bimbel dalam Satu
                            <span class="text-blue-600">Genggaman.</span>
                        </h2>
                        <p
                            class="mt-5 text-sm leading-7 text-slate-500"
                        >
                            BimbelPro merupakan sistem informasi manajemen
                            berbasis web yang dirancang untuk membantu
                            pengelola bimbingan belajar mengatur kegiatan
                            operasional secara lebih terpusat, rapi, dan
                            efisien.
                        </p>
                        <p
                            class="mt-3 text-sm leading-7 text-slate-500"
                        >
                            Dengan pembagian hak akses Admin dan Tutor,
                            setiap pengguna dapat menjalankan tugasnya
                            sesuai tanggung jawab masing-masing.
                        </p>

                        <div class="mt-7">
                            <Link
                                :href="login()"
                                v-if="!$page.props.auth.user"
                                class="inline-flex items-center gap-3 rounded-xl bg-[#142B55] px-6 py-3.5 text-sm font-bold text-white transition hover:bg-blue-700"
                            >
                                Mulai Gunakan Sistem
                                <span>→</span>
                            </Link>
                            <Link
                                :href="dashboard()"
                                v-else
                                class="inline-flex items-center gap-3 rounded-xl bg-[#142B55] px-6 py-3.5 text-sm font-bold text-white transition hover:bg-blue-700"
                            >
                                Buka Dashboard
                                <span>→</span>
                            </Link>
                        </div>
                    </div>

                    <!-- BENEFIT CARDS -->
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="rounded-2xl bg-[#EEF4FF] p-6"
                        >
                            <div
                                class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600 text-xl text-white"
                            >
                                ✓
                            </div>
                            <h3
                                class="text-sm font-extrabold text-[#172554]"
                            >
                                Data Terpusat
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Informasi tersimpan dalam satu sistem
                                terintegrasi.
                            </p>
                        </div>

                        <div
                            class="mt-8 rounded-2xl bg-[#F0EEFF] p-6"
                        >
                            <div
                                class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-600 text-xl text-white"
                            >
                                ◈
                            </div>
                            <h3
                                class="text-sm font-extrabold text-[#172554]"
                            >
                                Hak Akses
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Akses disesuaikan dengan peran masing-masing
                                pengguna.
                            </p>
                        </div>

                        <div
                            class="rounded-2xl bg-[#EAF8F2] p-6"
                        >
                            <div
                                class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-xl text-white"
                            >
                                ↗
                            </div>
                            <h3
                                class="text-sm font-extrabold text-[#172554]"
                            >
                                Lebih Efisien
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Pengelolaan administrasi menjadi lebih
                                terorganisir.
                            </p>
                        </div>

                        <div
                            class="mt-8 rounded-2xl bg-[#FFF6E8] p-6"
                        >
                            <div
                                class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-amber-500 text-xl text-white"
                            >
                                ≡
                            </div>
                            <h3
                                class="text-sm font-extrabold text-[#172554]"
                            >
                                Laporan Terstruktur
                            </h3>
                            <p
                                class="mt-2 text-xs leading-6 text-slate-500"
                            >
                                Informasi aktivitas bimbel lebih mudah
                                dipantau.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA SECTION -->
            <section class="bg-[#142B55] px-5 py-20 lg:px-8">
                <div class="mx-auto max-w-4xl text-center">
                    <span
                        class="text-[11px] font-extrabold tracking-[3px] text-blue-300"
                    >
                        BIMBELPRO MANAGEMENT SYSTEM
                    </span>
                    <h2
                        class="mt-5 text-3xl leading-tight font-extrabold tracking-tight text-white sm:text-4xl"
                    >
                        Kelola Bimbingan Belajar
                        <span class="text-blue-300">Lebih Terarah.</span>
                    </h2>
                    <p
                        class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-blue-100/70"
                    >
                        Mulai kelola aktivitas bimbingan belajar secara
                        terpusat melalui BimbelPro.
                    </p>

                    <Link
                        :href="login()"
                        v-if="!$page.props.auth.user"
                        class="mt-9 inline-flex items-center gap-3 rounded-xl bg-white px-7 py-3.5 text-sm font-extrabold text-blue-700 shadow-xl transition hover:-translate-y-1 hover:bg-blue-50"
                    >
                        Masuk ke BimbelPro
                        <span class="text-lg">→</span>
                    </Link>
                    <Link
                        :href="dashboard()"
                        v-else
                        class="mt-9 inline-flex items-center gap-3 rounded-xl bg-white px-7 py-3.5 text-sm font-extrabold text-blue-700 shadow-xl transition hover:-translate-y-1 hover:bg-blue-50"
                    >
                        Buka Dashboard
                        <span class="text-lg">→</span>
                    </Link>
                </div>
            </section>
        </main>

        <!-- FOOTER -->
        <footer class="border-t border-slate-100 bg-white">
            <div
                class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-5 px-5 py-8 sm:flex-row lg:px-8"
            >
                <a href="#beranda" class="flex items-center gap-2">
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-white"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="m2 10 10-6 10 6-10 6-10-6Z" />
                            <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5" />
                        </svg>
                    </div>
                    <span
                        class="text-lg font-extrabold tracking-tight text-[#172554]"
                    >
                        Bimbel<span class="text-blue-600">Pro</span>
                    </span>
                </a>

                <p class="text-center text-[11px] text-slate-400">
                    Sistem Informasi Manajemen Bimbingan Belajar Berbasis Web.
                </p>

                <p class="text-[11px] font-medium text-slate-400">
                    © {{ new Date().getFullYear() }} BimbelPro.
                </p>
            </div>
        </footer>
    </div>
</template>
