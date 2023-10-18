<template>
    <div>
        <Menu :model="items" />
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import Menu from 'primevue/menu';
import { ref } from 'vue';
import useRoute from '@/composables/useRoute';

const route = useRoute();
const items = ref([
    {
        command: () => router.visit(route('dashboard.profile')),
        icon: 'pi pi-user',
        label: 'Profile',
    },
    {
        command: () => router.visit(route('dashboard.photos.create')),
        icon: 'pi pi-image',
        label: 'Photos',
    },
]);
</script>

<style scoped></style>
