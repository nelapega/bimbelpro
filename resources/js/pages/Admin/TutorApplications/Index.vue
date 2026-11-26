<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
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
const isSaving = ref(false);

const steps = [
    {
        key: 'menunggu',
        label: 'Menunggu',
        sublabel: 'Berkas diterima sistem',
        icon: '📥',
        desc: 'Pengajuan pendaftaran telah masuk dan menunggu giliran peninjauan oleh tim akademik.',
    },
    {
        key: 'sedang_ditinjau',
        label: 'Sedang Ditinjau',
        sublabel: 'Admin memeriksa berkas',
        icon: '🔍',
        desc: 'Tim akademik sedang memeriksa kualifikasi dan pengalaman mengajar. Jika lolos, calon tutor akan dihubungi untuk wawancara / microteaching.',
    },
    {
        key: 'diterima',
        label: 'Diterima',
        sublabel: 'Akun tutor dibuat otomatis',
        icon: '✅',
        desc: 'Calon tutor dinyatakan LULUS seleksi. Sistem akan otomatis membuat akun login dengan role Tutor.',
    },
];

const mainFlowIndex = computed(() => steps.findIndex(s => s.key === modalStatus.value));
const isRejected = computed(() => modalStatus.value === 'ditolak');

function openModal(app: typeof props.applications[0]) {
    selectedApp.value = app;
    modalStatus.value = app.status;
    modalNotes.value = app.admin_notes || '';
    customPassword.value = 'tutor123';
    isSaving.value = false;
}

function closeModal() {
    selectedApp.value = null;
}

function setStatus(status: string) {
    modalStatus.value = status;
}

function saveStatus() {
    if (!selectedApp.value || isSaving.value) return;
    isSaving.value = true;
    router.post(`/admin/pendaftaran-tutor/${selectedApp.value.id}/status`, {
        status: modalStatus.value,
        admin_notes: modalNotes.value,
        custom_password: customPassword.value,
    }, {
        onSuccess: () => closeModal(),
        onFinish: () => { isSaving.value = false; },
    });
}

function filterBy(status: string) {
    router.get('/admin/pendaftaran-tutor', status === 'all' ? {} : { status });
}

function getStatusBadge(status: string) {
    switch (status) {
        case 'menunggu': return { label: '📥 Menunggu', class: 'bg-amber-100 text-amber-800 border-amber-200' };
        case 'sedang_ditinjau': return { label: '🔍 Ditinjau', class: 'bg-blue-100 text-blue-800 border-blue-200' };
        case 'diterima': return { label: '✅ Diterima', class: 'bg-emerald-100 text-emerald-800 border-emerald-200' };
        case 'ditolak': return { label: '❌ Ditolak', class: 'bg-rose-100 text-rose-800 border-rose-200' };
        default: return { label: status, class: 'bg-slate-100 text-slate-800 border-slate-200' };
    }
}

function formatDate(dateStr: string) {
    return new Date(dateStr).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
}
</script>

