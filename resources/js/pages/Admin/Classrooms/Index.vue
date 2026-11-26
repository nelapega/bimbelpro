<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

const props = defineProps<{
    classrooms: Array<{
        id: number;
        name: string;
        subject: string;
        grade_level: string;
        capacity: number;
        room?: string | null;
        status: string;
        students_count: number;
        tutor?: { id: number; name: string };
    }>;
    tutors: Array<{ id: number; name: string }>;
}>();

const isModalOpen = ref(false);
const editingClassroom = ref<any>(null);

const form = useForm({
    name: '',
    subject: '',
    grade_level: 'SMA',
    capacity: 20,
    tutor_id: '',
    room: '',
    status: 'aktif',
});

function openCreate() {
    editingClassroom.value = null;
    form.reset();
    form.status = 'aktif';
    form.capacity = 20;
    isModalOpen.value = true;
}

function openEdit(c: any) {
    editingClassroom.value = c;
    form.name = c.name;
    form.subject = c.subject;
    form.grade_level = c.grade_level;
    form.capacity = c.capacity;
    form.tutor_id = c.tutor ? String(c.tutor.id) : '';
    form.room = c.room || '';
    form.status = c.status;
    isModalOpen.value = true;
}

function submitForm() {
    if (editingClassroom.value) {
        form.put(`/admin/kelas/${editingClassroom.value.id}`, {
            onSuccess: () => { isModalOpen.value = false; },
        });
    } else {
        form.post('/admin/kelas', {
            onSuccess: () => { isModalOpen.value = false; },
        });
    }
}

function deleteClassroom(c: any) {
    if (confirm(`Yakin ingin menghapus kelas ${c.name}?`)) {
        router.delete(`/admin/kelas/${c.id}`);
    }
}
</script>

<template>
    <Head title="Data Kelas Belajar | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Data Kelas Bimbingan Belajar</h1>
                <p class="mt-1 text-xs text-slate-500">Atur rombongan belajar, kapasitas kelas, ruang, dan penugasan tutor pengajar.</p>
            </div>

            <button
                @click="openCreate"
                class="inline-flex items-center gap-2 rounded-2xl bg-purple-600 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-purple-500/20 hover:bg-purple-700 transition"
            >
                <span>+ Buat Kelas Baru</span>
            </button>
        </div>

        <!-- TABLE OF CLASSROOMS -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">Nama Kelas</th>
                            <th class="px-6 py-4">Mata Pelajaran & Jenjang</th>
                            <th class="px-6 py-4">Tutor Pengampu</th>
                            <th class="px-6 py-4">Kapasitas Siswa</th>
                            <th class="px-6 py-4">Ruang Belajar</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="c in classrooms" :key="c.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4 font-extrabold text-slate-900">{{ c.name }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-purple-700">{{ c.subject }}</span>
                                <span class="block text-[10px] text-slate-400 font-semibold">{{ c.grade_level }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ c.tutor?.name ?? 'Belum Ditugaskan' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900">{{ c.students_count }}</span> / {{ c.capacity }} Siswa
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ c.room ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-0.5 text-[10px] font-bold">
                                    {{ c.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button @click="openEdit(c)" class="rounded-lg bg-purple-50 px-3 py-1 font-bold text-purple-700 hover:bg-purple-100">
                                    Edit
                                </button>
                                <button @click="deleteClassroom(c)" class="rounded-lg bg-rose-50 px-3 py-1 font-bold text-rose-600 hover:bg-rose-100">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL CREATE/EDIT -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm">
            <div class="w-full max-w-lg rounded-3xl bg-white p-6 shadow-2xl sm:p-8">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-4">
                    <h2 class="text-base font-extrabold text-slate-900">
                        {{ editingClassroom ? 'Edit Data Kelas' : 'Buat Kelas Belajar Baru' }}
                    </h2>
                    <button @click="isModalOpen = false" class="text-slate-400 text-xl font-bold">✕</button>
                </div>

                <form @submit.prevent="submitForm" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nama Rombongan Belajar *</label>
                        <input v-model="form.name" required type="text" placeholder="Contoh: 12 IPA Intensif SNBT" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Mata Pelajaran *</label>
                            <input v-model="form.subject" required type="text" placeholder="Matematika / Fisika / dll" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Tingkat Pendidikan *</label>
                            <select v-model="form.grade_level" required class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none">
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="UTBK / Alumni">UTBK / Alumni</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Tutor Pengajar</label>
                            <select v-model="form.tutor_id" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none">
                                <option value="">Pilih Tutor Pengampu</option>
                                <option v-for="t in tutors" :key="t.id" :value="t.id">{{ t.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Kapasitas Maksimal Siswa</label>
                            <input v-model="form.capacity" type="number" min="1" required class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Ruangan Belajar</label>
                        <input v-model="form.room" type="text" placeholder="Ruang Galileo / Ruang Einstein" class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="isModalOpen = false" class="rounded-xl px-4 py-2 font-bold text-slate-500">Batal</button>
                        <button type="submit" class="rounded-xl bg-purple-600 px-5 py-2 font-bold text-white hover:bg-purple-700">Simpan Kelas</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
