<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({
    layout: AdminLayout,
});

const props = defineProps<{
    students: Array<{
        id: number;
        nis: string;
        name: string;
        email?: string;
        phone?: string;
        grade_level: string;
        school_origin?: string;
        parent_name?: string;
        parent_phone?: string;
        address?: string;
        status: string;
        classroom?: { id: number; name: string };
    }>;
    classrooms: Array<{ id: number; name: string }>;
    filters: { search?: string; classroom_id?: string };
}>();

const searchInput = ref(props.filters.search || '');
const classroomFilter = ref(props.filters.classroom_id || '');

const isModalOpen = ref(false);
const editingStudent = ref<typeof props.students[0] | null>(null);

const form = useForm({
    nis: '',
    name: '',
    classroom_id: '',
    grade_level: 'SMA',
    email: '',
    phone: '',
    school_origin: '',
    parent_name: '',
    parent_phone: '',
    address: '',
    status: 'aktif',
});

function handleFilter() {
    router.get('/admin/siswa', {
        search: searchInput.value || undefined,
        classroom_id: classroomFilter.value || undefined,
    }, { preserveState: true });
}

function openCreateModal() {
    editingStudent.value = null;
    form.reset();
    form.status = 'aktif';
    isModalOpen.value = true;
}

function openEditModal(student: typeof props.students[0]) {
    editingStudent.value = student;
    form.nis = student.nis;
    form.name = student.name;
    form.classroom_id = student.classroom ? String(student.classroom.id) : '';
    form.grade_level = student.grade_level;
    form.email = student.email || '';
    form.phone = student.phone || '';
    form.school_origin = student.school_origin || '';
    form.parent_name = student.parent_name || '';
    form.parent_phone = student.parent_phone || '';
    form.address = student.address || '';
    form.status = student.status;
    isModalOpen.value = true;
}

function closeModal() {
    isModalOpen.value = false;
    editingStudent.value = null;
}

