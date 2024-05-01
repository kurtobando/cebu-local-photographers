<template>
    <main class="min-h-screen w-full">
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
