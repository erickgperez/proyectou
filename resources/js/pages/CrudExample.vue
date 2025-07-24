<script setup lang="ts">
import { computed, ref } from 'vue';

const step = ref(1);

const selectedItem = ref(null);
const selectedAction = ref('');

const currentTitle = computed(() => {
    switch (step.value) {
        case 1:
            return 'Listado';
        case 2:
            return 'Acciones';
        default:
            return 'Aplicar acciones';
    }
});

const consoles = ref([
    {
        name: 'PlayStation 5',
        manufacturer: 'Sony',
        year: 2020,
        sales: '10M',
        exclusive: true,
        acciones: null,
    },
    {
        name: 'Xbox Series X',
        manufacturer: 'Microsoft',
        year: 2020,
        sales: '6.5M',
        exclusive: false,
        acciones: null,
    },
    {
        name: 'Nintendo Switch',
        manufacturer: 'Nintendo',
        year: 2017,
        sales: '89M',
        exclusive: true,
        acciones: null,
    },
    {
        name: 'PlayStation 4',
        manufacturer: 'Sony',
        year: 2013,
        sales: '116M',
        exclusive: true,
        acciones: null,
    },
    {
        name: 'Xbox One',
        manufacturer: 'Microsoft',
        year: 2013,
        sales: '50M',
        exclusive: false,
        acciones: null,
    },
    {
        name: 'Nintendo Wii',
        manufacturer: 'Nintendo',
        year: 2006,
        sales: '101M',
        exclusive: true,
        acciones: null,
    },
]);

const selectItem = (item: any) => {
    selectedItem.value = item;
    step.value++;
};

const selectAction = (accion: string) => {
    selectedAction.value = accion;
    step.value++;
};
</script>

<template>
    <v-window v-model="step" class="h-auto w-100">
        <v-window-item :value="1">
            <v-card title="Listado de productos">
                <v-data-table :items="consoles" border="primary thin" class="w-100">
                    <template v-slot:item.acciones="{ item }">
                        <v-icon color="green-darken-2" icon="mdi-chevron-right-circle-outline" size="large" @click="selectItem(item)"></v-icon>
                    </template>
                </v-data-table>
            </v-card>
        </v-window-item>

        <v-window-item :value="2">
            <v-card class="align-center justify-center" :title="'Registro seleccionado: ' + selectedItem.name">
                <v-row dense>
                    <v-col cols="12" md="12">
                        <span class="text-h6">
                            <BR />
                            <span>Elija la acción a realizar</span>
                        </span>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-card
                            class="mx-auto"
                            subtitle="Editar la información del registro seleccionado"
                            title="Editar"
                            @click="selectAction('edit')"
                        >
                            <template v-slot:prepend>
                                <v-avatar color="blue-darken-2">
                                    <v-icon icon="mdi-text-box-edit" size="x-large"></v-icon>
                                </v-avatar>
                            </template>
                            <template v-slot:append>
                                <v-icon color="success" icon="mdi-check"></v-icon>
                            </template>
                        </v-card>
                    </v-col>

                    <v-col cols="12" md="6">
                        <v-card class="mx-auto" subtitle="Mostrar los datos solo de lectura" title="Ver" @click="selectAction('show')">
                            <template v-slot:prepend>
                                <v-avatar color="teal-lighten-4">
                                    <v-icon icon="mdi-eye-outline" size="x-large"></v-icon>
                                </v-avatar>
                            </template>
                            <template v-slot:append>
                                <v-icon color="success" icon="mdi-check"></v-icon>
                            </template>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-card class="mx-auto" subtitle="Borrar el registro seleccionado" title="Eliminar" @click="selectAction('delete')">
                            <template v-slot:prepend>
                                <v-avatar color="red-lighten-1">
                                    <v-icon icon="mdi-delete-alert" size="x-large"></v-icon>
                                </v-avatar>
                            </template>
                            <template v-slot:append>
                                <v-icon color="success" icon="mdi-check"></v-icon>
                            </template>
                        </v-card>
                    </v-col>
                </v-row>
            </v-card>
        </v-window-item>

        <v-window-item :value="3">
            <v-card title="Realizar acción">
                <v-row>
                    <v-col cols="12" md="6">
                        <v-card color="indigo" variant="outlined" class="md-6 mx-auto">
                            <v-card-item>
                                <div>
                                    <div class="text-overline mb-1">Datos del registro</div>
                                    <div class="text-h6 mb-1">{{ selectedItem }}</div>
                                </div>
                            </v-card-item>
                        </v-card>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-card color="indigo" variant="elevated" class="md-6 mx-auto">
                            <v-card-item>
                                <div>
                                    <div class="text-overline mb-1">Acción seleccionada</div>
                                    <div class="text-h6 mb-1">{{ selectedAction }}</div>
                                </div>
                            </v-card-item>
                        </v-card>
                    </v-col>
                </v-row>
            </v-card>
        </v-window-item>
    </v-window>

    <v-divider></v-divider>

    <v-card-actions>
        <v-btn v-if="step > 1" prepend-icon="mdi-arrow-left-bold" rounded variant="tonal" color="blue-darken-4" @click="step--">
            <template v-slot:prepend>
                <v-icon color="success"></v-icon>
            </template>
            Regresar
        </v-btn>
        <v-btn v-if="step == 3" prepend-icon="mdi-page-first" rounded variant="tonal" color="blue-darken-4" @click="step = 1">
            <template v-slot:prepend>
                <v-icon color="success"></v-icon>
            </template>
            Ir al inicio
        </v-btn>
    </v-card-actions>
</template>
