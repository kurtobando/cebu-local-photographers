<template>
    <div class="bg-white p-8 shadow-sm">
        <div class="inline-flex w-full items-center justify-between">
            <Brand />
            <Navigation />
            <MobileNavigation />
        </div>
    </div>
</template>

<script lang="ts" setup>
import Brand from '@/components/Brand/Brand.vue';
import MobileNavigation from '@/components/MobileNavigation/MobileNavigation.vue';
import Navigation from '@/components/Navigation/Navigation.vue';
</script>

<style scoped></style>
