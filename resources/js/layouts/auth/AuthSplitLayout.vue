
<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="min-h-screen bg-[#F5F7FC] lg:grid lg:grid-cols-2"
    >
        <!-- LEFT PANEL -->
        <section
            class="relative isolate flex min-h-[300px] flex-col overflow-hidden bg-[#142B55] px-6 py-8 text-white sm:px-10 lg:min-h-screen lg:px-14 lg:py-12"
        >
            <!-- BACKGROUND DECORATION -->
            <div
                class="absolute -right-32 -top-32 h-96 w-96 rounded-full bg-blue-500/20 blur-3xl"
            ></div>

            <div
                class="absolute -bottom-40 -left-32 h-96 w-96 rounded-full bg-indigo-500/20 blur-3xl"
            ></div>

            <div
                class="absolute right-12 top-1/3 h-40 w-40 rounded-full border border-white/5"
            ></div>

            <!-- LOGO -->
            <div class="relative z-10">
                <Link
                    :href="home()"
                    class="inline-flex items-center gap-3"
                >
                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-blue-700 shadow-lg"
                    >
                        <svg
                            class="h-7 w-7"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="m2 10 10-6 10 6-10 6-10-6Z" />
                            <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5" />
                            <path d="M22 10v6" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-xl font-extrabold tracking-tight">
                            Bimbel<span class="text-blue-300">Pro</span>
                        </h2>
                        <p
                            class="text-[9px] font-semibold tracking-[2px] text-blue-200"
                        >
                            LEARNING MANAGEMENT
                        </p>
                    </div>
                </Link>
            </div>

            <!-- MAIN CONTENT -->
            <div
                class="relative z-10 my-auto max-w-xl py-10 lg:py-12"
            >
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full border border-blue-300/20 bg-blue-400/10 px-4 py-2"
                >
                    <span
                        class="h-2 w-2 rounded-full bg-blue-300"
                    ></span>

                    <span
                        class="text-[10px] font-bold tracking-[1.5px] text-blue-100"
                    >
                        SMART LEARNING MANAGEMENT
                    </span>
                </div>

                <h1
                    class="max-w-lg text-3xl leading-tight font-extrabold tracking-tight sm:text-4xl lg:text-5xl"
                >
                    Kelola Bimbingan Belajar
                    <span class="text-blue-300">
                        Lebih Terarah.
                    </span>
                </h1>

                <p
                    class="mt-5 max-w-md text-sm leading-7 text-blue-100/75"
                >
                    Satu sistem untuk membantu pengelolaan siswa,
                    tutor, kelas, jadwal, absensi, dan administrasi
                    bimbingan belajar secara lebih mudah.
                </p>

                <!-- DASHBOARD MINI PREVIEW -->
                <div
                    class="mt-10 hidden max-w-md rounded-2xl border border-white/15 bg-white/10 p-4 shadow-2xl backdrop-blur-xl sm:block"
                >
                    <div
                        class="mb-5 flex items-center justify-between"
                    >
                        <div>
                            <p class="text-xs font-bold text-white">
                                BimbelPro Dashboard
                            </p>
                            <p class="mt-1 text-[9px] text-blue-200">
                                Ringkasan sistem manajemen
                            </p>
                        </div>

                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/10"
                        >
                            <svg
                                class="h-4 w-4 text-blue-200"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect x="3" y="3" width="7" height="7" rx="1" />
                                <rect x="14" y="3" width="7" height="7" rx="1" />
                                <rect x="3" y="14" width="7" height="7" rx="1" />
                                <rect x="14" y="14" width="7" height="7" rx="1" />
                            </svg>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div class="rounded-xl bg-white/10 p-3">
                            <svg
                                class="mb-3 h-5 w-5 text-blue-200"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <circle cx="9" cy="8" r="4" />
                                <path d="M3 21v-2a6 6 0 0 1 12 0v2" />
                                <path d="M17 8h5M19.5 5.5v5" />
                            </svg>
                            <p class="text-[9px] text-blue-200">
                                Siswa
                            </p>
                            <p class="mt-1 text-lg font-extrabold">
                                —
                            </p>
                        </div>

                        <div class="rounded-xl bg-white/10 p-3">
                            <svg
                                class="mb-3 h-5 w-5 text-indigo-200"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 21a8 8 0 0 1 16 0" />
                            </svg>
                            <p class="text-[9px] text-blue-200">
                                Tutor
                            </p>
                            <p class="mt-1 text-lg font-extrabold">
                                —
                            </p>
                        </div>

                        <div class="rounded-xl bg-white/10 p-3">
                            <svg
                                class="mb-3 h-5 w-5 text-emerald-200"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z" />
                            </svg>
                            <p class="text-[9px] text-blue-200">
                                Kelas
                            </p>
                            <p class="mt-1 text-lg font-extrabold">
                                —
                            </p>
                        </div>
                    </div>

                    <div
                        class="mt-4 flex items-center gap-3 rounded-xl border border-white/10 bg-white/5 p-3"
                    >
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-400/20 text-blue-200"
                        >
                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M8 2v4M16 2v4M3 10h18" />
                                <rect x="3" y="4" width="18" height="18" rx="2" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-[10px] font-bold text-white">
                                Jadwal Pembelajaran
                            </p>
                            <p class="mt-1 text-[9px] text-blue-200">
                                Semua aktivitas dalam satu sistem
                            </p>
                        </div>

                        <span class="ml-auto text-blue-200">→</span>
                    </div>
                </div>
            </div>

            <!-- BOTTOM TEXT -->
            <div
                class="relative z-10 hidden border-t border-white/10 pt-6 text-[10px] text-blue-200/70 sm:block"
            >
                Sistem Informasi Manajemen Bimbingan Belajar Berbasis Web.
            </div>
        </section>

        <!-- RIGHT PANEL -->
        <section
            class="flex min-h-[500px] items-center justify-center px-5 py-12 sm:px-10 lg:min-h-screen lg:px-12"
        >
            <div class="w-full max-w-[420px]">
                <!-- MOBILE BRAND -->
                <div class="mb-10 flex items-center gap-2 lg:hidden">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white"
                    >
                        <svg
                            class="h-6 w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="m2 10 10-6 10 6-10 6-10-6Z" />
                            <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5" />
                        </svg>
                    </div>

                    <span class="text-lg font-extrabold text-[#142B55]">
                        Bimbel<span class="text-blue-600">Pro</span>
                    </span>
                </div>

                <!-- FORM HEADING -->
                <div class="mb-8">
                    <div
                        class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600"
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <path d="m10 17 5-5-5-5M15 12H3" />
                        </svg>
                    </div>

                    <h2
                        v-if="title"
                        class="text-2xl font-extrabold tracking-tight text-[#142B55] sm:text-3xl"
                    >
                        {{ title }}
                    </h2>

                    <p
                        v-if="description"
                        class="mt-3 text-sm leading-6 text-slate-500"
                    >
                        {{ description }}
                    </p>
                </div>

                <!-- FORM CONTENT -->
                <slot />

                <!-- FOOTER -->
                <div
                    class="mt-10 border-t border-slate-100 pt-6 text-center"
                >
                    <p class="text-[10px] leading-5 text-slate-400">
                        © {{ new Date().getFullYear() }} BimbelPro.
                        All rights reserved.
                    </p>
                </div>
            </div>
        </section>
    </div>
</template>
