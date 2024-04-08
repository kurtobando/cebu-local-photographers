<template>
    <p
        v-if="text"
        class="text-left text-sm text-red-600">
        {{ text }}
    </p>
</template>

<script setup lang="ts">
defineProps<Props>();

interface Props {
    text: string | null;
}
</script>

<style scoped></style>
