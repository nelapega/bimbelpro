<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login } from '@/routes';

const features = [
    {
        title: 'Manajemen Data Siswa',
        description: 'Kelola data identitas, NIS, jenjang kelas, kontak wali, dan riwayat belajar siswa secara rapi.',
        icon: '♙',
        color: 'from-purple-500 to-indigo-600',
    },
    {
        title: 'Seleksi & Akun Tutor',
        description: 'Alur pendaftaran calon tutor terpadu dengan peninjauan berkas, seleksi, dan aktivasi akun otomatis.',
        icon: '♧',
        color: 'from-purple-600 to-fuchsia-600',
    },
    {
        title: 'Presensi Digital Terintegrasi',
        description: 'Tutor dapat mencatat kehadiran Hadir, Izin, Sakit, atau Alpa langsung per kelas secara realtime.',
        icon: '✓',
        color: 'from-indigo-500 to-purple-600',
    },
    {
        title: 'Kelas & Jadwal Belajar',
        description: 'Pengaturan kapasitas ruangan, pembagian mata pelajaran, penugasan tutor, dan jadwal mingguan terstruktur.',
        icon: '◷',
        color: 'from-purple-500 to-pink-500',
    },
    {
        title: 'Administrasi & Tagihan SPP',
        description: 'Pembuatan invoice otomatis, pelacakan tagihan jatuh tempo, dan validasi riwayat pembayaran.',
        icon: 'Rp',
        color: 'from-purple-600 to-violet-700',
    },
    {
        title: 'Laporan & Rekap Komprehensif',
        description: 'Pantau pertumbuhan siswa, rekapitulasi absensi kelas, dan laporan keuangan bimbel dalam satu tempat.',
        icon: '▥',
        color: 'from-violet-600 to-purple-800',
    },
];

const stats = [
    { value: '1.200+', label: 'Siswa Berprestasi' },
    { value: '50+', label: 'Tutor Ahli & Berlisensi' },
    { value: '98.4%', label: 'Tingkat Kelulusan Ujian' },
    { value: '15+', label: 'Kelas Aktif Unggulan' },
];

const sampleClasses = [
    {
        title: '12 SMA Intensif UTBK SNBT',
        category: 'Matematika & TPS',
        tutor: 'Rian Hidayat, S.Pd.',
        badge: 'Program Favorit',
        rating: '4.9 (148 ulasan)',
        sessions: '16 Sesi Belajar',
    },
    {
        title: '11 SMA Fisika Master Class',
        category: 'Fisika & Olimpiade',
        tutor: 'Sarah Azzahra, M.Si.',
        badge: 'Persiapan Juara',
        rating: '4.9 (96 ulasan)',
        sessions: '14 Sesi Belajar',
    },
    {
        title: '9 SMP Sukses Asesmen Nasional',
        category: 'Matematika & Sains',
        tutor: 'Dimas Pratama, S.Si.',
        badge: 'Reguler Juara',
        rating: '4.8 (112 ulasan)',
        sessions: '12 Sesi Belajar',
    },
];
</script>

