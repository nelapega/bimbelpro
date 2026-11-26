<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

const props = defineProps<{
    schedules: Array<{
        id: number;
        day: string;
        start_time: string;
        end_time: string;
        room?: string | null;
        topic?: string | null;
        classroom: { id: number; name: string };
        tutor: { id: number; name: string };
    }>;
    classrooms: Array<{ id: number; name: string; tutor_id?: number | null }>;
    tutors: Array<{ id: number; name: string }>;
}>();

const isModalOpen = ref(false);

const form = useForm({
    classroom_id: '',
    tutor_id: '',
    day: 'Senin',
    start_time: '15:30',
    end_time: '17:00',
    room: '',
    topic: '',
});

function openCreate() {
    form.reset();
    form.day = 'Senin';
    form.start_time = '15:30';
    form.end_time = '17:00';
    isModalOpen.value = true;
}

function submitForm() {
    form.post('/admin/jadwal', {
        onSuccess: () => { isModalOpen.value = false; },
    });
}

function deleteSchedule(item: any) {
    if (confirm(`Hapus jadwal ${item.day} ${item.classroom.name}?`)) {
        router.delete(`/admin/jadwal/${item.id}`);
    }
}
</script>

<template>
    <Head title="Jadwal Pembelajaran | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Jadwal Sesi Pembelajaran</h1>
                <p class="mt-1 text-xs text-slate-500">Kelola jadwal belajar mingguan, alokasi ruangan, dan penugasan tutor.</p>
            </div>

            <button
                @click="openCreate"
                class="inline-flex items-center gap-2 rounded-2xl bg-purple-600 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-purple-500/20 hover:bg-purple-700 transition"
            >
                <span>+ Tambah Jadwal Baru</span>
            </button>
        </div>

        <!-- SCHEDULES TABLE -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Hari & Jam</th>
                            <th class="px-6 py-4">Kelas Belajar</th>
                            <th class="px-6 py-4">Tutor Pengajar</th>
                            <th class="px-6 py-4">Ruangan</th>
                            <th class="px-6 py-4">Materi / Topik</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="s in schedules" :key="s.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4">
                                <span class="font-extrabold text-purple-800 text-sm block">{{ s.day }}</span>
                                <span class="text-[11px] font-semibold text-slate-500">{{ s.start_time }} - {{ s.end_time }} WIB</span>
                            </td>
                            <td class="px-6 py-4 font-extrabold text-slate-900">{{ s.classroom.name }}</td>
                            <td class="px-6 py-4 font-bold text-slate-800">{{ s.tutor.name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ s.room ?? '—' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ s.topic ?? '—' }}</td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    @click="deleteSchedule(s)"
                                    class="rounded-lg bg-rose-50 px-3 py-1 font-bold text-rose-600 hover:bg-rose-100"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>

                        <tr v-if="schedules.length === 0">
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                Belum ada jadwal yang tersimpan.
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
                    <h2 class="text-base font-extrabold text-slate-900">Tambah Jadwal Baru</h2>
                    <button @click="isModalOpen = false" class="text-slate-400 text-xl font-bold">✕</button>
                </div>

                <form @submit.prevent="submitForm" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Pilih Kelas *</label>
                        <select v-model="form.classroom_id" required class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none">
                            <option value="">Pilih Kelas</option>
                            <option v-for="c in classrooms" :key="c.id" :value="c.id">{{ c.name }}</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Tutor Pengajar *</label>
                        <select v-model="form.tutor_id" required class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none">
                            <option value="">Pilih Tutor</option>
                            <option v-for="t in tutors" :key="t.id" :value="t.id">{{ t.name }}</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Hari *</label>
                            <select v-model="form.day" required class="h-10 w-full rounded-xl border border-slate-200 px-2 focus:border-purple-500 focus:outline-none">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Mulai</label>
                            <input v-model="form.start_time" required type="text" placeholder="15:30" class="h-10 w-full rounded-xl border border-slate-200 px-2 focus:border-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Selesai</label>
                            <input v-model="form.end_time" required type="text" placeholder="17:00" class="h-10 w-full rounded-xl border border-slate-200 px-2 focus:border-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Ruangan</label>
                        <input v-model="form.room" type="text" placeholder="Ruang Galileo" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Topik Bahasan</label>
                        <input v-model="form.topic" type="text" placeholder="Kalkulus Lanjut / Bedah Soal UTBK" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="isModalOpen = false" class="rounded-xl px-4 py-2 font-bold text-slate-500">Batal</button>
                        <button type="submit" class="rounded-xl bg-purple-600 px-5 py-2 font-bold text-white hover:bg-purple-700">Simpan Jadwal</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
