<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

defineProps<{
    payments: Array<{
        id: number;
        payment_number: string;
        amount: number;
        payment_date: string;
        payment_method: string;
        status: string;
        notes?: string | null;
        student: { id: number; name: string };
        invoice: { id: number; invoice_number: string; title: string };
    }>;
    unpaidInvoices: Array<{
        id: number;
        invoice_number: string;
        title: string;
        amount: number;
        student: { name: string };
    }>;
    totalPaid: number;
}>();

const isModalOpen = ref(false);

const form = useForm({
    invoice_id: '',
    amount: 0,
    payment_date: new Date().toISOString().split('T')[0],
    payment_method: 'transfer_bank',
    notes: 'Pembayaran terkonfirmasi oleh Admin',
});

function onSelectInvoice(unpaidInvoices: any[]) {
    const inv = unpaidInvoices.find(i => String(i.id) === form.invoice_id);
    if (inv) {
        form.amount = inv.amount;
    }
}

function submitForm() {
    form.post('/admin/pembayaran', {
        onSuccess: () => { isModalOpen.value = false; },
    });
}

function formatRupiah(amount: number) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(amount);
}
</script>

<template>
    <Head title="Pencatatan Pembayaran Siswa | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Riwayat Pembayaran Siswa</h1>
                <p class="mt-1 text-xs text-slate-500">Mencatat penerimaan pembayaran SPP dan modul belajar siswa.</p>
            </div>

            <button
                @click="isModalOpen = true"
                class="inline-flex items-center gap-2 rounded-2xl bg-purple-600 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-purple-500/20 hover:bg-purple-700 transition"
            >
                <span>+ Catat Pembayaran Baru</span>
            </button>
        </div>

        <!-- TOTAL CARD -->
        <div class="rounded-3xl border border-purple-200 bg-gradient-to-r from-purple-900 to-indigo-900 p-6 text-white shadow-lg">
            <span class="text-[10px] font-bold tracking-widest text-purple-200 uppercase">TOTAL PEMBAYARAN MASUK TERVERIFIKASI</span>
            <h2 class="mt-2 text-3xl font-extrabold">{{ formatRupiah(totalPaid) }}</h2>
        </div>

        <!-- PAYMENTS TABLE -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Nomor Pembayaran</th>
                            <th class="px-6 py-4">Nama Siswa</th>
                            <th class="px-6 py-4">Invoice Terkait</th>
                            <th class="px-6 py-4">Nominal Bayar</th>
                            <th class="px-6 py-4">Tanggal & Metode</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="p in payments" :key="p.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4 font-mono font-bold text-purple-700">{{ p.payment_number }}</td>
                            <td class="px-6 py-4 font-extrabold text-slate-900">{{ p.student.name }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800">{{ p.invoice.title }}</span>
                                <span class="block text-[10px] text-slate-400 font-mono">{{ p.invoice.invoice_number }}</span>
                            </td>
                            <td class="px-6 py-4 font-extrabold text-emerald-600">{{ formatRupiah(p.amount) }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-700">{{ p.payment_date }}</span>
                                <span class="block text-[10px] text-purple-600 font-semibold uppercase">{{ p.payment_method }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 text-[10px] font-extrabold">
                                    {{ p.status }}
                                </span>
                            </td>
                        </tr>

                        <tr v-if="payments.length === 0">
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                Belum ada riwayat pembayaran yang tersimpan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm">
            <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl sm:p-8">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                    <h2 class="text-base font-extrabold text-slate-900">Catat Pembayaran Tagihan</h2>
                    <button @click="isModalOpen = false" class="text-slate-400 text-xl font-bold">✕</button>
                </div>

                <form @submit.prevent="submitForm" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Pilih Tagihan Belum Lunas *</label>
                        <select
                            v-model="form.invoice_id"
                            @change="onSelectInvoice(unpaidInvoices)"
                            required
                            class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none"
                        >
                            <option value="">Pilih Invoice Siswa</option>
                            <option v-for="inv in unpaidInvoices" :key="inv.id" :value="inv.id">
                                {{ inv.student.name }} — {{ inv.title }} ({{ formatRupiah(inv.amount) }})
                            </option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Jumlah Bayar (Rp) *</label>
                            <input v-model="form.amount" required type="number" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Tanggal Bayar *</label>
                            <input v-model="form.payment_date" required type="date" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Metode Pembayaran *</label>
                        <select v-model="form.payment_method" required class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none">
                            <option value="transfer_bank">Transfer Bank (BCA / Mandiri / BRI / BNI)</option>
                            <option value="qris">QRIS / E-Wallet</option>
                            <option value="tunai">Tunai / Kasir Bimbel</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Catatan / Bukti Bayar</label>
                        <input v-model="form.notes" type="text" placeholder="No. referensi transfer atau catatan kasir" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="isModalOpen = false" class="rounded-xl px-4 py-2 font-bold text-slate-500">Batal</button>
                        <button type="submit" class="rounded-xl bg-purple-600 px-5 py-2 font-bold text-white hover:bg-purple-700">Validasi & Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
