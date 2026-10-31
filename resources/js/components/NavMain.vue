<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import type { NavItem } from '@/types';

defineProps<{
    items: NavItem[];
}>();

const { isCurrentUrl } = useCurrentUrl();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <!-- SidebarGroupLabel dihapus -->
        <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
                <!-- Tambahkan class w-full dan buang batas lebar -->
                <SidebarMenuButton as-child :is-active="item.isActive" class="w-full h-10">
                    <Link :href="item.href" class="flex items-center gap-3">
                        <component :is="item.icon" class="w-5 h-5 flex-shrink-0" />
                        <!-- Pastikan span bisa membentang penuh -->
                        <span class="truncate whitespace-nowrap text-sm">{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
