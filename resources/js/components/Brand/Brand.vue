<template>
    <Link :href="route('home')">
        <h1 class="text-xl font-bold">Cebu Local Photographers</h1>
        <p class="text-sm leading-relaxed text-slate-400">an exclusive club for cebuano photographers</p>
    </Link>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import useRoutes from '@/composables/useRoute';

const route = useRoutes();
</script>

<style scoped></style>
