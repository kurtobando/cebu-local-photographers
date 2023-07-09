<template>
    <div>
        <img
            :alt="imageAlt"
            :src="imageSource"
            class="w-full h-[18rem] object-cover rounded" />
    </div>
</template>

<script lang="ts" setup>
defineProps<Props>();

interface Props {
    imageSource: string;
    imageAlt: string;
}
</script>

<style scoped></style>
