<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

const props = defineProps<{
    applications: Array<{
        id: number;
        name: string;
        email: string;
        phone: string;
        education: string;
        subject_specialization: string;
        experience_years: string;
        motivation: string;
        portfolio_url?: string | null;
        status: string;
        admin_notes?: string | null;
        reviewed_at?: string | null;
        created_at: string;
    }>;
    currentFilter: string;
    counts: {
        all: number;
        menunggu: number;
        sedang_ditinjau: number;
        diterima: number;
        ditolak: number;
    };
}>();

const selectedApp = ref<typeof props.applications[0] | null>(null);
const modalStatus = ref('menunggu');
const modalNotes = ref('');
const customPassword = ref('tutor123');

function openModal(app: typeof props.applications[0]) {
    selectedApp.value = app;
    modalStatus.value = app.status;
    modalNotes.value = app.admin_notes || '';
    customPassword.value = 'tutor123';
}

function closeModal() {
    selectedApp.value = null;
}

function saveStatus() {
    if (!selectedApp.value) return;

    router.post(`/admin/pendaftaran-tutor/${selectedApp.value.id}/status`, {
        status: modalStatus.value,
        admin_notes: modalNotes.value,
        custom_password: customPassword.value,
    }, {
        onSuccess: () => closeModal(),
    });
}

function filterBy(status: string) {
    router.get('/admin/pendaftaran-tutor', status === 'all' ? {} : { status });
}

function getStatusBadge(status: string) {
    switch (status) {
        case 'menunggu':
            return { label: 'Menunggu', class: 'bg-amber-100 text-amber-800 border-amber-200' };
        case 'sedang_ditinjau':
            return { label: 'Sedang Ditinjau', class: 'bg-blue-100 text-blue-800 border-blue-200' };
        case 'diterima':
            return { label: 'Diterima (Akun Aktif)', class: 'bg-emerald-100 text-emerald-800 border-emerald-200' };
        case 'ditolak':
            return { label: 'Ditolak', class: 'bg-rose-100 text-rose-800 border-rose-200' };
        default:
            return { label: status, class: 'bg-slate-100 text-slate-800 border-slate-200' };
    }
}
</script>

