<template>
    <div class="flex flex-col gap-4">
        <div class="inline-flex items-center gap-4">
            <img
                :src="imageSource"
                alt="avatar image"
                class="h-16 w-16 rounded-full" />
            <p>{{ name }}</p>
        </div>
        <p class="text-sm leading-relaxed">
            {{ comment }}
            <span class="block text-accent">{{ createdAt }}</span>
        </p>
        <p class="inline-flex gap-2">
            <Heart />
            <span>{{ heart }}</span>
        </p>
    </div>
</template>

<script lang="ts" setup>
import { Heart } from 'lucide-vue-next';

defineProps<Props>();

interface Props {
    imageSource: string;
    name: string;
    comment: string;
    createdAt: string;
    heart: number;
}
</script>

<style scoped></style>
