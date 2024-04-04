<template>
    <Meta title="Manage Photos Gallery" />
    <section class="flex flex-col gap-16 pt-24">
        <div class="flex flex-row items-center justify-center">
            <div class="w-full md:max-w-4xl">
                <AvatarWithProfileDescription
                    :about="post_author?.about ?? ''"
                    :image-source="post_author?.avatar ?? ''"
                    :name="post_author.name" />
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6">
            <div
                v-for="(image, key) in posts"
                :key="key">
                <Link
                    class="block"
                    :href="route('post', { id: image.id })">
                    <CardImage
                        :key="key"
                        :image-alt="image.title"
                        :image-source="image?.media?.medium ?? ''" />
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AvatarWithProfileDescription from '@/components/AvatarWithProfileDescription/AvatarWithProfileDescription.vue';
import CardImage from '@/components/CardImage/CardImage.vue';
import Meta from '@/components/Meta/Meta.vue';
import useRoute from '@/composables/useRoute';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { Post, PostAuthor } from '@/types';

interface Props {
    posts: Post[];
    post_author: PostAuthor;
}

const route = useRoute();

defineProps<Props>();
defineOptions({ layout: PageLayoutPublic });
</script>

<style scoped></style>
