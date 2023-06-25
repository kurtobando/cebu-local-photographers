<template>
    <Head>
        <title>{{ title ?? app.name }}</title>
        <meta
            name="description"
            content="an exclusive club for cebuano photographers" />
        <slot />
    </Head>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import useApp from '@/composables/useApp';

const app = useApp();

defineProps<Props>();

interface Props {
    title?: string;
}
</script>

<style scoped></style>
