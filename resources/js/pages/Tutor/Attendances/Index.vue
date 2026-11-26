<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import TutorLayout from '@/layouts/TutorLayout.vue';

defineOptions({
    layout: TutorLayout,
});

const props = defineProps<{
    myClassrooms: Array<{ id: number; name: string }>;
    selectedClassroomId: number;
    selectedDate: string;
    students: Array<{ id: number; name: string; nis: string }>;
    existingAttendances: Record<string, { status: string; notes?: string | null }>;
}>();

const classroomId = ref(props.selectedClassroomId);
const attendanceDate = ref(props.selectedDate);

// Siapkan form array untuk seluruh siswa
const form = useForm({
    classroom_id: props.selectedClassroomId,
    date: props.selectedDate,
    attendances: props.students.map((s) => ({
        student_id: s.id,
        name: s.name,
        nis: s.nis,
        status: props.existingAttendances[s.id]?.status || 'hadir',
        notes: props.existingAttendances[s.id]?.notes || '',
    })),
});

watch(() => props.students, (newStudents) => {
    form.classroom_id = props.selectedClassroomId;
    form.date = props.selectedDate;
    form.attendances = newStudents.map((s) => ({
        student_id: s.id,
        name: s.name,
        nis: s.nis,
        status: props.existingAttendances[s.id]?.status || 'hadir',
        notes: props.existingAttendances[s.id]?.notes || '',
    }));
});

function changeFilter() {
    router.get('/tutor/absensi', {
        classroom_id: classroomId.value,
        date: attendanceDate.value,
    }, { preserveState: false });
}

function submitAttendance() {
    form.post('/tutor/absensi');
}

function setAllStatus(status: 'hadir' | 'izin' | 'sakit' | 'alpa') {
    form.attendances.forEach((item) => {
        item.status = status;
    });
}
</script>

