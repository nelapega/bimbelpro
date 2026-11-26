<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    education: '',
    subject_specialization: '',
    experience_years: '1-2 tahun',
    motivation: '',
    portfolio_url: '',
});

function submit() {
    form.post('/daftar-tutor');
}
</script>

<template>
    <Head title="Pendaftaran Calon Tutor | BimbelPro" />

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
                        href="/informasi-pendaftaran"
                        class="rounded-xl border border-purple-200 bg-purple-50/80 px-4 py-2 text-xs font-bold text-purple-700 hover:bg-purple-100 transition-all shadow-sm"
                    >
                        Alur & Cek Status
                    </Link>
                    <Link
                        href="/login"
                        class="rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 px-4 py-2 text-xs font-bold text-white shadow-md shadow-purple-500/25 hover:opacity-95 transition-all"
                    >
                        Masuk Akun
                    </Link>
                </div>
            </nav>
        </header>

        <!-- FORM CONTAINER -->
        <main class="py-12 px-5 sm:px-6 lg:py-16">
            <div class="mx-auto max-w-3xl">

                <!-- INTRO BANNER -->
                <div class="overflow-hidden rounded-3xl bg-gradient-to-r from-purple-700 via-indigo-700 to-purple-900 p-8 text-white shadow-xl sm:p-10">
                    <span class="rounded-full bg-purple-500/40 px-3.5 py-1 text-[10px] font-bold tracking-[2px] text-purple-200 uppercase">
                        REKRUTMEN TENAGA PENGAJAR
                    </span>
                    <h1 class="mt-4 text-2xl font-extrabold sm:text-3xl">
                        Formulir Pendaftaran Calon Tutor
                    </h1>
                    <p class="mt-3 text-xs leading-relaxed text-purple-100/85 sm:text-sm">
                        Bergabunglah bersama keluarga pengajar profesional BimbelPro. Silakan lengkapi formulir di bawah ini dengan data yang sebenarnya. Data Anda akan ditinjau secara langsung oleh tim akademik.
                    </p>
                </div>

                <!-- CARD FORM -->
                <div class="mt-8 rounded-3xl border border-purple-100/90 bg-white p-6 shadow-xl shadow-purple-500/5 sm:p-10">
                    <form @submit.prevent="submit" class="space-y-6">

                        <!-- NAMA LENGKAP -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">
                                Nama Lengkap & Gelar <span class="text-rose-500">*</span>
                            </label>
                            <input
                                v-model="form.name"
                                type="text"
                                required
                                placeholder="Contoh: Rian Hidayat, S.Pd."
                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                            />
                            <p v-if="form.errors.name" class="mt-1.5 text-xs font-semibold text-rose-500">
                                {{ form.errors.name }}
                            </p>
                        </div>

                        <!-- EMAIL & TELEPON -->
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2">
                                    Alamat Email Aktif <span class="text-rose-500">*</span>
                                </label>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    required
                                    placeholder="emailanda@gmail.com"
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                                />
                                <p v-if="form.errors.email" class="mt-1.5 text-xs font-semibold text-rose-500">
                                    {{ form.errors.email }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2">
                                    Nomor WhatsApp / HP <span class="text-rose-500">*</span>
                                </label>
                                <input
                                    v-model="form.phone"
                                    type="text"
                                    required
                                    placeholder="081234567890"
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                                />
                                <p v-if="form.errors.phone" class="mt-1.5 text-xs font-semibold text-rose-500">
                                    {{ form.errors.phone }}
                                </p>
                            </div>
                        </div>

                        <!-- PENDIDIKAN TERAKHIR -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">
                                Riwayat Pendidikan Terakhir <span class="text-rose-500">*</span>
                            </label>
                            <input
                                v-model="form.education"
                                type="text"
                                required
                                placeholder="Contoh: S1 Pendidikan Matematika - Universitas Indonesia"
                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                            />
                            <p v-if="form.errors.education" class="mt-1.5 text-xs font-semibold text-rose-500">
                                {{ form.errors.education }}
                            </p>
                        </div>

                        <!-- BIDANG KEAHLIAN & PENGALAMAN -->
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2">
                                    Mata Pelajaran / Keahlian <span class="text-rose-500">*</span>
                                </label>
                                <input
                                    v-model="form.subject_specialization"
                                    type="text"
                                    required
                                    placeholder="Contoh: Matematika SMA & UTBK"
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                                />
                                <p v-if="form.errors.subject_specialization" class="mt-1.5 text-xs font-semibold text-rose-500">
                                    {{ form.errors.subject_specialization }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2">
                                    Pengalaman Mengajar <span class="text-rose-500">*</span>
                                </label>
                                <select
                                    v-model="form.experience_years"
                                    required
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                                >
                                    <option value="Kurang dari 1 tahun">&lt; 1 tahun / Fresh Graduate</option>
                                    <option value="1-2 tahun">1 - 2 tahun</option>
                                    <option value="3-5 tahun">3 - 5 tahun</option>
                                    <option value="Lebih dari 5 tahun">&gt; 5 tahun</option>
                                </select>
                                <p v-if="form.errors.experience_years" class="mt-1.5 text-xs font-semibold text-rose-500">
                                    {{ form.errors.experience_years }}
                                </p>
                            </div>
                        </div>

                        <!-- LINK CV / PORTOFOLIO / LINKEDIN -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">
                                Tautan Portofolio / LinkedIn / Google Drive CV (Opsional)
                            </label>
                            <input
                                v-model="form.portfolio_url"
                                type="url"
                                placeholder="https://linkedin.com/in/profilanda atau link resume"
                                class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                            />
                            <p v-if="form.errors.portfolio_url" class="mt-1.5 text-xs font-semibold text-rose-500">
                                {{ form.errors.portfolio_url }}
                            </p>
                        </div>

                        <!-- MOTIVASI -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">
                                Motivasi & Pendekatan Mengajar <span class="text-rose-500">*</span>
                            </label>
                            <textarea
                                v-model="form.motivation"
                                required
                                rows="4"
                                placeholder="Jelaskan motivasi Anda bergabung dan bagaimana metode pendekatan mengajar yang biasa Anda terapkan kepada siswa..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50/50 p-4 text-sm transition focus:border-purple-500 focus:bg-white focus:outline-none focus:ring-4 focus:ring-purple-100"
                            ></textarea>
                            <p v-if="form.errors.motivation" class="mt-1.5 text-xs font-semibold text-rose-500">
                                {{ form.errors.motivation }}
                            </p>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="pt-4">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="flex h-13 w-full items-center justify-center rounded-2xl bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-700 px-6 font-extrabold text-white shadow-lg shadow-purple-500/25 transition hover:brightness-110 disabled:opacity-50"
                            >
                                <span v-if="form.processing">Mengirim Pendaftaran...</span>
                                <span v-else>Kirim Pengajuan Pendaftaran Tutor →</span>
                            </button>
                        </div>

                        <p class="text-center text-xs text-slate-400">
                            Pendaftaran ini merupakan permohonan seleksi calon tutor. Akun pengajar akan diterbitkan setelah Anda dinyatakan diterima oleh Admin.
                        </p>
                    </form>
                </div>

            </div>
        </main>
    </div>
</template>
