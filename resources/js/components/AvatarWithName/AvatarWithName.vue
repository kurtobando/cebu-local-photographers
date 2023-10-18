<template>
    <div class="inline-flex items-center gap-4">
        <img
            class="h-12 w-12 rounded-full object-cover"
            :src="imageSource"
            alt="avatar" />
        <p class="leading-relaxed">
            {{ name }}
        </p>
    </div>
</template>

<script setup lang="ts">
defineProps<Props>();

interface Props {
    imageSource: string;
    name: string;
}
</script>

<style scoped></style>
