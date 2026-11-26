<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import TutorLayout from '@/layouts/TutorLayout.vue';

defineOptions({
    layout: TutorLayout,
});

defineProps<{
    announcements: Array<{
        id: number;
        title: string;
        content: string;
        is_pinned: boolean;
        created_at: string;
        author?: { name: string };
    }>;
}>();
</script>

<template>
    <Head title="Pengumuman Akademik | BimbelPro" />

    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Pengumuman & Informasi</h1>
                <p class="mt-1 text-xs text-slate-500">Pemberitahuan resmi dan arahan pembelajaran dari Administrator bimbel.</p>
            </div>
        </div>

        <!-- LIST OF ANNOUNCEMENTS -->
        <div class="space-y-4">
            <div
                v-for="ann in announcements"
                :key="ann.id"
                class="rounded-3xl border bg-white p-6 shadow-sm transition hover:shadow-md"
                :class="ann.is_pinned ? 'border-purple-300 ring-2 ring-purple-100' : 'border-purple-100'"
            >
                <div class="flex items-center justify-between">
                    <span v-if="ann.is_pinned" class="rounded-full bg-purple-100 px-3 py-1 text-[10px] font-bold text-purple-700">
                        📌 Pengumuman Penting
                    </span>
                    <span class="text-xs text-slate-400">{{ ann.created_at }}</span>
                </div>

                <h3 class="mt-3 text-base font-extrabold text-slate-900">{{ ann.title }}</h3>
                <p class="mt-2 text-xs text-slate-600 leading-relaxed">{{ ann.content }}</p>

                <div class="mt-4 border-t border-slate-100 pt-3 text-[11px] font-semibold text-slate-400">
                    Oleh: {{ ann.author?.name ?? 'Administrator BimbelPro' }}
                </div>
            </div>

            <div v-if="announcements.length === 0" class="rounded-3xl border border-dashed border-slate-200 bg-white p-12 text-center text-slate-400 text-xs">
                Belum ada pengumuman untuk Anda.
            </div>
        </div>

    </div>
</template>