<template>
    <Head title="Manajemen Pendaftaran Calon Tutor | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">Pendaftaran & Seleksi Calon Tutor</h1>
            <p class="mt-1 text-xs text-slate-500">Tinjau biodata, perbarui progres seleksi, dan terima atau tolak calon tenaga pengajar.</p>
        </div>

        <!-- STAT CARDS -->
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
            <div class="rounded-2xl border border-amber-100 bg-amber-50 p-4 text-center">
                <p class="text-2xl font-extrabold text-amber-700">{{ counts.menunggu }}</p>
                <p class="mt-0.5 text-[11px] font-semibold text-amber-600">📥 Menunggu</p>
            </div>
            <div class="rounded-2xl border border-blue-100 bg-blue-50 p-4 text-center">
                <p class="text-2xl font-extrabold text-blue-700">{{ counts.sedang_ditinjau }}</p>
                <p class="mt-0.5 text-[11px] font-semibold text-blue-600">🔍 Ditinjau</p>
            </div>
            <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-4 text-center">
                <p class="text-2xl font-extrabold text-emerald-700">{{ counts.diterima }}</p>
                <p class="mt-0.5 text-[11px] font-semibold text-emerald-600">✅ Diterima</p>
            </div>
            <div class="rounded-2xl border border-rose-100 bg-rose-50 p-4 text-center">
                <p class="text-2xl font-extrabold text-rose-700">{{ counts.ditolak }}</p>
                <p class="mt-0.5 text-[11px] font-semibold text-rose-600">❌ Ditolak</p>
            </div>
        </div>

        <!-- FILTER TABS -->
        <div class="flex flex-wrap gap-2 border-b border-purple-100 pb-3">
            <button @click="filterBy('all')" class="rounded-xl px-4 py-2 text-xs font-bold transition" :class="currentFilter === 'all' ? 'bg-purple-600 text-white' : 'bg-white text-slate-600 hover:bg-purple-50'">Semua ({{ counts.all }})</button>
            <button @click="filterBy('menunggu')" class="rounded-xl px-4 py-2 text-xs font-bold transition" :class="currentFilter === 'menunggu' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 hover:bg-amber-50'">📥 Menunggu ({{ counts.menunggu }})</button>
            <button @click="filterBy('sedang_ditinjau')" class="rounded-xl px-4 py-2 text-xs font-bold transition" :class="currentFilter === 'sedang_ditinjau' ? 'bg-blue-600 text-white' : 'bg-white text-slate-600 hover:bg-blue-50'">🔍 Ditinjau ({{ counts.sedang_ditinjau }})</button>
            <button @click="filterBy('diterima')" class="rounded-xl px-4 py-2 text-xs font-bold transition" :class="currentFilter === 'diterima' ? 'bg-emerald-600 text-white' : 'bg-white text-slate-600 hover:bg-emerald-50'">✅ Diterima ({{ counts.diterima }})</button>
            <button @click="filterBy('ditolak')" class="rounded-xl px-4 py-2 text-xs font-bold transition" :class="currentFilter === 'ditolak' ? 'bg-rose-600 text-white' : 'bg-white text-slate-600 hover:bg-rose-50'">❌ Ditolak ({{ counts.ditolak }})</button>
        </div>

        <!-- TABLE -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Nama & Kontak</th>
                            <th class="px-6 py-4">Keahlian</th>
                            <th class="px-6 py-4">Pengalaman</th>
                            <th class="px-6 py-4">Mendaftar</th>
                            <th class="px-6 py-4">Status & Catatan</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="app in applications" :key="app.id" class="hover:bg-purple-50/30 transition">
                            <td class="px-6 py-4">
                                <p class="font-extrabold text-slate-900">{{ app.name }}</p>
                                <p class="text-[11px] text-slate-400">{{ app.email }}</p>
                                <p class="text-[11px] text-slate-400">{{ app.phone }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-purple-700">{{ app.subject_specialization }}</p>
                                <p class="text-[11px] text-slate-500">{{ app.education }}</p>
                            </td>
                            <td class="px-6 py-4 font-semibold">{{ app.experience_years }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ formatDate(app.created_at) }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full border px-3 py-1 text-[10px] font-extrabold" :class="getStatusBadge(app.status).class">
                                    {{ getStatusBadge(app.status).label }}
                                </span>
                                <p v-if="app.admin_notes" class="mt-1 max-w-[180px] truncate text-[10px] text-slate-400 italic">
                                    "{{ app.admin_notes }}"
                                </p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button @click="openModal(app)" class="rounded-xl bg-purple-600 px-3.5 py-1.5 text-xs font-bold text-white hover:bg-purple-700 transition shadow-sm">
                                    Proses →
                                </button>
                            </td>
                        </tr>
                        <tr v-if="applications.length === 0">
                            <td colspan="6" class="py-16 text-center">
                                <p class="text-3xl mb-2">📋</p>
                                <p class="font-bold text-slate-600">Tidak ada pendaftaran di kategori ini.</p>
                                <p class="mt-1 text-xs text-slate-400">Pendaftar baru akan muncul di sini secara otomatis.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================================================================
             MODAL SELEKSI DENGAN STEPPER VISUAL
        ================================================================ -->
        <Teleport to="body">
            <div
                v-if="selectedApp"
                class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm"
                @click.self="closeModal"
            >
                <div class="w-full max-w-2xl rounded-3xl bg-white shadow-2xl max-h-[94vh] overflow-y-auto">

                    <!-- Modal Header -->
                    <div class="sticky top-0 z-10 flex items-center justify-between rounded-t-3xl border-b border-slate-100 bg-white px-6 py-5">
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900">Proses Seleksi Calon Tutor</h2>
                            <p class="text-xs text-slate-500 mt-0.5">{{ selectedApp.name }} • {{ selectedApp.email }}</p>
                        </div>
                        <button @click="closeModal" class="flex h-8 w-8 items-center justify-center rounded-full text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition text-lg font-bold">
                            ✕
                        </button>
                    </div>

                    <div class="p-6 space-y-6">

                        <!-- BIODATA RINGKAS -->
                        <div class="grid grid-cols-2 gap-3 rounded-2xl bg-purple-50/70 p-4 border border-purple-100 text-xs">
                            <div>
                                <span class="text-slate-500">Pendidikan</span>
                                <p class="font-bold text-slate-800 mt-0.5">{{ selectedApp.education }}</p>
                            </div>
                            <div>
                                <span class="text-slate-500">Mata Pelajaran Keahlian</span>
                                <p class="font-bold text-purple-700 mt-0.5">{{ selectedApp.subject_specialization }}</p>
                            </div>
                            <div>
                                <span class="text-slate-500">Pengalaman Mengajar</span>
                                <p class="font-bold text-slate-800 mt-0.5">{{ selectedApp.experience_years }}</p>
                            </div>
                            <div v-if="selectedApp.portfolio_url">
                                <span class="text-slate-500">Portofolio / CV</span>
                                <a :href="selectedApp.portfolio_url" target="_blank" class="block font-bold text-purple-600 hover:underline truncate mt-0.5">Buka Link ↗</a>
                            </div>
                        </div>

                        <!-- MOTIVASI -->
                        <div class="text-xs">
                            <p class="font-bold text-slate-700 mb-1.5">Motivasi & Pendekatan Mengajar:</p>
                            <p class="rounded-xl bg-slate-50 p-3 text-slate-600 leading-relaxed border border-slate-100 max-h-24 overflow-y-auto">
                                {{ selectedApp.motivation }}
                            </p>
                        </div>

                        <!-- ==============================
                             STEPPER PROGRES SELEKSI
                        ============================== -->
                        <div>
                            <p class="text-xs font-extrabold uppercase tracking-wider text-purple-900 mb-5">
                                Perbarui Tahap Seleksi — Klik tahap yang sesuai
                            </p>

                            <!-- MAIN FLOW STEPPER (3 tahap linear) -->
                            <div class="relative mb-5">
                                <!-- Background connector -->
                                <div class="absolute top-5 h-0.5 bg-slate-100 rounded-full" style="left: 56px; right: 56px;"></div>
                                <!-- Filled connector -->
                                <div
                                    class="absolute top-5 h-0.5 rounded-full bg-gradient-to-r from-purple-500 to-indigo-500 transition-all duration-500"
                                    :style="{
                                        left: '56px',
                                        width: isRejected ? '0%' : (mainFlowIndex <= 0 ? '0%' : mainFlowIndex === 1 ? '50%' : '100%'),
                                        maxWidth: 'calc(100% - 112px)',
                                    }"
                                ></div>

                                <div class="relative flex justify-between px-4">
                                    <div
                                        v-for="(step, idx) in steps"
                                        :key="step.key"
                                        class="flex flex-col items-center gap-2 cursor-pointer group"
                                        style="width: 33%"
                                        @click="setStatus(step.key)"
                                    >
                                        <!-- Node circle -->
                                        <div
                                            class="relative z-10 flex h-10 w-10 items-center justify-center rounded-full border-2 text-base font-bold transition-all duration-200"
                                            :class="[
                                                modalStatus === step.key
                                                    ? 'border-purple-500 bg-purple-600 text-white shadow-lg shadow-purple-300/50 scale-110'
                                                    : !isRejected && mainFlowIndex > idx
                                                        ? 'border-emerald-400 bg-emerald-500 text-white'
                                                        : 'border-slate-200 bg-white text-slate-400 group-hover:border-purple-400 group-hover:bg-purple-50 group-hover:text-purple-600'
                                            ]"
                                        >
                                            <span v-if="!isRejected && mainFlowIndex > idx && modalStatus !== step.key">✓</span>
                                            <span v-else>{{ step.icon }}</span>
                                        </div>

                                        <!-- Label -->
                                        <div class="text-center max-w-[80px]">
                                            <p class="text-[10px] font-extrabold leading-tight"
                                                :class="modalStatus === step.key ? 'text-purple-700' : 'text-slate-600'">
                                                {{ step.label }}
                                            </p>
                                            <p class="text-[9px] text-slate-400 leading-tight mt-0.5">{{ step.sublabel }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TOLAK PENGAJUAN - pisah dari main flow -->
                            <div
                                class="flex cursor-pointer items-center gap-3 rounded-2xl border-2 p-3.5 transition-all duration-200"
                                :class="isRejected
                                    ? 'border-rose-400 bg-rose-50 shadow-sm shadow-rose-100'
                                    : 'border-dashed border-slate-200 hover:border-rose-300 hover:bg-rose-50/50'"
                                @click="setStatus('ditolak')"
                            >
                                <span class="text-xl shrink-0">❌</span>
                                <div class="flex-1">
                                    <p class="text-xs font-extrabold" :class="isRejected ? 'text-rose-700' : 'text-slate-600'">Tolak Pengajuan</p>
                                    <p class="text-[10px] mt-0.5" :class="isRejected ? 'text-rose-500' : 'text-slate-400'">Belum memenuhi kualifikasi formasi saat ini</p>
                                </div>
                                <!-- Radio indicator -->
                                <div class="h-5 w-5 rounded-full border-2 flex items-center justify-center shrink-0 transition"
                                    :class="isRejected ? 'border-rose-500 bg-rose-500' : 'border-slate-300'">
                                    <div v-if="isRejected" class="h-2 w-2 rounded-full bg-white"></div>
                                </div>
                            </div>

                            <!-- Deskripsi status yang dipilih -->
                            <div
                                class="mt-4 rounded-2xl border p-4 text-xs leading-relaxed transition-all"
                                :class="isRejected ? 'border-rose-200 bg-rose-50 text-rose-700' : 'border-purple-100 bg-purple-50/50 text-slate-600'"
                            >
                                <p class="font-bold mb-1 text-sm" :class="isRejected ? 'text-rose-800' : 'text-slate-800'">
                                    {{ isRejected ? '❌ Ditolak' : (steps.find(s => s.key === modalStatus)?.icon + ' ' + steps.find(s => s.key === modalStatus)?.label) }}
                                </p>
                                {{ isRejected
                                    ? 'Pengajuan tidak memenuhi kualifikasi yang dibutuhkan saat ini. Tambahkan catatan alasan penolakan agar pendaftar memahami hasilnya.'
                                    : steps.find(s => s.key === modalStatus)?.desc }}
                            </div>

                            <!-- PASSWORD jika diterima -->
                            <div v-if="modalStatus === 'diterima'" class="mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 space-y-3">
                                <p class="text-xs font-bold text-emerald-900">
                                    ✓ Sistem akan otomatis membuat akun login Tutor untuk:
                                    <span class="font-extrabold text-emerald-700">{{ selectedApp.email }}</span>
                                </p>
                                <div>
                                    <label class="block text-[11px] font-bold text-emerald-800 mb-1.5">Kata Sandi Awal Akun Tutor</label>
                                    <input
                                        v-model="customPassword"
                                        type="text"
                                        class="h-10 w-full rounded-xl border border-emerald-300 bg-white px-3 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-emerald-400"
                                        placeholder="Minimal 6 karakter"
                                    />
                                    <p class="mt-1.5 text-[10px] text-emerald-600">⚠ Catat password ini dan berikan ke tutor. Minta mereka menggantinya setelah login pertama.</p>
                                </div>
                            </div>
                        </div>

                        <!-- CATATAN ADMIN -->
                        <div class="text-xs">
                            <label class="block font-bold text-slate-700 mb-1.5">
                                Catatan Seleksi / Alasan Keputusan
                                <span class="ml-1 font-normal text-slate-400">(ditampilkan ke pendaftar saat cek status)</span>
                            </label>
                            <textarea
                                v-model="modalNotes"
                                rows="3"
                                placeholder="Contoh: Lulus wawancara teknis. Ditugaskan mengajar Matematika SMA. Silakan hubungi admin untuk jadwal orientasi."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 p-3 text-xs focus:border-purple-500 focus:outline-none focus:ring-4 focus:ring-purple-100 resize-none"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="sticky bottom-0 flex items-center justify-end gap-3 rounded-b-3xl border-t border-slate-100 bg-white px-6 py-4">
                        <button @click="closeModal" class="rounded-xl px-4 py-2 text-xs font-bold text-slate-500 hover:bg-slate-100 transition">
                            Batal
                        </button>
                        <button
                            @click="saveStatus"
                            :disabled="isSaving"
                            class="rounded-xl px-6 py-2.5 text-xs font-bold text-white shadow-md transition disabled:opacity-70"
                            :class="isRejected
                                ? 'bg-rose-600 hover:bg-rose-700'
                                : modalStatus === 'diterima'
                                    ? 'bg-emerald-600 hover:bg-emerald-700'
                                    : 'bg-purple-600 hover:bg-purple-700'"
                        >
                            <span v-if="isSaving">⏳ Menyimpan...</span>
                            <span v-else-if="modalStatus === 'diterima'">✅ Terima & Aktifkan Akun Tutor</span>
                            <span v-else-if="modalStatus === 'ditolak'">❌ Simpan Penolakan</span>
                            <span v-else>Simpan Progres Seleksi →</span>
                        </button>
                    </div>

                </div>
            </div>
        </Teleport>

    </div>
</template>
