<template>
    <Meta title="Manage Gallery" />
    <PageLayoutDashboard>
        <template #title>Manage Gallery</template>
        <template #description>Manage your recent photos, you edit or even archive your photos.</template>

        <template v-if="posts.length">
            <div class="grid grid-cols-1 gap-2 md:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="image in posts"
                    :key="image.id">
                    <template v-if="image?.status === 'draft'">
                        <Link
                            class="relative"
                            :href="route('dashboard.photos.edit', { post: image.id })">
                            <CardImage
                                :show-stats="true"
                                :image-alt="image.title"
                                :image-source="image?.media?.medium ?? ''"
                                :stats="{
                                    likes: 0,
                                    comments: 0,
                                    views: 0,
                                }" />
                            <div class="absolute bottom-0 left-0 w-full bg-black p-2 text-center text-white">
                                {{ image.status.toUpperCase() }}
                            </div>
                        </Link>
                    </template>
                    <template v-else>
                        <Link :href="route('post', { id: image.id })">
                            <CardImage
                                :show-stats="true"
                                :image-alt="image.title"
                                :image-source="image?.media?.medium ?? ''"
                                :stats="{
                                    likes: image.likes,
                                    comments: image.comments,
                                    views: image.views,
                                }" />
                        </Link>
                    </template>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="grid w-full place-content-center gap-4 rounded border border-slate-100 p-8 py-14">
                <div class="grid place-content-center">
                    <Link
                        :href="route('dashboard.photos.create')"
                        class="inline-block">
                        <Button label="Start Uploading Photos" />
                    </Link>
                </div>
                <p class="text-sm leading-relaxed text-slate-400">
                    No photo in your gallery yet, start uploading now instead.
                </p>
            </div>
        </template>
    </PageLayoutDashboard>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
import CardImage from '@/components/CardImage/CardImage.vue';
import Meta from '@/components/Meta/Meta.vue';
import useRoutes from '@/composables/useRoute';
import PageLayoutDashboard from '@/layouts/PageLayoutDashboard.vue';
import { Post } from '@/types';

interface Props {
    posts: Post[];
}

defineProps<Props>();

const route = useRoutes();
</script>

<style scoped></style>
