<template>
    <Meta title="Manage Photos Gallery" />
    <section>
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
import CardAvatarImage from '@/components/CardAvatarImage/CardAvatarImage.vue';
import Meta from '@/components/Meta/Meta.vue';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';
import { Post } from '@/types';

interface Props {
    posts: Post[];
}

defineProps<Props>();
defineOptions({ layout: PageLayoutPublic });
</script>

<style scoped></style>