<template>
    <Head title="BimbelPro - Sistem Terpadu Manajemen Bimbingan Belajar">
        <meta
            name="description"
            content="BimbelPro mempermudah pengelolaan bimbel: manajemen siswa, jadwal, presensi tutor, administrasi keuangan, dan seleksi pengajar profesional."
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" />
        <link
            href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
    </Head>

    <div class="min-h-screen bg-[#FAF8FF] font-['Plus_Jakarta_Sans'] text-slate-800 selection:bg-purple-500 selection:text-white">

        <!-- LIQUID GLASS FLOATING NAVBAR -->
        <header class="fixed inset-x-0 top-3 z-50 px-4 sm:px-6 lg:px-8">
            <nav
                class="mx-auto flex h-[68px] max-w-7xl items-center justify-between rounded-2xl border border-white/60 bg-white/70 px-5 shadow-lg shadow-purple-500/5 backdrop-blur-xl transition hover:border-purple-200/70 sm:px-7"
            >
                <!-- BRAND LOGO -->
                <Link href="/" class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-purple-600 to-indigo-600 text-white shadow-md shadow-purple-500/25"
                    >
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m2 10 10-6 10 6-10 6-10-6Z" />
                            <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5" />
                            <path d="M22 10v6" />
                        </svg>
                    </div>

                    <div class="leading-tight">
                        <span class="text-xl font-extrabold tracking-tight text-slate-900">
                            Bimbel<span class="bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">Pro</span>
                        </span>
                        <span class="block text-[8px] font-bold tracking-[2px] text-purple-700/80">
                            LEARNING ECOSYSTEM
                        </span>
                    </div>
                </Link>

                <!-- NAVIGATION LINKS -->
                <div class="hidden items-center gap-8 text-[13px] font-semibold text-slate-600 md:flex">
                    <a href="#beranda" class="transition hover:text-purple-600">Beranda</a>
                    <a href="#fitur" class="transition hover:text-purple-600">Fitur Sistem</a>
                    <a href="#seleksi-tutor" class="transition hover:text-purple-600">Alur Penerimaan</a>
                    <Link href="/informasi-pendaftaran" class="transition hover:text-purple-600">
                        Cek Status Calon Tutor
                    </Link>
                </div>

                <!-- ACTIONS -->
                <div class="flex items-center gap-3">
                    <Link
                        href="/daftar-tutor"
                        class="hidden rounded-xl border border-purple-200/80 bg-purple-50/80 px-4 py-2 text-xs font-bold text-purple-700 backdrop-blur-md transition hover:bg-purple-100 hover:text-purple-800 sm:inline-flex"
                    >
                        Daftar Jadi Tutor
                    </Link>

                    <Link
                        v-if="$page.props.auth?.user"
                        :href="dashboard()"
                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-5 py-2 text-xs font-bold text-white shadow-md shadow-purple-500/25 transition hover:brightness-110"
                    >
                        <span>Dashboard</span>
                        <span class="text-xs">→</span>
                    </Link>

                    <Link
                        v-else
                        :href="login()"
                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-5 py-2 text-xs font-bold text-white shadow-md shadow-purple-500/25 transition hover:brightness-110"
                    >
                        <span>Masuk</span>
                        <span class="text-xs">→</span>
                    </Link>
                </div>
            </nav>
        </header>

        <!-- HERO SECTION (CourseHub Style with Purple Lavender Accent) -->
        <section id="beranda" class="relative overflow-hidden pt-36 pb-20 lg:pt-44 lg:pb-32">
            <!-- AMBIENT PURPLE GLOWS -->
            <div class="pointer-events-none absolute -top-24 left-1/2 -z-10 h-[500px] w-[800px] -translate-x-1/2 rounded-full bg-gradient-to-b from-purple-200/50 via-indigo-100/30 to-transparent blur-3xl"></div>
            <div class="pointer-events-none absolute -right-40 top-1/4 -z-10 h-96 w-96 rounded-full bg-purple-300/30 blur-3xl"></div>
            <div class="pointer-events-none absolute -left-40 top-1/2 -z-10 h-96 w-96 rounded-full bg-fuchsia-200/25 blur-3xl"></div>

            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-10">

                    <!-- HERO COPY -->
                    <div class="lg:col-span-7">
                        <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-purple-200/70 bg-purple-100/70 px-4 py-1.5 shadow-sm backdrop-blur-md">
                            <span class="flex h-2 w-2 rounded-full bg-purple-600 animate-pulse"></span>
                            <span class="text-[11px] font-bold tracking-[1.5px] text-purple-800">
                                MODERN BIMBEL MANAGEMENT PLATFORM
                            </span>
                        </div>

                        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl lg:leading-[1.15]">
                            Kelola Bimbel Modern,
                            <span class="block bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-800 bg-clip-text text-transparent">
                                Wujudkan Masa Depan Juara.
                            </span>
                        </h1>

                        <p class="mt-6 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg">
                            BimbelPro membantu pengelola bimbingan belajar mengatur data siswa, presensi digital, jadwal belajar, administrasi pembayaran, dan penerimaan tutor pengajar berkualitas dalam satu sistem terintegrasi.
                        </p>

                        <!-- CTA BUTTONS -->
                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            <Link
                                href="/daftar-tutor"
                                class="inline-flex items-center gap-3 rounded-2xl bg-gradient-to-r from-purple-600 to-indigo-600 px-7 py-3.5 text-sm font-extrabold text-white shadow-xl shadow-purple-500/25 transition duration-300 hover:-translate-y-0.5 hover:shadow-purple-500/35"
                            >
                                <span>Daftar Jadi Calon Tutor</span>
                                <span class="text-lg">→</span>
                            </Link>

                            <Link
                                href="/informasi-pendaftaran"
                                class="inline-flex items-center gap-2 rounded-2xl border border-purple-200/80 bg-white/80 px-6 py-3.5 text-sm font-bold text-purple-900 shadow-sm backdrop-blur-md transition hover:bg-purple-50 hover:border-purple-300"
                            >
                                <span>Alur & Cek Pendaftaran</span>
                            </Link>
                        </div>

                        <!-- STATS BADGES (CourseHub Style) -->
                        <div class="mt-12 grid grid-cols-2 gap-6 border-t border-purple-100/80 pt-8 sm:grid-cols-4">
                            <div v-for="stat in stats" :key="stat.label">
                                <p class="text-2xl font-extrabold tracking-tight text-purple-950 sm:text-3xl">
                                    {{ stat.value }}
                                </p>
                                <p class="mt-1 text-xs font-semibold text-slate-500">
                                    {{ stat.label }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- HERO VISUAL (Card Preview CourseHub Style) -->
                    <div class="relative lg:col-span-5">
                        <div class="relative mx-auto max-w-md lg:max-w-none">

                            <!-- GLASS CARD HIGHLIGHT -->
                            <div class="relative rounded-3xl border border-white/80 bg-white/80 p-6 shadow-2xl shadow-purple-500/10 backdrop-blur-xl sm:p-8">

                                <!-- CARD HEADER BADGE -->
                                <div class="flex items-center justify-between border-b border-purple-50 pb-5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-purple-700">
                                            ▤
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold tracking-wider text-purple-600 uppercase">Kelas Aktif</p>
                                            <h3 class="text-base font-extrabold text-slate-900">12 IPA UTBK SNBT</h3>
                                        </div>
                                    </div>
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-[11px] font-bold text-emerald-600">
                                        ● Berlangsung
                                    </span>
                                </div>

                                <!-- TUTOR PROFILE CHIP -->
                                <div class="mt-5 flex items-center justify-between rounded-2xl bg-purple-50/60 p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-600 text-sm font-bold text-white">
                                            RH
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-800">Rian Hidayat, S.Pd.</p>
                                            <p class="text-[11px] text-purple-600 font-medium">Tutor Matematika & TPS</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-slate-700">15:30 - 17:00</span>
                                </div>

                                <!-- ATTENDANCE STATS PREVIEW -->
                                <div class="mt-5 space-y-3">
                                    <div class="flex items-center justify-between text-xs font-bold">
                                        <span class="text-slate-600">Presensi Kehadiran Siswa</span>
                                        <span class="text-purple-700">95% Hadir</span>
                                    </div>
                                    <div class="h-2.5 w-full overflow-hidden rounded-full bg-purple-100">
                                        <div class="h-full rounded-full bg-gradient-to-r from-purple-500 to-indigo-600" style="width: 95%"></div>
                                    </div>
                                </div>

                                <!-- FLOATING ACCENT PILL 1 -->
                                <div class="mt-6 flex items-center justify-between rounded-xl border border-purple-100 bg-white p-3.5 shadow-sm">
                                    <div class="flex items-center gap-2.5">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-xs font-bold text-emerald-700">✓</span>
                                        <p class="text-xs font-bold text-slate-700">Seleksi Calon Tutor</p>
                                    </div>
                                    <span class="rounded-lg bg-purple-100/80 px-2.5 py-1 text-[10px] font-bold text-purple-700">
                                        Sistem Seleksi Aktif
                                    </span>
                                </div>

                                <!-- FLOATING ACCENT PILL 2 -->
                                <div class="mt-3 flex items-center justify-between rounded-xl border border-purple-100 bg-white p-3.5 shadow-sm">
                                    <div class="flex items-center gap-2.5">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100 text-xs font-bold text-indigo-700">Rp</span>
                                        <p class="text-xs font-bold text-slate-700">Manajemen Tagihan SPP</p>
                                    </div>
                                    <span class="text-xs font-bold text-emerald-600">Lunas Otomatis</span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- TOP FEATURES GRID (Inspired by CourseHub "Explore Top Categories") -->
        <section id="fitur" class="py-20 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="text-center">
                    <p class="text-xs font-bold tracking-[2px] text-purple-600 uppercase">
                        FITUR UTAMA BIMBELPRO
                    </p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                        Semua Kebutuhan Bimbingan Belajar, Dalam Satu Platform
                    </h2>
                    <p class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-slate-600 sm:text-base">
                        Dirancang khusus untuk institusi bimbel, mempermudah koordinasi antara Administrator, Tutor Pengajar, dan Siswa.
                    </p>
                </div>

                <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="feature in features"
                        :key="feature.title"
                        class="group relative rounded-3xl border border-purple-100/80 bg-white p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-purple-200 hover:shadow-xl hover:shadow-purple-500/10"
                    >
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br text-2xl text-white shadow-md"
                            :class="feature.color"
                        >
                            {{ feature.icon }}
                        </div>

                        <h3 class="mt-6 text-lg font-extrabold text-slate-900 group-hover:text-purple-700 transition">
                            {{ feature.title }}
                        </h3>

                        <p class="mt-3 text-xs leading-6 text-slate-500 sm:text-sm">
                            {{ feature.description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SPECIAL FEATURE: SISTEM PENERIMAAN TUTOR (The Differentiator Feature) -->
        <section id="seleksi-tutor" class="relative py-20 lg:py-24">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="overflow-hidden rounded-3xl border border-purple-200/70 bg-gradient-to-br from-purple-900 via-indigo-900 to-purple-950 p-8 text-white shadow-2xl sm:p-12 lg:p-16">
                    <div class="grid items-center gap-10 lg:grid-cols-12">
                        <div class="lg:col-span-7">
                            <span class="rounded-full bg-purple-500/30 px-3.5 py-1.5 text-[10px] font-bold tracking-[2px] text-purple-200 uppercase">
                                FITUR PEMBEDA BIMBELPRO
                            </span>

                            <h2 class="mt-5 text-2xl font-extrabold tracking-tight sm:text-3xl lg:text-4xl">
                                Sistem Penerimaan & Seleksi Calon Tutor Terstruktur
                            </h2>

                            <p class="mt-4 text-sm leading-relaxed text-purple-100/80 sm:text-base">
                                Calon tutor yang mendaftar tidak otomatis menjadi pengguna aktif. Data tersimpan sebagai calon dan melalui proses peninjauan berkas serta wawancara oleh Admin. Setelah disetujui, sistem secara otomatis menerbitkan akun login tutor.
                            </p>

                            <!-- 4 STEP PIPELINE -->
                            <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-4">
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                                    <span class="text-xs font-bold text-purple-300">Tahap 1</span>
                                    <p class="mt-1 text-sm font-extrabold text-white">Pendaftaran</p>
                                    <p class="mt-1 text-[11px] text-purple-200/70">Pengisian biodata & portofolio</p>
                                </div>

                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                                    <span class="text-xs font-bold text-purple-300">Tahap 2</span>
                                    <p class="mt-1 text-sm font-extrabold text-white">Peninjauan</p>
                                    <p class="mt-1 text-[11px] text-purple-200/70">Admin meninjau berkas</p>
                                </div>

                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                                    <span class="text-xs font-bold text-purple-300">Tahap 3</span>
                                    <p class="mt-1 text-sm font-extrabold text-white">Seleksi</p>
                                    <p class="mt-1 text-[11px] text-purple-200/70">Microteaching & wawancara</p>
                                </div>

                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                                    <span class="text-xs font-bold text-purple-300">Tahap 4</span>
                                    <p class="mt-1 text-sm font-extrabold text-white">Aktivasi Akun</p>
                                    <p class="mt-1 text-[11px] text-purple-200/70">Akun tutor siap digunakan</p>
                                </div>
                            </div>

                            <div class="mt-8 flex flex-wrap items-center gap-4">
                                <Link
                                    href="/daftar-tutor"
                                    class="rounded-xl bg-white px-6 py-3 text-xs font-extrabold text-purple-900 shadow-lg transition hover:bg-purple-50"
                                >
                                    Daftar Sekarang →
                                </Link>
                                <Link
                                    href="/informasi-pendaftaran"
                                    class="rounded-xl border border-white/30 px-6 py-3 text-xs font-bold text-white transition hover:bg-white/10"
                                >
                                    Cek Status Pengajuan
                                </Link>
                            </div>
                        </div>

                        <!-- STATUS BADGE SHOWCASE -->
                        <div class="space-y-3 lg:col-span-5">
                            <div class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-md">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-purple-200">Status 1</span>
                                    <span class="rounded-full bg-amber-400/20 px-3 py-1 text-[10px] font-bold text-amber-300">Menunggu</span>
                                </div>
                                <p class="mt-2 text-xs text-purple-100/70">Berkas baru masuk dan menunggu antrean pemeriksaan Admin.</p>
                            </div>

                            <div class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-md">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-purple-200">Status 2</span>
                                    <span class="rounded-full bg-blue-400/20 px-3 py-1 text-[10px] font-bold text-blue-300">Sedang Ditinjau</span>
                                </div>
                                <p class="mt-2 text-xs text-purple-100/70">Admin sedang memverifikasi kualifikasi atau menjadwalkan wawancara.</p>
                            </div>

                            <div class="rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-md">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-purple-200">Status 3</span>
                                    <span class="rounded-full bg-emerald-400/20 px-3 py-1 text-[10px] font-bold text-emerald-300">Diterima</span>
                                </div>
                                <p class="mt-2 text-xs text-purple-100/70">Lolos seleksi! Akun Tutor dibuat dan diaktifkan otomatis ke portal.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- POPULAR CLASSES SECTION (CourseHub Style) -->
        <section class="py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-xs font-bold tracking-[2px] text-purple-600 uppercase">
                            PROGRAM & KELAS TERFAVORIT
                        </p>
                        <h2 class="mt-2 text-3xl font-extrabold text-slate-900">
                            Kelas Unggulan BimbelPro
                        </h2>
                    </div>
                    <Link href="/login" class="text-xs font-bold text-purple-600 hover:text-purple-800">
                        Masuk ke Dashboard Sistem →
                    </Link>
                </div>

                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="item in sampleClasses"
                        :key="item.title"
                        class="overflow-hidden rounded-3xl border border-purple-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-purple-500/10"
                    >
                        <div class="flex items-center justify-between">
                            <span class="rounded-full bg-purple-100 px-3 py-1 text-[10px] font-bold text-purple-700">
                                {{ item.badge }}
                            </span>
                            <span class="text-xs font-bold text-amber-500">★ {{ item.rating }}</span>
                        </div>

                        <h3 class="mt-5 text-lg font-extrabold text-slate-900">
                            {{ item.title }}
                        </h3>

                        <p class="mt-2 text-xs font-semibold text-purple-600">
                            {{ item.category }}
                        </p>

                        <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4">
                            <div class="flex items-center gap-2">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full bg-purple-100 text-xs font-bold text-purple-700">
                                    {{ item.tutor.charAt(0) }}
                                </div>
                                <span class="text-xs font-medium text-slate-600">{{ item.tutor }}</span>
                            </div>
                            <span class="text-xs font-bold text-slate-500">{{ item.sessions }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="border-t border-purple-100 bg-white py-12 text-slate-600">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-purple-600 text-white font-bold">
                            B
                        </div>
                        <span class="text-base font-extrabold text-slate-900">
                            Bimbel<span class="text-purple-600">Pro</span>
                        </span>
                    </div>

                    <p class="text-xs text-slate-400">
                        &copy; 2026 BimbelPro Management System. All rights reserved.
                    </p>

                    <div class="flex items-center gap-6 text-xs font-semibold text-slate-500">
                        <Link href="/daftar-tutor" class="hover:text-purple-600">Daftar Tutor</Link>
                        <Link href="/informasi-pendaftaran" class="hover:text-purple-600">Alur Seleksi</Link>
                        <Link href="/login" class="hover:text-purple-600">Masuk Akun</Link>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</template>
