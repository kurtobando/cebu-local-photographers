<template>
    <section class="mx-auto max-w-6xl py-8">
        <Meta title="Manage Users" />
        <div>
            <DataTable
                :value="data"
                stripedRows>
                <Column
                    field="id"
                    header="ID"
                    :sortable="true" />
                <Column
                    field="email"
                    header="Email"
                    :sortable="true" />
                <Column
                    field="name"
                    header="Name" />
                <Column
                    field="provider"
                    header="Provider"
                    :sortable="true" />
                <Column
                    field="status"
                    header="Status"
                    :sortable="true" />
                <Column
                    field="action"
                    header="Action" />
            </DataTable>
        </div>
    </section>
</template>

<script setup lang="ts">
import Column from 'primevue/column';
import DataTable from 'primevue/datatable';
import { ref } from 'vue';
import Meta from '@/Components/Meta/Meta.vue';
import PageLayoutDashboard from '@/Layouts/PageLayoutDashboard.vue';

const data = ref([
    {
        action: 'Edit',
        email: 'sample@domain.com',
        id: 1,
        name: 'John Doe',
        provider: 'Google',
        status: 'Active',
    },
]);
defineOptions({ layout: PageLayoutDashboard });
</script>

<style scoped></style>
