<template>
    <Meta title="Discover" />
    <PageLayoutPublic>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
            <template
                v-for="post in posts"
                :key="post.id">
                <Link
                    :href="route('post', { id: post.id })"
                    class="custom-card-image relative inline-block">
                    <CardImage
                        class="!h-[30rem] !rounded-none"
                        :image-alt="post.title"
                        :image-source="post.media?.large || ''" />
                    <div
                        class="custom-card-image-caption absolute bottom-0 left-0 w-full bg-gradient-to-t from-gray-950 transition-opacity">
                        <div class="inline-flex items-center gap-4 p-6 pt-28">
                            <img
                                referrerpolicy="no-referrer"
                                class="h-12 w-12 rounded-full bg-slate-50 object-cover"
                                :src="post?.user?.avatar"
                                :alt="post?.user?.name" />
                            <div class="flex flex-col">
                                <p class="capitalize text-white">{{ post?.user?.name }}</p>
                                <p class="text-sm text-slate-400">{{ helper.formatDate(post?.created_at) }}</p>
                            </div>
                        </div>
                    </div>
                </Link>
            </template>
        </div>
    </PageLayoutPublic>
</template>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
import CardImage from '@/components/CardImage/CardImage.vue';
import Meta from '@/components/Meta/Meta.vue';
import useHelper from '@/composables/useHelper';
import useRoute from '@/composables/useRoute';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { Post } from '@/types';

interface Props {
    posts: Post[];
}

defineProps<Props>();

const route = useRoute();
const helper = useHelper();
</script>

<style>
.custom-card-image:hover > .custom-card-image-caption {
    opacity: 0 !important;
}
</style>
