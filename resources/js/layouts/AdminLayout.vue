<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const currentPath = computed(() => page.url);

const menuGroups = [
    {
        title: 'MENU UTAMA',
        items: [
            { label: 'Dashboard', icon: '▦', href: '/admin/dashboard' },
            { label: 'Pendaftaran Tutor', icon: '✦', href: '/admin/pendaftaran-tutor', badge: 'Seleksi' },
        ],
    },
    {
        title: 'AKADEMIK',
        items: [
            { label: 'Data Siswa', icon: '♙', href: '/admin/siswa' },
            { label: 'Data Tutor', icon: '♧', href: '/admin/tutor' },
            { label: 'Data Kelas', icon: '▤', href: '/admin/kelas' },
            { label: 'Jadwal Belajar', icon: '◷', href: '/admin/jadwal' },
            { label: 'Absensi Siswa', icon: '✓', href: '/admin/absensi' },
        ],
    },
    {
        title: 'KEUANGAN',
        items: [
            { label: 'Tagihan SPP', icon: '▱', href: '/admin/tagihan' },
            { label: 'Pembayaran', icon: 'Rp', href: '/admin/pembayaran' },
        ],
    },
    {
        title: 'LAINNYA',
        items: [
            { label: 'Laporan Rekap', icon: '▥', href: '/admin/laporan' },
            { label: 'Pengaturan Akun', icon: '⚙', href: '/settings/profile' },
        ],
    },
];

function isItemActive(href: string) {
    if (href === '/admin/dashboard') {
        return currentPath.value === '/admin/dashboard';
    }
    return currentPath.value.startsWith(href);
}

function logout() {
    router.post('/logout');
}
</script>

<template>
    <div class="min-h-screen bg-[#FAF8FF] font-['Plus_Jakarta_Sans'] text-slate-800 selection:bg-purple-500 selection:text-white">

        <!-- SIDEBAR (PURPLE THEME) -->
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
                        ADMINISTRATOR PANEL
                    </p>
                </div>
            </div>

            <!-- NAVIGATION -->
            <div class="flex-1 overflow-y-auto px-4 py-6 scrollbar-thin">
                <div v-for="group in menuGroups" :key="group.title" class="mb-6">
                    <p class="mb-2.5 px-3 text-[10px] font-bold tracking-[1.8px] text-purple-300/70">
                        {{ group.title }}
                    </p>

                    <div class="space-y-1">
                        <Link
                            v-for="item in group.items"
                            :key="item.label"
                            :href="item.href"
                            class="flex items-center justify-between rounded-xl px-3.5 py-2.5 text-[13px] font-semibold transition"
                            :class="[
                                isItemActive(item.href)
                                    ? 'bg-gradient-to-r from-purple-600 to-indigo-600 text-white shadow-md shadow-purple-900/40'
                                    : 'text-purple-100/75 hover:bg-white/10 hover:text-white'
                            ]"
                        >
                            <span class="flex items-center gap-3">
                                <span class="flex h-6 w-6 items-center justify-center text-base">{{ item.icon }}</span>
                                {{ item.label }}
                            </span>
                            <span
                                v-if="item.badge"
                                class="rounded-full bg-purple-400/25 px-2 py-0.5 text-[10px] font-bold text-purple-200"
                            >
                                {{ item.badge }}
                            </span>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- SIDEBAR BOTTOM -->
            <div class="border-t border-white/10 p-4 bg-purple-950/40">
                <div class="mb-3 flex items-center gap-3 rounded-xl bg-white/10 p-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-purple-500 to-indigo-500 text-xs font-bold text-white shadow-sm">
                        A
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-xs font-bold">{{ $page.props.auth?.user?.name ?? 'Admin BimbelPro' }}</p>
                        <p class="text-[10px] text-purple-200">Administrator Utama</p>
                    </div>
                </div>

                <button
                    @click="logout"
                    class="flex w-full items-center justify-center gap-2 rounded-xl border border-white/10 bg-white/5 py-2.5 text-xs font-bold text-purple-100 transition hover:bg-rose-500/25 hover:border-rose-400 hover:text-white"
                >
                    <span>↪</span>
                    Keluar Sistem
                </button>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="min-h-screen lg:pl-[260px]">

            <!-- TOPBAR / LIQUID GLASS HEADER -->
            <header class="sticky top-0 z-30 flex h-[72px] items-center justify-between border-b border-purple-100/80 bg-white/80 px-5 backdrop-blur-xl sm:px-8">
                <div class="flex items-center gap-3">
                    <div class="flex h-2.5 w-2.5 rounded-full bg-purple-600 animate-pulse"></div>
                    <span class="text-xs font-extrabold tracking-wider text-purple-900 uppercase">
                        BimbelPro Academic Control
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    <Link
                        href="/"
                        target="_blank"
                        class="hidden text-xs font-bold text-purple-700 hover:text-purple-900 sm:inline-flex items-center gap-1"
                    >
                        <span>Lihat Web Publik</span>
                        <span>↗</span>
                    </Link>

                    <div class="flex items-center gap-2.5 rounded-xl border border-purple-100 bg-purple-50/60 px-3 py-1.5">
                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-purple-600 text-xs font-bold text-white">
                            A
                        </div>
                        <span class="text-xs font-bold text-slate-800">
                            {{ $page.props.auth?.user?.name ?? 'Admin' }}
                        </span>
                    </div>
                </div>
            </header>

            <!-- FLASH MESSAGE -->
            <div v-if="$page.props.flash?.status" class="mx-5 sm:mx-8 mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-bold text-emerald-800 shadow-sm">
                ✓ {{ $page.props.flash.status }}
            </div>

            <!-- PAGE CONTENT -->
            <main class="p-5 sm:p-8">
                <slot />
            </main>
        </div>

    </div>
</template>
