<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    searchedEmail?: string;
    application?: {
        id: number;
        name: string;
        email: string;
        subject_specialization: string;
        education: string;
        status: string;
        admin_notes?: string | null;
        created_at: string;
    } | null;
}>();

const emailInput = ref(props.searchedEmail || '');

function checkStatus() {
    if (!emailInput.value) return;
    router.get('/informasi-pendaftaran/cek', { email: emailInput.value });
}

function getStatusBadge(status: string) {
    switch (status) {
        case 'menunggu':
            return {
                label: 'Menunggu Pemeriksaan',
                color: 'bg-amber-100 text-amber-800 border-amber-200',
                desc: 'Berkas pengajuan Anda telah diterima dan berada dalam antrean peninjauan oleh tim akademik.',
            };
        case 'sedang_ditinjau':
            return {
                label: 'Sedang Ditinjau & Seleksi',
                color: 'bg-blue-100 text-blue-800 border-blue-200',
                desc: 'Berkas Anda sedang diproses. Tim kami akan segera menghubungi Anda untuk tahap wawancara / microteaching.',
            };
        case 'diterima':
            return {
                label: 'Selamat! Diterima Menjadi Tutor',
                color: 'bg-emerald-100 text-emerald-800 border-emerald-200',
                desc: 'Selamat! Pengajuan Anda telah disetujui. Akun login Tutor Anda telah aktif.',
            };
        case 'ditolak':
            return {
                label: 'Belum Sesuai Kriteria',
                color: 'bg-rose-100 text-rose-800 border-rose-200',
                desc: 'Mohon maaf, saat ini kualifikasi yang diajukan belum sesuai dengan kebutuhan formasi bimbingan belajar kami.',
            };
        default:
            return {
                label: status,
                color: 'bg-slate-100 text-slate-700 border-slate-200',
                desc: 'Status dalam proses.',
            };
    }
}
</script>

