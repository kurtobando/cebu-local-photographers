<template>
    <div class="border-b border-slate-100 bg-white p-8 shadow-sm">
        <div class="inline-flex w-full items-center justify-between">
            <Brand />
            <Navigation />
            <MobileNavigation />
        </div>
    </div>
</template>

<script lang="ts" setup>
import Brand from '@/Components/Brand/Brand.vue';
import MobileNavigation from '@/Components/MobileNavigation/MobileNavigation.vue';
import Navigation from '@/Components/Navigation/Navigation.vue';
</script>

<style scoped></style>
