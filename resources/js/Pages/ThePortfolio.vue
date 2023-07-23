<template>
    <LayoutTheFold>
        <Meta title="Portfolio" />
        <template v-slot:header>
            <div class="-mt-8 grid place-content-center">
                <CardPortfolio
                    :followers="1000"
                    :posts="12"
                    about="I’m John Doe, located in Cebu. I am a freelance photographer, send me a message if you are interested."
                    image-source="https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80"
                    name="John Doe"
                    role="Contributor" />
            </div>
        </template>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6">
            <CardAvatarImage
                v-for="(image, key) in images"
                :key="key"
                :image-alt="image.alt"
                :image-source="image.source" />
        </div>
    </LayoutTheFold>
</template>

<script lang="ts" setup>
import PageLayoutPublic from '@/Layouts/PageLayoutPublic.vue';
import LayoutTheFold from '@/Layouts/LayoutTheFold.vue';
import CardAvatarImage from '@/Components/CardAvatarImage/CardAvatarImage.vue';
import CardPortfolio from '@/Components/CardPortfolio/CardPortfolio.vue';
import Meta from '@/Components/Meta/Meta.vue';

const images = [
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579521846-7e8760eafe04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=775&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1682687220305-ce8a9ab237b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
        alt: 'demo',
    },
    {
        source: 'https://plus.unsplash.com/premium_photo-1670333291486-6c29ace33919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687360441387-0179af118555?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80',
        alt: 'demo',
    },
    {
        source: 'https://plus.unsplash.com/premium_photo-1676654935906-570ac2f94180?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579521846-7e8760eafe04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=775&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1682687220305-ce8a9ab237b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
        alt: 'demo',
    },
    {
        source: 'https://plus.unsplash.com/premium_photo-1670333291486-6c29ace33919?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687360441387-0179af118555?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80',
        alt: 'demo',
    },
    {
        source: 'https://plus.unsplash.com/premium_photo-1676654935906-570ac2f94180?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687561114580-66fe98588cde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=683&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687365414421-147891bed96a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
    {
        source: 'https://images.unsplash.com/photo-1687579520892-5160c0df4b3a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=900&q=80',
        alt: 'demo',
    },
];

defineOptions({ layout: PageLayoutPublic });
</script>

<style scoped></style>
