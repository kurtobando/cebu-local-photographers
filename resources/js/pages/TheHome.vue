<template>
    <section>
        <Meta title="Discover" />
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
            <CardImage
                v-for="(image, key) in images"
                :key="key"
                :author="image.author"
                :image-alt="image.alt"
                :image-source="image.source"
                :reactions="image.reactions" />
        </div>
    </section>
</template>

<script lang="ts" setup>
import CardImage from '@/components/CardImageWithAuthor/CardImageWithAuthor.vue';
import Meta from '@/components/Meta/Meta.vue';
import PageLayoutPublic from '@/layouts/PageLayoutPublic.vue';

const images = [
    {
        alt: 'demo',
        author: {
            avatar: 'https://plus.unsplash.com/premium_photo-1664354821480-9f5038c7a4c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80',
            name: 'John Doe',
        },
        reactions: {
            comment: 5,
            heart: 10,
            view: 100,
        },
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
    },
    {
        alt: 'demo',
        author: {
            avatar: 'https://plus.unsplash.com/premium_photo-1664354821480-9f5038c7a4c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80',
            name: 'John Doe',
        },
        reactions: {
            comment: 5,
            heart: 10,
            view: 100,
        },
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
    },
    {
        alt: 'demo',
        author: {
            avatar: 'https://plus.unsplash.com/premium_photo-1664354821480-9f5038c7a4c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80',
            name: 'John Doe',
        },
        reactions: {
            comment: 5,
            heart: 10,
            view: 100,
        },
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
    },
    {
        alt: 'demo',
        author: {
            avatar: 'https://plus.unsplash.com/premium_photo-1664354821480-9f5038c7a4c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80',
            name: 'John Doe',
        },
        reactions: {
            comment: 5,
            heart: 10,
            view: 100,
        },
        source: 'https://images.unsplash.com/photo-1687579521846-7e8760eafe04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=775&q=80',
    },
    {
        alt: 'demo',
        author: {
            avatar: 'https://plus.unsplash.com/premium_photo-1664354821480-9f5038c7a4c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80',
            name: 'John Doe',
        },
        reactions: {
            comment: 5,
            heart: 10,
            view: 100,
        },
        source: 'https://images.unsplash.com/photo-1682687220305-ce8a9ab237b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
    },
    {
        alt: 'demo',
        author: {
            avatar: 'https://plus.unsplash.com/premium_photo-1664354821480-9f5038c7a4c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80',
            name: 'John Doe',
        },
        reactions: {
            comment: 5,
            heart: 10,
            view: 100,
        },
        source: 'https://plus.unsplash.com/premium_photo-1670333291486-6c29ace33919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
    },
    {
        alt: 'demo',
        author: {
            avatar: 'https://plus.unsplash.com/premium_photo-1664354821480-9f5038c7a4c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80',
            name: 'John Doe',
        },
        reactions: {
            comment: 5,
            heart: 10,
            view: 100,
        },
        source: 'https://images.unsplash.com/photo-1687360441387-0179af118555?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80',
    },
    {
        alt: 'demo',
        author: {
            avatar: 'https://plus.unsplash.com/premium_photo-1664354821480-9f5038c7a4c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80',
            name: 'John Doe',
        },
        reactions: {
            comment: 5,
            heart: 10,
            view: 100,
        },
        source: 'https://plus.unsplash.com/premium_photo-1676654935906-570ac2f94180?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
    },
];

defineOptions({ layout: PageLayoutPublic });
</script>

<style scoped></style>
