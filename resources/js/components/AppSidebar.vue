
<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

import {
    LayoutGrid,
    Users,
    UserCheck,
    BookOpen,
    Calendar,
    ClipboardList,
    CreditCard,
    FileText,
    Settings,
} from '@lucide/vue';

import AppLogo from '@/components/AppLogo.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';

import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';

import type { NavItem } from '@/types';

// Mengambil informasi pengguna yang sedang login
const page = usePage<{
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
            role: string;
        } | null;
    };
}>();

// Memeriksa role pengguna
const isAdmin = computed(() => {
    return page.props.auth?.user?.role === 'admin';
});

// Menentukan alamat dashboard berdasarkan role
const dashboardHref = computed(() => {
    return isAdmin.value
        ? '/admin/dashboard'
        : '/tutor/dashboard';
});

// Menu navigasi menyesuaikan role
const mainNavItems = computed<NavItem[]>(() => {

    // MENU ADMIN
    if (isAdmin.value) {
        return [
            {
                title: 'Dashboard',
                href: '/admin/dashboard',
                icon: LayoutGrid,
            },
            {
                title: 'Data Siswa',
                href: '#',
                icon: Users,
            },
            {
                title: 'Data Tutor',
                href: '#',
                icon: UserCheck,
            },
            {
                title: 'Kelas',
                href: '#',
                icon: BookOpen,
            },
            {
                title: 'Jadwal',
                href: '#',
                icon: Calendar,
            },
            {
                title: 'Absensi',
                href: '#',
                icon: ClipboardList,
            },
            {
                title: 'Pembayaran',
                href: '#',
                icon: CreditCard,
            },
            {
                title: 'Laporan',
                href: '#',
                icon: FileText,
            },
            {
                title: 'Pengaturan',
                href: '/settings/profile',
                icon: Settings,
            },
        ];
    }

    // MENU TUTOR
    return [
        {
            title: 'Dashboard',
            href: '/tutor/dashboard',
            icon: LayoutGrid,
        },
        {
            title: 'Kelas Saya',
            href: '#',
            icon: BookOpen,
        },
        {
            title: 'Jadwal Mengajar',
            href: '#',
            icon: Calendar,
        },
        {
            title: 'Absensi',
            href: '#',
            icon: ClipboardList,
        },
        {
            title: 'Pengaturan',
            href: '/settings/profile',
            icon: Settings,
        },
    ];
});
</script>

<template>
    <Sidebar
        collapsible="icon"
        variant="inset"
        class="!bg-[#123B70] [&>div]:!bg-[#123B70] text-white"
    >

        <!-- HEADER -->
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboardHref">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <!-- NAVIGASI -->
        <SidebarContent>
            <NavMain
                :items="mainNavItems"
                class="text-white"
            />
        </SidebarContent>

        <!-- USER -->
        <SidebarFooter>
            <NavUser />
        </SidebarFooter>

    </Sidebar>

    <slot />
</template>
