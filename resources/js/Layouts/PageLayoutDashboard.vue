<template>
    <div>
        <div class="inline-flex w-full items-center justify-between gap-8 border-b p-8">
            <Brand />
            <nav class="font-sm inline-flex gap-8 text-sm">
                <a href="">Discover</a>
                <a href="">Submit a Photo</a>
                <a href="">My Profile</a>
            </nav>
        </div>
        <slot />
    </div>
</template>

<script setup lang="ts">
import Brand from '@/Components/Brand/Brand.vue';
</script>

<style scoped></style>
