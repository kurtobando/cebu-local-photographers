<template>
    <div class="border-b p-8">
        <div class="inline-flex w-full items-center justify-between">
            <Brand />
            <Navigation />
            <MobileNavigation />
        </div>
    </div>
</template>

<script lang="ts" setup>
import Brand from '@/Components/Brand/Brand.vue';
import Navigation from '@/Components/Navigation/Navigation.vue';
import MobileNavigation from '@/Components/MobileNavigation/MobileNavigation.vue';
</script>

<style scoped></style>
