<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

const props = defineProps<{
    invoices: Array<{
        id: number;
        invoice_number: string;
        title: string;
        amount: number;
        due_date: string;
        status: string;
        notes?: string | null;
        student: { id: number; name: string; nis: string };
    }>;
    students: Array<{ id: number; name: string; nis: string }>;
    currentStatus: string;
    summary: { total: number; unpaid: number; paid: number };
}>();

const isModalOpen = ref(false);

const form = useForm({
    student_id: '',
    title: 'SPP Bimbingan Belajar',
    amount: 750000,
    due_date: '',
    notes: '',
});

function openCreate() {
    form.reset();
    form.title = 'SPP Bimbingan Belajar';
    form.amount = 750000;
    isModalOpen.value = true;
}

function submitForm() {
    form.post('/admin/tagihan', {
        onSuccess: () => { isModalOpen.value = false; },
    });
}

function filterStatus(st: string) {
    router.get('/admin/tagihan', st === 'all' ? {} : { status: st });
}

function formatRupiah(amount: number) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(amount);
}
</script>

<template>
    <Head title="Manajemen Tagihan SPP | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Manajemen Tagihan & Invoice Siswa</h1>
                <p class="mt-1 text-xs text-slate-500">Buat dan pantau status pelunasan tagihan bimbingan belajar.</p>
            </div>

            <button
                @click="openCreate"
                class="inline-flex items-center gap-2 rounded-2xl bg-purple-600 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-purple-500/20 hover:bg-purple-700 transition"
            >
                <span>+ Buat Tagihan Baru</span>
            </button>
        </div>

        <!-- STATS BADGES -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-2xl border border-purple-100 bg-white p-5 shadow-sm">
                <span class="text-xs font-semibold text-slate-500">Total Nominal Tagihan</span>
                <p class="mt-1 text-2xl font-extrabold text-slate-900">{{ formatRupiah(summary.total) }}</p>
            </div>
            <div class="rounded-2xl border border-amber-200 bg-amber-50/60 p-5 shadow-sm">
                <span class="text-xs font-bold text-amber-700">Piutang Belum Lunas</span>
                <p class="mt-1 text-2xl font-extrabold text-amber-900">{{ formatRupiah(summary.unpaid) }}</p>
            </div>
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/60 p-5 shadow-sm">
                <span class="text-xs font-bold text-emerald-700">Tagihan Sudah Lunas</span>
                <p class="mt-1 text-2xl font-extrabold text-emerald-900">{{ formatRupiah(summary.paid) }}</p>
            </div>
        </div>

        <!-- FILTER TABS -->
        <div class="flex gap-2">
            <button
                @click="filterStatus('all')"
                class="rounded-xl px-4 py-2 text-xs font-bold transition"
                :class="currentStatus === 'all' ? 'bg-purple-600 text-white' : 'bg-white text-slate-600 hover:bg-purple-50'"
            >
                Semua Tagihan
            </button>
            <button
                @click="filterStatus('belum_lunas')"
                class="rounded-xl px-4 py-2 text-xs font-bold transition"
                :class="currentStatus === 'belum_lunas' ? 'bg-amber-500 text-white' : 'bg-white text-slate-600 hover:bg-amber-50'"
            >
                Belum Lunas
            </button>
            <button
                @click="filterStatus('lunas')"
                class="rounded-xl px-4 py-2 text-xs font-bold transition"
                :class="currentStatus === 'lunas' ? 'bg-emerald-600 text-white' : 'bg-white text-slate-600 hover:bg-emerald-50'"
            >
                Lunas
            </button>
        </div>

        <!-- TABLE OF INVOICES -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Nomor Invoice</th>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4">Judul Tagihan</th>
                            <th class="px-6 py-4">Nominal</th>
                            <th class="px-6 py-4">Jatuh Tempo</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="inv in invoices" :key="inv.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4 font-mono font-bold text-purple-700">{{ inv.invoice_number }}</td>
                            <td class="px-6 py-4">
                                <p class="font-extrabold text-slate-900">{{ inv.student.name }}</p>
                                <p class="text-[10px] text-slate-400 font-mono">{{ inv.student.nis }}</p>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ inv.title }}</td>
                            <td class="px-6 py-4 font-extrabold text-slate-900">{{ formatRupiah(inv.amount) }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ inv.due_date }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="rounded-full px-3 py-1 text-[10px] font-extrabold uppercase"
                                    :class="inv.status === 'lunas' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'"
                                >
                                    {{ inv.status === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                                </span>
                            </td>
                        </tr>

                        <tr v-if="invoices.length === 0">
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                Tidak ada tagihan pada kategori ini.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL CREATE -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm">
            <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl sm:p-8">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                    <h2 class="text-base font-extrabold text-slate-900">Buat Tagihan Siswa Baru</h2>
                    <button @click="isModalOpen = false" class="text-slate-400 text-xl font-bold">✕</button>
                </div>

                <form @submit.prevent="submitForm" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Pilih Siswa *</label>
                        <select v-model="form.student_id" required class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none">
                            <option value="">Pilih Siswa Penerima Tagihan</option>
                            <option v-for="s in students" :key="s.id" :value="s.id">{{ s.name }} ({{ s.nis }})</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Judul / Deskripsi Tagihan *</label>
                        <input v-model="form.title" required type="text" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Nominal (Rp) *</label>
                            <input v-model="form.amount" required type="number" step="1000" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Jatuh Tempo *</label>
                            <input v-model="form.due_date" required type="date" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Catatan Tambahan</label>
                        <textarea v-model="form.notes" rows="2" placeholder="Catatan untuk siswa/wali..." class="w-full rounded-xl border border-slate-200 p-2.5 focus:border-purple-500 focus:outline-none"></textarea>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="isModalOpen = false" class="rounded-xl px-4 py-2 font-bold text-slate-500">Batal</button>
                        <button type="submit" class="rounded-xl bg-purple-600 px-5 py-2 font-bold text-white hover:bg-purple-700">Terbitkan Tagihan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
