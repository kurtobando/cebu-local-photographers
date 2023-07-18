<template>
    <section>
        <Meta title="Dashboard" />
        <p>Hello World</p>
    </section>
</template>

<script setup lang="ts">
import Meta from '@/Components/Meta/Meta.vue';
import PageLayoutDashboard from '@/Layouts/PageLayoutDashboard.vue';

defineOptions({ layout: PageLayoutDashboard });
</script>

<style scoped></style>
