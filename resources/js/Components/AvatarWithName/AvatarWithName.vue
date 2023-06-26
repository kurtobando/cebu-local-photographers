<template>
    <div class="inline-flex gap-4 items-center">
        <img
            class="h-12 w-12 object-cover rounded-full"
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
