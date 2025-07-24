<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import DashboardContent from '@/pages/Dashboard.vue';
import ProfileContent from '@/pages/settings/Profile.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, reactive, ref, watch } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const tab = ref('tab1');
/*interface TabsData {
    tab1: string;
    tab2: string;
    tab3: string;
    tab4: string;
}
const tabsData = ref<TabsData | null>(null); // Initialize with null or an empty object matching the interface*/
const tabsData = reactive({
    tab1: '',
    tab2: '',
    tab3: '',
    tab4: '',
});

const activeComponent = computed(() => {
    return (tabUser: string, page: string) => {
        const lastTab = localStorage.getItem('lastTab');
        const cargado = ref('');
        console.log('tabUser: ' + tabUser);
        console.log('page: ' + page);
        console.log(tabsData);
        for (const key in tabsData) {
            // Ensure the property belongs directly to the object 1and not its prototype chain
            if (tabsData.hasOwnProperty(key)) {
                console.log(key + ': ' + tabsData[key]);
                if (tabsData[key] == props.page && props.page != undefined) {
                    cargado.value = key;
                }
            }
        }
        console.log('cargando: ' + cargado.value);
        if (tabUser == lastTab) {
            if (cargado.value === '' || cargado.value == tabUser) {
                tabsData[lastTab] = props.page;
                switch (props.page) {
                    case 'dashboard':
                        return DashboardContent;
                    case 'settings':
                        return ProfileContent;
                    default:
                        return null;
                }
            }
        }
        return null;
        /*console.log('**********');
        console.log(tabsData);
        console.log('lastTab: ' + lastTab);
        console.log('tab: ' + tabUser);
        console.log('page: ' + props.page);
        console.log('---------');

        if (tabUser == lastTab) {
            const cargado = ref('');
            for (const key in tabsData) {
                // Ensure the property belongs directly to the object 1and not its prototype chain
                if (tabsData.hasOwnProperty(key)) {
                    console.log(key + ': ' + tabsData[key]);
                    if (tabsData[key] == props.page && props.page != undefined) {
                        cargado.value = key;
                    }
                }
            }
            console.log('cargado: ' + cargado.value);
            if (cargado.value == tabUser || cargado.value === '') {
                tabsData[tabUser] = props.page;
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
        }*/
    };
});

watch(tab, (newValue) => {
    localStorage.setItem('lastTab', newValue);
});

onMounted(() => {
    // Access the DOM element after it's mounted

    if (localStorage.getItem('tabs') === null) {
        console.log('inicializar los tabs en localStorage');
    }
    const jsonString = '{"tab1": null, "tab2": null, "tab3": null, "tab4" : null}';
    localStorage.setItem('tabs', jsonString);

    const tabsString = localStorage.getItem('tabs') ?? '{}';
    const tabsObj_ = JSON.parse(tabsString.replaceAll("'", '"'));
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
                    prepend-icon="mdi-account"
                    :text="'Option ' + (index + 1)"
                    v-for="(url, tab, index) in tabsData"
                    :value="tab"
                    :key="tab"
                    :is="activeComponent(tab, url)"
                ></v-tab>
                <!-- <v-tab prepend-icon="mdi-lock" text="Option 2" value="tab2"> </v-tab>
                </v-t>ab prepend-icon="mdi-access-point" text="Option 3" value="tab3"></v-tab> -->
            </v-tabs>

            <v-tabs-window v-model="tab">
                <v-tabs-window-item v-for="(url, tab) in tabsData" :value="tab" :key="tab">
                    <v-card flat>
                        <KeepAlive><component :is="activeComponent(tab, url)"></component></KeepAlive>
                    </v-card>
                </v-tabs-window-item>
            </v-tabs-window>
        </div>
    </AppLayout>
</template>
