<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import TutorLayout from '@/layouts/TutorLayout.vue';

defineOptions({
    layout: TutorLayout,
});

const props = defineProps<{
    tutor: {
        id: number;
        name: string;
        email: string;
    };
    application?: {
        phone?: string;
        education?: string;
        subject_specialization?: string;
        experience_years?: string;
        portfolio_url?: string;
        status?: string;
        admin_notes?: string;
    } | null;
}>();

const form = useForm({
    name: props.tutor.name,
    phone: props.application?.phone || '',
    education: props.application?.education || '',
    subject_specialization: props.application?.subject_specialization || '',
});

function updateProfile() {
    form.put('/tutor/profil');
}
</script>

<template>
    <Head title="Profil Saya | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Profil Saya</h1>
                <p class="mt-1 text-xs text-slate-500">Informasi biodata, kualifikasi pengajar, dan data akun Tutor Anda.</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            <!-- PROFILE SUMMARY CARD -->
            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm text-center">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-tr from-purple-600 to-indigo-600 text-2xl font-extrabold text-white shadow-xl shadow-purple-500/20">
                    {{ tutor.name.charAt(0) }}
                </div>

                <h2 class="mt-4 text-base font-extrabold text-slate-900">{{ tutor.name }}</h2>
                <p class="text-xs font-semibold text-purple-700">{{ application?.subject_specialization ?? 'Tutor BimbelPro' }}</p>

                <div class="mt-6 rounded-2xl bg-purple-50/60 p-4 text-left text-xs space-y-2">
                    <div>
                        <span class="text-slate-400 block text-[10px]">Email Akun:</span>
                        <span class="font-bold text-slate-800">{{ tutor.email }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[10px]">Status Akun:</span>
                        <span class="rounded-full bg-emerald-100 text-emerald-800 px-2 py-0.5 text-[10px] font-bold">Aktif Terverifikasi</span>
                    </div>
                </div>
            </div>

            <!-- EDIT FORM -->
            <div class="rounded-3xl border border-purple-100 bg-white p-6 shadow-sm lg:col-span-2">
                <h2 class="text-base font-extrabold text-slate-900 pb-3 border-b border-slate-100 mb-5">
                    Perbarui Informasi Pengajar
                </h2>

                <form @submit.prevent="updateProfile" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nama Lengkap & Gelar</label>
                        <input v-model="form.name" required type="text" class="h-11 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nomor WhatsApp</label>
                        <input v-model="form.phone" type="text" class="h-11 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Spesialisasi Mata Pelajaran</label>
                        <input v-model="form.subject_specialization" type="text" class="h-11 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Pendidikan Terakhir</label>
                        <input v-model="form.education" type="text" class="h-11 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-end">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="rounded-xl bg-purple-600 px-6 py-2.5 font-bold text-white shadow-md hover:bg-purple-700 transition"
                        >
                            {{ form.processing ? 'Menyimpan...' : 'Simpan Profil' }}
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</template>
