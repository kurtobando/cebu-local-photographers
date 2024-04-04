<template>
    <img
        :alt="imageAlt"
        :src="imageSource"
        class="h-[18rem] w-full rounded object-cover" />
</template>

<script lang="ts" setup>
defineProps<Props>();

interface Props {
    imageSource: string;
    imageAlt: string;
}
</script>

<style scoped></style>
