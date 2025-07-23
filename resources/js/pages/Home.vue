<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import DashboardContent from '@/pages/Dashboard.vue';
import ProfileContent from '@/pages/settings/Profile.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const tab = ref('tab1');

const activeComponent = computed(() => {
    return (tabUser: string) => {
        if (tabUser == props.tabDestino) {
            switch (props.page) {
                case 'dashboard':
                    return DashboardContent;
                case 'settings':
                    return ProfileContent;
                default:
                    return null;
            }
        } else {
            return null;
        }
    };
});

onMounted(() => {
    // Access the DOM element after it's mounted
    console.log(tab.value);
    console.log(props.tabDestino);
    console.log(props.page);
});

interface Props {
    mustVerifyEmail?: boolean;
    status?: string;
    page?: string;
    tabDestino?: string;
}

const props = defineProps<Props>();
</script>

<template>
    <Head title="Home" />
    <AppLayout :breadcrumbs="breadcrumbs" :activeTab="tab">
        <div class="d-flex flex-row">
            <v-tabs v-model="tab" color="primary" direction="vertical">
                <v-tab prepend-icon="mdi-account" text="Option 1" value="tab1"> </v-tab>
                <v-tab prepend-icon="mdi-lock" text="Option 2" value="tab2"> </v-tab>
                <v-tab prepend-icon="mdi-access-point" text="Option 3" value="tab3"></v-tab>
            </v-tabs>

            <v-tabs-window v-model="tab">
                <v-tabs-window-item value="tab1">
                    <v-card flat>
                        <KeepAlive><component :is="activeComponent('tab1')"></component></KeepAlive>
                    </v-card>
                </v-tabs-window-item>

                <v-tabs-window-item value="tab2">
                    <v-card flat>
                        <KeepAlive><component :is="activeComponent('tab2')"></component></KeepAlive>
                    </v-card>
                </v-tabs-window-item>

                <v-tabs-window-item value="tab3">
                    <v-card flat>
                        <v-card-text>
                            <p>
                                Fusce a quam. Phasellus nec sem in justo pellentesque facilisis. Nam eget dui. Proin viverra, ligula sit amet ultrices
                                semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. In dui magna, posuere eget, vestibulum et,
                                tempor auctor, justo.
                            </p>

                            <p class="mb-0">
                                Cras sagittis. Phasellus nec sem in justo pellentesque facilisis. Proin sapien ipsum, porta a, auctor quis, euismod
                                ut, mi. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nam at tortor in tellus interdum
                                sagittis.
                            </p>
                        </v-card-text>
                    </v-card>
                </v-tabs-window-item>
            </v-tabs-window>
        </div>
    </AppLayout>
</template>
