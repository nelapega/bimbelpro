<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

defineProps<{
    tutors: Array<{
        id: number;
        name: string;
        email: string;
        classrooms_count: number;
        schedules_count: number;
        tutor_application?: {
            subject_specialization?: string;
            education?: string;
            phone?: string;
            experience_years?: string;
        };
    }>;
}>();

const editingTutor = ref<any>(null);
const form = useForm({
    name: '',
    email: '',
});

function openEdit(tutor: any) {
    editingTutor.value = tutor;
    form.name = tutor.name;
    form.email = tutor.email;
}

function submitEdit() {
    if (!editingTutor.value) return;
    form.put(`/admin/tutor/${editingTutor.value.id}`, {
        onSuccess: () => { editingTutor.value = null; },
    });
}
</script>

<template>
    <Head title="Data Tutor Pengajar | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">
                    Data Tenaga Pengajar (Tutor)
                </h1>
                <p class="mt-1 text-xs text-slate-500">
                    Kelola profil, mata pelajaran, dan penugasan kelas tutor yang telah aktif.
                </p>
            </div>
        </div>

        <!-- TUTORS GRID -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="tutor in tutors"
                :key="tutor.id"
                class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm transition hover:shadow-lg hover:shadow-purple-500/5"
            >
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-600 text-base font-extrabold text-white shadow-md">
                        {{ tutor.name.charAt(0) }}
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900">{{ tutor.name }}</h3>
                        <p class="text-xs text-purple-700 font-bold">
                            {{ tutor.tutor_application?.subject_specialization ?? 'Tutor Bimbel' }}
                        </p>
                    </div>
                </div>

                <div class="mt-5 space-y-2 rounded-2xl bg-purple-50/60 p-4 text-xs">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Email:</span>
                        <span class="font-semibold text-slate-800">{{ tutor.email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Pendidikan:</span>
                        <span class="font-semibold text-slate-800 truncate max-w-[150px]">{{ tutor.tutor_application?.education ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Kelas Diampu:</span>
                        <span class="font-bold text-purple-700">{{ tutor.classrooms_count }} Kelas</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Jadwal Sesi:</span>
                        <span class="font-bold text-purple-700">{{ tutor.schedules_count }} Sesi / Minggu</span>
                    </div>
                </div>

                <div class="mt-5 flex items-center justify-end">
                    <button
                        @click="openEdit(tutor)"
                        class="rounded-xl bg-purple-50 px-4 py-2 text-xs font-bold text-purple-700 hover:bg-purple-100 transition"
                    >
                        Edit Profil Tutor
                    </button>
                </div>
            </div>
        </div>

        <!-- EDIT MODAL -->
        <div v-if="editingTutor" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm">
            <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
                <h2 class="text-base font-extrabold text-slate-900 mb-4">Edit Data Tutor</h2>
                <form @submit.prevent="submitEdit" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nama Lengkap</label>
                        <input v-model="form.name" type="text" required class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Alamat Email</label>
                        <input v-model="form.email" type="email" required class="h-10 w-full rounded-xl border border-slate-200 px-3 focus:border-purple-500 focus:outline-none" />
                    </div>
                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="editingTutor = null" class="rounded-xl px-4 py-2 text-xs font-bold text-slate-500">Batal</button>
                        <button type="submit" class="rounded-xl bg-purple-600 px-5 py-2 text-xs font-bold text-white hover:bg-purple-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
