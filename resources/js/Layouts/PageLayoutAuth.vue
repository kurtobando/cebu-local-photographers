<template>
    <section class="w-full min-h-screen inline-flex">
        <div class="w-full lg:w-1/2 grid place-items-center">
            <slot />
        </div>
        <div class="lg:w-1/2 bg-slate-200 hidden lg:block">
            <img
                alt="auth background image"
                class="w-full h-screen object-cover"
                src="/build/assets/images/background-auth.jpg" />
        </div>
    </section>
</template>

<script lang="ts" setup></script>

<style scoped></style>
