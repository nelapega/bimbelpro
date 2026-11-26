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

const progressSteps = [
    {
        key: 'menunggu',
        step: 1,
        label: 'Pengajuan Diterima',
        icon: '📥',
        desc: 'Berkas pengajuan Anda telah masuk ke sistem dan menunggu giliran peninjauan oleh tim akademik.',
    },
    {
        key: 'sedang_ditinjau',
        step: 2,
        label: 'Sedang Ditinjau',
        icon: '🔍',
        desc: 'Tim akademik BimbelPro sedang memeriksa kualifikasi Anda. Kami akan menghubungi Anda via WhatsApp/email untuk jadwal wawancara atau microteaching.',
    },
    {
        key: 'diterima',
        step: 3,
        label: 'Diterima & Akun Aktif',
        icon: '✅',
        desc: 'Selamat! Pengajuan Anda telah disetujui. Akun login Tutor Anda sudah aktif. Silakan masuk ke portal untuk melihat kelas dan jadwal mengajar.',
    },
];

function getActiveStepIndex(status: string) {
    if (status === 'ditolak') return -1;
    return progressSteps.findIndex(s => s.key === status);
}

function getStatusInfo(status: string) {
    switch (status) {
        case 'menunggu':
            return { label: '📥 Menunggu Pemeriksaan', badgeClass: 'bg-amber-100 text-amber-800 border-amber-200', headerClass: 'from-amber-50 to-orange-50 border-amber-200' };
        case 'sedang_ditinjau':
            return { label: '🔍 Sedang Ditinjau & Diproses', badgeClass: 'bg-blue-100 text-blue-800 border-blue-200', headerClass: 'from-blue-50 to-indigo-50 border-blue-200' };
        case 'diterima':
            return { label: '✅ Diterima Menjadi Tutor', badgeClass: 'bg-emerald-100 text-emerald-800 border-emerald-200', headerClass: 'from-emerald-50 to-teal-50 border-emerald-200' };
        case 'ditolak':
            return { label: '❌ Belum Sesuai Kriteria', badgeClass: 'bg-rose-100 text-rose-800 border-rose-200', headerClass: 'from-rose-50 to-pink-50 border-rose-200' };
        default:
            return { label: status, badgeClass: 'bg-slate-100 text-slate-700 border-slate-200', headerClass: 'from-slate-50 to-slate-50 border-slate-200' };
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

                        <!-- DATA DITEMUKAN -->
                        <div v-if="application">

                            <!-- Header identitas & badge status -->
                            <div
                                class="rounded-2xl border bg-gradient-to-br p-5 mb-5"
                                :class="getStatusInfo(application.status).headerClass"
                            >
                                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-start">
                                    <div>
                                        <h3 class="text-base font-extrabold text-slate-900">{{ application.name }}</h3>
                                        <p class="text-xs text-slate-600 mt-0.5">{{ application.subject_specialization }} • {{ application.education }}</p>
                                        <p class="text-[11px] text-slate-400 mt-1">Mendaftar: {{ new Date(application.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) }}</p>
                                    </div>
                                    <span class="rounded-full border px-4 py-1.5 text-xs font-extrabold whitespace-nowrap" :class="getStatusInfo(application.status).badgeClass">
                                        {{ getStatusInfo(application.status).label }}
                                    </span>
                                </div>
                            </div>

                            <!-- PROGRESS TRACKER (hanya untuk status normal flow, bukan ditolak) -->
                            <div v-if="application.status !== 'ditolak'" class="rounded-2xl border border-purple-100 bg-white p-5 mb-4">
                                <p class="text-xs font-extrabold uppercase tracking-wider text-purple-900 mb-5">Progres Seleksi Anda</p>

                                <!-- Stepper horizontal -->
                                <div class="relative">
                                    <!-- Background line -->
                                    <div class="absolute top-5 h-0.5 bg-slate-100 rounded-full" style="left: 20px; right: 20px;"></div>
                                    <!-- Progress line filled -->
                                    <div
                                        class="absolute top-5 h-0.5 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 transition-all duration-700"
                                        :style="{
                                            left: '20px',
                                            width: getActiveStepIndex(application.status) <= 0 ? '0%' :
                                                   getActiveStepIndex(application.status) === 1 ? '50%' : '100%',
                                            maxWidth: 'calc(100% - 40px)',
                                        }"
                                    ></div>

                                    <div class="relative flex justify-between px-2">
                                        <div
                                            v-for="(step, idx) in progressSteps"
                                            :key="step.key"
                                            class="flex flex-col items-center gap-2"
                                            style="width: 33%"
                                        >
                                            <!-- Node -->
                                            <div
                                                class="relative z-10 flex h-10 w-10 items-center justify-center rounded-full border-2 text-base font-bold transition-all duration-300"
                                                :class="[
                                                    application.status === step.key
                                                        ? 'border-purple-500 bg-purple-600 text-white shadow-lg shadow-purple-200/60 scale-110'
                                                        : getActiveStepIndex(application.status) > idx
                                                            ? 'border-emerald-400 bg-emerald-500 text-white'
                                                            : 'border-slate-200 bg-white text-slate-300'
                                                ]"
                                            >
                                                <span v-if="getActiveStepIndex(application.status) > idx && application.status !== step.key">✓</span>
                                                <span v-else>{{ step.icon }}</span>
                                            </div>

                                            <!-- Label -->
                                            <div class="text-center max-w-[80px]">
                                                <p class="text-[10px] font-extrabold leading-tight"
                                                    :class="application.status === step.key ? 'text-purple-700' : getActiveStepIndex(application.status) > idx ? 'text-emerald-600' : 'text-slate-400'">
                                                    {{ step.label }}
                                                </p>
                                                <p class="text-[9px] text-slate-400 mt-0.5 leading-tight">Tahap {{ step.step }} dari 3</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi tahap aktif -->
                                <div class="mt-5 rounded-xl bg-purple-50 border border-purple-100 p-4 text-xs text-slate-600 leading-relaxed">
                                    <p class="font-bold text-slate-800 mb-1">{{ progressSteps.find(s => s.key === application!.status)?.label }}</p>
                                    {{ progressSteps.find(s => s.key === application!.status)?.desc }}
                                </div>
                            </div>

                            <!-- STATUS DITOLAK -->
                            <div v-if="application.status === 'ditolak'" class="rounded-2xl border border-rose-200 bg-rose-50 p-5 mb-4">
                                <div class="flex gap-3">
                                    <span class="text-2xl shrink-0">❌</span>
                                    <div>
                                        <p class="font-bold text-rose-800 text-sm">Pengajuan Belum Sesuai Kriteria</p>
                                        <p class="text-xs text-rose-600 mt-1 leading-relaxed">
                                            Mohon maaf, saat ini kualifikasi yang Anda ajukan belum sesuai dengan kebutuhan formasi tenaga pengajar kami. Anda dapat mencoba mendaftar kembali di lain waktu.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- CATATAN DARI ADMIN -->
                            <div v-if="application.admin_notes" class="rounded-2xl border border-indigo-100 bg-indigo-50 p-4 mb-4">
                                <div class="flex items-start gap-3">
                                    <span class="text-lg shrink-0">💬</span>
                                    <div class="text-xs">
                                        <p class="font-extrabold text-indigo-900 mb-1.5">Catatan dari Tim Akademik BimbelPro:</p>
                                        <p class="text-indigo-700 leading-relaxed italic">"{{ application.admin_notes }}"</p>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA JIKA DITERIMA -->
                            <div v-if="application.status === 'diterima'" class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5">
                                <p class="text-sm font-extrabold text-emerald-900 mb-1">🎉 Selamat! Akun Tutor Anda sudah aktif.</p>
                                <p class="text-xs text-emerald-700 mb-4 leading-relaxed">
                                    Silakan masuk menggunakan email <strong>{{ application.email }}</strong> dan password yang telah diberikan oleh admin. Ganti password Anda setelah login pertama.
                                </p>
                                <Link
                                    href="/login"
                                    class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white hover:bg-emerald-700 shadow-md shadow-emerald-200 transition"
                                >
                                    Masuk ke Portal Tutor →
                                </Link>
                            </div>
                        </div>

                        <!-- DATA TIDAK DITEMUKAN -->
                        <div v-else class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-8 text-center">
                            <p class="text-3xl mb-2">🔎</p>
                            <p class="text-sm font-bold text-slate-700">Data Pendaftaran Tidak Ditemukan</p>
                            <p class="mt-1 text-xs text-slate-500">
                                Tidak ada pengajuan pendaftaran dengan email
                                <span class="font-bold text-purple-600">{{ searchedEmail }}</span>.
                            </p>
                            <div class="mt-4">
                                <Link href="/daftar-tutor" class="text-xs font-bold text-purple-600 hover:text-purple-800">
                                    Belum mendaftar? Klik di sini untuk daftar sebagai calon tutor →
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
