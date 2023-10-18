<template>
    <section class="inline-flex min-h-screen w-full">
        <div class="grid w-full place-items-center lg:w-1/2">
            <slot />
        </div>
        <div class="hidden bg-slate-200 lg:block lg:w-1/2">
            <img
                alt="auth background image"
                class="h-screen w-full object-cover"
                src="/build/assets/images/background-auth.jpg" />
        </div>
    </section>
</template>

<script lang="ts" setup></script>

<style scoped></style>
