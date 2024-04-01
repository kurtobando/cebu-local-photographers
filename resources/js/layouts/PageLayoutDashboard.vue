<template>
    <main class="flex min-h-screen w-full flex-col bg-slate-50">
        <Header />
        <section class="p-8">
            <div class="mx-auto w-full max-w-5xl rounded bg-white p-8 shadow-sm">
                <slot />
            </div>
        </section>
    </main>
    <Toast />
</template>

<script lang="ts" setup>
import Toast from 'primevue/toast';
import Header from '@/components/Header/Header.vue';
</script>

<style scoped></style>