function submitForm() {
    if (editingStudent.value) {
        form.put(`/admin/siswa/${editingStudent.value.id}`, {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post('/admin/siswa', {
            onSuccess: () => closeModal(),
        });
    }
}

function deleteStudent(student: typeof props.students[0]) {
    if (confirm(`Yakin ingin menghapus siswa ${student.name}?`)) {
        router.delete(`/admin/siswa/${student.id}`);
    }
}
</script>

<template>
    <Head title="Data Siswa | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">
                    Data Siswa Bimbingan Belajar
                </h1>
                <p class="mt-1 text-xs text-slate-500">
                    Kelola data identitas, NIS, kelas, dan kontak wali siswa.
                </p>
            </div>

            <button
                @click="openCreateModal"
                class="inline-flex items-center gap-2 rounded-2xl bg-purple-600 px-5 py-2.5 text-xs font-bold text-white shadow-md shadow-purple-500/20 hover:bg-purple-700 transition"
            >
                <span>+ Tambah Siswa Baru</span>
            </button>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="flex flex-col gap-3 rounded-2xl border border-purple-100 bg-white p-4 shadow-sm sm:flex-row sm:items-center">
            <input
                v-model="searchInput"
                @keyup.enter="handleFilter"
                type="text"
                placeholder="Cari nama atau NIS siswa..."
                class="h-10 flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 text-xs focus:border-purple-500 focus:bg-white focus:outline-none"
            />

            <select
                v-model="classroomFilter"
                @change="handleFilter"
                class="h-10 rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs font-medium focus:border-purple-500 focus:outline-none"
            >
                <option value="">Semua Kelas</option>
                <option v-for="c in classrooms" :key="c.id" :value="c.id">{{ c.name }}</option>
            </select>

            <button
                @click="handleFilter"
                class="h-10 rounded-xl bg-purple-100 px-4 text-xs font-bold text-purple-800 hover:bg-purple-200"
            >
                Filter
            </button>
        </div>

        <!-- STUDENTS TABLE -->
        <div class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-purple-50/50 text-[11px] font-extrabold uppercase text-purple-900 border-b border-purple-100">
                        <tr>
                            <th class="px-6 py-4">NIS</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Kelas & Jenjang</th>
                            <th class="px-6 py-4">Asal Sekolah</th>
                            <th class="px-6 py-4">Kontak Wali</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr v-for="s in students" :key="s.id" class="hover:bg-purple-50/20 transition">
                            <td class="px-6 py-4 font-mono font-bold text-purple-700">{{ s.nis }}</td>
                            <td class="px-6 py-4 font-extrabold text-slate-900">{{ s.name }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-800">{{ s.classroom?.name ?? 'Belum Ditentukan' }}</span>
                                <span class="block text-[10px] text-purple-600 font-semibold">{{ s.grade_level }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ s.school_origin ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">{{ s.parent_name ?? '—' }}</p>
                                <p class="text-[10px] text-slate-400">{{ s.parent_phone ?? '' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="rounded-full px-2.5 py-0.5 text-[10px] font-bold"
                                    :class="s.status === 'aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600'"
                                >
                                    {{ s.status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button
                                    @click="openEditModal(s)"
                                    class="rounded-lg bg-purple-50 px-3 py-1 font-bold text-purple-700 hover:bg-purple-100"
                                >
                                    Edit
                                </button>
                                <button
                                    @click="deleteStudent(s)"
                                    class="rounded-lg bg-rose-50 px-3 py-1 font-bold text-rose-600 hover:bg-rose-100"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>

                        <tr v-if="students.length === 0">
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                Tidak ada data siswa yang sesuai pencarian.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- FORM MODAL (ADD / EDIT) -->
        <div
            v-if="isModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm"
        >
            <div class="w-full max-w-xl rounded-3xl bg-white p-6 shadow-2xl sm:p-8 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <h2 class="text-lg font-extrabold text-slate-900">
                        {{ editingStudent ? 'Edit Data Siswa' : 'Tambah Siswa Baru' }}
                    </h2>
                    <button @click="closeModal" class="text-slate-400 hover:text-slate-600 text-xl font-bold">✕</button>
                </div>

                <form @submit.prevent="submitForm" class="mt-5 space-y-4 text-xs">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Nomor Induk Siswa (NIS) *</label>
                            <input v-model="form.nis" required type="text" placeholder="BP-2026-001" class="h-10 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Nama Lengkap *</label>
                            <input v-model="form.name" required type="text" placeholder="Nama siswa" class="h-10 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Pilih Kelas</label>
                            <select v-model="form.classroom_id" class="h-10 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none">
                                <option value="">Tanpa Kelas (Belum Ditempatkan)</option>
                                <option v-for="c in classrooms" :key="c.id" :value="c.id">{{ c.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Jenjang Pendidikan *</label>
                            <select v-model="form.grade_level" required class="h-10 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none">
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="UTBK / Alumni">UTBK / Alumni</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Asal Sekolah</label>
                            <input v-model="form.school_origin" type="text" placeholder="Contoh: SMAN 1 Jakarta" class="h-10 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Status Siswa *</label>
                            <select v-model="form.status" required class="h-10 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                                <option value="lulus">Lulus</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Nama Orang Tua / Wali</label>
                            <input v-model="form.parent_name" type="text" placeholder="Nama wali" class="h-10 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Nomor WhatsApp Wali</label>
                            <input v-model="form.parent_phone" type="text" placeholder="0812345678" class="h-10 w-full rounded-xl border border-slate-200 px-3 text-xs focus:border-purple-500 focus:outline-none" />
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-3 border-t border-slate-100 pt-4">
                        <button type="button" @click="closeModal" class="rounded-xl px-4 py-2 text-xs font-bold text-slate-500 hover:bg-slate-100">Batal</button>
                        <button type="submit" class="rounded-xl bg-purple-600 px-5 py-2 text-xs font-bold text-white shadow-md hover:bg-purple-700">
                            {{ editingStudent ? 'Perbarui Siswa' : 'Simpan Siswa' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
