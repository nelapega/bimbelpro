<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const currentPath = computed(() => page.url);

const menus = [
    { label: 'Dashboard', icon: '▦', href: '/tutor/dashboard' },
    { label: 'Jadwal Mengajar', icon: '◷', href: '/tutor/jadwal' },
    { label: 'Kelas Saya', icon: '▤', href: '/tutor/kelas-saya' },
    { label: 'Daftar Siswa', icon: '♙', href: '/tutor/siswa' },
    { label: 'Input Absensi', icon: '✓', href: '/tutor/absensi', badge: 'Presensi' },
    { label: 'Pengumuman', icon: '📢', href: '/tutor/pengumuman' },
    { label: 'Profil Saya', icon: '◎', href: '/tutor/profil' },
    { label: 'Pengaturan', icon: '⚙', href: '/settings/security' },
];

function isItemActive(href: string) {
    if (href === '/tutor/dashboard') {
        return currentPath.value === '/tutor/dashboard';
    }
    return currentPath.value.startsWith(href);
}

function logout() {
    router.post('/logout');
}
</script>

<template>
    <div class="min-h-screen bg-[#FAF8FF] font-['Plus_Jakarta_Sans'] text-slate-800 selection:bg-purple-500 selection:text-white">

        <!-- SIDEBAR -->
        <aside
            class="fixed inset-y-0 left-0 z-40 hidden w-[260px] flex-col bg-[#260645] text-white lg:flex border-r border-purple-900/40 shadow-xl"
        >
            <!-- BRAND -->
            <div class="flex h-[80px] items-center gap-3 border-b border-white/10 px-6">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-purple-500 to-indigo-500 shadow-md shadow-purple-900/30">
                    <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m2 10 10-6 10 6-10 6-10-6Z"/>
                        <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-extrabold tracking-tight">
                        Bimbel<span class="text-purple-300">Pro</span>
                    </h1>
                    <p class="text-[9px] font-bold tracking-[2px] text-purple-200">
                        PORTAL TUTOR
                    </p>
                </div>
            </div>

            <!-- MENU -->
            <div class="flex-1 overflow-y-auto px-4 py-6 scrollbar-thin">
                <p class="mb-3 px-3 text-[10px] font-bold tracking-[1.8px] text-purple-300/70 uppercase">
                    MENU PEMBELAJARAN
                </p>

                <div class="space-y-1">
                    <Link
                        v-for="menu in menus"
                        :key="menu.label"
                        :href="menu.href"
                        class="flex items-center justify-between rounded-xl px-3.5 py-2.5 text-[13px] font-semibold transition"
                        :class="[
                            isItemActive(menu.href)
                                ? 'bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-md shadow-purple-900/40'
                                : 'text-purple-100/75 hover:bg-white/10 hover:text-white'
                        ]"
                    >
                        <span class="flex items-center gap-3">
                            <span class="flex h-6 w-6 items-center justify-center text-base">{{ menu.icon }}</span>
                            {{ menu.label }}
                        </span>
                        <span
                            v-if="menu.badge"
                            class="rounded-full bg-purple-400/25 px-2 py-0.5 text-[10px] font-bold text-purple-200"
                        >
                            {{ menu.badge }}
                        </span>
                    </Link>
                </div>
            </div>

            <!-- USER PROFILE FOOTER -->
            <div class="border-t border-white/10 p-4 bg-purple-950/40">
                <div class="mb-3 flex items-center gap-3 rounded-xl bg-white/10 p-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-purple-500 to-indigo-500 text-xs font-bold text-white shadow-sm">
                        T
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-xs font-bold">{{ $page.props.auth?.user?.name ?? 'Tutor BimbelPro' }}</p>
                        <p class="text-[10px] text-purple-200">Tenaga Pengajar Aktif</p>
                    </div>
                </div>

                <button
                    @click="logout"
                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 py-2.5 text-xs font-bold text-purple-100 transition hover:bg-rose-500/25 hover:border-rose-400 hover:text-white"
                >
                    <span>↪</span>
                    Keluar Portal
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="min-h-screen lg:pl-[260px]">

            <!-- TOPBAR / LIQUID GLASS HEADER -->
            <header class="sticky top-0 z-30 flex h-[72px] items-center justify-between border-b border-purple-100/80 bg-white/80 px-5 backdrop-blur-xl sm:px-8">
                <div class="flex items-center gap-3">
                    <div class="flex h-2.5 w-2.5 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-xs font-extrabold tracking-wider text-purple-900 uppercase">
                        Portal Akademik Pengajar
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    <Link
                        href="/tutor/absensi"
                        class="hidden rounded-xl bg-purple-50 px-3 py-1.5 text-xs font-bold text-purple-700 hover:bg-purple-100 sm:inline-flex items-center gap-1.5"
                    >
                        <span>✓ Input Presensi Hari Ini</span>
                    </Link>

                    <div class="flex items-center gap-2.5 rounded-xl border border-purple-100 bg-purple-50/60 px-3 py-1.5">
                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-gradient-to-tr from-purple-600 to-indigo-600 text-xs font-bold text-white">
                            T
                        </div>
                        <span class="text-xs font-bold text-slate-800">
                            {{ $page.props.auth?.user?.name ?? 'Tutor' }}
                        </span>
                    </div>
                </div>
            </header>

            <!-- FLASH MESSAGE -->
            <div v-if="$page.props.flash?.status" class="mx-5 sm:mx-8 mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-bold text-emerald-800 shadow-sm">
                ✓ {{ $page.props.flash.status }}
            </div>

            <!-- CONTENT -->
            <main class="p-5 sm:p-8">
                <slot />
            </main>
        </div>

    </div>
</template>