<template>
    <Head title="Informasi & Cek Status Pendaftaran Tutor | BimbelPro" />

    <div class="min-h-screen bg-[#FAF8FF] font-['Plus_Jakarta_Sans'] text-slate-800 pb-16">

        <!-- LIQUID GLASS FLOATING NAVBAR -->
        <header class="sticky top-4 z-50 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 pt-2">
            <nav class="relative flex items-center justify-between rounded-2xl border border-white/60 bg-white/70 px-5 py-3.5 shadow-lg shadow-purple-500/5 backdrop-blur-xl transition-all sm:px-6">
                <Link href="/" class="flex items-center gap-3 group">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-purple-600 via-indigo-600 to-purple-500 text-white font-extrabold shadow-md shadow-purple-500/30 group-hover:scale-105 transition-transform">
                        B
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-900">
                        Bimbel<span class="text-purple-600">Pro</span>
                    </span>
                </Link>

                <div class="flex items-center gap-3">
                    <Link
                        href="/daftar-tutor"
                        class="rounded-xl border border-purple-200 bg-purple-50/80 px-4 py-2 text-xs font-bold text-purple-700 hover:bg-purple-100 transition-all shadow-sm"
                    >
                        Form Pendaftaran
                    </Link>
                    <Link
                        href="/login"
                        class="rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-4 py-2 text-xs font-bold text-white shadow-md shadow-purple-500/25 hover:opacity-95 transition-all"
                    >
                        Masuk Sistem
                    </Link>
                </div>
            </nav>
        </header>

        <main class="py-12 px-5 sm:px-6 lg:py-16">
            <div class="mx-auto max-w-4xl space-y-10">

                <!-- STATUS MESSAGE IF ANY -->
                <div
                    v-if="$page.props.flash?.status"
                    class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5 text-sm font-semibold text-emerald-800"
                >
                    {{ $page.props.flash.status}}
                </div>

                <!-- CEK STATUS SECTION -->
                <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-xl shadow-purple-500/5 sm:p-8">
                    <div class="flex items-center gap-3 text-purple-700 mb-2">
                        <span class="text-xl">◷</span>
                        <h2 class="text-lg font-extrabold text-slate-900">
                            Cek Status Pengajuan Pendaftaran Tutor
                        </h2>
                    </div>

                    <p class="text-xs text-slate-500 mb-6">
                        Masukkan alamat email yang Anda gunakan saat mendaftar untuk melihat perkembangan status verifikasi.
                    </p>

                    <form @submit.prevent="checkStatus" class="flex flex-col gap-3 sm:flex-row">
                        <input
                            v-model="emailInput"
                            type="email"
                            required
                            placeholder="Ketik email pendaftaran Anda..."
                            class="h-12 flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                        />
                        <button
                            type="submit"
                            class="h-12 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-6 font-bold text-white shadow-md transition hover:brightness-110"
                        >
                            Cek Status
                        </button>
                    </form>

                    <!-- HASIL PENCARIAN -->
                    <div v-if="searchedEmail" class="mt-6 border-t border-slate-100 pt-6">
                        <div v-if="application" class="rounded-2xl border p-5" :class="getStatusBadge(application.status).color">
                            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                                <div>
                                    <h3 class="text-base font-extrabold text-slate-900">
                                        {{ application.name }}
                                    </h3>
                                    <p class="text-xs text-slate-600">
                                        {{ application.subject_specialization }} • {{ application.education }}
                                    </p>
                                </div>
                                <span class="rounded-full border px-4 py-1.5 text-xs font-extrabold" :class="getStatusBadge(application.status).color">
                                    {{ getStatusBadge(application.status).label }}
                                </span>
                            </div>

                            <p class="mt-4 text-xs leading-relaxed text-slate-700">
                                {{ getStatusBadge(application.status).desc }}
                            </p>

                            <div v-if="application.admin_notes" class="mt-3 rounded-xl bg-white/80 p-3 text-xs border border-purple-100">
                                <span class="font-bold text-slate-800">Catatan dari Admin:</span>
                                <p class="mt-1 text-slate-600">{{ application.admin_notes }}</p>
                            </div>

                            <div v-if="application.status === 'diterima'" class="mt-5 border-t border-emerald-200 pt-4">
                                <p class="text-xs font-semibold text-emerald-800 mb-3">
                                    Silakan gunakan akun Anda untuk masuk ke Dashboard Tutor:
                                </p>
                                <Link
                                    href="/login"
                                    class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2 text-xs font-bold text-white hover:bg-emerald-700"
                                >
                                    Masuk ke Portal Tutor →
                                </Link>
                            </div>
                        </div>

                        <div v-else class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                            <p class="text-sm font-bold text-slate-700">
                                Data Pendaftaran Tidak Ditemukan
                            </p>
                            <p class="mt-1 text-xs text-slate-500">
                                Tidak ada pengajuan pendaftaran dengan email <span class="font-bold text-purple-600">{{ searchedEmail }}</span>.
                            </p>
                            <div class="mt-4">
                                <Link href="/daftar-tutor" class="text-xs font-bold text-purple-600 hover:text-purple-800">
                                    Ingin mendaftar sebagai tutor baru? Klik di sini →
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ALUR LENGKAP PENERIMAAN -->
                <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm sm:p-8">
                    <h2 class="text-lg font-extrabold text-slate-900 mb-6">
                        Alur Penerimaan Calon Pengajar BimbelPro
                    </h2>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="flex gap-4 rounded-2xl bg-purple-50/60 p-4 border border-purple-100/60">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-600 text-sm font-bold text-white">
                                1
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">Pengajuan Pendaftaran</h3>
                                <p class="mt-1 text-xs text-slate-600 leading-relaxed">
                                    Calon pengajar mengisi formulir data diri, pendidikan, bidang keahlian, dan motivasi melalui halaman publik.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 rounded-2xl bg-purple-50/60 p-4 border border-purple-100/60">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-sm font-bold text-white">
                                2
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">Pemeriksaan Berkas</h3>
                                <p class="mt-1 text-xs text-slate-600 leading-relaxed">
                                    Admin akademik meneliti kecocokan latar belakang pendidikan dengan kebutuhan kelas belajar aktif.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 rounded-2xl bg-purple-50/60 p-4 border border-purple-100/60">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-violet-600 text-sm font-bold text-white">
                                3
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">Seleksi & Wawancara</h3>
                                <p class="mt-1 text-xs text-slate-600 leading-relaxed">
                                    Calon tutor terpilih dihubungi untuk wawancara teknis dan microteaching untuk menguji metode komunikasi.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 rounded-2xl bg-purple-50/60 p-4 border border-purple-100/60">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-sm font-bold text-white">
                                4
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">Aktivasi Akun & Penugasan</h3>
                                <p class="mt-1 text-xs text-slate-600 leading-relaxed">
                                    Setelah disetujui, akun Tutor diaktifkan otomatis dan diberikan akses ke kelas serta jadwal mengajar.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</template>