<template>
    <Head title="Input Absensi Siswa | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Presensi Kehadiran Siswa</h1>
                <p class="mt-1 text-xs text-slate-500">
                    Input kehadiran siswa: Hadir, Izin, Sakit, atau Alpa pada kelas yang Anda ampu.
                </p>
            </div>
        </div>

        <!-- FILTER KELAS & TANGGAL -->
        <div class="flex flex-col gap-3 rounded-3xl border border-purple-100 bg-white p-5 shadow-sm sm:flex-row sm:items-center">
            <div class="flex-1">
                <label class="block text-[11px] font-bold text-slate-500 mb-1">Pilih Kelas Saya</label>
                <select
                    v-model="classroomId"
                    @change="changeFilter"
                    class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs font-bold text-slate-800 focus:outline-none focus:border-purple-500"
                >
                    <option v-for="c in myClassrooms" :key="c.id" :value="c.id">{{ c.name }}</option>
                </select>
            </div>

            <div class="w-full sm:w-60">
                <label class="block text-[11px] font-bold text-slate-500 mb-1">Tanggal Sesi</label>
                <input
                    v-model="attendanceDate"
                    @change="changeFilter"
                    type="date"
                    class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-xs font-bold text-slate-800 focus:outline-none focus:border-purple-500"
                />
            </div>

            <div class="pt-5 sm:pt-4">
                <button
                    @click="changeFilter"
                    class="h-11 rounded-xl bg-purple-100 px-5 text-xs font-bold text-purple-800 hover:bg-purple-200 transition"
                >
                    Muat Daftar Siswa
                </button>
            </div>
        </div>

        <!-- FORM ABSENSI SISWA -->
        <div v-if="form.attendances.length > 0" class="overflow-hidden rounded-3xl border border-purple-100 bg-white shadow-sm">
            <div class="flex flex-col justify-between gap-3 border-b border-purple-100 bg-purple-50/50 p-5 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-sm font-extrabold text-purple-950">
                        Daftar Siswa di Kelas Ini ({{ form.attendances.length }} Siswa)
                    </h2>
                    <p class="text-[11px] text-slate-500">Pilih status kehadiran dan tambahkan catatan jika diperlukan.</p>
                </div>

                <!-- QUICK SET ALL BUTTONS -->
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-slate-400">Set Semua:</span>
                    <button
                        type="button"
                        @click="setAllStatus('hadir')"
                        class="rounded-lg bg-emerald-50 border border-emerald-200 px-2.5 py-1 text-[10px] font-bold text-emerald-700 hover:bg-emerald-100"
                    >
                        Hadir Semua
                    </button>
                </div>
            </div>

            <form @submit.prevent="submitAttendance" class="p-5 sm:p-7 space-y-4">
                <div
                    v-for="(item, idx) in form.attendances"
                    :key="item.student_id"
                    class="flex flex-col justify-between gap-4 rounded-2xl border border-slate-100 bg-slate-50/40 p-4 transition hover:bg-purple-50/20 lg:flex-row lg:items-center"
                >
                    <!-- STUDENT INFO -->
                    <div class="min-w-[200px]">
                        <p class="text-sm font-extrabold text-slate-900">{{ item.name }}</p>
                        <p class="text-[11px] text-purple-600 font-mono font-bold">{{ item.nis }}</p>
                    </div>

                    <!-- ATTENDANCE STATUS OPTIONS (HADIR, IZIN, SAKIT, ALPA) -->
                    <div class="flex flex-wrap items-center gap-2">
                        <!-- HADIR -->
                        <label
                            class="flex cursor-pointer items-center gap-1.5 rounded-xl border px-3.5 py-2 text-xs font-bold transition"
                            :class="item.status === 'hadir' ? 'border-emerald-500 bg-emerald-500 text-white shadow-sm' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'"
                        >
                            <input type="radio" v-model="item.status" value="hadir" class="sr-only" />
                            <span>✓ Hadir</span>
                        </label>

                        <!-- IZIN -->
                        <label
                            class="flex cursor-pointer items-center gap-1.5 rounded-xl border px-3.5 py-2 text-xs font-bold transition"
                            :class="item.status === 'izin' ? 'border-blue-500 bg-blue-500 text-white shadow-sm' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'"
                        >
                            <input type="radio" v-model="item.status" value="izin" class="sr-only" />
                            <span>ℹ Izin</span>
                        </label>

                        <!-- SAKIT -->
                        <label
                            class="flex cursor-pointer items-center gap-1.5 rounded-xl border px-3.5 py-2 text-xs font-bold transition"
                            :class="item.status === 'sakit' ? 'border-amber-500 bg-amber-500 text-white shadow-sm' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'"
                        >
                            <input type="radio" v-model="item.status" value="sakit" class="sr-only" />
                            <span>✚ Sakit</span>
                        </label>

                        <!-- ALPA -->
                        <label
                            class="flex cursor-pointer items-center gap-1.5 rounded-xl border px-3.5 py-2 text-xs font-bold transition"
                            :class="item.status === 'alpa' ? 'border-rose-500 bg-rose-500 text-white shadow-sm' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'"
                        >
                            <input type="radio" v-model="item.status" value="alpa" class="sr-only" />
                            <span>✕ Alpa</span>
                        </label>
                    </div>

                    <!-- NOTES -->
                    <div class="w-full lg:w-64">
                        <input
                            v-model="item.notes"
                            type="text"
                            placeholder="Catatan (opsional)..."
                            class="h-9 w-full rounded-xl border border-slate-200 bg-white px-3 text-xs focus:border-purple-500 focus:outline-none"
                        />
                    </div>
                </div>

                <!-- SUBMIT ACTION -->
                <div class="flex items-center justify-between border-t border-slate-100 pt-5">
                    <span class="text-xs text-slate-400">
                        Presensi akan langsung tersimpan dan terhubung ke laporan Admin.
                    </span>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-2xl bg-gradient-to-r from-purple-600 to-indigo-600 px-7 py-3 text-xs font-extrabold text-white shadow-lg shadow-purple-500/25 hover:brightness-110 disabled:opacity-50 transition"
                    >
                        {{ form.processing ? 'Menyimpan Presensi...' : 'Simpan Presensi Kehadiran →' }}
                    </button>
                </div>
            </form>
        </div>

        <div v-else class="rounded-3xl border border-dashed border-slate-200 bg-white p-12 text-center">
            <p class="text-sm font-bold text-slate-700">Tidak ada siswa terdaftar di kelas ini</p>
            <p class="mt-1 text-xs text-slate-400">Silakan hubungi Admin akademik untuk menambahkan siswa ke rombongan belajar Anda.</p>
        </div>

    </div>
</template>
