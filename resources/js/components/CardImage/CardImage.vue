<template>
    <div class="relative h-[25rem] rounded">
        <template v-if="showStats">
            <div
                class="absolute left-0 top-0 grid h-full w-full place-content-center bg-black bg-opacity-40 transition-opacity hover:opacity-0">
                <div class="inline-flex items-center justify-between gap-4">
                    <div class="inline-flex gap-2 text-white">
                        <Heart />
                        <span>{{ stats?.likes || 0 }}</span>
                    </div>
                    <div class="inline-flex gap-2 text-white">
                        <MessageCircle />
                        <span>{{ stats?.comments || 0 }}</span>
                    </div>
                    <div class="inline-flex gap-2 text-white">
                        <Eye />
                        <span>{{ stats?.views || 0 }}</span>
                    </div>
                </div>
            </div>
        </template>
        <img
            referrerpolicy="no-referrer"
            :alt="imageAlt"
            :src="imageSource"
            :class="$attrs"
            class="h-full w-full object-cover" />
    </div>
</template>

<script lang="ts" setup>
import { Eye, Heart, MessageCircle } from 'lucide-vue-next';

interface Props {
    imageSource: string;
    imageAlt: string;
    showStats?: boolean;
    stats?: {
        likes: number;
        comments: number;
        views: number;
    };
}

defineProps<Props>();
</script>

<style scoped></style>
