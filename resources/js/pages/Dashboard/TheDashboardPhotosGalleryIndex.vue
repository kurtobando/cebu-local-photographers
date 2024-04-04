<template>
    <Meta title="Manage Photos Gallery" />
    <section class="flex flex-col gap-16 pt-24">
        <div class="flex flex-row items-center justify-center">
            <div class="w-full md:w-1/2">
                <AvatarWithProfileDescription
                    :about="post_author?.about ?? ''"
                    :image-source="post_author?.avatar ?? ''"
                    :name="post_author.name" />
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6">
            <CardAvatarImage
                v-for="(image, key) in posts"
                :key="key"
                :image-alt="image.title"
                :image-source="image?.media?.medium ?? ''" />
        </div>
    </section>
</template>

<script setup lang="ts">
import AvatarWithProfileDescription from '@/components/AvatarWithProfileDescription/AvatarWithProfileDescription.vue';
import CardAvatarImage from '@/components/CardAvatarImage/CardAvatarImage.vue';
import Meta from '@/components/Meta/Meta.vue';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { Post, PostAuthor } from '@/types';

interface Props {
    posts: Post[];
    post_author: PostAuthor;
}

defineProps<Props>();
defineOptions({ layout: PageLayoutPublic });
</script>

<style scoped></style>
