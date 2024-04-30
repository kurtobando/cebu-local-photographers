<template>
    <main class="w-full">
        <Header />
        <section class="">
            <slot />
        </section>
    </main>
    <Toast />
</template>

<script setup lang="ts">
import Header from '@/components/Header/Header.vue';
</script>

<style scoped></style>
