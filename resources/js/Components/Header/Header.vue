<template>
    <div class="p-8 border-b border-gray-200">
        <div class="w-full inline-flex items-center justify-between">
            <Brand />
            <Navigation />
        </div>
    </div>
</template>

<script setup lang="ts">
import Brand from '@/Components/Brand/Brand.vue';
import Navigation from '@/Components/Navigation/Navigation.vue';
</script>

<style scoped></style>
