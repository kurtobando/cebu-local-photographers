<template>
    <div class="flex flex-col gap-2 rounded border border-slate-200 p-8 py-12 shadow-sm">
        <h3 class="text-xl font-semibold">{{ title }}</h3>
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
