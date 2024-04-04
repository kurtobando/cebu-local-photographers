<template>
    <div>
        <img
            :src="imageSource"
            :alt="imageAlt"
            class="h-[25rem] w-full rounded object-cover" />
        <div class="inline-flex w-full items-center justify-between py-4">
            <AvatarWithName
                :name="author.name"
                :image-source="author.avatar" />
            <ReactionCount
                :comment="reactions.comment"
                :heart="reactions.heart"
                :view="reactions.view" />
        </div>
    </div>
</template>

<script setup lang="ts">
import AvatarWithName from '@/components/AvatarWithName/AvatarWithName.vue';
import ReactionCount from '@/components/ReactionCount/ReactionCount.vue';

defineProps<Props>();

interface Props {
    imageSource: string;
    imageAlt: string;
    author: Author;
    reactions: Reaction;
}

interface Author {
    name: string;
    avatar: string;
}

interface Reaction {
    comment: number;
    heart: number;
    view: number;
}
</script>

<style scoped></style>
