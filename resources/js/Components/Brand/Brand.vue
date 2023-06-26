<template>
    <Link :href="route('home')">
        <h1 class="font-bold text-xl">Cebu Local Photographers</h1>
        <p class="leading-relaxed text-slate-600">an exclusive club for cebuano photographers</p>
    </Link>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import useRoute from '@/composables/useRoute';

const route = useRoute();
</script>

<style scoped></style>
