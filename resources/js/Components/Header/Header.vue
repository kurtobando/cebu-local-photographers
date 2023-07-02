<template>
    <div class="p-8 border-b">
        <div class="w-full inline-flex items-center justify-between">
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
