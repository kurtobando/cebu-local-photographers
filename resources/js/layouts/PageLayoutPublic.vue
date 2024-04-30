<template>
    <main class="w-full">
        <Header />
        <section class="">
            <slot />
        </section>
    </main>
    <ModalSignInNow />
    <Toast />
</template>

<script setup lang="ts">
import Header from '@/components/Header/Header.vue';
import ModalSignInNow from '@/components/ModalSignInNow/ModalSignInNow.vue';
</script>

<style scoped></style>
