<template>
    <main class="w-full">
        <Header />
        <section class="p-8">
            <slot />
        </section>
    </main>
</template>

<script setup lang="ts">
import Header from '@/Components/Header/Header.vue';
</script>

<style scoped></style>
