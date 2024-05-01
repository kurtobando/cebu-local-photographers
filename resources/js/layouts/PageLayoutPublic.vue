<template>
    <main class="flex min-h-screen w-full flex-col justify-between">
        <Header />
        <section class="">
            <slot />
        </section>
        <Footer />
    </main>
    <Toast />
    <ModalSignInNow />
</template>

<script setup lang="ts">
import Footer from '@/components/Footer/Footer.vue';
import Header from '@/components/Header/Header.vue';
import ModalSignInNow from '@/components/ModalSignInNow/ModalSignInNow.vue';
</script>

<style scoped></style>
