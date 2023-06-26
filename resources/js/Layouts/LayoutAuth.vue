<template>
    <section class="w-full min-h-screen inline-flex">
        <div class="w-1/2 grid place-items-center">
            <slot />
        </div>
        <div class="w-1/2 bg-slate-200">
            <img
                class="w-full h-screen object-cover"
                src="/build/assets/images/background-auth.jpg"
                alt="auth background image" />
        </div>
    </section>
</template>

<script setup lang="ts"></script>

<style scoped></style>
