<template>
    <div class="flex flex-col gap-2 p-8 py-12 border border-slate-200 shadow-sm rounded">
        <h3 class="font-semibold text-xl">{{ title }}</h3>
        <p>{{ date }}, {{ time }}</p>
        <p>{{ location }}</p>
        <Button label="I’m Interested" />
    </div>
</template>

<script lang="ts" setup>
import Button from 'primevue/button';

defineProps<Props>();

interface Props {
    title: string;
    date: string;
    time: string;
    location: string;
}
</script>

<style scoped></style>
