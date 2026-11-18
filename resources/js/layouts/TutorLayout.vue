
<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';

const menus = [
    { label: 'Dashboard', icon: '▦', href: '/tutor/dashboard', active: true },
    { label: 'Jadwal Mengajar', icon: '◷' },
    { label: 'Kelas Saya', icon: '▤' },
    { label: 'Data Siswa', icon: '♙' },
    { label: 'Absensi', icon: '✓' },
    { label: 'Profil Saya', icon: '◎' },
];

function logout() {
    router.post('/logout');
}
</script>

<template>
    <div class="min-h-screen bg-[#F5F7FC] text-[#172554]">

        <!-- SIDEBAR -->
        <aside class="fixed inset-y-0 left-0 z-40 hidden w-[255px] flex-col bg-[#142B55] text-white lg:flex">

            <!-- LOGO -->
            <div class="flex h-[82px] items-center gap-3 border-b border-white/10 px-7">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500 shadow-lg">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                        <path d="m2 10 10-6 10 6-10 6-10-6Z"/>
                        <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-extrabold">
                        Bimbel<span class="text-blue-300">Pro</span>
                    </h1>
                    <p class="text-[9px] font-semibold tracking-[2px] text-blue-200">
                        TUTOR PORTAL
                    </p>
                </div>
            </div>

            <!-- MENU -->
            <div class="flex-1 px-4 py-7">
                <p class="mb-4 px-3 text-[10px] font-bold tracking-[1.8px] text-blue-300/70">
                    MENU PEMBELAJARAN
                </p>

                <div class="space-y-2">
                    <template v-for="menu in menus" :key="menu.label">

                        <Link
                            v-if="menu.href && menu.active"
                            :href="menu.href"
                            class="flex items-center gap-3 rounded-xl bg-blue-500 px-3 py-3 text-[13px] font-semibold text-white shadow-lg"
                        >
                            <span class="flex h-6 w-6 items-center justify-center text-lg">
                                {{ menu.icon }}
                            </span>
                            {{ menu.label }}
                        </Link>

                        <div
                            v-else
                            class="flex items-center justify-between rounded-xl px-3 py-3 text-[13px] text-blue-100/75"
                        >
                            <span class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center text-lg">
                                    {{ menu.icon }}
                                </span>
                                {{ menu.label }}
                            </span>

                            <span class="text-[9px] text-blue-300/50">
                                Segera
                            </span>
                        </div>

                    </template>
                </div>
            </div>

            <!-- USER PROFILE -->
            <div class="border-t border-white/10 p-4">
                <div class="mb-4 flex items-center gap-3 rounded-xl bg-white/10 p-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-400 text-sm font-bold">
                        T
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-xs font-bold">
                            {{ $page.props.auth.user.name }}
                        </p>
                        <p class="text-[10px] text-blue-200">
                            Tutor / Pengajar
                        </p>
                    </div>
                </div>

                <button
                    @click="logout"
                    class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-blue-100 transition hover:bg-red-500/20 hover:text-white"
                >
                    <span class="text-lg">↪</span>
                    Keluar
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="min-h-screen lg:pl-[255px]">

            <!-- HEADER -->
            <header class="sticky top-0 z-30 flex h-[76px] items-center justify-between border-b border-slate-100 bg-white/95 px-5 backdrop-blur-xl sm:px-8">
                <div>
                    <h2 class="text-sm font-extrabold text-[#172554] sm:text-base">
                        Portal Tutor
                    </h2>

                    <p class="mt-1 text-[10px] text-slate-400 sm:text-xs">
                        Area pembelajaran dan pengajaran
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden text-right sm:block">
                        <p class="text-xs font-bold text-slate-700">
                            {{ $page.props.auth.user.name }}
                        </p>
                        <p class="text-[10px] text-slate-400">
                            Tutor
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                        T
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="p-5 sm:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>
