<template>
    <div class="flex flex-col gap-2">
        <div class="inline-flex items-center gap-4">
            <img
                :src="avatar"
                alt="avatar image"
                class="h-12 w-12 rounded-full" />
            <div class="flex flex-col">
                <p class="text-sm">{{ name }}</p>
                <span class="text-sm text-accent"> {{ helper.formatDateFromNow(createdAt) }}</span>
            </div>
        </div>
        <p class="text-sm leading-relaxed">
            {{ comment }}
        </p>
        <p class="inline-flex items-center gap-2">
            <Heart :size="20" />
            <span>{{ heart }}</span>
        </p>
    </div>
</template>

<script lang="ts" setup>
import { Heart } from 'lucide-vue-next';
import useHelper from '@/composables/useHelper';

defineProps<Props>();

interface Props {
    avatar: string;
    name: string;
    comment: string;
    createdAt: string;
    heart: number;
}

const helper = useHelper();
</script>

<style scoped></style>
