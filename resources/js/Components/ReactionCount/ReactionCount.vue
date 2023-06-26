<template>
    <div class="inline-flex items-center gap-2">
        <i class="pi pi-heart !text-xl"></i>
        <span>{{ heart }}</span>
        <i class="pi pi-comment !text-xl"></i>
        <span>{{ comment }}</span>
        <i class="pi pi-eye !text-xl"></i>
        <span>{{ view }}</span>
    </div>
</template>

<script setup lang="ts">
defineProps<Props>();

interface Props {
    heart: number;
    comment: number;
    view: number;
}
</script>

<style scoped></style>
