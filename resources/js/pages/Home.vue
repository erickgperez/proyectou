<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import CrudExample from '@/pages/CrudExample.vue';
import DashboardContent from '@/pages/Dashboard.vue';
import InformeExample from '@/pages/InformeExample.vue';
import ProfileContent from '@/pages/settings/Profile.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { computed, markRaw, onMounted, ref, watch } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const page_ = usePage();
//const currentUrl = ref('');
const currentUrl = computed(() => page_.props.request);

const tab = ref('tab1');
/*interface TabsData {
    tab1: string;
    tab2: string;
    tab3: string;
    tab4: string;
}
const tabsData = ref<TabsData | null>(null); // Initialize with null or an empty object matching the interface*/
const tabsData = markRaw({
    tab1: '',
    tab2: '',
    tab3: '',
    tab4: '',
});
const tabsComponent = markRaw({
    dashboard: DashboardContent,
    settings: ProfileContent,
    informeExample: InformeExample,
    crudExample: CrudExample,
});
const activeComponent = computed(() => {
    return (tabUser: string) => {
        const currentTab = tab.value;
        const cargado = ref('');
        for (const key in tabsData) {
            // Ensure the property belongs directly to the object 1and not its prototype chain
            if (tabsData.hasOwnProperty(key)) {
                if (tabsData[key] == props.page && props.page != undefined) {
                    cargado.value = key;
                }
            }
        }

        if (tabUser == currentTab) {
            if (cargado.value === '' || cargado.value == tabUser) {
                tabsData[currentTab] = props.page;
            }
        }
        return null;
    };
});
const activeComponentTab = computed(() => {
    return (tabUser: string) => {
        for (const key in tabsData) {
            // Ensure the property belongs directly to the object 1and not its prototype chain
            if (tabsData.hasOwnProperty(key)) {
                if (key == tabUser) {
                    return tabsComponent[tabsData[key]];
                }
            }
        }
    };
});

watch(currentUrl, () => {
    //Cuando se cargue una nueva url, provocar un cambio en tab para que se actualice ese sección de la interfaz de usuario
    const tabVal = tab.value;
    tab.value = '';
    tab.value = tabVal;
    console.log(currentUrl.value);
});

onMounted(() => {
    for (const key in tabsData) {
        // Poner todos los tab en null
        if (tabsData.hasOwnProperty(key)) {
            tabsData[key] = null;
        }
    }
    tab.value = 'tab1';
});

interface Props {
    mustVerifyEmail?: boolean;
    status?: string;
    page?: string;
}

const props = defineProps<Props>();
</script>

<template>
    <Head title="Home" />
    <AppLayout :breadcrumbs="breadcrumbs" :activeTab="tab">
        <div class="d-flex flex-row">
            <v-tabs v-model="tab" color="primary" direction="vertical">
                <v-tab
                    prepend-icon="mdi-tab"
                    :title="'Espacio de trabajo ' + (index + 1)"
                    :text="'Espacio ' + (index + 1)"
                    v-for="(url, tab, index) in tabsData"
                    :value="tab"
                    :key="tab"
                    :is="activeComponent(tab)"
                >
                </v-tab>
            </v-tabs>

            <v-tabs-window v-model="tab" class="w-100 pl-5">
                <v-tabs-window-item v-for="(url, tab) in tabsData" :value="tab" :key="tab">
                    <v-card flat>
                        <KeepAlive><component :is="activeComponentTab(tab)"></component></KeepAlive>
                    </v-card>
                </v-tabs-window-item>
            </v-tabs-window>
        </div>
    </AppLayout>
</template>
