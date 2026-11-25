
<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';

const menuGroups = [
    {
        title: 'MENU UTAMA',
        items: [
            { label: 'Dashboard', icon: '▦', href: '/admin/dashboard', active: true },
        ],
    },
    {
        title: 'AKADEMIK',
        items: [
            { label: 'Data Siswa', icon: '♙', href: null },
            { label: 'Data Tutor', icon: '♧', href: null },
            { label: 'Data Kelas', icon: '▤', href: null },
            { label: 'Jadwal Belajar', icon: '◷', href: null },
            { label: 'Absensi', icon: '✓', href: null },
        ],
    },
    {
        title: 'KEUANGAN',
        items: [
            { label: 'Tagihan', icon: '▱', href: null },
            { label: 'Pembayaran', icon: 'Rp', href: null },
        ],
    },
    {
        title: 'LAINNYA',
        items: [
            { label: 'Laporan', icon: '▥', href: null },
            { label: 'Pengaturan', icon: '⚙', href: null },
        ],
    },
];

function logout() {
    router.post('/logout');
}
</script>

<template>
    <div class="min-h-screen bg-[#F5F7FC] text-[#172554]">

        <!-- SIDEBAR -->
        <aside
            class="fixed inset-y-0 left-0 z-40 hidden w-[255px] flex-col bg-[#142B55] text-white lg:flex"
        >
            <!-- BRAND -->
            <div class="flex h-[82px] items-center gap-3 border-b border-white/10 px-7">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500 shadow-lg">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                        <path d="m2 10 10-6 10 6-10 6-10-6Z"/>
                        <path d="M6 12.5v4.5c3.5 3 8.5 3 12 0v-4.5"/>
                    </svg>
                </div>

                <div>
                    <h1 class="text-xl font-extrabold tracking-tight">
                        Bimbel<span class="text-blue-300">Pro</span>
                    </h1>
                    <p class="text-[9px] font-semibold tracking-[2px] text-blue-200">
                        MANAGEMENT SYSTEM
                    </p>
                </div>
            </div>

            <!-- NAVIGATION -->
            <div class="flex-1 overflow-y-auto px-4 py-6">
                <div v-for="group in menuGroups" :key="group.title" class="mb-7">
                    <p class="mb-3 px-3 text-[10px] font-bold tracking-[1.8px] text-blue-300/70">
                        {{ group.title }}
                    </p>

                    <div class="space-y-1">
                        <template v-for="item in group.items" :key="item.label">
                            <Link
                                v-if="item.href && item.active"
                                :href="item.href"
                                class="flex items-center gap-3 rounded-xl bg-blue-500 px-3 py-3 text-[13px] font-semibold text-white shadow-lg shadow-blue-950/20"
                            >
                                <span class="flex h-6 w-6 items-center justify-center text-lg">{{ item.icon }}</span>
                                {{ item.label }}
                            </Link>

                            <div
                                v-else
                                class="flex items-center justify-between rounded-xl px-3 py-3 text-[13px] font-medium text-blue-100/75"
                            >
                                <span class="flex items-center gap-3">
                                    <span class="flex h-6 w-6 items-center justify-center text-lg">{{ item.icon }}</span>
                                    {{ item.label }}
                                </span>
                                <span class="text-[9px] text-blue-300/50">Segera</span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- SIDEBAR BOTTOM -->
            <div class="border-t border-white/10 p-4">
                <div class="mb-4 flex items-center gap-3 rounded-xl bg-white/10 p-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-400 text-sm font-bold text-white">
                        A
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-xs font-bold">{{ $page.props.auth?.user?.name ?? 'Admin BimbelPro' }}</p>
                        <p class="text-[10px] text-blue-200">Administrator</p>
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
                        Panel Administrator
                    </h2>
                    <p class="mt-1 text-[10px] text-slate-400 sm:text-xs">
                        Sistem Manajemen Bimbingan Belajar
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden text-right sm:block">
                        <p class="text-xs font-bold text-slate-700">{{ $page.props.auth?.user?.name ?? 'Admin BimbelPro' }}</p>
                        <p class="text-[10px] text-slate-400">Administrator</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-sm font-extrabold text-blue-700">
                        A
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="p-5 sm:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>
