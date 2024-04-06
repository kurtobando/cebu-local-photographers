<template>
    <Meta title="Manage Gallery" />
    <PageLayoutDashboard>
        <template #title>Manage Gallery</template>
        <template #description>Manage your recent photos, you edit or even archive your photos.</template>
        <div class="grid place-content-center">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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
        </div>
    </PageLayoutDashboard>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
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
