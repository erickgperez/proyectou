<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout3.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
    activeTab?: string;
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
    activeTab: () => 'tab1',
});
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs" :activeTab="activeTab">
        <slot />
    </AppLayout>
</template>
