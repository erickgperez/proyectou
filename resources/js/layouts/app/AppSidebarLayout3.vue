<script setup lang="ts">
import type { BreadcrumbItemType } from '@/types';
import { Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

import { type User } from '@/types';
import { usePage } from '@inertiajs/vue3';
const page = usePage();
const user = page.props.auth.user as User;

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
    activeTab?: string;
}
const drawer = ref(false);
const group = ref(null);

const menu = ref(false);

const handleLogout = () => {
    router.flushAll();
};

watch(group, () => {
    drawer.value = false;
});

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
    activeTab: () => 'tab1',
});
</script>

<template>
    <v-responsive>
        <v-app>
            <v-navigation-drawer
                :permanent="!drawer"
                :expand-on-hover="drawer"
                :rail="drawer"
                :location="$vuetify.display.mobile ? 'bottom' : undefined"
                class="bg-blue-grey-darken-2"
            >
                <v-list class="text-white">
                    <v-list-item prepend-icon="mdi-school" subtitle="descripción" title="Nombre Aplicación">
                        <template v-slot:prepend>
                            <v-avatar>
                                <v-icon color="info" icon="mdi-school" size="x-large"></v-icon>
                            </v-avatar>
                        </template>
                    </v-list-item>
                </v-list>
                <v-divider></v-divider>

                <v-list density="compact" nav>
                    <Link :href="route('informe-example')" preserve-state preserve-scroll>
                        <v-list-item
                            prepend-icon="mdi-text-box-multiple-outline"
                            :class="$page.url === '/informe/example' ? 'bg-blue-lighten-4' : ''"
                        >
                            Informe
                        </v-list-item>
                    </Link>
                    <Link :href="route('crud-example')" preserve-state preserve-scroll>
                        <v-list-item prepend-icon="mdi-form-textbox" :class="$page.url === '/crud/example' ? 'bg-blue-lighten-4' : ''">
                            CRUD
                        </v-list-item>
                    </Link>
                    <Link :href="route('profile.edit')" preserve-state preserve-scroll>
                        <v-list-item prepend-icon="mdi-cog" :class="$page.url === '/settings/profile' ? 'bg-blue-lighten-4' : ''">
                            Configuración
                        </v-list-item>
                    </Link>
                </v-list>
            </v-navigation-drawer>
            <v-app-bar :elevation="10" rounded="b-xl">
                <template v-slot:prepend>
                    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                </template>
                <template v-slot:append>
                    <v-list rounded="b-xl">
                        <v-menu v-model="menu" :close-on-content-click="false" location="bottom center">
                            <template v-slot:activator="{ props }">
                                <v-list-item
                                    prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
                                    :subtitle="user.email"
                                    :title="user.name"
                                    v-bind="props"
                                ></v-list-item>
                            </template>

                            <v-card>
                                <v-list>
                                    <v-list-item prepend-icon="mdi-cog">
                                        <Link
                                            :href="route('profile.edit')"
                                            prefetch
                                            as="button"
                                            :only="['tabContent']"
                                            preserve-state
                                            preserve-scroll
                                        >
                                            Settings
                                        </Link>
                                    </v-list-item>

                                    <v-list-item prepend-icon="mdi-logout">
                                        <Link class="block" method="post" :href="route('logout')" @click="handleLogout" as="button"> Log out </Link>
                                    </v-list-item>
                                </v-list>
                            </v-card>
                        </v-menu>
                    </v-list>
                </template>

                <v-app-bar-title>Aplicación</v-app-bar-title>
            </v-app-bar>
            <v-main class="ma-5">
                <slot />
            </v-main>
        </v-app>
    </v-responsive>
</template>