<template>
    <Head title="Manajemen Pendaftaran Calon Tutor | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">
                    Pendaftaran & Seleksi Calon Tutor
                </h1>
                <p class="mt-1 text-xs text-slate-500">
                    Tinjau biodata, pengalaman, dan tentukan penerimaan calon tenaga pengajar.
                </p>
            </div>
        </div>

        <!-- FILTER TABS -->
        <div class="flex flex-wrap items-center gap-2 border-b border-purple-100 pb-3">
            <button
                @click="filterBy('all')"
                class="rounded-xl px-4 py-2 text-xs font-bold transition"
                :class="currentFilter === 'all' ? 'bg-purple-600 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-purple-50'"
            >
                Semua ({{ counts.all }})
            </button>

            <button
                @click="filterBy('menunggu')"
                class="rounded-xl px-4 py-2 text-xs font-bold transition"
                :class="currentFilter === 'menunggu' ? 'bg-amber-500 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-amber-50'"
            >
                Menunggu ({{ counts.menunggu }})
            </button>

            <button
                @click="filterBy('sedang_ditinjau')"
                class="rounded-xl px-4 py-2 text-xs font-bold transition"
                :class="currentFilter === 'sedang_ditinjau' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-blue-50'"
            >
                Sedang Ditinjau ({{ counts.sedang_ditinjau }})
            </button>

            <button
                @click="filterBy('diterima')"
                class="rounded-xl px-4 py-2 text-xs font-bold transition"
                :class="currentFilter === 'diterima' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-emerald-50'"
            >
                Diterima ({{ counts.diterima }})
            </button>

            <button
                @click="filterBy('ditolak')"
                class="rounded-xl px-4 py-2 text-xs font-bold transition"
                :class="currentFilter === 'ditolak' ? 'bg-rose-600 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-rose-50'"
            >
                Ditolak ({{ counts.ditolak }})
            </button>
        </div>

        <!-- TABLE OF APPLICANTS -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Nama & Email</th>
                            <th class="px-6 py-4">Keahlian & Pendidikan</th>
                            <th class="px-6 py-4">Pengalaman</th>
                            <th class="px-6 py-4">Status Seleksi</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="app in applications" :key="app.id" class="hover:bg-purple-50/30 transition">
                            <td class="px-6 py-4">
                                <p class="font-extrabold text-slate-900">{{ app.name }}</p>
                                <p class="text-[11px] text-slate-400">{{ app.email }} • {{ app.phone }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-purple-700">{{ app.subject_specialization }}</p>
                                <p class="text-[11px] text-slate-500">{{ app.education }}</p>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-700">
                                {{ app.experience_years }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full border px-3 py-1 text-[10px] font-extrabold" :class="getStatusBadge(app.status).class">
                                    {{ getStatusBadge(app.status).label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    @click="openModal(app)"
                                    class="rounded-xl bg-purple-100 px-3.5 py-1.5 text-xs font-bold text-purple-800 hover:bg-purple-200 transition"
                                >
                                    Tinjau Berkas & Aksi
                                </button>
                            </td>
                        </tr>

                        <tr v-if="applications.length === 0">
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                Tidak ada data pendaftaran calon tutor pada kategori ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- REVIEW & ACTION MODAL -->
        <div
            v-if="selectedApp"
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm"
        >
            <div class="w-full max-w-2xl rounded-3xl bg-white p-6 shadow-2xl sm:p-8 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-900">
                            Detail Calon Tutor
                        </h2>
                        <p class="text-xs text-slate-500">Periksa kualifikasi dan putuskan status seleksi.</p>
                    </div>
                    <button @click="closeModal" class="text-slate-400 hover:text-slate-600 text-xl font-bold">
                        ✕
                    </button>
                </div>

                <div class="mt-5 space-y-4 text-xs">
                    <div class="grid grid-cols-2 gap-4 rounded-2xl bg-purple-50/60 p-4 border border-purple-100">
                        <div>
                            <span class="text-slate-500">Nama Lengkap:</span>
                            <p class="font-extrabold text-slate-900 text-sm">{{ selectedApp.name }}</p>
                        </div>
                        <div>
                            <span class="text-slate-500">Email & Telepon:</span>
                            <p class="font-bold text-slate-800">{{ selectedApp.email }}</p>
                            <p class="text-slate-600">{{ selectedApp.phone }}</p>
                        </div>
                        <div>
                            <span class="text-slate-500">Pendidikan Terakhir:</span>
                            <p class="font-bold text-slate-800">{{ selectedApp.education }}</p>
                        </div>
                        <div>
                            <span class="text-slate-500">Mata Pelajaran:</span>
                            <p class="font-bold text-purple-700">{{ selectedApp.subject_specialization }}</p>
                        </div>
                    </div>

                    <div>
                        <span class="font-bold text-slate-700">Motivasi & Pendekatan Mengajar:</span>
                        <p class="mt-1 rounded-xl bg-slate-50 p-3 text-slate-600 leading-relaxed border border-slate-100">
                            {{ selectedApp.motivation }}
                        </p>
                    </div>

                    <div v-if="selectedApp.portfolio_url">
                        <span class="font-bold text-slate-700">Tautan Portofolio / CV:</span>
                        <a :href="selectedApp.portfolio_url" target="_blank" class="mt-1 block text-purple-600 hover:underline">
                            {{ selectedApp.portfolio_url }} ↗
                        </a>
                    </div>

                    <!-- ACTION FORM -->
                    <div class="border-t border-slate-100 pt-4 space-y-4">
                        <h3 class="text-xs font-extrabold uppercase tracking-wider text-purple-900">
                            Keputusan Admin
                        </h3>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1.5">Ubah Status Seleksi</label>
                            <select
                                v-model="modalStatus"
                                class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs font-bold text-slate-800 focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-100"
                            >
                                <option value="menunggu">Menunggu</option>
                                <option value="sedang_ditinjau">Sedang Ditinjau</option>
                                <option value="diterima">Diterima (Aktifkan Akun Tutor)</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>

                        <!-- PASSWORD INPUT IF ACCEPTED -->
                        <div v-if="modalStatus === 'diterima'" class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 space-y-2">
                            <p class="font-bold text-emerald-900 text-xs">
                                ✓ Sistem akan otomatis membuat akun login Tutor untuk email ini.
                            </p>
                            <div>
                                <label class="block text-[11px] font-bold text-emerald-800 mb-1">
                                    Kata Sandi Akun Tutor (Default: tutor123)
                                </label>
                                <input
                                    v-model="customPassword"
                                    type="text"
                                    class="h-10 w-full rounded-xl border border-emerald-300 bg-white px-3 text-xs font-semibold focus:outline-none"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1.5">Catatan Seleksi / Alasan</label>
                            <textarea
                                v-model="modalNotes"
                                rows="3"
                                placeholder="Contoh: Lulus microteaching dengan nilai A+, ditugaskan untuk mengajar SMA."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 p-3 text-xs focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-100"
                            ></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-3 border-t border-slate-100 pt-4">
                    <button
                        @click="closeModal"
                        class="rounded-xl px-4 py-2 text-xs font-bold text-slate-500 hover:bg-slate-100"
                    >
                        Batal
                    </button>
                    <button
                        @click="saveStatus"
                        class="rounded-xl bg-purple-600 px-5 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700"
                    >
                        Simpan Keputusan →
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>
