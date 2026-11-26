<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="min-h-screen bg-[#FAF8FF] font-['Plus_Jakarta_Sans'] lg:grid lg:grid-cols-2">

        <!-- LEFT PANEL (PURPLE CORPORATE) -->
        <section
            class="relative isolate flex min-h-[320px] flex-col overflow-hidden bg-gradient-to-br from-[#2E0854] via-[#4C1D95] to-[#581C87] px-6 py-8 text-white sm:px-10 lg:min-h-screen lg:px-14 lg:py-12"
        >
            <!-- BACKGROUND GLOWS -->
            <div class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-purple-500/25 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-32 h-96 w-96 rounded-full bg-indigo-500/25 blur-3xl"></div>
            <div class="absolute right-12 top-1/3 h-40 w-40 rounded-full border border-white/5"></div>

            <!-- LOGO -->
            <div class="relative z-10">
                <Link :href="home()" class="inline-flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-purple-700 shadow-lg shadow-purple-950/20">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m2 10 10-6 10 6-10 6-10-6Z" />
                            <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5" />
                            <path d="M22 10v6" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-xl font-extrabold tracking-tight">
                            Bimbel<span class="text-purple-300">Pro</span>
                        </h2>
                        <p class="text-[9px] font-semibold tracking-[2px] text-purple-200">
                            LEARNING ECOSYSTEM
                        </p>
                    </div>
                </Link>
            </div>

            <!-- MAIN CONTENT -->
            <div class="relative z-10 my-auto max-w-xl py-10 lg:py-12">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-purple-300/20 bg-purple-400/10 px-4 py-2">
                    <span class="h-2 w-2 rounded-full bg-purple-300"></span>
                    <span class="text-[10px] font-bold tracking-[1.5px] text-purple-100 uppercase">
                        SISTEM TERINTEGRASI
                    </span>
                </div>

                <h1 class="max-w-lg text-3xl leading-tight font-extrabold tracking-tight sm:text-4xl lg:text-5xl">
                    Kelola Bimbingan Belajar
                    <span class="text-purple-300">
                        Lebih Terarah.
                    </span>
                </h1>

                <p class="mt-5 max-w-md text-sm leading-7 text-purple-100/75">
                    Satu sistem terpadu untuk membantu pengelolaan data siswa, pengajar, kelas, jadwal, presensi, administrasi tagihan SPP, dan seleksi tutor.
                </p>

                <!-- DASHBOARD MINI PREVIEW -->
                <div class="mt-10 hidden max-w-md rounded-2xl border border-white/15 bg-white/10 p-5 shadow-2xl backdrop-blur-xl sm:block">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-white">BimbelPro Control Center</p>
                            <p class="mt-0.5 text-[10px] text-purple-200">Portal Admin & Tutor</p>
                        </div>
                        <span class="rounded-full bg-purple-400/20 px-2.5 py-0.5 text-[9px] font-bold text-purple-200">
                            Online
                        </span>
                    </div>

                    <div class="grid grid-cols-3 gap-2.5 text-center">
                        <div class="rounded-xl bg-white/10 p-3">
                            <p class="text-[10px] text-purple-200">Siswa Aktif</p>
                            <p class="mt-1 text-base font-extrabold">1.200+</p>
                        </div>
                        <div class="rounded-xl bg-white/10 p-3">
                            <p class="text-[10px] text-purple-200">Tutor Ahli</p>
                            <p class="mt-1 text-base font-extrabold">50+</p>
                        </div>
                        <div class="rounded-xl bg-white/10 p-3">
                            <p class="text-[10px] text-purple-200">Kelulusan</p>
                            <p class="mt-1 text-base font-extrabold">98%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="relative z-10 border-t border-white/10 pt-6 text-xs text-purple-200/60">
                &copy; 2026 BimbelPro Management System.
            </div>
        </section>

        <!-- RIGHT PANEL (FORM AREA) -->
        <main class="flex items-center justify-center px-6 py-12 sm:px-10 lg:px-16">
            <div class="w-full max-w-md space-y-7">
                <div v-if="title || description">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
                        {{ title }}
                    </h2>
                    <p v-if="description" class="mt-2 text-sm text-slate-500">
                        {{ description }}
                    </p>
                </div>

                <slot />
            </div>
        </main>

    </div>
</template>
