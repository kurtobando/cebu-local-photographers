<template>
    <div>
        <img
            :src="imageSource"
            :alt="imageAlt"
            class="w-full h-[25rem] object-cover rounded" />
        <div class="w-full inline-flex items-center justify-between py-4">
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
import AvatarWithName from '@/Components/AvatarWithName/AvatarWithName.vue';
import ReactionCount from '@/Components/ReactionCount/ReactionCount.vue';

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
